<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import UserCigars from '@/Components/UserCigars.vue';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>

        dahslboar

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        User cigars component:
        <UserCigars></UserCigars>

    </AuthenticatedLayout>
</template>
