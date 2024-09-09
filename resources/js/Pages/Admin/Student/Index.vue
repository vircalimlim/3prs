<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head } from "@inertiajs/vue3";
import AddModal from "./Partials/AddModal.vue";
import EditModal from "./Partials/EditModal.vue";
import { ref, reactive } from "vue";
import Pagination from "@/Components/Pagination.vue";

const {students} = defineProps({
  students: {
    type: Object,
    required: true,
  },
});

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
              <!-- <th scope="col" class="px-6 py-3">STUDENT ID</th> -->
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
            <tr v-for="student in students.data" class="bg-white border-b">
              <!-- <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                10034238472
              </th> -->
              <td class="px-6 py-4 capitalize">{{ `${student.last_name}, ${student.first_name}` }}</td>
              <td class="px-6 py-4">{{student.gender}}</td>
              <td class="px-6 py-4">{{student.dob}}</td>
              <td class="px-6 py-4">{{student.email}}</td>
              <td class="px-6 py-4">{{student.mobile}}</td>
              <td class="px-6 py-4 capitalize">{{student.address}}</td>
              <td class="px-6 py-4 text-right">
                <a @click.prevent="openEditModal(student)" href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
          </tbody>
        </table>
        <Pagination :links="students.links"/>
      </div>
    </section>
    <AddModal :showAdd="showAdd" @close="showAdd = false" />
    <EditModal v-if="showEdit" :showEdit="showEdit" @close="showEdit = false" :student="editStudent" />
  </Admin>
</template>
