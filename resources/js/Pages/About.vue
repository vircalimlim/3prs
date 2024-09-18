<script setup lang="ts">
import TextHeader from '@/Components/TextHeader.vue';
import StudentLayout from '@/Layouts/StudentLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <StudentLayout page-name="About Us">
        <section class="flex flex-col md:flex-row justify-center gap-10 py-10">
            <img class="w-full h-full md:h-[350px] md:w-[50%]" src="/images/hero.png" alt="about image">
            <div>
                <TextHeader title="About Us" style="font-size: 40px;"/>
                <p class="mt-5">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ut, delectus labore dolores eum porro laudantium deleniti optio itaque eius nemo, unde maxime vel harum quisquam dolorem quidem commodi facilis. Obcaecati doloremque quidem animi! Dolore, qui labore. Unde, dolores? Laborum dicta ipsa dolores fuga ratione id quo repellendus aut eveniet!
                </p>
            </div>
        </section>
    </StudentLayout>
</template>