<script setup lang="ts">
import ImageCarousel from '@/Components/ImageCarousel.vue';
import StudentLayout from '@/Layouts/StudentLayout.vue';
import { Link } from '@inertiajs/vue3';

const {} = defineProps({
    'announcement': {
        type: Object,
        required: true,
    },
    'more_announcements': {
        type: Array<any>,
        required: true,
    },
    'storage_link': {
        type: String,
        required: true,
    }
});

const formatDate = (inputDate: string) => {
    const date = new Date(inputDate.split(' ')[0]);

    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const year = date.getFullYear();

    return `${month}/${day}/${year}`;
}

</script>

<template>
    <StudentLayout page-name="Announcement Details">
        <section class="flex flex-col md:flex-row justify-center gap-10 py-10">
            <div>
                <ImageCarousel :images="announcement.images" :image="announcement.image" file_folder="/storage/images/announcements/"/>
                <!-- <img class="object-cover w-full h-9s6 md:h-86s md:w-full" :src="storage_link + '/' + announcement.image"> -->
                <h1 class="mt-5 text-2xl font-bold tracking-tight text-gray-900 capitalize">{{ announcement.title }}</h1>
                <p class="text-[14px] font-bold text-gray-600">{{ formatDate(announcement.created_at) }}</p>
                <div class="mt-5" v-html="announcement.description"></div>
            </div>
            <div v-show="more_announcements.length > 0">
                <h3 class="uppercase text-2xl font-bold mb-5">Latest Announcements</h3>
                <div class="flex flex-col gap-5">
                    <Link :href="`/announcement/${more_announcement.id}`" v-for="more_announcement in more_announcements" class="flex flex-row items-center gap-2 md:w-96 rounded hover:bg-gray-100">
                        <img class="h-full w-28" :src="storage_link + '/' + more_announcement.image">
                        <div>
                            <h1 class="text-lg font-bold tracking-tight text-gray-900 capitalize">{{ more_announcement.title }}</h1>
                            <strong class="mt-2 text-md text-gray-600">{{ formatDate(more_announcement.created_at) }}</strong>
                        </div>
                    </Link>
                </div>
            </div>
        </section>
    </StudentLayout>
</template>