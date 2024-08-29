<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onBeforeUnmount } from 'vue';

const isHidden = ref(false);
let lastScrollTop = 0;

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
}

.hidden {
    top: -100px;
}

</style>

<template>

    <Head title="Welcome" />
    <main class="w-full">
        <header class="flex flex-wrap justify-between py-5 px-2 bg-gray-50"
            :class="{ 'hidden': isHidden, 'navbar': true }">
            <div>
                <img class="h-8" src="/images/logo.png" alt="school logo">
            </div>
            <div>
                <img src="" alt="website logo">
            </div>
            <div>
                <button type="button"
                    class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2">
                    Login
                </button>
            </div>
        </header>

        <section class="bg-center bg-no-repeat bg-[url('/images/hero.png')] bg-cover bg-gray-400 bg-blend-multiply">
            <div class="px-4 mx-auto max-w-screen-xl text-start py-24 lg:py-56">
                <h1
                    class="w-full sm:w-72 mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                    Discover Boundless Research
                </h1>
                <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl">
                    Access Boundless Knowledge
                </p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-start sm:space-y-0">
                    <!-- <a href="#"
                        class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        Get started
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a> -->
                    <a href="#"
                        class="max-w-32 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg border border-white hover:border-blue-800 hover:text-grey-300 hover:bg-blue-800 focus:ring-4 focus:ring-gray-400">
                        Learn more
                    </a>
                </div>
            </div>
        </section>

        <section class="flex flex-wrap justify-between items-center px-5 mt-20">
            <div class="w-full md:w-[50%]">
                <h1
                    class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-700 md:text-5xl lg:text-6xl">
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
                    expedita ad voluptas porro labore repellat laboriosam incidunt? Non, libero nulla voluptate alias
                    ipsa sequi nam labore! Enim esse illum ut perspiciatis quia autem eaque recusandae soluta ullam est
                    cupiditate aspernatur, nesciunt asperiores nam. Ratione necessitatibus, veritatis impedit blanditiis
                    obcaecati nam optio voluptates minima vero quidem neque fugiat repudiandae possimus ad ipsa nesciunt
                    aspernatur dolorum reprehenderit fugit placeat repellat quasi quam eum earum? Possimus nihil
                    voluptas a, molestiae nemo nesciunt ipsa iste officiis voluptatum vel excepturi. Soluta animi et ea.
                    Ex aperiam unde necessitatibus vitae debitis esse modi, tempora asperiores reprehenderit maxime
                    repudiandae suscipit id quidem. Similique fugit vitae tenetur, eveniet voluptate quaerat quos
                    repellat itaque. Nobis architecto maiores id sit nemo! Sit veniam perspiciatis perferendis in velit
                    aliquam labore, nesciunt possimus corporis facilis autem doloremque minus animi consequuntur
                    assumenda reiciendis mollitia at consectetur dolor inventore quidem quam temporibus. Perspiciatis
                    facilis nostrum quibusdam, deleniti esse cumque itaque vitae autem, fugiat eius ullam quod similique
                    totam sit repellat.
                </p>
                <a href="#"
                    class="mt-5 bg-blue-700 inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg hover:text-grey-300 hover:bg-blue-800">
                    Explore Our Library
                </a>
            </div>
            <div class="w-full md:w-[50%] px-4">
                <div
                    class="min-h-[400px] rounded bg-center bg-no-repeat bg-[url('/images/library.png')] bg-gray-400 bg-blend-multiply">
                </div>
            </div>
        </section>

        <section class="px-5 mt-20">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-700 md:text-5xl lg:text-6xl">
                Research Library Collections
            </h1>


            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-10">
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg" alt="">
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
                    <div>
                        <img class="h-auto max-w-full rounded-lg"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg" alt="">
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
                    <div>
                        <img class="h-auto max-w-full rounded-lg"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg" alt="">
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
                </div>
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg"
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
                    <div>
                        <img class="h-auto max-w-full rounded-lg"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg" alt="">
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
                    <div>
                        <img class="h-auto max-w-full rounded-lg"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-5.jpg" alt="">
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
                </div>
                <div class="grid gap-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg" alt="">
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
                    <div>
                        <img class="h-auto max-w-full rounded-lg"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg" alt="">
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
                    <div>
                        <img class="h-auto max-w-full rounded-lg"
                            src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg" alt="">
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
                </div>
            </div>
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
