<script setup lang="ts">
import { ref, computed,inject } from 'vue';
import axios from 'axios';
import listrow from '../listrow.vue';
import { PerfectScrollbar } from 'vue3-perfect-scrollbar'
import 'vue3-perfect-scrollbar/style.css'
import ActivityLog from './ActivityLog.vue';
import { Documents, Actions, Users } from '@/dbschema';
import { route, Route } from 'ziggy-js';




let labelstyle = inject('labelstyle');

let Recent = ref<Documents[]>([]);
const documents = inject<Documents[]>('documents', []);

const allActivities = computed(() => [...documents, ...Recent.value]);


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

// async function dbuncheck(actid: number) {
//     try {

//         let res = await axios.post(route('checked', {}, undefined, Ziggy), { actid });

//         console.log('res',res.data.error);

//     } catch (error: any) {
//         console.log('exeption->',error,actid)
//     }
// }

async function dbuncheck(actid: number) {
    try {
        const res = await axios.post(route('checked'), { 'actid':actid });

        console.log('dbuncheck response:', res.data);
        return res; // return it for awaiting
    } catch (error: any) {
        if (error.response) {
            console.log('validation errors:', error.response.data.errors);
            console.log('Controller error message:', error.response.data.error);
            console.log('Message:', error.response.data.message);
        } else {
            console.log('Unexpected error:', error.message);
        }
        throw error; // rethrow if you want to handle it in uncheck
    }
}


// function uncheck(id: number) {
//     let trgtelmt = allActivities.value.find(doc => doc.user.action.find(b => b.id === id))

//     if (trgtelmt) {
//         const trgtact = trgtelmt.user.action.find(actobj => actobj.id === id);
//         trgtact ? trgtact.checked = 1 : trgtact
//         console.log('trgtact->',trgtact?.checked)
//         console.log('function->',dbuncheck(id))

//     }
// }


async function uncheck(id: number) {
    let trgtelmt = allActivities.value.find(doc => doc.user?.action?.some(act => act.id === id));

    if (!trgtelmt || !trgtelmt.user?.action) return; // safety check

    const trgtact = trgtelmt.user.action.find(act => act.id === id);

    if (trgtact) {
        trgtact.checked = 1; // update local state
        console.log('trgtact.checked->', trgtact.checked,'trgtact->', trgtact,'actid->', id,'dashboard->',route('checked'));
        try {
            const res = await dbuncheck(id);
            console.log('dbuncheck response:', res?.data);
        } catch (e) {
            console.error('dbuncheck failed', e);
        }
    }
}


let listrowstyle = 'flex flex-col gap-1'
</script>

<template>
    <div class="h-full flex flex-col border border-white rounded-md p-2 ">
        <p :class="labelstyle">Activity Log </p>
        <!--  -->
        <!-- Scrollable container :href="doc.link"-->
        <PerfectScrollbar class="flex-1 mt-2">
            <listrow class="flex flex-col gap-1">
                <div v-if="allActivities.length">
                    <div id="unseen" v-for="doc in allActivities" :key="doc.id">
                        <div v-for="act in doc.user.action" :key="act.id">
                            <div v-if="act.checked === 0">
                                <a href="#" @click="uncheck(act.id)"
                                    class="px-3 text-[0.5em] sm:text-[0.6em] md:text-[0.6em] lg:text-[0.65em] xl:text-[0.7em] font-bold py-1 text-black border block rounded-md relative"
                                    :class="getclrcls(act.event_type)">
                                    {{ act.filename }} was {{ act.event_type }} by {{ doc.user.name }} ({{ doc.user.role
                                    }})
                                    <br>
                                    {{ act.created_at }}
                                    <div
                                        class="right-[5px] top-[5px] size-[6px] rounded-xl absolute border-1 border-white  bg-red-500">
                                    </div>
                                </a>
                            </div>
                            <div v-else>
                            </div>
                        </div>
                    </div>
                    <div id="seen" v-for="doc in allActivities" :key="doc.id">
                        <div v-if="allActivities.length">
                            <div v-for="act in doc.user.action" :key="act.id">
                                <div v-if="act.checked === 1">
                                    <a href="#" @click="uncheck(act.id)"
                                        class="px-3 text-[0.5em] sm:text-[0.6em] md:text-[0.6em] lg:text-[0.65em] xl:text-[0.7em] font-bold py-1 text-black border block rounded-md relative"
                                        :class="getclrcls(act.event_type)">
                                        {{ doc.filename }} was {{ act.event_type }} by {{ doc.user.name }} ({{
                                            doc.user.role }})
                                        <br>
                                        {{ act.created_at }}
                                    </a>
                                </div>
                                <div v-else>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <p class="text-white">No activities found.</p>
                        </div>
                    </div>
                </div>
            </listrow>
        </PerfectScrollbar>
    </div>
</template>

<style scoped></style> <!-- @click.prevent="uncheck(act.id)" -->
