<script setup lang="ts">
import { ref, onMounted, onUnmounted } from "vue";
import StudentLayout from '@/Layouts/StudentLayout.vue';
import { Link } from '@inertiajs/vue3';
import Dotdotdot from 'dotdotdot-js';

const {} = defineProps({
    'achievements': {
        type: Array<any>,
        required: true,
    },
    'storage_link': {
        type: String,
        required: true,
    }
});

const clampText = ref([]);

const formatDate = (inputDate: string) => {
    const date = new Date(inputDate.split(' ')[0]);

    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const year = date.getFullYear();

    return `${month}/${day}/${year}`;
}

onMounted(() => {

if (clampText.value.length > 1) {
  // Apply Dotdotdot to each element in the array
  clampText.value.forEach(text => {
    if (text) {
      new Dotdotdot(text, {
        height: 100,  // Set max height for the text container
        truncate: 'letter'  // Truncate by letter, can be 'word' or 'node'
      });
    }
  });
} else if (clampText.value.length === 1 && clampText.value[0]) {
  // Handle single element case
  new Dotdotdot(clampText.value[0], {
    height: 100,
    truncate: 'letter'
  });
}

});
</script>

<template>
    <StudentLayout page-name="Achievements">
        <section class="flex flex-col justify-center items-center gap-10 py-10">
            
            <a v-for="achievement in achievements" href="#" class="flex flex-col bg-white rounded-lg shadow md:flex-row w-full hover:bg-gray-100">
                <img class="object-cover w-full h-96 md:h-86 md:w-[450px]" :src="`${storage_link}/${achievement.image}`" alt="">
                <div class="h-full flex flex-col justify-between p-4 leading-normal">
                    <h5 class="text-2xl font-bold tracking-tight text-[#1034a6] capitalize">{{achievement.title}}</h5>
                    <p class="text-[14px] font-bold text-gray-600 mb-2">{{ achievement.publish_date ? formatDate(achievement.publish_date) : formatDate(achievement.created_at) }}</p>
                    <div ref="clampText" v-html="achievement.description" class="mb-3 font-normal text-gray-700 line-clamp-5"></div>
                    <div class="mt-5">
                        <Link :href="`/achievement/${achievement.id}`"
                            class="py-2 px-3 text-base font-medium text-center text-[#e5432d] rounded-lg border border-[#e5432d] border-2 hover:border-[#e5432d] hover:text-white hover:text-grey-300 hover:bg-[#e5432d] shadow-md">
                            Read more
                        </Link>
                    </div>
                </div>
            </a>
            <div v-if="achievements.length < 1">
                <h1 class="text-gray-500">No results found.</h1>
            </div>

        </section>
    </StudentLayout>
</template>

<style scoped>
    .line-clamp-5 {
    display: -webkit-box;
    -webkit-line-clamp: 5;
    line-clamp: 5;
    -webkit-box-pack: end;
    text-overflow: ellipsis;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-align: left;
    }
</style>