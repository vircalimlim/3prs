<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
  <Head title="Dashboard" />

  <Admin>
    <section>
    <div class="flex justify-between items-center">
      <h1
        class="my-5 text-4xl font-extrabold tracking-tight leading-none text-gray-600"
      >
        Materials
      </h1>
      <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2">
        Add
      </button>
    </div>

      <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">Category</th>
              <th scope="col" class="px-6 py-3">Title</th>
              <th scope="col" class="px-6 py-3">Description</th>
              <th scope="col" class="px-6 py-3">File</th>
              <th scope="col" class="px-6 py-3">Created Date</th>
              <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b">
                <td class="px-6 py-4">
                Lorem, ipsum dolor.
              </td>
              <td class="px-6 py-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, asperiores!
              </td>
              <td class="px-6 py-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque necessitatibus quasi, mollitia ad tempore sapiente ab quam voluptatem distinctio quae consectetur dolor minima quos ipsa explicabo, illo aliquam rerum? Magnam suscipit aspernatur est.
              </td>
              <td class="px-6 py-4">
                lorem_ipsum.pdf
              </td>
              <td class="px-6 py-4">
                2024-08-30
              </td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr class="bg-white border-b">
                <td class="px-6 py-4">
                Lorem, ipsum dolor.
              </td>
              <td class="px-6 py-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, asperiores!
              </td>
              <td class="px-6 py-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque necessitatibus quasi, mollitia ad tempore sapiente ab quam voluptatem distinctio quae consectetur dolor minima quos ipsa explicabo, illo aliquam rerum? Magnam suscipit aspernatur est.
              </td>
              <td class="px-6 py-4">
                lorem_ipsum.pdf
              </td>
              <td class="px-6 py-4">
                2024-08-30
              </td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr class="bg-white border-b">
                <td class="px-6 py-4">
                Lorem, ipsum dolor.
              </td>
              <td class="px-6 py-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus, asperiores!
              </td>
              <td class="px-6 py-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque necessitatibus quasi, mollitia ad tempore sapiente ab quam voluptatem distinctio quae consectetur dolor minima quos ipsa explicabo, illo aliquam rerum? Magnam suscipit aspernatur est.
              </td>
              <td class="px-6 py-4">
                lorem_ipsum.pdf
              </td>
              <td class="px-6 py-4">
                2024-08-30
              </td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </Admin>
</template>
