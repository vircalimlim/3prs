<script setup lang="ts">
import TextHeader from "@/Components/TextHeader.vue";
import StudentLayout from "@/Layouts/StudentLayout.vue";
import { Link } from "@inertiajs/vue3";

const contacts = [
  {
    name: "Jose Chan",
    address: "Binalonan, Pangasinan",
    email: "josechan12@gmail.com",
  },
  {
    name: "Kevin Mchale",
    address: "Binalonan, Pangasinan",
    email: "kevinmc@gmail.com",
  },
  {
    name: "Reggie Miller",
    address: "Binalonan, Pangasinan",
    email: "reggiemiller@gmail.com",
  },
  {
    name: "Stephanie Manzon",
    address: "Binalonan, Pangasinan",
    email: "steph@gmail.com",
  },
];
</script>

<template>
  <StudentLayout page-name="Contact Us">
    <section>
      <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-lg text-gray-50 uppercase bg-blue-700">
            <tr>
              <th
                scope="col"
                class="px-6 py-3"
              >
                Developers
              </th>
              <th
                scope="col"
                class="px-6 py-3"
              >
                Address
              </th>
              <th
                scope="col"
                class="px-6 py-3"
              >
                Email
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="contact in contacts"
              class="bg-white border-b text-lg"
            >
              <th
                scope="row"
                class="capitalize px-6 py-4 font-medium text-gray-900 min-w-96 align-top"
              >
                {{ contact.name }}
              </th>
              <td class="px-6 py-4">
                {{ contact.address }}
              </td>
              <td class="px-6 py-4">
                {{ contact.email }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </StudentLayout>
</template>