<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import DefaultCard from '@/Layouts/DefaultCard'
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <DefaultCard>
            <Welcome />
        </DefaultCard>
    </AppLayout>
</template>
