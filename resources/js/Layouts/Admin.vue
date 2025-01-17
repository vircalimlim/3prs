<script setup>
import { Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { ref } from "vue";
const isShowDropDown = ref(false);
const isShowDropDown2 = ref(false);
const isShowDropDown3 = ref(false);

const toggleMenu = ref(false);
const currentRoute = route().current();

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
      <a href="/">
        <img
          class="h-15 p-2 mb-5"
          src="/images/logo-binalonan-without-bg.png"
          alt=""
        >
      </a>
      <ul class="space-y-2 font-medium">
        <li>
          <Link
            :href="route('dashboard')"
            :class="currentRoute == 'dashboard' ? 'text-blue-800 bg-gray-100' : ''"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/dashboard.png" />
          <span :class="currentRoute == 'dashboard' ? 'text-[#e5432d]' : ''" class="ms-3">Dashboard</span>
          </Link>
        </li>
        <li v-if="$page.props.auth.user.user_key == '1000000000' || $page.props.auth.user.user_key == '2000000000'">
          <Link
            :href="route('semester.index')"
            :class="currentRoute == 'semester.index' ? 'text-blue-800 bg-gray-100' : ''"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/semester.png" />
          <span :class="currentRoute == 'semester.index' ? 'text-[#e5432d]' : ''" class="flex-1 ms-3 whitespace-nowrap">Semester</span>
          </Link>
        </li>
        <!-- <li v-if="$page.props.auth.user.user_key == '1000000000' || $page.props.auth.user.user_key == '2000000000'">
          <Link
            :href="route('admin.student.index')"
            :class="currentRoute == 'admin.student.index' ? 'text-blue-800 bg-gray-100' : ''"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/student.png" />
          <span :class="currentRoute == 'admin.student.index' ? 'text-[#e5432d]' : ''" class="flex-1 ms-3 whitespace-nowrap">Student</span>
          </Link>
        </li> -->
        <li v-if="$page.props.auth.user.user_key == '1000000000' || $page.props.auth.user.user_key == '3000000000'">
          <Link
            :href="route('admin.post.index')"
            :class="currentRoute == 'admin.post.index' ? 'text-blue-800 bg-gray-100' : ''"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/post.png" />
          <span :class="currentRoute == 'admin.post.index' ? 'text-[#e5432d]' : ''" class="flex-1 ms-3 whitespace-nowrap">Post</span>
          </Link>
        </li>
        <li v-if="$page.props.auth.user.user_key == '1000000000' || $page.props.auth.user.user_key == '3000000000'">
          <button
            @click="isShowDropDown3 = !isShowDropDown3"
            type="button"
            class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100"
            aria-controls="dropdown-example"
            data-collapse-toggle="dropdown-example"
          >
            <img class="h-8 w-8" src="/images/icons/futurism.png" />
            <span class="flex-1 ms-3 text-left rtl:text-right">Sustainability and Futurism</span>
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
            v-show="isShowDropDown3"
            id="dropdown-example"
            class="py-2 space-y-2"
          >
            <li>
              <Link
                :href="route('admin.futurism.category.index')"
                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100"
                :class="currentRoute == 'admin.futurism.category.index' ? 'text-[#e5432d] bg-gray-100' : ''"
              >Category Images</Link>
            </li>
            <li>
              <Link
                :href="route('admin.futurism.index')"
                :class="currentRoute == 'admin.futurism.index' ? 'text-[#e5432d] bg-gray-100' : ''"
                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100"
              >Futurism</Link>
            </li>
          </ul>
        </li>
        <!-- <li v-if="$page.props.auth.user.user_key == '1000000000' || $page.props.auth.user.user_key == '3000000000'">
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
                :class="currentRoute == 'admin.category.index' ? 'text-[#e5432d] bg-gray-100' : ''"
              >Category</Link>
            </li>
            <li>
              <Link
                :href="route('admin.material.index')"
                :class="currentRoute == 'admin.material.index' ? 'text-[#e5432d] bg-gray-100' : ''"
                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100"
              >Materials</Link>
            </li>
          </ul>
        </li> -->
        <li v-if="$page.props.auth.user.user_key == '1000000000' || $page.props.auth.user.user_key == '3000000000'">
          <Link
            :href="route('admin.material.index')"
            :class="currentRoute == 'admin.material.index' ? 'text-blue-800 bg-gray-100' : ''"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/research.png" />
          <span :class="currentRoute == 'admin.material.index' ? 'text-[#e5432d]' : ''" class="flex-1 ms-3 whitespace-nowrap">Research</span>
          </Link>
        </li>
        <li v-if="$page.props.auth.user.user_key == '1000000000' || $page.props.auth.user.user_key == '3000000000'">
          <Link
            :href="route('admin.logs')"
            :class="currentRoute == 'admin.logs' ? 'text-blue-800 bg-gray-100' : ''"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/logs.png" />
          <span :class="currentRoute == 'admin.logs' ? 'text-[#e5432d]' : ''" class="flex-1 ms-3 whitespace-nowrap">Logs</span>
          </Link>
        </li>
        <li>
          <Link
            :href="route('about')"
            :class="currentRoute == 'about' ? 'text-blue-800 bg-gray-100' : ''"
            class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group"
          >
          <img class="h-8 w-8" src="/images/icons/about.png" />
          <span class="flex-1 ms-3 whitespace-nowrap">About</span>
          </Link>
        </li>
        <li class="block md:hidden">
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
  <section class="w-full absolute top-0 right-0 px-2 py-4 text-end hidden md:block">
    <div class="flex justify-end text-center">
      <img class="avatar mr-4 w-10 h-10 rounded-full cursor-pointer" src="/images/icons/profile-2.gif" alt="Rounded avatar">
      <div id="post-child-dropdown" class="absolute top-14 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
          <ul class="py-2 text-sm text-gray-700" aria-labelledby="doubleDropdownButton">
            <li>
              <Link :href="route('admin.password')" class="block px-4 py-2 hover:bg-gray-100">Change Password</Link>
            </li>
            <li>
              <Link
                :href="route('logout')"
                method="post"
                as="button"
                class="ml-4 block px-4 py-2 hover:bg-gray-100"
              >
              Logout
              </Link>
            </li>
          </ul>
      </div>
    </div>
  </section>
  <div class="p-4 md:ml-64 h-screen">
    <slot />
  </div>
  
</template>

<style scoped>
#post-child-dropdown {
  display: none;
}

#post-child-dropdown:hover {
  display: block;
}

.avatar:hover + #post-child-dropdown{
  display: block;
}
</style>