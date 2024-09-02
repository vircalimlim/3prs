<template>
    <div v-if="links.length > 3">
      <div class="flex flex-wrap justify-center mt-5 -mb-1">
        <template
          v-for="(link, index) in links"
          :key="index"
        >
          <div
            v-if="link.url === null"
            class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded"
            v-html="link.label"
          />
          <Link
            v-else
            :class="[
              'mb-1 mr-1 px-4 py-3 text-sm leading-4 border rounded',
              link.active || activeLink === index ? 'bg-red text-red-700' : 'hover:bg-white'
            ]"
            :href="link.url"
            @click="setActiveLink(index)"
            v-html="link.label"
          />
        </template>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from "vue";
  import { Link } from "@inertiajs/vue3";
  
  const props = defineProps({
    links: Array,
  });
  
  const activeLink = ref(null);
  
  const setActiveLink = (index) => {
    activeLink.value = index;
  };
  </script>
  