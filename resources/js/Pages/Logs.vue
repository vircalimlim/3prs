<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref, reactive } from "vue";
import Pagination from "@/Components/Pagination.vue";

const { logs } = defineProps({
  logs: {
    type: Object,
    required: true,
  },
});
</script>

<template>

  <Head title="Logs" />

  <Admin>
    <section>

      <div class="flex justify-between items-center">
        <h1 class="my-5 text-4xl font-extrabold tracking-tight leading-none text-gray-600">
          Research Views
        </h1>
        <div class="flex flex-wrap gap-2">
        </div>
      </div>

      <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th
                scope="col"
                class="px-6 py-3"
              >Full Name</th>
              <th
                scope="col"
                class="px-6 py-3"
              >Visit Date</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="log in logs.data"
              class="bg-white border-b"
            >
              <th
                scope="row"
                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
              >
                {{log.last_name}}, {{log.first_name}}
              </th>
              <td class="px-6 py-4">{{log.created_at}}</td>
            </tr>
            <tr v-if="logs.data.length == 0">
              <td
                class="text-center"
                colspan="2"
              >No records found.</td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="logs.links" />
    </section>
  </Admin>
</template>
