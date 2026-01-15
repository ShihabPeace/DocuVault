<script setup lang="ts">
import { ref } from 'vue';
import { inject } from 'vue';
import { usePage } from '@inertiajs/vue3';
import SearchBar from './search-bar.vue'
import Tab from './tab.vue';
import Logo from './logo.vue';
import notification from './notification.vue';





</script>
<!-- navbar: -->
<template>

    <div class="p-4 xl:p-5 lg:p-3 p-2 xl:p-3 col-start-1 col-end-17 justify-between border-white w-full flex flex-row">
        <Logo title="DocuVault"/>
        <div class="transition-all justify-between sm:w-[30%] md:w-[40%]  items-center flex">
            <notification title="Notifications" imgsrc="images/notify.png"/>
            <Tab title="Upload" imgsrc="images/upload.png"/>
            <Tab title="Profile" imgsrc="images/user.png" />
        </div>
        <SearchBar title="Search"/>
    </div>

</template>
