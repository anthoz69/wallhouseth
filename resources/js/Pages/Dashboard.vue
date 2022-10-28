<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import DefaultCard from '@/Layouts/DefaultCard.vue'

const props = defineProps({
    'user_count': Number,
    'product_count': Number,
    'order_count': Number,
})
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="flex flex-row space-x-4 justify-center">
            <div class="basis-4/12">
                <div class="card bg-white text-center px-4 py-7 shadow">
                    <div class="text-4xl">{{ $comma(props.user_count) }}</div>
                    <div class="text-sm text-gray-400 mt-1">Total users</div>
                </div>
            </div>
            <div class="basis-4/12">
                <div class="card bg-white text-center px-4 py-7 shadow">
                    <div class="text-4xl">{{ $comma(props.product_count) }}</div>
                    <div class="text-sm text-gray-400 mt-1">Total products</div>
                </div>
            </div>
            <div class="basis-4/12">
                <div class="card bg-white text-center px-4 py-7 shadow">
                    <div class="text-4xl">{{ $comma(props.order_count) }}</div>
                    <div class="text-sm text-gray-400 mt-1">Total orders</div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
