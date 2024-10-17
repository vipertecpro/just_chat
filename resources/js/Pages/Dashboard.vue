<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="flex flex-col justify-between items-center rounded-lg h-[calc(100vh-38px)] relative">
            <div class="bg-gray-800 w-full h-full p-14 dark:bg-gray-800 overflow-y-auto flex flex-col gap-4">
                <div class="flex items-start gap-2.5 justify-start">
                    <div class="flex flex-col gap-1 w-full max-w-[320px]">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">Bonnie Green</span>
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">11:46</span>
                        </div>
                        <div class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                            <p class="text-sm font-normal text-gray-900 dark:text-white"> That's awesome. I think our users will really appreciate the improvements.</p>
                        </div>
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Delivered</span>
                    </div>
                </div>
                <div class="flex items-start gap-2.5 justify-end">
                    <div class="flex flex-col gap-1 w-full max-w-[320px]">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">Bonnie Green</span>
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">11:46</span>
                        </div>
                        <div class="flex flex-col leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                            <p class="text-sm font-normal text-gray-900 dark:text-white"> That's awesome. I think our users will really appreciate the improvements.</p>
                        </div>
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Delivered</span>
                    </div>
                </div>
            </div>
            <form class="absolute w-full bottom-0">
                <label for="chat" class="sr-only">Your message</label>
                <div class="flex items-center px-3 py-2 bg-gray-50 dark:bg-gray-800">
                    <input id="chat" rows="1" class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Your message..." />
                        <button type="submit" class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600">
                        <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                        </svg>
                        <span class="sr-only">Send message</span>
                    </button>
                </div>
            </form>

        </div>
    </AuthenticatedLayout>
</template>
