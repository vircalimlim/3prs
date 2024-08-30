<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head } from "@inertiajs/vue3";
import AddModal from "./Partials/AddModal.vue";
import { ref, reactive } from "vue";
import EditModal from "./Partials/EditModal.vue";

const showAdd = ref(false);
const showEdit = ref(false);
interface Semester {
  name: string;
  start_date: string;
  end_date: string;
}


const editSemester = reactive<Semester>({
  name: '',
  start_date: '',
  end_date: '',
});

const openAddModal = () => {
  showAdd.value = true;
};

const openEditModal = (semester: Semester) => {
  showEdit.value = true;
  Object.assign(editSemester, semester);
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
        Semester
      </h1>
      <button @click.prevent="openAddModal()" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2">
        Add
      </button>
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
                      /></svg
                  ></a>
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
                        d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"
                      /></svg
                  ></a>
                </div>
              </th>
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
                2024 1st Sem
              </th>
              <td class="px-6 py-4">Aug 01, 2024</td>
              <td class="px-6 py-4">Jan 30, 2025</td>
              <td class="px-6 py-4 text-right">
                <a  @click.prevent="openEditModal({name: 'name1', start_date: '2024-08-30', end_date: '2025-01-01'})" href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr class="bg-white border-b">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                2024 2nd Sem
              </th>
              <td class="px-6 py-4">Feb 01, 2025</td>
              <td class="px-6 py-4">Jun 30, 2025</td>
              <td class="px-6 py-4 text-right">
                <a @click.prevent="openEditModal({name: 'name2', start_date: '2024-09-30', end_date: '2025-02-01'})" href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr class="bg-white border-b">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                2025 1st Sem
              </th>
              <td class="px-6 py-4">Feb 01, 2025</td>
              <td class="px-6 py-4">Jun 30, 2025</td>
              <td class="px-6 py-4 text-right">
                <a @click.prevent="openEditModal({name: 'name3', start_date: '2024-10-30', end_date: '2025-05-01'})" href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    <AddModal :showAdd="showAdd" @close="showAdd = false" />
    <EditModal v-if="showEdit" :showEdit="showEdit" @close="showEdit = false" :semester="editSemester" />
  </Admin>
</template>
