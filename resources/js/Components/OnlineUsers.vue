<script setup lang="ts">
import {inject, onMounted, ref, Ref} from 'vue';
import axios from 'axios';
import {EchoServer} from "@/echo";

interface User {
    id: number;
    name: string;
    email: string;
    is_online: boolean;
    unread_count: number;
}

const onlineUsers = inject<User[]>('onlineUsers', []);
const selectedUser = inject<Ref<User | null>>('selectedUser', ref(null));

const selectUser = async (user: User) => {
    selectedUser.value = user;
    await axios.post(`/api/internal/singleChat/${user.id}/markAsRead`);
    user.unread_count = 0; // Reset unread count
};
onMounted(() => {
    onlineUsers.value.forEach((user: any) => {
        EchoServer.private(`chat.${user.id}`)
            .listen('MessageSent', (response: { message: any, unread_count: number }) => {
                const receiver = onlineUsers.value.find(u => u.id === response.message.receiver_id);
                if (receiver) {
                    receiver.unread_count = response.unread_count;
                }
            });
    });
});
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
            <span v-if="user.unread_count > 0" class="inline-flex items-center justify-center w-6 h-6 me-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                {{ user.unread_count }}
            </span>
        </a>
    </li>
</template>

<style scoped>

</style>
