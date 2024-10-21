<script setup lang="ts">
import { ref, provide, onMounted, watch } from 'vue';
import axios from 'axios';
import { usePage } from '@inertiajs/vue3';
import OnlineUsers from '@/Components/OnlineUsers.vue';
import OneOnOneChat from '@/Pages/OneOnOneChat.vue';
import { Link } from '@inertiajs/vue3';
import { EchoServer } from '@/echo';

interface User {
    id: number;
    name: string;
    email: string;
    is_online: boolean;
    unread_count: number;
}

const user = usePage().props.auth.user as User;
const onlineUsers = ref<User[]>([]);
const isFetched = ref(false);
const selectedUser = ref<User | null>(null);

const fetchOnlineUsers = async () => {
    if (!isFetched.value) {
        const response = await axios.post('/api/internal/online-users');
        onlineUsers.value = response.data;
        isFetched.value = true;
    }
};

const selectUser = (user: User) => {
    selectedUser.value = user;
};

const closeChat = () => {
    selectedUser.value = null;
};

onMounted(() => {
    EchoServer.channel('online-users')
        .listen('UserStatusChanged', fetchOnlineUsers);
    fetchOnlineUsers();
});

provide('onlineUsers', onlineUsers);
provide('fetchOnlineUsers', fetchOnlineUsers);
provide('selectedUser', selectedUser);
provide('selectUser', selectUser);
provide('closeChat', closeChat);
</script>
<template>
    <div>
        <div class="flex justify-between h-full xl:h-[calc(100vh-38px)] w-full xl:w-[calc(100vw-38px)] xl:max-w-[1600px] top-0 xl:top-[19px] bg-gray-100 dark:bg-gray-900 mx-auto  overflow-hidden relative gap-1 ">
            <aside id="sidebar-double" class="flex z-40 absolute w-[35rem] h-full xl:h-[calc(100vh-38px)] transition-transform -translate-x-full xl:translate-x-0" aria-label="Sidebar">
                <div class="z-30 py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-between">
                    <ul class="space-y-2">
                        <li>
                            <Link :href="route('dashboard')" class="flex items-center p-2 text-gray-400 rounded-lg transition duration-75 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            </Link>
                        </li>
                    </ul>
                    <ul class="space-y-2">
                        <li>
                            <button id="mega-menu-icons-dropdown-button" data-dropdown-toggle="mega-menu-icons-dropdown" data-dropdown-offset-distance="10" data-dropdown-offset-skidding="100" data-dropdown-placement="right" class="flex items-center p-2 text-gray-400 rounded-lg transition duration-75 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"> <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                            </button>
                            <div id="mega-menu-icons-dropdown" class="absolute z-10 grid hidden w-auto grid-cols-1 text-sm bg-white border border-gray-100 rounded-lg shadow-md dark:border-gray-700 dark:bg-gray-700">
                                <div class="p-4 text-gray-900 md:pb-4 dark:text-white">
                                    <div class="pb-4 text-sm text-gray-900 dark:text-white">
                                        <div class="font-medium ">{{ user.name }}</div>
                                        <div class="truncate">{{ user.email }}</div>
                                    </div>
                                    <ul class="space-y-4" aria-labelledby="mega-menu-icons-dropdown-button">
                                        <li>
                                            <Link :href="route('profile.edit')" class="flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-500 group">
                                                <span class="sr-only">My Profile</span>
                                                <svg class="w-3 h-3 me-2 text-gray-400 dark:text-gray-500 group-hover:text-blue-600 dark:group-hover:text-blue-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                                </svg>
                                                My Profile
                                            </Link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li>
                            <Link
                                 :href="route('logout')"
                                 method="post"
                                 as="button"
                                 class="flex items-center p-2 text-gray-400 rounded-lg transition duration-75 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                 <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/></svg>
                            </Link>
                        </li>
                    </ul>
                </div>
                <div id="secondary-sidenav" class="flex flex-col relative py-5 max-w-full w-full h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-col justify-start w-full max-w-full items-start gap-2 text-start  px-2">
                        <h4 class="text-2xl font-extrabold text-gray-700 dark:text-white">Chats</h4>
                        <div class="flex flex-col items-start justify-start gap-2 w-full max-w-full">
                            <form class="flex-1 justify-start w-full">
                                <label for="default-search" class="sr-only text-sm font-medium text-gray-900 dark:text-white">Search</label>
                                <div class="relative w-full">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg aria-hidden="true" class="h-5 w-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <input type="search" id="default-search" class="flex w-full rounded-lg border border-gray-300 bg-white p-2 pl-12 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Search" required />
                                </div>
                            </form>
                            <div class="flex flex-row justify-start max-w-fit w-full py-2 gap-2">
                                <span class="bg-gray-100 text-gray-800 text-sm md:text-md font-medium me-2 px-2 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">All</span>
                                <span class="bg-gray-100 text-gray-800 text-sm md:text-md font-medium me-2 px-2 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">Unread</span>
                                <span class="bg-gray-100 text-gray-800 text-sm md:text-md font-medium me-2 px-2 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">Favorites</span>
                                <span class="bg-gray-100 text-gray-800 text-sm md:text-md font-medium me-2 px-2 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">Groups</span>
                            </div>
                        </div>
                    </div>
                    <div class="pt-2 pb-40 h-full w-full overflow-y-auto">
                        <ul class="w-full max-w-full">
                            <OnlineUsers />
                        </ul>
                    </div>
                </div>
            </aside>
            <div class="w-full h-auto overflow-y-auto xl:ml-[35rem]">
                <button data-drawer-target="sidebar-double" data-drawer-toggle="sidebar-double" aria-controls="sidebar-double" type="button" class="absolute items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 z-20">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>
                <div v-if="selectedUser">
                    <OneOnOneChat :friend="selectedUser" :current-user="user" @closeChat="closeChat" />
                </div>
                <div v-else>
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>

