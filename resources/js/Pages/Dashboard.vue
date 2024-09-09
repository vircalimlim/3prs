<script setup lang="ts">
import Admin from '@/Layouts/Admin.vue';
import { Head, Link } from '@inertiajs/vue3';
const props = defineProps({
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
    }
});
</script>

<template>
    <Head title="Dashboard" />

    <Admin>
        <!-- <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div> -->
        <div class="md:h-full flex items-center justify-center">
            <div class="flex flex-wrap gap-10 justify-center">
            
                <Link :href="route('admin.student.index')" class="flex flex-col gap-2 items-center justify-center max-w-sm py-6 px-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h3 class="text-2xl font-medium text-gray-600">Total Students</h3>
                    <h1 class="font-bold text-6xl text-gray-700">{{total_students}}</h1>
                </Link>

                <Link :href="route('semester.enrolled_student')" class="flex flex-col gap-2 items-center justify-center max-w-sm py-6 px-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h3 class="text-2xl font-medium text-gray-600">Total Enrolled</h3>
                    <h1 class="font-bold text-6xl text-gray-700">{{ total_enrolled }}</h1>
                </Link>

                <Link :href="route('admin.post.index')" class="flex flex-col gap-2 items-center justify-center max-w-sm py-6 px-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h3 class="text-2xl font-medium text-gray-600">Achievements</h3>
                    <h1 class="font-bold text-6xl text-gray-700">{{total_achievements}}</h1>
                </Link>

                <Link :href="route('admin.post.index')" class="flex flex-col gap-2 items-center justify-center max-w-sm py-6 px-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h3 class="text-2xl font-medium text-gray-600">Announcements</h3>
                    <h1 class="font-bold text-6xl text-gray-700">{{ total_announcements }}</h1>
                </Link>

                <Link :href="route('admin.material.index')" class="flex flex-col gap-2 items-center justify-center max-w-sm py-6 px-20 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h3 class="text-2xl font-medium text-gray-600">Research Materials</h3>
                    <h1 class="font-bold text-6xl text-gray-700">{{ total_materials }}</h1>
                </Link>

            </div>
        </div>
        
    </Admin>
</template>
