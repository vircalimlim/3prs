<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head, Link } from "@inertiajs/vue3";
import AddModal from "./Partials/AddModal.vue";
import { ref, reactive } from "vue";
import EditModal from "./Partials/EditModal.vue";
import Pagination from "@/Components/Pagination.vue";

const {semesters, is_sem_started} = defineProps({
  semesters: {
    type: Object,
    required: true,
  },
  is_sem_started: {
    type: Boolean,
    required: true,
  }
});

const showAdd = ref(false);
const showEdit = ref(false);
// Define a type for dynamic properties
type DynamicObject = Record<string, any>;
const current_url = window.location.href;

// Create a reactive object with dynamic properties
const editSemester = reactive<DynamicObject>({});

const openAddModal = () => {
  showAdd.value = true;
};

const openEditModal = (semester: DynamicObject, is_sem_started: Boolean) => {
  if(is_sem_started) return;

  showEdit.value = true;
  Object.assign(editSemester, semester);
};
</script>

<template>
  <Head title="Dashboard" />

  <Admin>
    <section>
      
    <!-- <div class="text-sm font-medium text-center text-gray-500 mb-5">
        <ul class="flex flex-wrap -mb-px">
            <li class="me-2">
                <Link :href="route('semester.index')" :class="current_url == route('semester.index') ? 'active-tab' : ''" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                  Semester
                </Link>
            </li>
            <li class="me-2">
                <Link :href="route('semester.enrolled_student')" :class="current_url == route('semester.enrolled_student') ? 'active-tab' : ''" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" aria-current="page">
                  Enrolled Student
                </Link>
            </li>
        </ul>
    </div> -->

    <div class="flex justify-between items-center">
      <h1
        class="my-5 text-4xl font-extrabold tracking-tight leading-none text-gray-600"
      >
        Semester
      </h1>
      <div class="flex flex-wrap gap-2">
        <!-- <Link :href="route('semester.register_student')" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2">
          Register Student
        </Link> -->
        <button :disabled="is_sem_started" :class="is_sem_started ? 'text-gray-500 cursor-not-allowed' : ''" @click.prevent="openAddModal()" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2">
          Add
        </button>
      </div>
    </div>

      <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3">Semester Name</th>
              <th scope="col" class="px-6 py-3">
                <div class="flex items-center">
                  Start Date
                  <a href="#"
                    ><svg
                      class="w-3 h-3 ms-1.5"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"
                      /></svg>
                    </a>
                </div>
              </th>
              <th scope="col" class="px-6 py-3">
                <div class="flex items-center">
                  End Date
                  <a href="#"
                    ><svg
                      class="w-3 h-3 ms-1.5"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/></svg></a>
                </div>
              </th>
              <th scope="col">
                Enroll Student
              </th>
              <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="semester in semesters.data" class="bg-white border-b">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                {{semester.name}}
              </th>
              <td class="px-6 py-4">{{semester.start_date}}</td>
              <td class="px-6 py-4">{{semester.end_date}}</td>
              <td class="px-6 py-4">
                <Link :href="route('admin.student.index')+'?sem='+semester.id">
                  <img class="h-8 w-8" src="/images/icons/student.png" />
                </Link>
              </td>
              <td class="px-6 py-4 text-right">
                <a  @click.prevent="openEditModal(semester, is_sem_started)" :class="is_sem_started ? 'text-gray-500 cursor-not-allowed' : ''" href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr v-if="semesters.data.length == 0">
              <td class="text-center" colspan="3">No records found.</td>
            </tr>
          </tbody>
        </table>
        <Pagination :links="semesters.links" />
      </div>
    </section>

    <AddModal :showAdd="showAdd" @close="showAdd = false" />
    <EditModal v-if="showEdit" :showEdit="showEdit" @close="showEdit = false" :semester="editSemester" />
  </Admin>
</template>
