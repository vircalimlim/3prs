<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { watchEffect, defineEmits } from 'vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const {showEdit, material} = defineProps({
  showEdit: {
    type: Boolean,
    required: true
  },
  material: {
    type: Object,
    required: true
  },
  categories: {
    type: Array,
    required: true
  }
});

const emit = defineEmits(['close']);

const form = useForm({
    category: '',
    title: '',
    description: '',
    currentFile: '',
    pdf: null,
    id: '',
    author: '',
    published_date: '',
});

const closeModal = () => {
  emit('close');
  form.reset();
};

const editForm = () => {
  form.category = material.category_id || '';
  form.title = material.title || '';
  form.description = material.description || '';
  form.currentFile = material.file_path || '';
  form.pdf = null,
  form.id = material.id || '';
  form.author = material.author || '';
  form.published_date = material.published_date || '';
};

const updateMaterial = () => {
  form.post(route("admin.material.update"), {
    onSuccess: () => {
      emit('close');
      form.category = '';
      form.title = '';
      form.description = '';
      form.currentFile = '';
      form.pdf = null;
      form.id = '';
      form.author = '';
      form.published_date = '';
            
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
    <h1 class="text-gray-700 text-2xl font-bold">Edit Material</h1>
    <form @submit.prevent="updateMaterial" class="mt-6 space-y-6">

        <div>
            <InputLabel for="category" value="Category" />
            <select v-model="form.category" id="countries" class="w-full block mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2" required>
                <option value="" disabled selected>Select category</option>
                <option v-for="category in categories" :value="category.id">{{category.title}}</option>
            </select>
        </div>

        <div>
            <InputLabel for="pdf" value="Upload pdf" />
            <input type="file" id="pdf" @input="form.pdf = $event.target.files[0]" accept="application/pdf" class="block mt-2 w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none" aria-describedby="file_input_help" />
            <!-- <p class="mt-1 text-sm text-gray-500" id="file_input_help">JPG, JPEG, PNG.</p> -->
            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
            {{ form.progress.percentage }}%
            </progress>
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
        <InputLabel for="author" value="Author" />
        <TextInput
          id="author"
          type="text"
          class="mt-1 block w-full"
          v-model="form.author"
          required
        />
        <InputError class="mt-2" :message="form.errors.author" />
      </div>

      <div>
        <InputLabel for="published_date" value="Published Date" />
        <TextInput
          id="published_date"
          type="date"
          class="mt-1 block w-full"
          v-model="form.published_date"
          required
        />
        <InputError class="mt-2" :message="form.errors.published_date" />
      </div>

      <div>
        <InputLabel for="description" value="Description" />
        <textarea v-model="form.description" id="description" rows="4" required class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write description here..."></textarea>
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
