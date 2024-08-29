<script setup lang="ts">
const { title } = defineProps<{
    title: string
}>();
</script>

<template>
    <h1
        class="underline-after mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-700 md:text-5xl lg:text-6xl">
        {{title}}
    </h1>
</template>

<style scoped>
.underline-after {
    position: relative;
    display: inline-block;
}

.underline-after::after {
    content: '';
    display: block;
    position: absolute;
    /* left: 50%; */
    bottom: -15px;
    width: 30%;
    height: 4px;
    background-color: red;
    /* transform: translateX(-50%); */
    transition: width 0.3s ease;
}
</style>