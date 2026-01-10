<script setup lang="ts">
import { computed, inject } from 'vue';
import { PerfectScrollbar } from 'vue3-perfect-scrollbar';
import { Documents } from '@/Documents';
import listrow from '@/components/listrow.vue';
const documents = inject<Documents[]>('documents', []);

let PendingDocs = computed(() => documents.filter(doc => doc.status === 'pending'));

let labelstyle = inject('labelstyle');
</script>

<template>
    <div class="h-full flex flex-col border border-white rounded-md p-2 ">
        <p :class="labelstyle">Pending Documents</p>
        <PerfectScrollbar class="flex-1 mt-2">
            <listrow class="flex flex-col gap-1">
                <div v-if="PendingDocs.length">
                    <div id="PendingDocs" v-for="doc in PendingDocs" :key="doc.id">
                        <a href="#" class="px-3 bg-blue-500 text-[0.5em] sm:text-[0.6em] md:text-[0.6em] lg:text-[0.65em] xl:text-[0.7em] font-bold py-1 text-black border block rounded-md relative">
                            {{ doc.file }}
                        </a>
                    </div>
                </div>
                <div v-else>
                    <p class="text-white">No activities found.</p>
                </div>

            </listrow>
        </PerfectScrollbar>
    </div>

</template>

<style scoped></style>