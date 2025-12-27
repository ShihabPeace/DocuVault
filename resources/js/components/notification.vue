<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { inject } from 'vue';
const { props } = usePage()
var route = (props.route as any)
let tab_class = inject("tab-class")
const attrprops = defineProps({
    imgsrc: String,
    href: String
})

</script>

<template>
    <a :href="href" :class="tab_class">  
        <img class="size-full object-cover" :src="imgsrc" alt="">
    </a>
</template>

<style scoped></style>