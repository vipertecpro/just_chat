<script setup lang="ts">
import axios from "axios";
import { nextTick, onMounted, ref, watch } from "vue";
import { EchoServer } from "@/echo";
import { PresenceChannel } from 'laravel-echo';

interface User {
    id: number;
    name: string;
}

interface Message {
    id: number;
    sender_id: number;
    receiver_id: number;
    text: string;
    created_at_relative: string;
}

const props = defineProps<{
    friend: User;
    currentUser: User;
}>();

const messages = ref<Message[]>([]);
const newMessage = ref("");
const messageBox = ref<HTMLDivElement | null>(null);
const isFriendTyping = ref(false);
const isFriendTypingTimer = ref<number | null>(null);
const isFriendOnline = ref(false);

const scrollToBottom = () => {
    nextTick(() => {
        if (messageBox.value) {
            messageBox.value.scrollTo({
                top: messageBox.value.scrollHeight,
                behavior: "smooth",
            });
        }
    });
};

watch(messages, scrollToBottom, { deep: true });

const fetchMessages = async () => {
    const response = await axios.get(`/api/internal/singleChat/${props.friend.id}`);
    messages.value = response.data.filter((message: Message) =>
        (message.sender_id === props.currentUser.id && message.receiver_id === props.friend.id) ||
        (message.sender_id === props.friend.id && message.receiver_id === props.currentUser.id)
    );
    scrollToBottom();
};

const sendMessage = async () => {
    if (newMessage.value.trim() !== "") {
        const response = await axios.post(`/api/internal/singleChat/${props.friend.id}`, {
            message: newMessage.value,
        });
        const newMsg: Message = {
            id: response.data.id,
            sender_id: response.data.sender_id,
            receiver_id: response.data.receiver_id,
            text: response.data.text,
            created_at_relative: response.data.created_at_relative,
        };
        messages.value.push(newMsg);
        newMessage.value = "";
        scrollToBottom();
    }
};

const sendTypingEvent = () => {
    (EchoServer.private(`chat.${props.friend.id}`) as PresenceChannel).whisper("typing", {
        userID: props.currentUser.id,
    });
};

onMounted(() => {
    fetchMessages();
    watch(() => props.friend, fetchMessages);
});

EchoServer.private(`chat.${props.currentUser.id}`)
    .listen("MessageSent", (response: { message: Message, unread_count: number }) => {
        if ((response.message.sender_id === props.currentUser.id && response.message.receiver_id === props.friend.id) ||
            (response.message.sender_id === props.friend.id && response.message.receiver_id === props.currentUser.id)) {
            messages.value.push(response.message);
            scrollToBottom();
        }
    })
    .listenForWhisper("typing", (response: { userID: number }) => {
        isFriendTyping.value = response.userID === props.friend.id;

        if (isFriendTypingTimer.value) {
            clearTimeout(isFriendTypingTimer.value);
        }

        isFriendTypingTimer.value = window.setTimeout(() => {
            isFriendTyping.value = false;
        }, 1000);
    });
</script>

<template>
    <div v-if="friend" class="flex flex-col justify-between items-center rounded-lg h-[100vh] xl:h-[calc(100vh-38px)] relative">
        <div class="flex w-full justify-start items-center dark:bg-gray-700 gap-2 p-2 border-b dark:border-gray-700 pl-16 xl:pl-2">
            <img src="/avatar-person.svg" alt="User" class="w-10 h-10 rounded-full" />
            <h2 class="text-lg dark:text-gray-200">{{ friend.name }}</h2>
        </div>
        <div class="flex-1 w-full overflow-y-auto p-4" ref="messageBox" style="max-height: calc(100vh - 120px);">
            <div v-for="message in messages" :key="message.id">
                <div v-if="message.sender_id === currentUser.id" class="flex items-start gap-2.5 justify-end">
                    <div class="flex flex-col gap-2 w-full max-w-[320px] mb-2">
                        <div class="p-4 bg-blue-100 text-gray-900 dark:bg-gray-700 dark:text-white rounded-lg">
                            {{ message.text }}
                            <div class="flex items-center justify-end space-x-2 rtl:space-x-reverse">
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ message.created_at_relative }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else class="flex items-start gap-2.5 justify-start mb-2">
                    <div class="flex flex-col gap-1 w-full max-w-[320px]">
                        <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-900 dark:text-white">
                            {{ message.text }}
                            <div class="flex items-center justify-end space-x-2 rtl:space-x-reverse">
                                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ message.created_at_relative }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <small v-if="isFriendTyping" class="text-gray-700 dark:text-gray-500 h-fit w-full flex px-2 my-2">
            {{ friend.name }} is typing...
        </small>
        <form class="w-full bottom-0 p-2 bg-gray-50 dark:bg-gray-800" @submit.prevent="sendMessage">
            <div class="flex items-center">
                <input
                    id="chat"
                    v-model="newMessage"
                    class="block p-2.5 w-full text-sm bg-white border rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                    placeholder="Type a message..."
                    @keydown="sendTypingEvent"
                    @keyup.enter="sendMessage"
                />
                <button type="button" @click="sendMessage" class="ml-2 p-2 text-blue-600 rounded-full dark:text-blue-500">
                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
    <div v-else>
        <p>No friend selected.</p>
    </div>
</template>
