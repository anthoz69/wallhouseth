<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
    file_url: String
})

const form = useForm({
    file: null
})

const onSubmitHandle = () => {
    form.post(route('backoffice.products.import.store'))
}
</script>

<template>
    <AppLayout title="รายการสินค้า">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                นำเข้า Excel
            </h2>
        </template>

        <div class="bg-white rounded-lg border border-gray-200 shadow-md">
            <form @submit.prevent="onSubmitHandle" class="py-5 px-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="user_avatar">
                    อัพโหลดไฟล์
                </label>
                <input class="block w-full text-md text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 mb-3" aria-describedby="user_avatar_help" id="user_avatar" type="file" @input="form.file = $event.target.files[0]" required>

                <div class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                    ดาวโหลดไฟล์ Template สำหรับ Import <a class="text-blue-600 font-bold hover:underline" :href="file_url" target="_blank">template-import-product.xlsx</a>
                </div>

                <div class="text-red-400 mt-1" v-if="form.errors.file">{{ form.errors.file }}</div>

                <div class="flex justify-end">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                        :disabled="form.processing"
                    >อัพโหลด</button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
