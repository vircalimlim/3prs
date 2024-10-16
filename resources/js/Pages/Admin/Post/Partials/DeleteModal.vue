<script setup lang="ts">
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { watchEffect, defineEmits } from 'vue';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const {showDelete, post} = defineProps({
  showDelete: {
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
  type: ''
});

const closeModal = () => {
  emit('close');
  form.reset();
};

const editForm = () => {
  form.type = post.type || '';
  form.id = post.id || '';
  form.title = post.title || '';
};

const deletePost = () => {
  form.delete(route("admin.post.delete"), {
    onSuccess: () => {
      emit('close');
      form.type = '';
      form.id = '';
      form.title = '';
                  
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
  <Modal :show="showDelete" @close="closeModal">
    <h1 class="text-gray-700 text-2xl font-bold">Delete Post</h1>
    <form @submit.prevent="deletePost" class="mt-6 space-y-6">
        <div class="pt-2 text-center text-lg">Are you sure you want to delete this post?</div>
        <h1 class="text-center font-bold pb-2">"{{ form.title }}"</h1>
        <div class="flex justify-center gap-4">
            <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Delete</button>
            <button @click.prevent="closeModal" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Close</button>
        </div>
    </form>
  </Modal>
</template>
