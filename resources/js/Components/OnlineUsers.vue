<script setup lang="ts">
import { inject, ref, Ref } from 'vue';
import { Link } from '@inertiajs/vue3';

interface User {
    id: number;
    name: string;
    email: string;
    is_online: boolean;
}

const onlineUsers = inject<User[]>('onlineUsers', []);
const selectedUser = inject<Ref<User | null>>('selectedUser', ref(null));

const selectUser = (user: User) => {
    selectedUser.value = user;
};
</script>

<template>
    <li class="hover:bg-gray-900" v-for="user in onlineUsers" :key="user.id">
        <a @click.prevent="selectUser(user)" class="flex items-center rtl:space-x-reverse">
            <div class="flex-shrink-0 px-4">
                <div class="relative">
                    <img class="w-10 h-10 rounded-full" src="/avatar-person.svg" alt="{{ user.name }}">
                    <span v-if="user.is_online" class="top-0 left 7 absolute w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                    <span v-else class="top-0 left 7 absolute w-3.5 h-3.5 bg-gray-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                </div>
            </div>
            <div class="flex-1 min-w-0 gap-4 border-b dark:border-gray-700 space-y-1  p-2">
                <p class="text-md font-medium text-gray-900 truncate dark:text-white">
                    {{ user.name }}
                </p>
                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                    {{ user.email }}
                </p>
            </div>
        </a>
    </li>
</template>

<style scoped>

</style>
