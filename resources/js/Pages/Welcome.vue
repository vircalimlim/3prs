<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted } from "vue";
import TextHeader from "@/Components/TextHeader.vue";
import Footer from "@/Components/Footer.vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import Dotdotdot from "dotdotdot-js";

const { achievements, section2, section1 } = defineProps({
  achievements: {
    type: Array,
    required: true,
  },
  announcements: {
    type: Array,
    required: true,
  },
  section1: {
    type: Object,
    required: true,
  },
  section2: {
    type: Object,
    required: true,
  },
  storage_link: {
    type: String,
    required: true,
  },
});
const showMenu = ref(true);
const scrollValue = ref(0);
const isMenuOpen = ref(false);
let lastScrollTop = 0;
const clampTextAchvmnt = ref(null);
const clampTextAnnncmnt = ref(null);
let dotInstance = null;

const formSection1 = useForm({
  description: "",
  image: null,
  category: "section1",
});

const formSection2 = useForm({
  description: "",
  image: null,
  category: "section2",
});

const handleScroll = () => {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  scrollValue.value = scrollTop;

  if (scrollTop === 0) {
    showMenu.value = true; // Show menu at the topmost position
  } else if (scrollTop > lastScrollTop) {
    showMenu.value = true; // Show menu when scrolling down
  } else if (scrollTop < lastScrollTop) {
    showMenu.value = false; // Hide menu when scrolling up
  }

  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
};

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};

const editImage = (category) => {
  const fileId = `file-${category}`;
  document.getElementById(fileId).click();
};

const updateSection1 = () => {
  formSection1.post(route("section.update"), {
    onSuccess: () => {
      formSection1.image = null;

      toast.success("Saved!", {
        autoClose: 1000,
      });
    },
  });
};

const updateSection2 = () => {
  formSection2.post(route("section.update"), {
    onSuccess: () => {
      formSection2.image = null;

      toast.success("Saved!", {
        autoClose: 1000,
      });
    },
  });
};

onMounted(() => {
  window.addEventListener("scroll", handleScroll);
  formSection2.description = section2.description || "";

  if (clampTextAchvmnt.value.length > 1) {
    // Apply Dotdotdot to each element in the array
    clampTextAchvmnt.value.forEach((text) => {
      if (text) {
        new Dotdotdot(text, {
          height: 100, // Set max height for the text container
          truncate: "letter", // Truncate by letter, can be 'word' or 'node'
        });
      }
    });
  } else if (clampTextAchvmnt.value.length === 1 && clampTextAchvmnt.value[0]) {
    // Handle single element case
    new Dotdotdot(clampTextAchvmnt.value[0], {
      height: 100,
      truncate: "letter",
    });
  }

  if (clampTextAnnncmnt.value.length > 1) {
    // Apply Dotdotdot to each element in the array
    clampTextAnnncmnt.value.forEach((text) => {
      if (text) {
        new Dotdotdot(text, {
          height: 100, // Set max height for the text container
          truncate: "letter", // Truncate by letter, can be 'word' or 'node'
        });
      }
    });
  } else if (
    clampTextAnnncmnt.value.length === 1 &&
    clampTextAnnncmnt.value[0]
  ) {
    // Handle single element case
    new Dotdotdot(clampTextAnnncmnt.value[0], {
      height: 100,
      truncate: "letter",
    });
  }
});

onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll);
});
</script>

<style scoped>
header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  transition: top 0.3s;
  z-index: 1000;
}

.hidden {
  top: -100px;
}
</style>

