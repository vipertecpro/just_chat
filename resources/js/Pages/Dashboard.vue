<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="flex flex-row justify-center items-center rounded-lg h-[100vh] xl:h-[calc(100vh-38px)] relative">
            <div class="flex flex-row justify-center items-center bg-gray-800 w-full h-full dark:bg-gray-800 overflow-y-auto gap-4">
                <h1 class="text-8xl font-extrabold w-fit bg-gradient-to-r from-blue-500 via-teal-500 to-pink-500 bg-clip-text box-content text-transparent text-center select-none [text-shadow:_0_0_10px_rgb(255_255_255_/_40%)]">JUST-CHAT</h1>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
