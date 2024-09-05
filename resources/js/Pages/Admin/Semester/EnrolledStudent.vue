<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head, Link, router, useForm } from "@inertiajs/vue3";
import { ref, reactive } from "vue";
import Pagination from "@/Components/Pagination.vue";

const {students, semesters} = defineProps<{
  students: Object,
  semesters: Array<Object>,
}>();

const current_url = window.location.href;
const baseUrl = current_url.split('?')[0];
const filteredSem = ref('');

const handleTypeFilter = () => {
    router.get('/admin/semester/enrolled/student', {sem: filteredSem.value}, {preserveState: true, preserveScroll: true});
}
</script>

<template>
  <Head title="Dashboard" />

  <Admin>
    <section>

    <div class="text-sm font-medium text-center text-gray-500 mb-5">
        <ul class="flex flex-wrap -mb-px">
            <li class="me-2">
                <Link :href="route('semester.index')" :class="baseUrl == route('semester.index') ? 'active-tab' : ''" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300">
                  Semester
                </Link>
            </li>
            <li class="me-2">
                <Link :href="route('semester.enrolled_student')" :class="baseUrl == route('semester.enrolled_student') ? 'active-tab' : ''" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300" aria-current="page">
                  Enrolled Student
                </Link>
            </li>
        </ul>
    </div>

    <div class="flex justify-between items-center">
      <h1
        class="my-5 text-4xl font-extrabold tracking-tight leading-none text-gray-600"
      >
        Enrolled Students
      </h1>
      <div class="flex items-center gap-2">
        <select @change="handleTypeFilter" v-model="filteredSem" id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2">
            <option value="" selected>Filter by semester</option>
            <option v-for="semester in semesters" :value="semester.id">{{semester.name}}</option>
        </select>
      </div>
    </div>
      <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3">Semester</th>
              <th scope="col" class="px-6 py-3">Student Name</th>
              <th scope="col" class="px-6 py-3">Gender</th>
              <th scope="col" class="px-6 py-3">Date Of Birth</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="student in students.data" :key="student.id" class="bg-white border-b">
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize"
              >
                {{student.name}}
              </th>
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap capitalize"
              >
                {{`${student.last_name}, ${student.first_name}`}}
              </th>
              <td class="px-6 py-4">{{student.gender}}</td>
              <td class="px-6 py-4">{{student.dob}}</td>
            </tr>
            <tr v-if="students.data.length == 0">
              <td class="text-center py-5" colspan="4">
                <p class="text-xl">No records found.</p>
                <Link :href="route('semester.register_student')" class="py-2 text-blue-400">Click here to register student.</Link>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="students.links" />
    </section>
  </Admin>
</template>
