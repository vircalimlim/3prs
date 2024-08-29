<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, onBeforeUnmount } from 'vue';
import StudentNavbar from '@/Components/StudentNavbar.vue';
import Footer from '@/Components/Footer.vue';
import TextHeader from '@/Components/TextHeader.vue';

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
        <StudentNavbar />
        <section class="flex justify-center">
            <div class="max-w-[600px] px-2 sm:px-5 mt-20 text-justify">
                <div class="flex items-center gap-2 mb-5">
                    <img class="rounded-full object-cover" style="height: 30px; width: 30px;" src="/images/hero.png"
                        alt="author">
                    <span class="font-bold text-lg">John Doe</span>
                    <span>●</span>
                    <span class="text-sm text-gray-700">2 days ago</span>
                </div>
                <h1 class="text-4xl font-extrabold tracking-tight leading-none text-gray-700">
                    Latest Posts
                </h1>
                <span class="text-sm text-gray-500">Update 4 hours ago</span>
                <p class="mt-5">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint inventore sapiente enim officia,
                    expedita
                    quis. Cumque expedita voluptatum illo qui dolorum ipsam explicabo pariatur tenetur sunt. Accusamus
                    voluptate, nobis, architecto iusto modi libero reiciendis quos saepe ab distinctio explicabo?
                </p>
                <img class="min-h-96 my-5" src="/images/archives.png" alt="archive image">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit aperiam praesentium aliquid
                    quam dolorum labore quaerat nemo maxime. Illo blanditiis, delectus ipsam doloribus rerum nisi beatae
                    accusantium dolore ex illum itaque tempore adipisci, error explicabo commodi similique. Quae nostrum
                    est delectus quas eum illum minus eveniet numquam minima modi! Exercitationem officiis praesentium,
                    cumque odit dolore quibusdam repellendus voluptatum libero. Quod explicabo perferendis accusantium.
                    Beatae perspiciatis adipisci soluta, temporibus hic quibusdam, ut suscipit error, sequi incidunt
                    commodi. Excepturi porro debitis perferendis corporis perspiciatis non sequi quaerat reiciendis,
                    laborum quae, maxime, provident atque libero sed velit expedita aliquam. Reprehenderit ipsa nobis
                    tenetur doloremque a sed optio iste temporibus necessitatibus laboriosam, delectus cumque velit?
                    Placeat obcaecati mollitia doloribus, earum officiis voluptatibus accusantium quae dolor perferendis
                    quia incidunt eos deleniti reprehenderit possimus quos similique et recusandae odio distinctio
                    aliquam quasi iste neque dolorem? Quod cumque animi, dolore autem temporibus veritatis vitae soluta
                    ad magni quia tempore. Autem cumque quaerat ratione quisquam eaque, nulla totam quibusdam asperiores
                    praesentium doloribus. Dolore, dicta! Odit autem, ea libero nemo velit natus voluptate
                    exercitationem blanditiis. Accusantium perferendis ab doloremque numquam. Beatae, ex. Rem impedit
                    repellendus sapiente error rerum asperiores. Quisquam ea nemo accusantium quidem. Nisi animi
                    repellat temporibus? Ea distinctio maiores at nemo, eligendi incidunt a fuga odit quasi, architecto
                    laudantium qui ullam aut sequi nam ipsa perspiciatis, nulla consectetur! Dolorem suscipit ad ducimus
                    eligendi magni quos minus nobis.
                </p>
            </div>
        </section>
        <section class="px-2 sm:px-5 mt-20">
            <TextHeader title="Recent Posts" class="mb-10"/>
            <div class="flex flex-col md:flex-row gap-6">

                <div
                    class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100">
                    <img class="object-cover w-full rounded-t-lg h-36 md:w-48 md:rounded-none md:rounded-s-lg"
                        src="/images/archives.png" alt="">
                    <div class="p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Noteworthy
                            technology acquisitions 2021</h5>
                    </div>
                </div>
                <div
                    class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100">
                    <img class="object-cover w-full rounded-t-lg h-36 md:w-48 md:rounded-none md:rounded-s-lg"
                        src="/images/archives.png" alt="">
                    <div class="p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Noteworthy
                            technology acquisitions 2021</h5>
                    </div>
                </div>
                <div
                    class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100">
                    <img class="object-cover w-full rounded-t-lg h-36 md:w-48 md:rounded-none md:rounded-s-lg"
                        src="/images/archives.png" alt="">
                    <div class="p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Noteworthy
                            technology acquisitions 2021</h5>
                    </div>
                </div>
            </div>
        </section>
        <Footer />
    </main>
</template>
