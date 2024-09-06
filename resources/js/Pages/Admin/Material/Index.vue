<script setup lang="ts">
import Pagination from "@/Components/Pagination.vue";
import Admin from "@/Layouts/Admin.vue";
import { Head } from "@inertiajs/vue3";
import { ref, reactive } from "vue";
import AddModal from "./Partials/AddModal.vue";

const {materials, categories, file_link} = defineProps<{
  materials: Object,
  categories: Array<Object>,
  file_link: string,
}>();

const showAdd = ref(false);
const showEdit = ref(false);
// Define a type for dynamic properties
type DynamicObject = Record<string, any>;

// Create a reactive object with dynamic properties
const editMaterial = reactive<DynamicObject>({});

const openAddModal = () => {
  showAdd.value = true;
};

const openEditModal = (category: DynamicObject) => {
  showEdit.value = true;
  Object.assign(editMaterial, category);
};
</script>

<template>
  <Head title="Dashboard" />

  <Admin>
    <section>
    <div class="flex justify-between items-center">
      <h1
        class="my-5 text-4xl font-extrabold tracking-tight leading-none text-gray-600"
      >
        Materials
      </h1>
      <button @click.prevent="openAddModal" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2">
        Add
      </button>
    </div>

      <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Category</th>
              <th scope="col" class="px-6 py-3">Title</th>
              <th scope="col" class="px-6 py-3">Description</th>
              <th scope="col" class="px-6 py-3">File</th>
              <th scope="col" class="px-6 py-3">Status</th>
              <th scope="col" class="px-6 py-3">Created Date</th>
              <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="material in materials.data" class="bg-white border-b">
              <td class="px-6 py-4">
                {{material.category.title}}
              </td>
              <td class="px-6 py-4">
                {{material.title}}
              </td>
              <td class="px-6 py-4">
                {{material.description}}
              </td>
              <td class="px-6 py-4">
                <a class="text-blue-400" :href="`${file_link}/${material.file_path}`" target="_blank" rel="noopener noreferrer">
                  {{material.file_path}}
                </a>
              </td>
              <td class="px-6 py-4">
                {{material.status}}
              </td>
              <td class="px-6 py-4">
                {{material.created_at}}
              </td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr v-if="materials.data.length == 0">
              <td class="text-center py-5" colspan="6">No records found.</td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="materials.links"/>
    </section>
    <AddModal :showAdd="showAdd" @close="showAdd = false" :categories="categories"/>
    <!-- <EditModal v-if="showEdit" :showEdit="showEdit" @close="showEdit = false" :category="editCategory" /> -->
  </Admin>
</template>
