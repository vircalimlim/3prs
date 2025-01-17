<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head } from "@inertiajs/vue3";
import AddModal from "./Partials/AddModal.vue";
import EditModal from "./Partials/EditModal.vue";
import { ref, reactive } from "vue";
import Pagination from "@/Components/Pagination.vue";
import { useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';

const { students, courses } = defineProps({
  students: {
    type: Object,
    required: true,
  },
  courses: {
    type: Array<any>,
    required: true,
  }
});

const showAdd = ref(false);
const showEdit = ref(false);
// Define a type for dynamic properties
type DynamicObject = Record<string, any>;
const toEnrollStudents = reactive<any[]>([]);

// Create a reactive object with dynamic properties
const editStudent = reactive<DynamicObject>({});

const openAddModal = () => {
  showAdd.value = true;
};

const openEditModal = (student: DynamicObject) => {
  showEdit.value = true;
  Object.assign(editStudent, student);
};

const form = useForm({});

const deleteStudent = (id: number) => {
  if (confirm('Are you sure you want to delete this student?')) {
    form.delete(route("admin.student.delete", { id }), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        toast.success("Student deleted!", {
          autoClose: 1000,
        });
      },
    });
  }
};

const enrollStudent = (student_id: number, sem_id: number) => {
  const item = { student_id: student_id, sem_id: sem_id };
  const index = toEnrollStudents.findIndex(
        obj => obj.student_id === item.student_id && obj.sem_id === item.sem_id
    );

  if (index !== -1) {
      // If item exists, remove it
      toEnrollStudents.splice(index, 1);
  } else {
      // If item doesn't exist, add it
      toEnrollStudents.push(item);
  }
}

const enrollForm = useForm({});
const enrollStudentSave = () => {
  enrollForm.post(route("admin.student.enroll", { toEnrollStudents }), {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        toEnrollStudents.length = 0;
        console.log(toEnrollStudents);
        toast.success("Saved!", {
          autoClose: 1000,
        });
      },
    });
}
</script>

<template>

  <Head title="Dashboard" />

  <Admin>
    <section>
      <div class="flex justify-between items-center">
        <h1 class="my-5 text-4xl font-extrabold tracking-tight leading-none text-gray-600">
          Student
        </h1>
        <div class="flex gap-x-2 items-center">
          <button
            v-show="toEnrollStudents.length > 0"
            @click.prevent="enrollStudentSave"
            type="button"
            class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2"
          >
            Save Changes
          </button>
          <button
            @click.prevent="openAddModal"
            type="button"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2"
          >
            Add
          </button>
        </div>
      </div>

      <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <!-- <th scope="col" class="px-6 py-3">STUDENT ID</th> -->
              <th
                scope="col"
                class="px-6 py-3"
              >Full Name</th>
              <th
                scope="col"
                class="px-6 py-3"
              >Course</th>
              <th
                scope="col"
                class="px-6 py-3"
              >Email</th>
              <th
                scope="col"
                class="px-6 py-3"
              >ID</th>
              <th
                scope="col"
                class="px-6 py-3"
              >User Key</th>
              <th
                scope="col"
                class="px-6 py-3"
              >Status</th>
              <th
                scope="col"
                class="px-6 py-3"
              >
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="student in students.data"
              :key="student.id"
              class="bg-white border-b"
            >
              <!-- <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                10034238472
              </th> -->
              <td class="px-6 py-4 capitalize">{{ `${student.last_name}, ${student.first_name} ${student.middle_name}` }}</td>
              <td class="px-6 py-4">{{student.course}}</td>
              <td class="px-6 py-4">{{student.email}}</td>
              <td class="px-6 py-4">{{ student.student_number }}</td>
              <td class="px-6 py-4">{{ student.user_key }}</td>
              <td class="px-6 py-4">
                <input type="checkbox" :checked="student.is_enrolled" :disabled="student.is_enrolled" @change="enrollStudent(student.id, parseInt(route().params.sem))" :class="student.is_enrolled ? 'text-green-300' : 'text-green-500'" class="w-4 h-4 bg-gray-100 border-gray-300 focus:ring-green-500 focus:ring-2 focus:ring-offset-2">
              </td>
              <td class="px-6 py-4 text-right">
                <a
                  @click.prevent="openEditModal(student)"
                  href="#"
                  class="font-medium text-blue-600 hover:underline mr-2"
                >Edit</a>
                <a
                  @click.prevent="deleteStudent(student.id)"
                  href="#"
                  class="font-medium text-red-600 hover:underline"
                >Delete</a>
              </td>
            </tr>
            <tr v-if="students.data.length == 0">
              <td
                class="text-center"
                colspan="7"
              >No records found.</td>
            </tr>
          </tbody>
        </table>
        <Pagination :links="students.links" />
      </div>
    </section>
    <AddModal
      :showAdd="showAdd"
      :courses="courses"
      @close="showAdd = false"
    />
    <EditModal
      v-if="showEdit"
      :showEdit="showEdit"
      @close="showEdit = false"
      :student="editStudent"
      :courses="courses"
    />
  </Admin>
</template>
