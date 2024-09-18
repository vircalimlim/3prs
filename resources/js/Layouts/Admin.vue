<script setup>
import { Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { ref } from "vue";
const isShowDropDown = ref(false);
const isShowDropDown2 = ref(false);

const toggleMenu = ref(false);

const handleMenu = () => {
  toggleMenu.value = !toggleMenu.value;
};
</script>

<template>
  <button
    @click="handleMenu"
    data-drawer-target="default-sidebar"
    data-drawer-toggle="default-sidebar"
    aria-controls="default-sidebar"
    type="button"
    :class="toggleMenu ? 'hidden' : 'inline-flex'"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
  >
    <span class="sr-only">Open sidebar</span>
    <svg
      class="w-6 h-6"
      aria-hidden="true"
      fill="currentColor"
      viewBox="0 0 20 20"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        clip-rule="evenodd"
        fill-rule="evenodd"
        d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
      >
      </path>
    </svg>
  </button>

  <aside
    id="default-sidebar"
    :class="toggleMenu ? 'translate-x-0' : '-translate-x-full'"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full md:translate-x-0"
    aria-label="Sidebar"
  >
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50">
      <div class="mb-2 text-end block md:hidden">
        <span
          @click="handleMenu"
          class="text-[30px] text-gray-700 px-2 cursor-pointer rounded hover:bg-gray-200"
        >&times;</span>
      </div>
      <img
        class="h-15 p-2 mb-5"
        src="/images/logo-without-bg.png"
        alt=""
      >
      <ul class="space-y-2 font-medium">
        <li>
          <Link
            :href="route('dashboard')"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/dashboard.png" />
          <span class="ms-3">Dashboard</span>
          </Link>
        </li>
        <li>
          <Link
            :href="route('semester.index')"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/semester.png" />
          <span class="flex-1 ms-3 whitespace-nowrap">Semester</span>
          </Link>
        </li>
        <li>
          <Link
            :href="route('admin.student.index')"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/student.png" />
          <span class="flex-1 ms-3 whitespace-nowrap">Student</span>
          </Link>
        </li>
        <li>
          <Link
            :href="route('admin.post.index')"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/post.png" />
          <span class="flex-1 ms-3 whitespace-nowrap">Post</span>
          </Link>
        </li>
        <li>
          <button
            @click="isShowDropDown2 = !isShowDropDown2"
            type="button"
            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
            aria-controls="dropdown-example"
            data-collapse-toggle="dropdown-example"
          >
            <img class="h-8 w-8" src="/images/icons/research.png" />
            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Research</span>
            <svg
              class="w-3 h-3"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 10 6"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m1 1 4 4 4-4"
              />
            </svg>
          </button>
          <ul
            v-show="isShowDropDown2"
            id="dropdown-example"
            class="py-2 space-y-2"
          >
            <li>
              <Link
                :href="route('admin.category.index')"
                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100"
              >Category</Link>
            </li>
            <li>
              <Link
                :href="route('admin.material.index')"
                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100"
              >Materials</Link>
            </li>
          </ul>
        </li>
        <li>
          <Link
            :href="route('admin.logs')"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/logs.png" />
          <span class="flex-1 ms-3 whitespace-nowrap">Logs</span>
          </Link>
        </li>
        <li>
          <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/logout.png" />
          <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
          </Link>
        </li>
      </ul>
    </div>
  </aside>

  <div class="p-4 md:ml-64 h-screen">
    <slot />
  </div>
</template>