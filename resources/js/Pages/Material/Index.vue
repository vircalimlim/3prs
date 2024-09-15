<script setup lang="ts">
import StudentLayout from "@/Layouts/StudentLayout.vue";
import { Link } from "@inertiajs/vue3";

const {} = defineProps({
  materials: {
    type: Array<any>,
    required: true,
  },
  storage_link: {
    type: String,
    required: true,
  },
});
</script>

<template>
  <StudentLayout page-name="Research">
    <section>

      <div
        v-if="materials.length > 0"
        class="relative overflow-x-auto"
      >
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-lg text-gray-700 uppercase bg-gray-50">
            <tr>
              <th
                scope="col"
                class="px-6 py-3"
              >
                Title
              </th>
              <th
                scope="col"
                class="px-6 py-3"
              >
                Description
              </th>
              <th
                scope="col"
                class="px-6 py-3"
              >
                Link
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="material in materials"
              class="bg-white border-b text-lg"
            >
              <th
                scope="row"
                class="capitalize px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                {{ material.title }}
              </th>
              <td class="px-6 py-4">
                {{ material.description }}
              </td>
              <td class="px-6 py-4">
                <Link
                  class="text-blue-600 hover:text-blue-400"
                  :href="`/research/${material.id}`"
                >{{ material.file_path }}</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-if="materials.length < 1">
        <h1 class="text-gray-500 text-center">No results found.</h1>
      </div>
    </section>
    <!-- <section class="flex flex-col justify-center items-center gap-10 py-10">
            
            <a v-for="achievement in achievements" href="#" class="flex flex-col bg-white rounded-lg shadow md:flex-row md:max-w-[90%] hover:bg-gray-100">
                <img class="object-cover w-full h-96 md:h-86 md:w-[450px]" :src="`${storage_link}/${achievement.image}`" alt="">
                <div class="h-full flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 capitalize">{{achievement.title}}</h5>
                    <p v-html="achievement.description" class="mb-3 font-normal text-gray-700 line-clamp-5"></p>
                    <div class="mt-5">
                        <Link :href="`/achievement/${achievement.id}`"
                            class="py-2 px-3 text-base font-medium text-center text-blue-700 rounded-lg border border-border-800 hover:border-blue-800 hover:text-white hover:text-grey-300 hover:bg-blue-800 shadow-md">
                            Read more
                        </Link>
                    </div>
                </div>
            </a>
            <div v-if="achievements.length < 1">
                <h1 class="text-gray-500">No results found.</h1>
            </div>

        </section> -->
  </StudentLayout>
</template>