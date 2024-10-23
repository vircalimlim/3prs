<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import AddModal from "../Futurism/Partials/AddModal.vue";
import EditModal from "../Futurism/Partials/EditModal.vue";
import ImageModal from "../Futurism/Partials/ImageModal.vue";
import DeleteModal from "../Futurism/Partials/DeleteModal.vue";
import { reactive, ref } from "vue";
import Pagination from "@/Components/Pagination.vue";
import { onMounted } from "vue";
import ImagesModal from "./Partials/ImagesModal.vue";

const { posts } = defineProps({
  posts: {
    type: Object,
    required: true,
  },
  storage_link: {
    type: String,
    required: true,
  },
});

const filteredPost = ref("");
const showAdd = ref(false);
const showEdit = ref(false);
const showImage = ref(false);
const showDelete = ref(false);
const showImages = ref(false);
type DynamicObject = Record<string, any>;

// Create a reactive object with dynamic properties
const editPost = reactive<DynamicObject>({});
const deletePost = reactive<DynamicObject>({});

const openAddModal = () => {
  showAdd.value = true;
};

const openEditModal = (post: DynamicObject) => {
  showEdit.value = true;
  post.type = filteredPost.value;
  Object.assign(editPost, post);
};

const openImageModal = (post: DynamicObject) => {
  showImage.value = true;
  post.type = filteredPost.value;
  Object.assign(editPost, post);
};

const openImagesModal = (post: DynamicObject) => {
  showImages.value = true;
  post.type = filteredPost.value;
  Object.assign(editPost, post);
};

const openDeleteModal = (post: DynamicObject) => {
  showDelete.value = true;
  post.type = filteredPost.value;
  Object.assign(deletePost, post);
};

const getFilter = () => {
  const defaultValue = "";
  const url = new URL(window.location.href);
  const params = new URLSearchParams(url.search);
  const categoryValue = params.get("category") || defaultValue;
  filteredPost.value = categoryValue;
};

const handleTypeFilter = () => {
  router.get(
    "/admin/futurism",
    { category: filteredPost.value },
    { preserveState: true, preserveScroll: true }
  );
};

const formatDate = (inputDate: string) => {
    const date = new Date(inputDate.split(' ')[0]);

    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const year = date.getFullYear();

    return `${month}/${day}/${year}`;
}

onMounted(() => {
  getFilter();
});
</script>

<template>

  <Head title="Dashboard" />

  <Admin>
    <section>
      <div class="flex justify-between items-center">
        <h1 class="my-5 text-4xl font-extrabold tracking-tight leading-none text-gray-600 capitalize">
          Futurism
        </h1>
        <div class="flex items-center gap-2 mb-4">
          <select
            @change="handleTypeFilter"
            v-model="filteredPost"
            id="countries"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2"
          >
            <option
              value=""
              selected
            >All</option>
            <option value="innovation">Av Innovation</option>
            <option value="futurism">Futurism</option>
            <option value="social">Social Impact</option>
            <option value="empowerment">Women Empowerment</option>
            <option value="learning">Learning Development</option>
            <option value="environmental">Environmental Projects</option>
            <option value="initiatives">Student Initiatives</option>
          </select>

          <button
            @click.prevent="openAddModal"
            type="button"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center"
          >
            Add
          </button>
        </div>
      </div>

      <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th
                scope="col"
                class="px-6 py-3"
              >Image</th>
              <th
                scope="col"
                class="px-6 py-3"
              >Title</th>
              <th
                scope="col"
                class="px-6 py-3"
              >Description</th>
              <th
                scope="col"
                class="px-6 py-3"
              >Date</th>
              <th
                scope="col"
                class="px-6 py-3"
              >
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="post in posts.data"
              class="bg-white border-b"
            >
              <td class="w-96 px-2 py-4 whitespace-nowrap align-top">
                <div
                  @click.prevent="openImageModal(post)"
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
                    class="h-auto w-auto md:h-[350px] md:w-full object-cover rounded"
                    :src="storage_link + '/' + post.image"
                    alt="image description"
                  >
                </div>
              </td>

              <td class="font-bold px-4 py-4 align-top">
                <a @click.prevent="openImagesModal(post)" class="hover:text-blue-700" href="">{{post.title}}</a>
              </td>
              <td
                class="px-6 py-4 inline-block"
                v-html="post.description"
              >
              </td>
              <td class="font-bold px-4 py-4 align-top">
                {{post.publish_date}}
              </td>
              <td class="px-6 py-4 text-right align-top">
                <a
                  @click.prevent="openEditModal(post)"
                  href="#"
                  class="font-medium text-blue-600 hover:underline"
                >Edit</a>
                <span class="px-2">|</span>
                <a
                  @click.prevent="openDeleteModal(post)"
                  href="#"
                  class="font-medium text-red-600 hover:underline"
                >Delete</a>
              </td>
            </tr>
            <tr v-if="posts.data.length == 0">
              <td
                class="text-center"
                colspan="4"
              >No records found.</td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="posts.links" />
    </section>
    <AddModal
      :showAdd="showAdd"
      @close="showAdd = false"
    />
    <EditModal
      v-if="showEdit"
      :showEdit="showEdit"
      @close="showEdit = false"
      :post="editPost"
    />
    <ImageModal
      v-if="showImage"
      :showImage="showImage"
      @close="showImage = false"
      :post="editPost"
    />
    <ImagesModal
      v-if="showImages"
      :showImages="showImages"
      @close="showImages = false"
      :post="editPost"
    />
    <DeleteModal
      v-if="showDelete"
      :showDelete="showDelete"
      @close="showDelete = false"
      :post="deletePost"
    />
  </Admin>
</template>
