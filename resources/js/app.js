import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

import.meta.glob([
    '../assets/**'
])

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const instant = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)

        instant.config.globalProperties.$currency = (number) => {
            const formatter = new Intl.NumberFormat('th', {
                style: 'currency',
                currency: 'THB',
            })

            return formatter.format(number)
        }

        instant.config.globalProperties.$comma = (number) => {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }

        return instant.mount(el)
    },
});

InertiaProgress.init({ color: '#4B5563' });
