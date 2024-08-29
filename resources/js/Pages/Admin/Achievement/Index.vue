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
        Achievements
      </h1>
      <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2">
        Add
      </button>
    </div>

      <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3">Image</th>
              <th scope="col" class="px-6 py-3">Title</th>
              <th scope="col" class="px-6 py-3">Description</th>
              <th scope="col" class="px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white border-b">
              <td class="px-6 py-4 whitespace-nowrap w-96">
                <img class="h-[150px] w-[300px] object-cover rounded" src="/images/library.png" alt="image description">
              </td>
              <td class="px-6 py-4">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Id, tempore!
              </td>
              <td class="px-6 py-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae neque dignissimos aliquid ea quidem distinctio dolore, optio eaque ipsa itaque deleniti, voluptatem labore natus nam illo nulla tempore aliquam? Rem repudiandae modi eligendi, delectus iusto earum quaerat iste. Perspiciatis illum eligendi iste amet, libero natus, odio voluptate, culpa quos magnam nihil. Vel unde aliquid cupiditate nobis sapiente quae ipsam repudiandae?
              </td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr class="bg-white border-b">
              <td class="px-6 py-4">
                <img class="h-[150px] w-[300px] object-cover rounded" src="/images/reading.png" alt="image description">
              </td>
              <td class="px-6 py-4">
                Lorem ipsum dolor sit amet consectetur.
              </td>
              <td class="px-6 py-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis, reprehenderit ipsum sit voluptas veniam minus cumque voluptatibus dolore adipisci in at nulla? Impedit earum, officia vero ratione dolor itaque accusamus, culpa laudantium facere quos dignissimos!
              </td>
              <td class="px-6 py-4 text-right">
                <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
              </td>
            </tr>
            <tr class="bg-white border-b">
              <td class="px-6 py-4">
                <img class="h-[150px] w-[300px] object-cover rounded" src="/images/hero.png" alt="image description">
              </td>
              <td class="px-6 py-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, eum. Voluptatibus molestias dolorem, culpa ea accusamus quidem voluptas ducimus perspiciatis repellendus non officiis!
              </td>
              <td class="px-6 py-4">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium eius reiciendis similique dolor ratione repellendus amet nulla veniam officia neque velit modi deserunt et, unde provident iure nostrum quae quibusdam. Repudiandae magnam aspernatur minus saepe, similique soluta laudantium sapiente voluptates quibusdam, maxime doloribus blanditiis, dolores nobis dignissimos fugiat fugit vero! Minima corrupti ipsam pariatur mollitia! Saepe cupiditate iure, ipsam expedita explicabo sequi eius ut distinctio omnis molestiae iusto!
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
