<script setup lang="ts">
</script>

<template>
    <div>
        <div class="flex h-full xl:h-[calc(100vh-38px)] w-full xl:w-[calc(100vw-38px)] xl:max-w-[1600px] top-0 xl:top-[19px] bg-gray-100 dark:bg-gray-900 mx-auto  overflow-hidden relative">
            <aside id="sidebar-double" class="flex z-40 absolute h-full xl:h-[calc(100vh-38px)] transition-transform -translate-x-full xl:translate-x-0" aria-label="Sidebar">
                <div class="z-30 py-5 px-3 w-16 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-between">
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="flex items-center p-2 text-gray-400 rounded-lg transition duration-75 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-2 text-gray-400 rounded-lg transition duration-75 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-2 text-gray-400 rounded-lg transition duration-75 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-2 text-gray-400 rounded-lg transition duration-75 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-2 text-gray-400 rounded-lg transition duration-75 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            </a>
                        </li>
                    </ul>
                    <ul class="space-y-2">
                        <li>
                            <a href="#" class="flex items-center p-2 text-gray-400 rounded-lg transition duration-75 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.707 7.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l2-2a1 1 0 00-1.414-1.414L11 7.586V3a1 1 0 10-2 0v4.586l-.293-.293z"></path><path d="M3 5a2 2 0 012-2h1a1 1 0 010 2H5v7h2l1 2h4l1-2h2V5h-1a1 1 0 110-2h1a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-2 text-gray-400 rounded-lg transition duration-75 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <div id="secondary-sidenav" class="flex flex-col relative py-5 px-2 max-w-full w-full h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-col justify-start w-full max-w-fit items-start gap-2 text-start">
                        <h4 class="text-2xl font-extrabold text-gray-700 dark:text-white">Chats</h4>
                        <div class="flex flex-col items-start justify-start gap-2 w-full max-w-fit">
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
                        <ul class="w-full max-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <li class="p-2">
                                <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                    <div class="flex-shrink-0">
                                        <img class="w-10 h-10 rounded-full" src="/avatar-person.svg" alt="Neil image">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            Neil Sims
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            email@flowbite.com
                                        </p>
                                    </div>
                                    <div class="inline-flex items-center text-sm font-semibold text-gray-500">
                                        $320
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <div class="grid grid-cols-1 bg-gray-50 dark:bg-gray-800 w-full h-full">
                <div class="col-span-1 bg-gray-50 dark:bg-gray-700 w-screen h-screen space-y-4">
                    <button data-drawer-target="sidebar-double" data-drawer-toggle="sidebar-double" aria-controls="sidebar-double" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
