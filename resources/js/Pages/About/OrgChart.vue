<script setup>
import TextHeader from "@/Components/TextHeader.vue";
import StudentLayout from "@/Layouts/StudentLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
import ContactSection from "./ContactSection.vue";

const { orgchart, contact } = defineProps({
  orgchart: {
    type: Object,
    required: true,
  },
  contact: {
    type: Object,
    required: true,
  },
});

const form = useForm({
  description: "",
  image: null,
  category: "org-chart",
});

const updateAbout = () => {
  form.post(route("about.update"), {
    onSuccess: () => {
      form.image = null;

      toast.success("Saved!", {
        autoClose: 1000,
      });
    },
  });
};

const editImage = (category) => {
  const fileId = `file-${category}`;
  document.getElementById(fileId).click();
};

onMounted(() => {
  form.description = orgchart.description || "";
});
</script>

<template>
  <StudentLayout page-name="Organizational Chart">
    <form @submit.prevent="updateAbout">
      <section class="relative grid grid-rows-1 md:grid-cols-2 justify-start gap-10 py-10">
        <div
          v-if="$page.props.auth.user && $page.props.auth.user.student_id == 0"
          @click="editImage('org-chart')"
          class="relative group"
        >
          <div class="absolute inset-0 md:h-[350px] flex items-center justify-center rounded bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer">
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
            class="w-full md:h-[350px]"
            :src="`/storage/images/about/${orgchart.thumbnail}`"
            alt="about image"
          >
          <input
            id="file-org-chart"
            @input="form.image = $event.target.files[0]"
            class="hidden"
            accept="image/png, image/gif, image/jpeg, image/jpg"
            type="file"
          >
        </div>
        <div v-else>
          <img
            class="w-full md:h-full"
            :src="`/storage/images/about/${orgchart.thumbnail}`"
            alt="about image"
          >
        </div>
        <div>
          <TextHeader
            title="Organizational Chart"
            class="text-[#1034a6]"
            style="font-size: 40px;"
          />
          <div v-if="$page.props.auth.user && $page.props.auth.user.student_id == 0">
            <textarea
              v-model="form.description"
              class="block mt-5"
              rows="10"
              cols="50"
              name=""
              id=""
              required
            >{{ orgchart.description }}</textarea>
            <button
              type="submit"
              class="mt-2 border border-blue-900 text-blue-800 bg-white-700 hover:bg-blue-800 hover:text-white font-medium rounded-lg text-sm px-5 py-2 me-2 mb-2 focus:outline-none"
            >
              Save
            </button>
          </div>
          <p
            v-else
            class="mt-5"
          >
            {{ orgchart.description }}
          </p>
        </div>
      </section>
    </form>

    <ContactSection :contact="contact" />
  </StudentLayout>
</template>