<template>

  <Head title="Welcome" />
  <main class="w-full">

    <nav
      v-show="showMenu"
      :class="scrollValue >= 250 ? 'bg-white' : 'bg-transparent'"
      class="fixed z-10 w-full border-gray-200 py-4"
    >
      <div class="max-w-screen-xl flex flex-wraps items-center justify-between mx-auto p-4">
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
          :class="isMenuOpen ? 'block fixed top-20 left-0 md:relative md:top-0' : 'hidden'"
          class="w-full md:block"
          id="navbar-default"
        >
          <ul class="menu-items bg-white md:bg-transparent text-xl font-bold flex flex-col justify-center p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
            <li>
              <Link
                href="/"
                :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
                class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
              >Home</Link>
            </li>
            <li>
              <div
                onclick=""
                id="post-dropdown"
                class="relative flex items-center md:hover:text-blue-700"
                :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
              >
                <a
                  href="#"
                  class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 cursor-pointer"
                >
                  Post
                </a>
                <svg
                  class="w-2.5 h-2.5 ms-3"
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

                <div
                  id="post-child-dropdown"
                  class="absolute top-8 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44"
                >
                  <ul
                    class="py-2 text-sm text-gray-700"
                    aria-labelledby="doubleDropdownButton"
                  >
                    <li>
                      <Link
                        :href="route('announcement.index')"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >Announcements</Link>
                    </li>
                    <li>
                      <Link
                        :href="route('achievement.index')"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >Achievements</Link>
                    </li>
                  </ul>
                </div>

              </div>
            </li>
            <li>
              <Link
                href="/research"
                :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
                class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
              >Research</Link>
            </li>
            <li>
              <div
                onclick=""
                id="post-dropdown"
                class="relative flex items-center md:hover:text-blue-700"
                :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
              >
                <a
                  href="#"
                  class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 cursor-pointer"
                >
                  Sustainability and Futurism
                </a>
                <svg
                  class="w-2.5 h-2.5 ms-3"
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

                <div
                  id="post-child-dropdown"
                  class="absolute top-8 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-full"
                >
                  <ul
                    class="py-2 text-sm text-gray-700"
                    aria-labelledby="doubleDropdownButton"
                  >
                    <li>
                      <Link
                        :href="route('futurism.index', {category: 'innovation'})"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >AVInnovation</Link>
                    </li>
                    <li>
                      <Link
                        :href="route('futurism.index', {category: 'futurism'})"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >Futurism</Link>
                    </li>
                    <li>
                      <Link
                        :href="route('futurism.index', {category: 'social'})"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >Social Impact</Link>
                    </li>
                    <li>
                      <Link
                        :href="route('futurism.index', {category: 'empowerment'})"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >Women Empowerment</Link>
                    </li>
                    <li>
                      <Link
                        :href="route('futurism.index', {category: 'learning'})"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >Learning Development</Link>
                    </li>
                    <li>
                      <Link
                        :href="route('futurism.index', {category: 'environmental'})"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >Environmental Projects</Link>
                    </li>
                    <li>
                      <Link
                        :href="route('futurism.index', {category: 'initiatives'})"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >Student Initiatives</Link>
                    </li>
                  </ul>
                </div>

              </div>
            </li>
            <li>
              <div
                onclick=""
                id="post-dropdown"
                class="relative flex items-center md:hover:text-blue-700"
                :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
              >
                <a
                  href="#"
                  class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 cursor-pointer"
                >
                  About
                </a>
                <svg
                  class="w-2.5 h-2.5 ms-3"
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

                <div
                  id="post-child-dropdown"
                  class="absolute top-8 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44"
                >
                  <ul
                    class="py-2 text-sm text-gray-700"
                    aria-labelledby="doubleDropdownButton"
                  >
                    <li>
                      <Link
                        :href="route('about')"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >About</Link>
                    </li>
                    <li>
                      <Link
                        :href="route('mission')"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >Mission Vision</Link>
                    </li>
                    <li>
                      <Link
                        :href="route('org-chart')"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >Organizational Chart</Link>
                    </li>
                    <!-- <li>
                        <Link :href="route('vision')" class="block px-4 py-2 hover:bg-gray-100">Vision</Link>
                      </li>
                      <li>
                        <Link :href="route('objectives')" class="block px-4 py-2 hover:bg-gray-100">Objectives</Link>
                      </li> -->
                  </ul>
                </div>

              </div>
            </li>
            <li v-if="$page.props.auth.user == null">
              <Link
                href="/login"
                :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
                class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
              >Login</Link>
            </li>
            <li v-if="$page.props.auth.user !== null">
              <div
                onclick=""
                id="post-dropdown"
                class="relative flex items-center md:hover:text-blue-700"
                :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
              >
                <a
                  href="#"
                  class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 cursor-pointer"
                >
                  Settings
                </a>
                <svg
                  class="w-2.5 h-2.5 ms-3"
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

                <div
                  id="post-child-dropdown"
                  class="absolute top-8 z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-44"
                >
                  <ul
                    class="py-2 text-sm text-gray-700"
                    aria-labelledby="doubleDropdownButton"
                  >
                    <li>
                      <Link
                        :href="route('student.password')"
                        class="block px-4 py-2 hover:bg-gray-100"
                      >Change Password</Link>
                    </li>
                    <li>
                      <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="block w-full text-start px-4 py-2 hover:bg-gray-100"
                      >Logout</Link>
                    </li>
                  </ul>
                </div>

              </div>
            </li>
          </ul>
        </div>

        <div
          v-if="scrollValue < 250"
          class="hidden md:flex items-center gap-x-3"
        >
          <img
            src="/images/logo-binalonan-without-bg.png"
            class="h-10 hidden md:block"
            alt="Logo"
          />
          <img
            src="/images/binalonan-without-bg.png"
            class="h-12 hidden md:block"
            alt="Logo"
          />
        </div>
        <div
          v-else
          class="hidden md:flex items-center gap-x-3"
        >
          <img
            src="/images/logo-2.png"
            class="h-10 hidden md:block"
            alt="Logo"
          />
          <img
            src="/images/binalonan.png"
            class="h-12 hidden md:block"
            alt="Logo"
          />
        </div>
      </div>
    </nav>

    <section
      :style="{ backgroundImage: `url('/storage/images/about/${section1.thumbnail}')` }"
      class="bg-fixed bg-center bg-no-repeat bg-cover bg-gray-400 bg-blend-multiply"
    >
      <div class="px-4 mx-auto max-w-screen-xl text-start py-24 lg:py-56">
        <h1 class="w-full sm:w-72 mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
          Discover Boundless Research
        </h1>
        <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl">
          Access Boundless Knowledge
        </p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-start sm:space-y-0">
          <Link
            :href="route('about')"
            class="max-w-32 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg border border-white hover:border-blue-800 hover:text-grey-300 hover:bg-blue-800 focus:ring-4 focus:ring-gray-400"
          >
          About Us
          </Link>
        </div>
        <button
          @click="editImage('section-1')"
          v-if="$page.props.auth.user && $page.props.auth.user.student_id == 0"
          class="absolute top-[35%] right-[40%] py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-800 focus:ring-4 focus:ring-gray-400 shadow-lg"
        >
          Update Background Image
          <input
            @change="updateSection1"
            id="file-section-1"
            @input="formSection1.image = $event.target.files[0]"
            class="hidden"
            accept="image/png, image/gif, image/jpeg, image/jpg"
            type="file"
          >
        </button>
      </div>
    </section>

    <section
      v-if="$page.props.auth.user && $page.props.auth.user.student_id == 0"
      class="flex flex-wrap justify-between items-center px-5 mt-20"
    >
      <div class="w-full md:w-[50%]">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-700 md:text-5xl lg:text-6xl">
          Welcome to 3PRS e-Journal Website
        </h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl">
          Access Boundless Knowledge
        </p>
        <textarea
          v-model="formSection2.description"
          class="text-justify block"
          placeholder="Write your description here ..."
          rows="10"
          cols="60"
          required
        ></textarea>
        <button
          @click.prevent="updateSection2"
          type="button"
          class="mt-2 border border-blue-900 text-blue-800 bg-white-700 hover:bg-blue-800 hover:text-white font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 focus:outline-none"
        >
          Save
        </button>
        <!-- <a
          href="/research"
          class="mt-5 bg-blue-700 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg hover:text-grey-300 hover:bg-blue-800"
        >
          Explore Our Library
        </a> -->
      </div>
      <div class="w-full md:w-[50%] px-4">
        <div
          @click="editImage('section-2')"
          class="relative group"
        >
          <div class="absolute inset-0 flex items-center justify-center rounded bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="40"
              height="40"
              fill="currentColor"
              class="bi bi-camera text-white"
              viewBox="0 0 16 16"
            >
              <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z" />
              <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
            </svg>
          </div>

          <img
            class="h-auto w-auto md:h-[400px] md:w-full object-cover rounded"
            :src="`/storage/images/about/${section2.thumbnail}`"
            alt="image description"
          >
          <input
            id="file-section-2"
            @input="formSection2.image = $event.target.files[0]"
            class="hidden"
            accept="image/png, image/gif, image/jpeg, image/jpg"
            type="file"
          >
        </div>
      </div>
    </section>
    <section
      v-else
      class="flex flex-wrap justify-between items-center px-5 mt-20"
    >
      <div class="w-full md:w-[50%]">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-700 md:text-5xl lg:text-6xl">
          Welcome to 3PRS e-Journal Website
        </h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl">
          Access Boundless Knowledge
        </p>
        <p class="text-justify">
          {{section2.description}}
        </p>
        <a
          href="/research"
          class="mt-5 bg-blue-700 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg hover:text-grey-300 hover:bg-blue-800"
        >
          Explore Our Library
        </a>
      </div>
      <div class="w-full md:w-[50%] px-4">
        <div
          :style="{ backgroundImage: `url('/storage/images/about/${section2.thumbnail}')` }"
          class="min-h-[400px] rounded bg-center bg-cover bg-no-repeat bg-gray-400 bg-blend-multiply"
        >
        </div>
      </div>
    </section>

    <section class="px-5 mt-20">
      <TextHeader title="Announcements" />
      <div class="flex flex-wrap justify-center md:justify-start gap-10 mt-10">
        <div
          v-for="announcement in announcements"
          class="max-w-96"
        >
          <img
            class="h-72 max-w-full rounded-lg"
            :src="storage_link + '/announcements/' + announcement.image"
            :alt="announcement.title"
          >
          <h1 class="capitalize line-clamp-2 mt-5 text-xl font-extrabold tracking-tight leading-none text-gray-700 sm:text-2xl lg:text-3xl">
            {{ announcement.title }}
          </h1>
          <div
            ref="clampTextAnnncmnt"
            v-html="announcement.description"
            class="line-clamp-3 mt-2 mb-5 text-lg font-normal text-gray-500"
          ></div>
          <Link
            :href="`/announcement/${announcement.id}`"
            class="py-2 px-3 text-base font-medium text-center text-blue-700 rounded-lg border border-border-800 hover:border-blue-800 hover:text-white hover:text-grey-300 hover:bg-blue-800"
          >
          Read more
          </Link>
        </div>
      </div>
      <div v-show="achievements.length < 1">
        <h1 class="text-center text-xl text-gray-500 py-10">No achievements yet.</h1>
      </div>
    </section>

    <section class="px-5 mt-20">
      <TextHeader title="Achievements" />
      <div class="flex flex-wrap justify-center md:justify-start gap-10 mt-10">
        <div
          v-for="achievement in achievements"
          class="max-w-96"
        >
          <img
            class="h-72 max-w-full rounded-lg"
            :src="storage_link + '/achievements/' + achievement.image"
            :alt="achievement.title"
          >
          <h1 class="capitalize line-clamp-2 mt-5 text-xl font-extrabold tracking-tight leading-none text-gray-700 sm:text-2xl lg:text-3xl">
            {{ achievement.title }}
          </h1>
          <div
            ref="clampTextAchvmnt"
            v-html="achievement.description"
            class="line-clamp-3 mt-2 mb-5 text-lg font-normal text-gray-500"
          ></div>
          <Link
            :href="`/achievement/${achievement.id}`"
            class="py-2 px-3 text-base font-medium text-center text-blue-700 rounded-lg border border-border-800 hover:border-blue-800 hover:text-white hover:text-grey-300 hover:bg-blue-800"
          >
          Read more
          </Link>
        </div>
      </div>
      <div v-show="achievements.length < 1">
        <h1 class="text-center text-xl text-gray-500 py-10">No announcements yet.</h1>
      </div>
    </section>

    <Footer />

    <section
      class="fixed bottom-0 left-0 w-full"
      v-if="$page.props.auth.user && $page.props.auth.user.student_id == 0"
    >
      <div class="text-center bg-white py-2">
        <h3 class="">You're viewing as <strong>ADMIN</strong></h3>
        <p>You can customize some parts of this page.</p>
        <p>Go to <a
            class="text-blue-700 font-bold"
            href="/dashboard"
          >Dashboard</a></p>
      </div>
    </section>
  </main>
</template>

<style scoped>
#post-child-dropdown {
  display: none;
}

.menu-items > li:hover #post-child-dropdown {
  display: block;
  color: blue;
}

.menu-items > li {
  padding: 10px 0px;
}

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  line-clamp: 3;
  -webkit-box-pack: end;
  text-overflow: ellipsis;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-align: left;
}
</style>
