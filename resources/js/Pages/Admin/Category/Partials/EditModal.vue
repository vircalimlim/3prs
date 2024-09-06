<script setup lang="ts">
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { watchEffect, defineEmits } from 'vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const {showEdit, category} = defineProps({
  showEdit: {
    type: Boolean,
    required: true
  },
  category: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['close']);

const form = useForm({
  id: '',
  title: '',
  description: '',
});

const closeModal = () => {
  emit('close');
  form.reset();
};

const editForm = () => {
  form.title = category.title || '';
  form.description = category.description || '';
  form.id = category.id || '';
};

const updateCategory = () => {
  form.patch(route("admin.category.update"), {
    onSuccess: () => {
      emit('close');
      form.title = '';
      form.description = '';
      form.id = '';
      
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
    <h1 class="text-gray-700 text-2xl font-bold">Edit Category</h1>
    <form @submit.prevent="updateCategory" class="mt-6 space-y-6">
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
        <InputLabel for="description" value="Description" />
        <TextInput
          id="description"
          type="text"
          class="mt-1 block w-full"
          v-model="form.description"
          required
        />
        <InputError class="mt-2" :message="form.errors.description" />
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
