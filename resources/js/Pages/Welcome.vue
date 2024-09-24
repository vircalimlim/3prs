<script setup lang="ts">
import { Head, Link } from "@inertiajs/vue3";
import { ref, onMounted, onUnmounted } from "vue";
import TextHeader from "@/Components/TextHeader.vue";
import Footer from "@/Components/Footer.vue";

const { achievements } = defineProps({
  achievements: {
    type: Array<any>,
    required: true,
  },
  announcements: {
    type: Array<any>,
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

onMounted(() => {
  window.addEventListener("scroll", handleScroll);
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
          <ul class="bg-white md:bg-transparent text-xl font-bold flex flex-col justify-center p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
            <li>
              <Link
                href="/"
                :class="scrollValue >= 250 ? 'text-gray-700' : 'text-gray-700 md:text-gray-100'"
                class="block py-2 px-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
              >Home</Link>
            </li>
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
        <img
            v-show="scrollValue < 250"
            src="/images/logo-without-bg-2.png"
            class="h-8 hidden md:block"
            alt="Flowbite Logo"
          />
        <img
            v-show="scrollValue >= 250"
            src="/images/logo.png"
            class="h-8 hidden md:block"
            alt="Flowbite Logo"
         />
      </div>
    </nav>

    <section class="bg-fixed bg-center bg-no-repeat bg-[url('/images/hero.png')] bg-cover bg-gray-400 bg-blend-multiply">
      <div class="px-4 mx-auto max-w-screen-xl text-start py-24 lg:py-56">
        <h1 class="w-full sm:w-72 mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
          Discover Boundless Research
        </h1>
        <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl">
          Access Boundless Knowledge
        </p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-start sm:space-y-0">
          <a
            href="#"
            class="max-w-32 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg border border-white hover:border-blue-800 hover:text-grey-300 hover:bg-blue-800 focus:ring-4 focus:ring-gray-400"
          >
            Learn more
          </a>
        </div>
      </div>
    </section>

    <section class="flex flex-wrap justify-between items-center px-5 mt-20">
      <div class="w-full md:w-[50%]">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-700 md:text-5xl lg:text-6xl">
          Welcome to 3PRS e-Journal Website
        </h1>
        <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl">
          Access Boundless Knowledge
        </p>
        <p class="text-justify">
          Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus cupiditate vitae, enim quis atque
          odio fugit exercitationem inventore quae temporibus tenetur asperiores provident obcaecati ullam
          voluptas veniam. Aliquid, porro fugit dolorem id sunt expedita amet dolores non minima voluptate
          harum quod magni sed? Provident omnis, nemo non impedit suscipit, adipisci voluptates vero velit
          quis, sed id est maxime rem aspernatur illum voluptas dolores expedita veritatis quo? Iusto optio
          exercitationem ducimus accusamus alias dolor earum modi voluptatem minima beatae? Quaerat autem
          ratione, esse molestias fuga nostrum nobis distinctio eveniet adipisci. Consectetur facere quos
          ducimus at accusantium animi ipsam odit? Illum aliquid incidunt ullam ipsa harum provident
          praesentium impedit perferendis minus eius iste non explicabo voluptas veniam vel accusamus,
          voluptatibus a nemo maxime totam quia, odio tempore placeat? Nulla, voluptates accusamus veritatis
          corporis eum quae suscipit quos inventore, fuga ex, in cupiditate praesentium necessitatibus quis
          expedita ad voluptas porro labore repellat laboriosam incidunt.
        </p>
        <a
          href="#"
          class="mt-5 bg-blue-700 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg hover:text-grey-300 hover:bg-blue-800"
        >
          Explore Our Library
        </a>
      </div>
      <div class="w-full md:w-[50%] px-4">
        <div class="min-h-[400px] rounded bg-center bg-no-repeat bg-[url('/images/library.png')] bg-gray-400 bg-blend-multiply">
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
          <p
            v-html="announcement.description"
            class="line-clamp-3 mt-2 mb-5 text-lg font-normal text-gray-500"
          ></p>
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
          <p
            v-html="achievement.description"
            class="line-clamp-3 mt-2 mb-5 text-lg font-normal text-gray-500"
          ></p>
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
  </main>
</template>
