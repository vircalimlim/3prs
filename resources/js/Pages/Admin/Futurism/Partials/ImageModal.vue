<script setup>
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { watchEffect, defineEmits } from 'vue';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import InputError from '@/Components/InputError.vue';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const {showImage, post} = defineProps({
  showImage: {
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
  image: null,
});

const closeModal = () => {
  emit('close');
  form.reset();
};

const editForm = () => {
  form.image = post.image || '';
  form.id = post.id || '';
};

const updatePost = () => {
  form.post(route("admin.futurism.update_image"), {
    onSuccess: () => {
      emit('close');
      form.image = null;
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
  <Modal :show="showImage" @close="closeModal">
    <h1 class="text-gray-700 text-2xl font-bold">Image</h1>
    <form @submit.prevent="updatePost" class="mt-6 space-y-6">
      <div>
        <InputLabel for="image" value="Image" />
        <input type="file" @input="form.image = $event.target.files[0]" accept="image/png, image/gif, image/jpeg, image/jpg" required class="block mt-2 w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none" aria-describedby="file_input_help" id="image">
        <p class="mt-1 text-sm text-gray-500" id="file_input_help">JPG, JPEG, PNG.</p>
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
        {{ form.progress.percentage }}%
        </progress>
        <InputError class="mt-2" :message="form.errors.image" />
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
