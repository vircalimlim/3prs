<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onBeforeUnmount } from 'vue';
import StudentNavbar from '@/Components/StudentNavbar.vue';

const isHidden = ref(false);
let lastScrollTop = 0;
const items = [
    {
        title: 'First',
        description: 'The first item.',
    },
    {
        title: 'Second',
        description: 'The second item.',
    },
    {
        title: 'Second',
        description: 'The second item.',
    },
    {
        title: 'Second',
        description: 'The second item.',
    },
    {
        title: 'Second',
        description: 'The second item.',
    },
    {
        title: 'Second',
        description: 'The second item.',
    },
    {
        title: 'Second',
        description: 'The second item.',
    },
];

const handleScroll = () => {
    const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    if (currentScroll > lastScrollTop) {
        // Scroll Down
        isHidden.value = true;
    } else {
        // Scroll Up
        isHidden.value = false;
    }
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScroll);
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
    /* Ensure it's above other content */
}

.hidden {
    top: -100px;
    /* Adjust this value based on header height */
}

/* Optional: add additional styles for the navbar */
</style>

<template>

    <Head title="Welcome" />
    <main class="w-full">
        <StudentNavbar/>
        
        <!-- <header class="md:flex flex-wrap justify-between bg-white py-5 px-2 shadow"
            :class="{ 'hidden': isHidden, 'navbar': true }">
            <div>
                <img src="" alt="school logo">
            </div>
            <div>
                <img src="" alt="website logo">
            </div>
            <div class="flex">

                <form class="px-2">
                    <div class="relative">
                        <svg class="absolute w-4 h-4 text-gray-500 dark:text-gray-400" style="top: 18px; left: 10px;"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <input type="search" id="default-search"
                            class="block w-full p-4  text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search" required style="padding-left: 30px;" />
                    </div>
                </form>

                <button type="button"
                    class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 text-center">
                    Contact Us
                </button>
            </div>
            <div class="w-full px-5 mt-5">
                <div id="mega-menu-full-image" class="items-center justify-between w-full md:flex md:w-auto md:order-1">
                    <ul
                        class="flex text-xl flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-8 rtl:space-x-reverse">
                        <li>
                            <a href="#"
                                class="block py-2 px-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0"
                                aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0">Marketplace</a>
                        </li>
                    </ul>
                </div>
            </div>
        </header> -->
        <!-- <section class="md:mt-20 md:invisible">invisible Margin</section> -->

        <section class="flex flex-col md:flex-row">
            <div
                class="bg-center bg-no-repeat bg-[url('/images/group-reading.png')] min-h-[400px] bg-cover bg-gray-400 bg-blend-multiply mt-20 md:mt-5 w-full md:w-[65%]">
                <div class="px-4 mx-auto max-w-screen-xl text-start py-24 lg:py-56">
                    <h1
                        class="w-full sm:w-72 mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                        Discover Knowledge
                    </h1>
                    <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl">
                        A Secure Platform for Research Archive
                    </p>
                </div>
            </div>
            <div class="mt-5 w-full md:w-[35%] flex flex-col px-5">
                <div class="mt-10 visible"></div>
                <img class="rounded h-96 object-cover" src="/images/student-reading.png" alt="student reading">
                <p class="mb-8 text-md font-normal text-gray-900 mt-10">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione harum error repellendus accusantium
                    deserunt. Deleniti est error itaque rem dicta quia vel perferendis. Maiores maxime adipisci voluptas
                    nesciunt alias, perferendis omnis, ipsa perspiciatis optio eaque expedita impedit minima laborum et?
                </p>
                <a href="#"
                    class="max-w-32 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-blue-800 hover:text-gray-50 hover:bg-blue-800 mb-5">
                    Learn more
                </a>
            </div>
        </section>

        <section class="px-5 mt-20">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-700 md:text-5xl lg:text-6xl">
                Latest Posts
            </h1>


            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-10">


                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                    <a href="#">
                        <img class="rounded-t-lg h-72 w-full object-cover" src="/images/reading.png" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Noteworthy technology
                                acquisitions 2021</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate suscipit amet mollitia
                            qui ea vitae cum odit dolor? Aperiam, fugit. Quam quaerat adipisci quae cumque sequi
                            officiis optio rerum, eaque debitis voluptate modi labore ratione consequatur molestiae
                            doloremque numquam aliquid suscipit incidunt officia, voluptates esse, accusamus dolor!
                            Doloribus dolor nesciunt veniam aspernatur, quod cum hic.
                        </p>
                    </div>
                </div>

                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                    <a href="#">
                        <img class="rounded-t-lg h-72 w-full object-cover" src="/images/reading.png" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Noteworthy technology
                                acquisitions 2021</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700">
                            Here are the biggest enterprise technology
                            acquisitions of 2021 so far, in reverse chronological order.
                        </p>
                    </div>
                </div>

                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                    <a href="#">
                        <img class="rounded-t-lg h-72 w-full object-cover" src="/images/reading.png" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Noteworthy technology
                                acquisitions 2021</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Rerum amet minima corporis ipsum
                            est corrupti, sint veritatis beatae dignissimos dolor.
                        </p>
                    </div>
                </div>

                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow">
                    <a href="#">
                        <img class="rounded-t-lg h-72 w-full object-cover" src="/images/reading.png" alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Noteworthy technology
                                acquisitions 2021</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700">
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Odit perspiciatis, cupiditate
                            explicabo ad laudantium expedita eum mollitia adipisci consequatur! Repellendus natus
                            dolorum enim minima molestiae facere pariatur! Vel molestiae dolor nam, ducimus quaerat
                            nisi, odit pariatur asperiores exercitationem cupiditate officia nemo nihil laboriosam
                            eligendi. Ipsa.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <section class="px-5 mt-20">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-700 md:text-5xl lg:text-6xl">
                Research Archive Collections
            </h1>
            <div class="mt-10"></div>
            <masonry-wall :items="items" :ssr-columns="1" :column-width="400" :gap="16">
                <template #default="{ item, index }">
                    <div>
                        <img class="h-auto max-w-full rounded-lg" :style="{ height: `${(index + 1) * 100}px` }"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg" alt="">
                        <h1
                            class="mt-5 text-xl font-extrabold tracking-tight leading-none text-gray-700 sm:text-2xl lg:text-3xl">
                            Research Library Collections
                        </h1>
                        <p class="mt-2 text-lg font-normal text-gray-500">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis ducimus et non totam,
                            officia fugiat ex adipisci maiores laudantium deserunt maxime expedita incidunt. Nostrum
                            nemo sit asperiores voluptatibus enim beatae!
                        </p>
                    </div>
                </template>
            </masonry-wall>
        </section>

        <footer class="bg-white rounded-lg shadow mt-20">
            <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
                <div class="sm:flex sm:items-center sm:justify-between">
                    <a href="" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap">Flowbite</span>
                    </a>
                    <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0">
                        <li>
                            <a href="#" class="hover:underline me-4 md:me-6">About</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Contact</a>
                        </li>
                    </ul>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
                <span class="block text-sm text-gray-500 sm:text-center">© 2024 3PRS™.</span>
            </div>
        </footer>
    </main>
</template>
