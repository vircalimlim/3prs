<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head } from "@inertiajs/vue3";
import AddModal from "./Partials/AddModal.vue";
import EditModal from "./Partials/EditModal.vue";
import { ref, reactive } from "vue";

const showAdd = ref(false);
const showEdit = ref(false);
// Define a type for dynamic properties
type DynamicObject = Record<string, any>;

// Create a reactive object with dynamic properties
const editStudent = reactive<DynamicObject>({});

const openAddModal = () => {
  showAdd.value = true;
};

const openEditModal = (student: DynamicObject) => {
  showEdit.value = true;
  Object.assign(editStudent, student);
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
        Student
      </h1>
      <button @click.prevent="openAddModal" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2">
        Add
      </button>
    </div>

      <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3">STUDENT ID</th>
              <th scope="col" class="px-6 py-3">Full Name</th>
              <th scope="col" class="px-6 py-3">Gender</th>
              <th scope="col" class="px-6 py-3">DOB</th>
              <th scope="col" class="px-6 py-3">EMAIL</th>
              <th scope="col" class="px-6 py-3">MOBILE</th>
              <th scope="col" class="px-6 py-3">ADDRESS</th>
              <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                10034238472
              </th>
              <td class="px-6 py-4">John Canlas</td>
              <td class="px-6 py-4">Male</td>
              <td class="px-6 py-4">2004-05-15</td>
              <td class="px-6 py-4">johncanlas@gmail.com</td>
              <td class="px-6 py-4">09496537953</td>
              <td class="px-6 py-4">Lingayen, Pangasinan</td>
              <td class="px-6 py-4 text-right">
                <a @click.prevent="openEditModal({first_name: 'vir', middle_name: 'padilla', last_name: 'calimlim'})" href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr class="bg-white border-b">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                10034238472
              </th>
              <td class="px-6 py-4">John Canlas</td>
              <td class="px-6 py-4">Male</td>
              <td class="px-6 py-4">2004-05-15</td>
              <td class="px-6 py-4">johncanlas@gmail.com</td>
              <td class="px-6 py-4">09496537953</td>
              <td class="px-6 py-4">Lingayen, Pangasinan</td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr class="bg-white border-b">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                10034238472
              </th>
              <td class="px-6 py-4">John Canlas</td>
              <td class="px-6 py-4">Male</td>
              <td class="px-6 py-4">2004-05-15</td>
              <td class="px-6 py-4">johncanlas@gmail.com</td>
              <td class="px-6 py-4">09496537953</td>
              <td class="px-6 py-4">Lingayen, Pangasinan</td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr class="bg-white border-b">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                10034238472
              </th>
              <td class="px-6 py-4">John Canlas</td>
              <td class="px-6 py-4">Male</td>
              <td class="px-6 py-4">2004-05-15</td>
              <td class="px-6 py-4">johncanlas@gmail.com</td>
              <td class="px-6 py-4">09496537953</td>
              <td class="px-6 py-4">Lingayen, Pangasinan</td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr class="bg-white border-b">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                10034238472
              </th>
              <td class="px-6 py-4">John Canlas</td>
              <td class="px-6 py-4">Male</td>
              <td class="px-6 py-4">2004-05-15</td>
              <td class="px-6 py-4">johncanlas@gmail.com</td>
              <td class="px-6 py-4">09496537953</td>
              <td class="px-6 py-4">Lingayen, Pangasinan</td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr class="bg-white border-b">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                10034238472
              </th>
              <td class="px-6 py-4">John Canlas</td>
              <td class="px-6 py-4">Male</td>
              <td class="px-6 py-4">2004-05-15</td>
              <td class="px-6 py-4">johncanlas@gmail.com</td>
              <td class="px-6 py-4">09496537953</td>
              <td class="px-6 py-4">Lingayen, Pangasinan</td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr class="bg-white border-b">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                10034238472
              </th>
              <td class="px-6 py-4">John Canlas</td>
              <td class="px-6 py-4">Male</td>
              <td class="px-6 py-4">2004-05-15</td>
              <td class="px-6 py-4">johncanlas@gmail.com</td>
              <td class="px-6 py-4">09496537953</td>
              <td class="px-6 py-4">Lingayen, Pangasinan</td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <nav class="mt-5" aria-label="Page navigation example">
        <ul class="flex justify-center items-center -space-x-px h-10 text-base">
            <li>
            <a href="#" class="flex items-center justify-center px-4 h-10 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                <span class="sr-only">Previous</span>
                <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
            </a>
            </li>
            <li>
            <a href="#" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">1</a>
            </li>
            <li>
            <a href="#" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
            </li>
            <li>
            <a href="#" aria-current="page" class="z-10 flex items-center justify-center px-4 h-10 leading-tight text-gray-500 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700">3</a>
            </li>
            <li>
            <a href="#" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">4</a>
            </li>
            <li>
            <a href="#" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">5</a>
            </li>
            <li>
            <a href="#" class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                <span class="sr-only">Next</span>
                <svg class="w-3 h-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
            </a>
            </li>
        </ul>
    </nav>
    </section>
    <AddModal :showAdd="showAdd" @close="showAdd = false" />
    <EditModal v-if="showEdit" :showEdit="showEdit" @close="showEdit = false" :student="editStudent" />
  </Admin>
</template>
