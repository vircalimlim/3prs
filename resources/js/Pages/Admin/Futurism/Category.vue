<script setup lang="ts">
import Admin from "@/Layouts/Admin.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import { reactive, ref } from "vue";
import { onMounted } from "vue";
import CategoryImagesModal from "./Partials/CategoryImagesModal.vue";
import CategoryAddModal from "./Partials/CategoryAddModal.vue";
import CategoryEditModal from "./Partials/CategoryEditModal.vue";

const { categories, storage_link } = defineProps({
  categories: {
    type: Object,
    required: true,
  },
  storage_link: {
    type: String,
    required: true,
  },
});

const filteredPost = ref("");
const showImages = ref(false);
const showAdd = ref(false);
const showEdit = ref(false);
type DynamicObject = Record<string, any>;

// Create a reactive object with dynamic properties
const editCategory = reactive<DynamicObject>({});


const openImagesModal = (category: DynamicObject) => {
  showImages.value = true;
  Object.assign(editCategory, category);
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

const openAddModal = () => {
  showAdd.value = true;
};

const openEditModal = (category: DynamicObject) => {
  showEdit.value = true;
  Object.assign(editCategory, category);
};

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
          Futurism Category
        </h1>
        <button
            @click.prevent="openAddModal"
            type="button"
            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center"
          >
            Add
          </button>
      </div>

      <div class="relative overflow-x-auto shadow sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th
                scope="col"
                class="px-6 py-3"
              >Category</th>
              <th
                scope="col"
                class="px-6 py-3"
              >Images</th>
              <th>Edit</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(category, key) in categories"
              class="bg-white border-b"
            >
              <td
                class="px-6 py-4 inline-block capitalize"
              >
                {{ category.category_name }}
              </td>
              <td>
                <div v-if="category.images.length > 0" class="flex gap-2">
                  <img
                    @click.prevent="openImagesModal(category)"
                    v-for="image in category.images"
                    class="w-[150px] h-[150px] object-cover rounded"
                    :src="storage_link + '/' + image.image"
                    alt="image category"
                  >
                </div>
                <div v-else>
                  <img
                    @click.prevent="openImagesModal(category)"
                    class="w-[150px] h-[150px] object-cover rounded"
                    src="/images/no-image.png"
                    alt="image category"
                  >
                </div>
              </td>
              <td>
                <a
                  @click.prevent="openEditModal(category)"
                  href="#"
                  class="font-medium text-blue-600 hover:underline mr-2"
                >Edit</a>
              </td>
            </tr>
            <tr v-if="categories.length == 0">
              <td
                class="text-center"
                colspan="4"
              >No records found.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
    <CategoryAddModal       
      :showAdd="showAdd"
      @close="showAdd = false"
    />
    <CategoryEditModal       
      :showEdit="showEdit"
      :category="editCategory"
      @close="showEdit = false"
    />
    <CategoryImagesModal
      v-if="showImages"
      :showImages="showImages"
      @close="showImages = false"
      :category="editCategory"
    />
  </Admin>
</template>
