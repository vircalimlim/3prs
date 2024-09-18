<script setup>
import { Link } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted } from "vue";
import Footer from "@/Components/Footer.vue";

const { pageName } = defineProps({
  pageName: {
    type: String,
    required: true,
  },
});

const scrollValue = ref(0);
let lastScrollTop = 0;
const isMenuOpen = ref(false);

const handleScroll = () => {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  scrollValue.value = scrollTop;
  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
};

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};

onMounted(() => {
  window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll);
});
</script>

<template>
  <nav
    :class="scrollValue >= 250 ? 'hidden' : ''"
    class="absolute top-0 right-0 z-10 w-full border-gray-200 py-4 bg-fixed bg-center bg-no-repeat bg-[url('/images/hero.png')] bg-cover bg-gray-600 bg-blend-multiply h-[300px]"
  >
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a
        href="/"
        class="flex items-center space-x-3 rtl:space-x-reverse"
      >
        <img
          src="https://flowbite.com/docs/images/logo.svg"
          class="h-8"
          alt="Flowbite Logo"
        />
        <span class="text-white self-center text-2xl font-semibold whitespace-nowrap">3PRS</span>
      </a>
      <button
        @click="toggleMenu"
        data-collapse-toggle="navbar-default"
        type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
        aria-controls="navbar-default"
        aria-expanded="false"
      >
        <span class="sr-only">Open main menu</span>
        <svg
          class="w-5 h-5"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 17 14"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15"
          />
        </svg>
      </button>
      <div
        :class="isMenuOpen ? 'block fixed top-20 left-0 md:relative md:top-0' : 'hidden'"
        class="w-full md:block md:w-auto"
        id="navbar-default"
      >
        <ul class="bg-white md:bg-transparent text-xl font-bold flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
          <li>
            <Link
              :href="route('announcement.index')"
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
            >Announcements</Link>
          </li>
          <li>
            <Link
              :href="route('achievement.index')"
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
            >Achievements</Link>
          </li>
          <li>
            <Link
              href="/research"
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
            >Research</Link>
          </li>
          <li>
            <Link
              :href="route('about')"
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
            >About</Link>
          </li>
          <li v-if="$page.props.auth.user == null">
            <Link
              href="/login"
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
            >Login</Link>
          </li>
          <li v-if="$page.props.auth.user !== null">
            <Link
              :href="route('logout')"
              method="post"
              as="button"
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
            >Logout</Link>
          </li>
        </ul>
      </div>
    </div>
    <div class="h-full flex flex-col items-center justify-center gap-10">
      <h1 class="uppercase text-center text-4xl font-bold text-gray-50">{{pageName}}</h1>
      <div class="flex gap-2 text-gray-100">
        <Link
          class="hover:text-blue-600"
          href="/"
        >Home</Link>
        <span>//</span>
        <span class="text-blue-600 font-bold capitalize">{{pageName}}</span>
      </div>
    </div>
  </nav>
  <div class="h-[300px]"></div>

  <nav
    v-if="scrollValue >= 250"
    class="fixed top-0 right-0 z-10 w-full bg-white shadow border-gray-200 py-4"
  >
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a
        href="/"
        class="flex items-center space-x-3 rtl:space-x-reverse"
      >
        <img
          src="https://flowbite.com/docs/images/logo.svg"
          class="h-8"
          alt="Flowbite Logo"
        />
        <span class="self-center text-2xl font-semibold whitespace-nowrap">3PRS</span>
      </a>
      <button
        @click="toggleMenu"
        data-collapse-toggle="navbar-default"
        type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
        aria-controls="navbar-default"
        aria-expanded="false"
      >
        <span class="sr-only">Open main menu</span>
        <svg
          class="w-5 h-5"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 17 14"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15"
          />
        </svg>
      </button>
      <div
        :class="isMenuOpen ? 'block' : 'hidden'"
        class="w-full md:block md:w-auto"
        id="navbar-default"
      >
        <ul class="text-xl font-bold flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
          <li>
            <Link
              :href="route('announcement.index')"
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-100'"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
            >Announcements</Link>
          </li>
          <li>
            <Link
              :href="route('achievement.index')"
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-100'"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
            >Achievements</Link>
          </li>
          <li>
            <Link
              href="/research"
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-100'"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
            >Research</Link>
          </li>
          <li>
            <Link
              :href="route('about')"
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-100'"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
            >About</Link>
          </li>
          <li v-if="$page.props.auth.user == null">
            <Link
              href="/login"
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-100'"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
            >Login</Link>
          </li>
          <li v-if="$page.props.auth.user !== null">
            <Link
              :href="route('logout')"
              method="post"
              as="button"
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-100'"
              class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
            >Logout</Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="mt-5 p-2 md:p-4">
    <slot />
  </main>

  <Footer />
</template>
