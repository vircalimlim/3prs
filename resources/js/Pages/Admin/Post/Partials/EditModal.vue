<script setup lang="ts">
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { watchEffect, defineEmits, ref } from 'vue';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const {showEdit, post} = defineProps({
  showEdit: {
    type: Boolean,
    required: true
  },
  post: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['close']);

const form = useForm({
  id: '',
  title: '',
  description: '',
  type: '',
  publish_date: ''
});

const closeModal = () => {
  emit('close');
  form.reset();
};

const editForm = () => {
  form.title = post.title || '';
  form.description = post.description || '';
  form.type = post.type || '';
  form.id = post.id || '';
  form.publish_date = post.publish_date || new Date().toISOString().substr(0, 10);
};

const updatePost = () => {
  form.patch(route("admin.post.update"), {
    onSuccess: () => {
      emit('close');
      form.title = '';
      form.description = '';
      form.type = '';
      form.id = '';
      form.publish_date = '';
                  
      toast.success("Saved!", {
        autoClose: 1000,
      });

    },
  });
};

// Use watchEffect to track prop changes
watchEffect(() => {
  editForm();
});

</script>

<template>
  <Modal :show="showEdit" @close="closeModal">
    <h1 class="text-gray-700 text-2xl font-bold">Post</h1>
    <form @submit.prevent="updatePost" class="mt-6 space-y-6">
        
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
      
      <!-- DOCUMENTATION => https://vueup.github.io/vue-quill/guide/toolbar.html -->
      <QuillEditor v-model:content="form.description" 
        toolbar="essential" 
        contentType="html"
        placeholder="Write your description here..."
        theme="snow"/>

      <div class="flex items-center gap-4">
        <PrimaryButton :disabled="form.processing">Update</PrimaryButton>
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
