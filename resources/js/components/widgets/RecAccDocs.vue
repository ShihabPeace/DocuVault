<script setup lang="ts">
import { inject } from 'vue';

let labelstyle = inject('labelstyle');
</script>

<template>
    <p :class="labelstyle">Recently Viewed</p>
</template>

<style scoped></style>