<script setup lang="ts">
import ImageCarousel from '@/Components/ImageCarousel.vue';
import StudentLayout from '@/Layouts/StudentLayout.vue';
import { Link } from '@inertiajs/vue3';

const {futurism_category_images} = defineProps({
    'futurism': {
        type: Object,
        required: true,
    },
    'more_futurisms': {
        type: Array<any>,
        required: true,
    },
    'storage_link': {
        type: String,
        required: true,
    },
    'futurism_category_images': {
        type: Array<any>,
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
    <StudentLayout page-name="Futurism Details">
        <section class="flex flex-col md:flex-row justify-center gap-10 py-10">
            <div>
                <ImageCarousel :images="futurism.images" :image="futurism.image" file_folder="/storage/images/futurism/"/>
                <!-- <img class="object-cover w-full h-9s6 md:h-86s md:w-full" :src="storage_link + '/' + futurism.image"> -->
                <h1 class="mt-5 text-2xl font-bold tracking-tight text-gray-900 capitalize">{{ futurism.title }}</h1>
                <p class="text-[14px] font-bold text-gray-600 mb-2">{{ formatDate(futurism.created_at) }}</p>
                <div class="mt-5" v-html="futurism.description"></div>
            </div>
            <div v-if="futurism_category_images.length > 0" class="w-full mdw-96">
                <div class="flex flex-col gap-2">
                    <h3 class="text-2xl font-bold mb-5">SDG Initiatives</h3>
                    <div class="flex flex-wrap gap-5">
                        <img :src="storage_link + '/' + futurism_category_image.image" v-for="futurism_category_image in futurism_category_images" class="w-28 h-32 cover rounded">
                    </div>
                    <a :href="`/futurism/index/${futurism.category}`" class="text-blue-500 text-[18px] mt-2">Read More</a>
                </div>
            </div>
            <!-- <div v-show="more_futurisms.length > 0">
                <h3 class="uppercase text-2xl font-bold mb-5">Latest Futurisms</h3>
                <div class="flex flex-col gap-5">
                    <Link :href="`/futurism/${more_futurism.id}`" v-for="more_futurism in more_futurisms" class="flex flex-row items-center gap-2 md:w-96 rounded hover:bg-gray-100">
                        <img class="h-full w-28" :src="storage_link + '/' + more_futurism.image">
                        <div>
                            <h1 class="text-lg font-bold tracking-tight text-gray-900 capitalize">{{ more_futurism.title }}</h1>
                            <strong class="mt-2 text-md text-gray-600">{{ formatDate(more_futurism.created_at) }}</strong>
                        </div>
                    </Link>
                </div>
            </div> -->
        </section>
    </StudentLayout>
</template>