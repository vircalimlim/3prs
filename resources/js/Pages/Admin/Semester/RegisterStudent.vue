<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, reactive } from "vue";
import Pagination from "@/Components/Pagination.vue";

const {students, semesters} = defineProps<{
  students: Object,
  semesters: Array<Object>,
}>();

const form = useForm({
    selected_sem: '',
    selected_students: [],
    select_all: false,
    select_list: false,
});

const selectStudentsInList = (event: any) => {
    form.select_all = false;
    if(event.target.checked){
        form.selected_students = students.data.map(student => student.id);
    }
    else{
        form.selected_students = [];
    }
}

const selectAllStudent = (event: any) => {
    form.select_list = false;
    if(event.target.checked){
        form.selected_students = students.data.map(student => student.id);
    }
    else{
        form.selected_students = [];
    }
}

const registerStudent = () => {
    form.post(route("semester.register_student_save"), {
        onSuccess: () => {
            form.selected_sem       = '';
            form.selected_students  = [];
            form.select_all         = false;
            form.select_list        = false;
        },
  });
}
</script>

<template>
  <Head title="Dashboard" />

  <Admin>
    <section>
    <div class="flex justify-between items-center">
      <h1
        class="my-5 text-4xl font-extrabold tracking-tight leading-none text-gray-600"
      >
        Register Students
      </h1>
      <div class="flex items-center gap-2">
        <select v-model="form.selected_sem" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2">
            <option value="" disabled selected>Select semester</option>
            <option v-for="semester in semesters" :value="semester.id">{{semester.name}}</option>
        </select>

        <button @click.prevent="registerStudent" :disabled="form.selected_students.length < 1 || form.selected_sem == ''" :class="form.selected_students.length < 1 || form.selected_sem == '' ? 'cursor-not-allowed' : 'cursor-pointer'" type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center">
            Register
        </button>
      </div>
    </div>
    <div class="bg-white">
        <div colspan="3" class="px-6 py-4">
            <div class="flex gap-2 items-center">
                <input @click="selectAllStudent($event)" v-model="form.select_all" id="all_students" type="checkbox" name="students" :value="true">
                <label class="text-xl" for="all_students">
                    Select all students
                </label>
            </div>
        </div>
    </div>
      <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3">Student Name</th>
              <th scope="col" class="px-6 py-3">Gender</th>
              <th scope="col" class="px-6 py-3">Date Of Birth</th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b">
                <td colspan="3" class="px-6 py-4">
                    <div class="flex gap-2 items-center">
                        <input @click="selectStudentsInList($event)" v-model="form.select_list" id="all_list" type="checkbox" name="students" :value="true">
                        <label class="text-xl" for="all_list">
                            Select students in this list
                        </label>
                    </div>
                </td>
            </tr>
            <tr v-for="student in students.data" :key="student.id" class="bg-white border-b">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize"
              >
                <div class="flex gap-2 items-center">
                    <input v-model="form.selected_students" :id="student.id" type="checkbox" name="students" :value="student.id">
                    <label :for="student.id">
                        {{`${student.last_name}, ${student.first_name}`}}
                    </label>
                </div>
              </th>
              <td class="px-6 py-4">{{student.gender}}</td>
              <td class="px-6 py-4">{{student.dob}}</td>
            </tr>
            <tr v-if="students.data.length == 0">
              <td class="text-center" colspan="3">No records found.</td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="students.links" />
    </section>
  </Admin>
</template>
