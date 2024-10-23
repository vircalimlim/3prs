<script setup lang="ts">
import Pagination from "@/Components/Pagination.vue";
import Admin from "@/Layouts/Admin.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import { ref, reactive } from "vue";
import AddModal from "./Partials/AddModal.vue";
import EditModal from "./Partials/EditModal.vue";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const { materials, categories, file_link } = defineProps({
  materials: {
    type: Object,
    required: true,
  },
  categories: {
    type: Array<any>,
    required: true,
  },
  file_link: {
    type: String,
    required: true,
  },
});

const showAdd = ref(false);
const showEdit = ref(false);
const categoryFilter = ref('');
// Define a type for dynamic properties
type DynamicObject = Record<string, any>;

// Create a reactive object with dynamic properties
const editMaterial = reactive<DynamicObject>({});

const openAddModal = () => {
  showAdd.value = true;
};

const openEditModal = (material: DynamicObject) => {
  showEdit.value = true;
  Object.assign(editMaterial, material);
};

const handleCategoryFilter = () => {
  router.get(route('admin.material.index'), { type: categoryFilter.value }, { preserveState: true, preserveScroll: true });
}

const deleteForm = useForm({});

const deleteMaterial = (id: number) => {
  if (confirm('Are you sure you want to delete this material?')) {
    deleteForm.delete(route('admin.material.delete', { id: id }), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        toast.success("Saved!", {
          autoClose: 1000,
        });
      },
    });
  }
};
</script>

<template>
  <Head title="Dashboard" />

  <Admin>
    <section>
      <div class="flex justify-between items-center">
        <h1 class="my-5 text-4xl font-extrabold tracking-tight leading-none text-gray-600">
          Materials
        </h1>
        <div class="flex items-center gap-2">
          <select @change="handleCategoryFilter" v-model="categoryFilter" id="countries"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2">
            <option value="" selected>Filter by</option>
            <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
          </select>

          <button @click.prevent="openAddModal" type="button"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center">
            Add
          </button>
        </div>
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
                <span class="sr-only">Actions</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="material in materials.data" class="bg-white border-b">
              <td class="px-6 py-4">
                {{ material.category.title }}
              </td>
              <td class="px-6 py-4">
                {{ material.title }}
              </td>
              <td class="px-6 py-4">
                {{ material.description }}
              </td>
              <td class="px-6 py-4">
                <a class="text-blue-400" :href="`${file_link}/${material.file_path}`" target="_blank"
                  rel="noopener noreferrer">
                  {{ material.file_path }}
                </a>
              </td>
              <td class="px-6 py-4">
                {{ material.status }}
              </td>
              <td class="px-6 py-4">
                {{ material.published_date }}
              </td>
              <td class="px-6 py-4 text-right">
                <a @click.prevent="openEditModal(material)" href="#"
                  class="font-medium text-blue-600 hover:underline mr-2">Edit</a>
                <a @click.prevent="deleteMaterial(material.id)" href="#"
                  class="font-medium text-red-600 hover:underline">Delete</a>
              </td>
            </tr>
            <tr v-if="materials.data.length == 0">
              <td class="text-center py-5" colspan="7">No records found.</td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="materials.links" />
    </section>
    <AddModal :showAdd="showAdd" @close="showAdd = false" :categories="categories" />
    <EditModal v-if="showEdit" :showEdit="showEdit" @close="showEdit = false" :material="editMaterial"
      :categories="categories" />
  </Admin>
</template>
