<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head, useForm } from "@inertiajs/vue3";
import AddModal from "./Partials/AddModal.vue";
import { ref, reactive } from "vue";
import Pagination from "@/Components/Pagination.vue";
import EditModal from "./Partials/EditModal.vue";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const props = defineProps({
  categories: {
    type: Object,
    required: true
  }
});

const showAdd = ref(false);
const showEdit = ref(false);
// Define a type for dynamic properties
type DynamicObject = Record<string, any>;

// Create a reactive object with dynamic properties
const editCategory = reactive<DynamicObject>({});

const openAddModal = () => {
  showAdd.value = true;
};

const openEditModal = (category: DynamicObject) => {
  showEdit.value = true;
  Object.assign(editCategory, category);
};

const deleteForm = useForm({
  id: null as number | null,
});

const deleteCategory = (id: number) => {
  if (confirm('Are you sure you want to delete this category, it will also delete all the materials associated with it?')) {
    deleteForm.id = id;
    deleteForm.delete(route('admin.category.delete'), {
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
          Categories
        </h1>
        <button @click.prevent="openAddModal" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2">
          Add
        </button>
      </div>

      <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3">Name</th>
              <th scope="col" class="px-6 py-3">Description</th>
              <th scope="col" class="px-6 py-3">
                <span class="sr-only">Actions</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="category in categories.data" :key="category.id" class="bg-white border-b">
              <td class="px-6 py-4">
                {{ category.title }}
              </td>
              <td class="px-6 py-4">
                {{ category.description }}
              </td>
              <td class="px-6 py-4 text-right">
                <a @click.prevent="openEditModal(category)" href="#" class="font-medium text-blue-600 hover:underline mr-2">Edit</a>
                <a @click.prevent="deleteCategory(category.id)" href="#" class="font-medium text-red-600 hover:underline">Delete</a>
              </td>
            </tr>
            <tr v-if="categories.data.length == 0">
              <td class="text-center py-5" colspan="3">No records found.</td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="categories.links"/>
    </section>
    <AddModal :showAdd="showAdd" @close="showAdd = false" />
    <EditModal v-if="showEdit" :showEdit="showEdit" @close="showEdit = false" :category="editCategory" />
  </Admin>
</template>
