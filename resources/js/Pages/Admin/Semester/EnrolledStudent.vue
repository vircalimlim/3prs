<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, reactive } from "vue";
import Pagination from "@/Components/Pagination.vue";

const {students} = defineProps<{
  students: Object,
}>();

</script>

<template>
  <Head title="Dashboard" />

  <Admin>
    <section>
    <div class="flex justify-between items-center">
      <h1
        class="my-5 text-4xl font-extrabold tracking-tight leading-none text-gray-600"
      >
        Enrolled Students
      </h1>
      <div class="flex items-center gap-2">
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
            <tr v-for="student in students.data" :key="student.id" class="bg-white border-b">
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
              <td class="text-center" colspan="3">No records found.</td>
            </tr>
          </tbody>
        </table>
        <Pagination :links="students.links" />
      </div>
    </section>
  </Admin>
</template>
