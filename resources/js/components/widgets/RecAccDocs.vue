<script setup lang="ts">
import { ref, computed, reactive } from 'vue';
import axios from 'axios';
import listrow from '../listrow.vue';
import { PerfectScrollbar } from 'vue3-perfect-scrollbar'
import 'vue3-perfect-scrollbar/style.css'
import ActivityLog from './ActivityLog.vue';
let labelstyle = 'text-white text-[0.7em] font-bold'
interface ModelActivity {
    id: number,
    indicolor: string,
    content: string,
    user: string,
    link: string,
    role: string,
    date: Date,
    checked: boolean
}
const props = defineProps<{ activity?: ModelActivity[] }>();

// Ensure props.activity is always an array
const jsActivity: ModelActivity[] = props.activity ?? [];

// Make Recent reactive and safe (empty array initially)
let Recent = ref<ModelActivity[]>([
    {
        id: 1,
        indicolor: 'bg-green-500',
        content: 'New Document Created',
        user: 'John Doe',
        link: '#',
        role: 'Admin',
        date: new Date(),
        checked: false
    },
    {
        id: 2,
        indicolor: 'bg-red-500',
        content: 'Document Deleted',
        user: 'Jane Smith',
        link: '#',
        role: 'User',
        date: new Date(),
        checked: true
    },
    {
        id: 3,
        indicolor: 'bg-blue-500',
        content: 'Document Updated',
        user: 'Alice Johnson',
        link: '#',
        role: 'Editor',
        date: new Date(),
        checked: false
    }
]);

// let seen = props.props.activity.filter(item => item.checked === true)
// let unseen = props.props.activity.filter(item => item.checked === false)
// let unseen = computed(()=>(props.activity?.filter(item => item.checked === false)) || [])
// let seen = computed(()=>(props.activity.filter(item => item.checked === true)))
const allActivities = computed(() => [...jsActivity, ...Recent.value]);
const unseen = computed(() => allActivities.value?.filter(item => !item.checked)||[]);
const seen = computed(() => allActivities.value?.filter(item => item.checked)||[]);



// function uncheck(item)
//    item.checked != item.checked
// }

let listrowstyle = 'flex flex-col gap-1'
</script>

<template>
    <div class="h-full flex flex-col border border-white rounded-md p-2 ">
        <p :class="labelstyle">Recent Activity</p>
        <!-- Scrollable container -->
        <PerfectScrollbar class="flex-1 mt-2">
            <listrow class="flex flex-col gap-1">
                <div v-if="unseen.length || seen.length">
                <div  id="unseen" v-for="item in unseen" :key="item.id"
                    class="px-3 text-[0.4em] sm:text-[0.5em] md:text-[0.6em] lg:text-[0.65em] xl:text-[0.7em] font-bold py-1 text-black border rounded-md relative"
                    :class="item.indicolor">

                    <a :href="item.link">{{ item.id }}. {{ item.content }} <br> by {{ item.user
                    }}({{ item.role }}) 
                        <br>
                        {{ item.date }}</a>
                    <div class="right-[5px] top-[5px] size-[6px] rounded-xl absolute border-1 border-white  bg-red-500">
                    </div>

                </div>

                <div id="seen" v-for="item in seen" :key="item.id"
                    class="px-3 text-[0.4em] sm:text-[0.5em] md:text-[0.6em] lg:text-[0.65em] xl:text-[0.7em] font-bold py-1 text-black border rounded-md relative"
                    :class="item.indicolor">

                    <a :href="item.link">{{ item.id }}. {{ item.content }} <br> by {{ item.user
                    }}({{ item.role }})
                        <br>
                        {{ item.date }}</a>
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