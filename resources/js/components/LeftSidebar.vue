<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import tab from './tab.vue';



</script>

<template>
    <div
        class="col-span-3 sm:col-span-3 md:col-span-2 lg:col-span-2 xl:col-span-2 row-start-2 sm:row-start-2 md:row-start-3 lg:row-start-2 row-end-16 sm:row-end-15 flex flex-col flex-nowrap items-center justify-between gap-3 py-6 -px-9">
        <tab title="Dashboard" imgsrc="images/dashboard.png" />
        <tab title="Workflow" imgsrc="images/workflow.png" />
        <tab title="Audit" imgsrc="images/audit.png" />
        <tab title="Roles" imgsrc="images/roles.png" />
        <tab title="Settings" imgsrc="images/settings.png" />
    </div>
</template>
