<script setup lang="ts">
import StudentLayout from "@/Layouts/StudentLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import { ref, watch } from "vue";

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

const searchQuery = ref("");

const slugify = (text: { toString: () => string }) => {
  return (
    text
      .toString()
      .toLowerCase() // Convert to lowercase
      .trim() // Remove whitespace from both ends
      // .replace(/["'.,]/g, "") // Remove quotes and punctuation
      .replace(/\s+/g, "-") // Replace spaces with hyphens
      .replace(/-+/g, "-")
  ); // Remove duplicate hyphens
};

const handleSearch = () => {
  router.get(
    route("research.index_public"),
    { search: slugify(searchQuery.value) },
    { preserveState: true, preserveScroll: true }
  );
};

watch(searchQuery, (newValue: any, oldValue: any) => {
  if (newValue == "") {
    handleSearch();
  }
});
</script>

<template>
  <StudentLayout page-name="Research">
    <section>
      <div class="max-w-md text-end my-4 mx-auto">
        <label
          for="default-search"
          class="mb-2 text-sm font-medium text-gray-900 sr-only"
        >Search</label>
        <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg
              class="w-4 h-4 text-gray-500"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 20 20"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
              />
            </svg>
          </div>
          <input
            v-model="searchQuery"
            type="text"
            id="default-search"
            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Search title, category..."
            required
          />
          <button
            @click.prevent="handleSearch"
            type="button"
            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2"
          >Search</button>
        </div>
      </div>
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
                class="capitalize px-6 py-4 font-medium text-gray-900 min-w-96 align-top"
              >
                {{ material.title }}
              </th>
              <td class="px-6 py-4">
                {{ material.description }}
              </td>
              <td class="px-6 py-4 align-top">
                <a
                  target="_blank"
                  class="text-blue-600 hover:text-blue-400"
                  :href="`/research/${material.id}`"
                >File Path</a>
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