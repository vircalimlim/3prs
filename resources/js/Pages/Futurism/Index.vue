<script setup lang="ts">
import StudentLayout from '@/Layouts/StudentLayout.vue';
import { Link } from '@inertiajs/vue3';

const {category} = defineProps({
    'futurisms': {
        type: Array<any>,
        required: true,
    },
    'storage_link': {
        type: String,
        required: true,
    },
    'category': {
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
    <StudentLayout :page-name="category">
        <section class="flex flex-col justify-center items-center gap-10 py-10">
            
            <a v-for="futurism in futurisms" href="#" class="flex flex-col bg-white rounded-lg shadow md:flex-row w-full hover:bg-gray-100">
                <img class="object-cover w-full h-9sd6 md:h-8sds6 md:w-[450px]" :src="`${storage_link}/${futurism.image}`" alt="">
                <div class="h-full flex flex-col justify-between p-4 leading-normal">
                    <h5 class="text-2xl font-bold tracking-tight text-gray-900 capitalize">{{futurism.title}}</h5>
                    <p class="text-[14px] font-bold text-gray-600 mb-2">{{ formatDate(futurism.created_at) }}</p>
                    <p v-html="futurism.description" class="mb-3 font-normal text-gray-700 line-clamp-5"></p>
                    <div class="mt-5">
                        <Link :href="`/futurism/${futurism.id}`"
                            class="py-2 px-3 text-base font-medium text-center text-blue-700 rounded-lg border border-border-800 shadow-md hover:border-blue-800 hover:text-white hover:text-grey-300 hover:bg-blue-800">
                            Read more
                        </Link>
                    </div>
                </div>
            </a>
            <div v-if="futurisms.length < 1">
                <h1 class="text-gray-500">No results found.</h1>
            </div>

        </section>
    </StudentLayout>
</template>