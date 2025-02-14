<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted } from "vue";
import Footer from "@/Components/Footer.vue";

const { pageName } = defineProps({
  pageName: {
    type: String,
    required: true,
  },
});

const form = useForm({});

const scrollValue = ref(0);
let lastScrollTop = 0;
const isMenuOpen = ref(false);
const futurismCategories = ref([]);

const handleScroll = () => {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  scrollValue.value = scrollTop;
  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
};

const toggleMenu = () => {
  isMenuOpen.value = !isMenuOpen.value;
};

const getFuturismcategory = () => {
  axios
  .get("/get_futurism/category")
  .then((res) => {
    futurismCategories.value = res.data;
  });
}

onMounted(() => {
  getFuturismcategory();
  window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll);
});
</script>

<template>
  <nav
    :class="scrollValue >= 250 ? 'hidden' : ''"
    class="absolute -top-4 right-0 z-10 w-full border-gray-200 py-4 bg-fixed bg-center bg-no-repeat bg-[url('/images/hero.png')] bg-cover bg-gray-600 bg-blend-multiply h-[400px]"
  >
    <div class="bg-white py-4">
      <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4 bg-white">
        <a
          href="/"
          class="flex items-center space-x-3 rtl:space-x-reverse z-50"
        >
          <img
            src="https://flowbite.com/docs/images/logo.svg"
            class="h-8"
            alt="Flowbite Logo"
          />
          <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-700">3PRS</span>
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
          <ul class="menu-items bg-white text-xl font-bold flex flex-col justify-center p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
            <li>
              <Link
                href="/"
                class="text-gray-700 block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
              >Home</Link>
            </li>
            <li>
              <div
                onclick=""
                id="post-dropdown"
                class="relative flex items-center md:hover:text-blue-700"
              >
                <a
                  href="#"
                  class="text-gray-700 block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 cursor-pointer"
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
                class="text-gray-700 block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
              >Research</Link>
            </li>
            <li>
              <div
                onclick=""
                id="post-dropdown"
                class="relative flex items-center md:hover:text-blue-700"
              >
                <a
                  href="#"
                  class="text-gray-700 block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 cursor-pointer"
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
                    <li v-for="futurism_category in futurismCategories">
                      <Link
                        :href="route('futurism.index', {category: futurism_category.id})"
                        class="block px-4 py-2 hover:bg-gray-100 capitalize"
                      >{{futurism_category.name}}</Link>
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
              >
                <a
                  href="#"
                  class="text-gray-700 block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 cursor-pointer"
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
                      >VMO</Link>
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
                class="text-gray-700 block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
              >Login</Link>
            </li>
            <li v-if="$page.props.auth.user !== null">
              <div
                onclick=""
                id="post-dropdown"
                class="relative flex items-center md:hover:text-blue-700"
              >
                <a
                  href="#"
                  class="text-gray-700 block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:p-0 cursor-pointer"
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
    </div>
    <div class="h-full flex flex-col items-center justify-center gap-10">
      <h1 class="uppercase text-center text-4xl font-bold text-gray-50">{{pageName}}</h1>
      <div class="flex gap-2 text-gray-100">
        <Link
          class="hover:text-blue-600"
          href="/"
        >Home</Link>
        <span class="text-[#e5432d] text-bold">//</span>
        <span class="text-blue-600 font-bold capitalize">{{pageName}}</span>
      </div>
    </div>
  </nav>
  <div class="h-[400px]"></div>

  <nav
    v-if="scrollValue >= 250"
    class="fixed top-0 right-0 z-10 w-full bg-white shadow border-gray-200 py-4"
  >
    <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
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
        :class="isMenuOpen ? 'block fixed top-20 left-0 md:relative md:top-0 bg-white' : 'hidden'"
        class="w-full md:block"
        id="navbar-default"
      >
        <ul class="menu-items text-xl font-bold flex flex-col justify-center p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
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
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-100'"
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
                  <li v-for="futurism_category in futurismCategories">
                    <Link
                      :href="route('futurism.index', {category: futurism_category.id})"
                      class="block px-4 py-2 hover:bg-gray-100 capitalize"
                    >{{futurism_category.name}}</Link>
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
                    >VMO</Link>
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
              :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-100'"
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

  <main class="mt-5 p-2 md:p-4">
    <slot />
  </main>

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
</style>
