<script setup lang="ts">
import Admin from '@/Layouts/Admin.vue';
import { Head, Link } from '@inertiajs/vue3';

import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { ref, onMounted, computed } from 'vue';
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const {research_visit} = defineProps({
    'total_students': {
        type: Number,
        required: true
    },
    'total_enrolled': {
        type: Number,
        required: true
    },
    'total_achievements': {
        type: Number,
        required: true
    },
    'total_announcements': {
        type: Number,
        required: true
    },
    'total_materials': {
        type: Number,
        required: true
    },
    'research_visit': {
        type: Array<any>,
        required: true,
    }
});

const monthLabel = ref();
const monthTotal = ref();

const chartData = computed(() => ({
  labels: monthLabel.value,
  datasets: [
    {
      label: 'Research Visit',
      backgroundColor: '#000080',
      data: monthTotal.value,
    },
  ],
}));

const chartOptions = ref({
  responsive: true,
  maintainAspectRatio: false
})

onMounted(() => {
    monthLabel.value = research_visit.map(research => research.month);
    monthTotal.value = research_visit.map(research => research.total);
    console.log(monthLabel.value)
})
</script>

<template>
    <Head title="Dashboard" />

    <Admin>
        <div class="h-72">
            <Bar :data="chartData" :options="chartOptions" />
        </div>
        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div> -->
        <div class="">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 justify-items-center sm:justify-items-start gap-5 py-4">
            
                <Link :href="route('admin.student.index')" class="flex flex-col gap-2 items-center justify-center w-full max-w-sm py-6 px-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h3 class="text-xl font-medium text-blue-900">Total Students</h3>
                    <h1 class="font-bold text-6xl text-gray-700">{{total_students}}</h1>
                </Link>

                <Link :href="route('semester.enrolled_student')" class="flex flex-col gap-2 items-center justify-center w-full max-w-sm py-6 px-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h3 class="text-xl font-medium text-blue-900">Total Enrolled</h3>
                    <h1 class="font-bold text-6xl text-gray-700">{{ total_enrolled }}</h1>
                </Link>

                <Link :href="route('admin.post.index')" class="flex flex-col gap-2 items-center justify-center w-full max-w-sm py-6 px-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h3 class="text-xl font-medium text-blue-900">Achievements</h3>
                    <h1 class="font-bold text-6xl text-gray-700">{{total_achievements}}</h1>
                </Link>

                <Link :href="route('admin.post.index')" class="flex flex-col gap-2 items-center justify-center w-full max-w-sm py-6 px-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h3 class="text-xl font-medium text-blue-900">Announcements</h3>
                    <h1 class="font-bold text-6xl text-gray-700">{{ total_announcements }}</h1>
                </Link>

                <Link :href="route('admin.material.index')" class="flex flex-col gap-2 items-center justify-center w-full max-w-sm py-6 px-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h3 class="text-xl font-medium text-blue-900">Research Materials</h3>
                    <h1 class="font-bold text-6xl text-gray-700">{{ total_materials }}</h1>
                </Link>

            </div>
        </div>
        
    </Admin>
</template>
