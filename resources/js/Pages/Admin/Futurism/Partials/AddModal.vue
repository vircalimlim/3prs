<script setup>
import { ref, defineEmits, watch, reactive } from 'vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { useDropzone } from 'vue3-dropzone';

const {showAdd, futurism_categories} = defineProps({
  showAdd: {
    type: Boolean,
    required: true
  },
  futurism_categories: {
    type: Array,
    required: true,
  },
});

const state = reactive({
  files: [],
});

const emit = defineEmits(['close']);

const form = useForm({
  title: '',
  description: '',
  image: null,
  images: [],
  category: '',
  publish_date: ''
});

const closeModal = () => {
  emit('close');
  form.reset();
};

const storePost = () => {
  form.images = state.files
  form.post(route("admin.futurism.store"), {
    onSuccess: () => {
      emit('close');
      form.title = "";
      form.description = "";
      form.image = null;
      form.category = '';
      form.images = null;
      state.files = [];
                  
      toast.success("Saved!", {
        autoClose: 1000,
      });

    },
  });
}

const { getRootProps, getInputProps, isDragActive, ...rest } = useDropzone({
  onDrop,
});

watch(state, () => {
  // console.log('state', state);
});

watch(isDragActive, () => {
  // console.log('isDragActive', isDragActive.value, rest);
});

function onDrop(acceptFiles, rejectReasons) {
  state.files = acceptFiles;
}

function handleClickDeleteFile(index) {
  state.files.splice(index, 1);
}
</script>

<template>
  <Modal :show="showAdd" @close="closeModal">
    <h1 class="text-gray-700 text-2xl font-bold">Futurism</h1>
    <form @submit.prevent="storePost" class="mt-6 space-y-6">

        <div>
            <InputLabel for="category" value="Category" />
            <select v-model="form.category" id="category" class="w-full block mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2" required>
                <option value="" disabled selected>Select Category</option>
                <option v-for="futurism_category in futurism_categories" :value="futurism_category.id" class="capitalize">{{futurism_category.name}}</option>
            </select>
            <InputError class="mt-2" :message="form.errors.category" />
        </div>

      <div>
        <InputLabel for="title" value="Title" />
        <TextInput
          id="title"
          type="text"
          class="mt-1 block w-full"
          v-model="form.title"
          required
        />
        <InputError class="mt-2" :message="form.errors.title" />
      </div>

      <div>
        <InputLabel for="publish_date" value="Publish Date" />
        <input
          type="date"
          id="publish_date"
          v-model="form.publish_date"
          class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
        >
        <InputError class="mt-2" :message="form.errors.publish_date" />
      </div>

      <div>
        <InputLabel for="image" value="Image" />
        <input type="file" @input="form.image = $event.target.files[0]" accept="image/png, image/gif, image/jpeg, image/jpg" required class="block mt-2 w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none" aria-describedby="file_input_help" id="image">
        <p class="mt-1 text-sm text-gray-500" id="file_input_help">JPG, JPEG, PNG.</p>
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
        {{ form.progress.percentage }}%
        </progress>
      </div>

      <div>
          <InputLabel value="Images" class="mb-2"/>
          <div v-if="state.files.length > 0" class="files">
            <div class="file-item" v-for="(file, index) in state.files" :key="index">
              <span>{{ file.name }}</span>
              <span class="delete-file" @click="handleClickDeleteFile(index)"
                >Delete</span
              >
            </div>
          </div>
          <div v-else class="dropzone" v-bind="getRootProps()">
            <div
              class="multiple-image-border"
              :class="{
                isDragActive,
              }"
            >
              <input v-bind="getInputProps()" accept="image/png, image/gif, image/jpeg, image/jpg" />
              <p v-if="isDragActive">Drop the files here ...</p>
              <p v-else>Drag and drop files here, or Click to select files</p>
            </div>
          </div>
      </div>
      
      <!-- DOCUMENTATION => https://vueup.github.io/vue-quill/guide/toolbar.html -->
      <QuillEditor v-model:content="form.description" 
        toolbar="essential" 
        contentType="html"
        placeholder="Write your description here..."
        theme="snow"/>

      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="form.processing">Save</PrimaryButton>
        <Transition
          enter-active-class="transition ease-in-out"
          enter-from-class="opacity-0"
          leave-active-class="transition ease-in-out"
          leave-to-class="opacity-0"
        >
          <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
        </Transition>
      </div>
    </form>
  </Modal>
</template>

<style scoped>
.dropzone,
.files {
  width: 100%;
  /* max-width: 300px; */
  margin: 0 auto;
  padding: 10px;
  border-radius: 8px;
  box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
    rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
  font-size: 12px;
  line-height: 1.5;
}

.multiple-image-border {
  border: 2px dashed #ccc;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  transition: all 0.3s ease;
  background: #fff;

  &.isDragActive {
    border: 2px dashed #ffb300;
    background: rgb(255 167 18 / 20%);
  }
}

.file-item {
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: rgb(255 167 18 / 20%);
  padding: 7px;
  padding-left: 15px;
  margin-top: 10px;

  &:first-child {
    margin-top: 0;
  }

.delete-file {
    background: red;
    color: #fff;
    padding: 5px 10px;
    border-radius: 8px;
    cursor: pointer;
}
}
</style>
