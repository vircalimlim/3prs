<script setup>
import { ref, defineEmits, watch, reactive } from 'vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { useDropzone } from 'vue3-dropzone';

const {showAdd} = defineProps({
  showAdd: {
    type: Boolean,
    required: true
  }
});

const state = reactive({
  files: [],
});

const emit = defineEmits(['close']);

const form = useForm({
  name: '',
  images: [],
});

const closeModal = () => {
  emit('close');
  form.reset();
};

const storePost = () => {
  form.images = state.files
  form.post(route("admin.futurism_category.store"), {
    onSuccess: () => {
      emit('close');
      form.name = "";
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
    <h1 class="text-gray-700 text-2xl font-bold">Futurism Category</h1>
    <form @submit.prevent="storePost" class="mt-6 space-y-6">
      <div>
        <InputLabel for="name" value="Name" />
        <TextInput
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.name"
          required
        />
        <InputError class="mt-2" :message="form.errors.name" />
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
