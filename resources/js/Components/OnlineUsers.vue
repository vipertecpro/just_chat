<script setup lang="ts">
import {onMounted, ref} from 'vue';
import axios from 'axios';
import {Link, usePage} from '@inertiajs/vue3';
interface User {
    id: number;
    name: string;
    email: string;
    is_online: boolean;
}

const state = ref<{ onlineUsers: User[] }>({
    onlineUsers: [],
});
const fetchOnlineUsers = () => {
    axios.post('/api/internal/online-users').then(response => {
        state.value.onlineUsers = response.data;
    });
};
onMounted(() => {
    fetchOnlineUsers();
    window.addEventListener('load',  () =>{
        window.Echo.channel('online-users')
            .listen('UserStatusChanged', (e) => {
                fetchOnlineUsers();
            });
    });
});
</script>

<template>
    <li class="p-2" v-for="user in state.onlineUsers" :key="user.id">
        <Link :href="route('oneOnOneConversation')" class="flex items-center space-x-2 rtl:space-x-reverse">
            <div class="flex-shrink-0">
                <div class="relative">
                    <img class="w-10 h-10 rounded-full" src="/avatar-person.svg" alt="{{ user.name }}">
                    <span v-if="user.is_online" class="top-0 left 7 absolute w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                    <span v-else class="top-0 left 7 absolute w-3.5 h-3.5 bg-gray-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                    {{ user.name }}
                </p>
                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                    {{ user.email }}
                </p>
            </div>
            <div class="inline-flex items-center text-sm font-semibold text-gray-500">

            </div>
        </Link>
    </li>
</template>

<style scoped>

</style>
