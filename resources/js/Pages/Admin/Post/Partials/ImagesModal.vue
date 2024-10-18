<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { watchEffect, defineEmits, reactive } from 'vue';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import InputError from '@/Components/InputError.vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { useDropzone } from 'vue3-dropzone';

const {showImages, post} = defineProps({
  showImages: {
    type: Boolean,
    required: true
  },
  post: {
    type: Object,
    required: true
  }
});

const state = reactive({
  files: [],
});

const emit = defineEmits(['close']);

const form = useForm({
  id: '',
  images: [],
  image_name: '',
  type: ''
});

const closeModal = () => {
  emit('close');
  form.reset();
};

const editForm = () => {
  form.type = post.type || '';
  form.id = post.id || '';
};

const updatePost = () => {
  form.images = state.files;
  form.post(route("admin.post.upload_images"), {
    onSuccess: () => {
      emit('close');
    //   form.image = null;
      form.type = '';
      form.id = '';
                  
      toast.success("Saved!", {
        autoClose: 1000,
      });

    },
  });
};

const deleteimage = (id, image_name) => {
    form.id = id;
    form.image_name = image_name;

    form.delete(route("admin.post.delete.image"), {
    onSuccess: () => {
      emit('close');
      form.id = '';
      form.image_name;
                  
      toast.success("Saved!", {
        autoClose: 1000,
      });

    },
    preserveScroll: true,
  });
}

// Use watchEffect to track prop changes
watchEffect(() => {
  editForm();
});

const { getRootProps, getInputProps, isDragActive, ...rest } = useDropzone({
  onDrop,
});

function onDrop(acceptFiles, rejectReasons) {
  state.files = acceptFiles;
}

function handleClickDeleteFile(index) {
  state.files.splice(index, 1);
}

</script>

<template>
  <Modal :show="showImages" @close="closeModal">
    <h1 class="text-gray-700 text-2xl font-bold">Images</h1>
    <form @submit.prevent="updatePost" class="mt-6 space-y-6">
        <div class="flex flex-wrap gap-4">
            <div v-for="post_image in post.images" class="relative">
                <img :src="`/storage/images/${post.type}/${post_image.file_name}`" alt="Image 1" class="w-32 h-32 object-cover rounded-lg">
                <button @click.prevent="deleteimage(post_image.id, post_image.file_name)" class="absolute top-1 right-1 p-1 bg-red-500 text-white rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <div>
          <InputLabel value="Upload Images Here" class="mb-2 text-center"/>
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
              <input v-bind="getInputProps()" accept="image/png, image/gif, image/jpeg, image/jpg"/>
              <p v-if="isDragActive">Drop the files here ...</p>
              <p v-else>Drag and drop files here, or Click to select files</p>
            </div>
          </div>
        </div>

      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="form.processing">Upload</PrimaryButton>
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
