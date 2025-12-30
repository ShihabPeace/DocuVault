<script setup lang="ts">
import { inject } from 'vue';
import { ref, computed, reactive } from 'vue';
import axios from 'axios';
import listrow from '../listrow.vue';
import { PerfectScrollbar } from 'vue3-perfect-scrollbar'
import 'vue3-perfect-scrollbar/style.css'
import ActivityLog from './ActivityLog.vue';
import { Documents, Actions, Users } from '@/Documents';

let labelstyle = inject('labelstyle');

let Recent = ref<Documents[]>([]);
const documents = inject<Documents[]>('documents', []);

const allActivities = computed(() => [...documents, ...Recent.value]);
const unseen = computed(() => allActivities.value.filter(item => !item.checked));
const seen = computed(() => allActivities.value.filter(item => item.checked));

function getclrcls(evnt_type: string) {
    switch (evnt_type) {
        case 'created':
            return 'bg-green-500';
        case 'published':
            return 'bg-blue-500';
        case 'updated':
            return 'bg-yellow-500';
        case 'deleted':
            return 'bg-red-500';
        case 'viewed':
            return 'bg-gray-500';
        default:
            return 'bg-slate-500';
    }
}

function uncheck(doc:any){
//    document_id.checked != document_id.checked
console.log(doc);
}

let listrowstyle = 'flex flex-col gap-1'
</script>

<template>
    <div class="h-full flex flex-col border border-white rounded-md p-2 ">
        <p :class="labelstyle">Activity Log</p>
       
        <!-- Scrollable container -->
        <PerfectScrollbar class="flex-1 mt-2">
            <listrow class="flex flex-col gap-1">
                <div v-if="unseen.length || seen.length">
                    <div id="unseen" v-for="doc in unseen" :key="doc.id">
                        <div v-for="act in doc.user.action" :key="act.id">
                            <a @click.prevent="uncheck(act.id)" :href="doc.link" class="px-3 text-[0.5em] sm:text-[0.6em] md:text-[0.6em] lg:text-[0.65em] xl:text-[0.7em] font-bold py-1 text-black border block rounded-md relative"
                                :class="getclrcls(act.event_type)">
                                {{ doc.content }} {{ act.event_type }} by {{ doc.user.name }} ({{ doc.user.role }}) <br>
                                {{ act.created_at }}
                                <div
                                    class="right-[5px] top-[5px] size-[6px] rounded-xl absolute border-1 border-white  bg-red-500">
                                </div>
                            </a>
                        </div>
                    </div>

                    <div id="seen" v-for="doc in seen" :key="doc.id">
                        <div v-for="act in doc.user.action" :key="act.id">
                            <div class="px-3 text-[0.5em] sm:text-[0.6em] md:text-[0.6em] lg:text-[0.65em] xl:text-[0.7em] font-bold py-1 text-black border rounded-md relative"
                                :class="getclrcls(act.event_type)">
                                {{ doc.content }} {{ act.event_type }} by {{ doc.user.name }} ({{ doc.user.role }}) <br>
                                {{ act.created_at }}

                            </div>
                        </div>
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