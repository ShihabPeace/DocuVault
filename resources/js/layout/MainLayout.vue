<script setup lang="ts">
import { ref, provide } from "vue";
import TopNavbar from "@/components/TopNavbar.vue";
import LeftSidebar from "@/components/LeftSidebar.vue";

provide("tab-class", "transition-all flex xl:size-10 justify-center items-center size-[40px] bg-white rounded-[10px] mx-2 p-2")

</script>
<!-- mainlayout -->
<template >
    <div id="container" class="grid  grid-cols-[0.5fr_repeat(15,1fr)] grid-rows-[repeat(15,1fr)]  bg-stone-800 h-dvh">
        <TopNavbar />
        <LeftSidebar />
        <slot />
    </div>
</template>
