<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import {Link} from '@inertiajs/inertia-vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
    products: Object
})
</script>

<template>
    <AppLayout title="รายการสินค้า">
        <div class="flex justify-end mb-3">
            <Link class="btn btn-sm" :href="route('backoffice.products.create')">Create</Link>
        </div>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                รายการสินค้า
            </h2>
        </template>

        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-base text-gray-700 bg-gray-300/80 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            ชื่อสินค้า
                        </th>
                        <th scope="col" class="py-3 px-6">
                            SKU/Barcode
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Price
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Status
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody v-if="products.data.length">
                    <tr v-for="(product, index) in products.data"
                        class="bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                        :class="{ 'border-b': index !== products.length }"
                    >
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded mr-2" :src="product.main_image" alt="Default avatar">

                                {{ product.name }}
                            </div>
                        </th>
                        <td class="py-4 px-6">
                            <div class="text-gray-900">SKU: <strong>{{ product.sku }}</strong></div>
                            <div>Barcode: <strong>{{ product.barcode }}</strong></div>
                        </td>
                        <td class="py-4 px-6 text-left">
                            {{ $comma(product.price) }}
                        </td>
                        <td class="py-4 px-6">
                            {{ product.status_label }}
                        </td>
                        <td class="py-4 px-6 text-right">
                            <Link :href="route('backoffice.products.edit', { product: product.id })" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr>
                        <td colspan="5" class="text-center py-3 px-6">ไม่มีสินค้า</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <Pagination
            :prev-url="products.prev_page_url"
            :next-url="products.next_page_url"
            class="mt-5 justify-end"
        />
    </AppLayout>

</template>
