<script setup>
import { ref, defineEmits, watch } from 'vue';
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

const {showAdd} = defineProps({
  showAdd: {
    type: Boolean,
    required: true
  }
});

const emit = defineEmits(['close']);

const form = useForm({
  title: '',
  description: '',
  image: null,
  type: ''
});

const closeModal = () => {
  emit('close');
  form.reset();
};

const storePost = () => {
  form.post(route("admin.post.store"), {
    onSuccess: () => {
      emit('close');
      form.title = "";
      form.description = "";
      form.image = null;
      form.type = '';
                  
      toast.success("Saved!", {
        autoClose: 1000,
      });

    },
  });
}
</script>

<template>
  <Modal :show="showAdd" @close="closeModal">
    <h1 class="text-gray-700 text-2xl font-bold">Post</h1>
    <form @submit.prevent="storePost" class="mt-6 space-y-6">

        <div>
            <InputLabel for="type" value="Type" />
            <select v-model="form.type" id="countries" class="w-full block mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2" required>
                <option value="" disabled selected>Select type</option>
                <option value="achievements">Achievements</option>
                <option value="announcements">Announcements</option>
            </select>
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
        <InputLabel for="image" value="Image" />
        <input type="file" @input="form.image = $event.target.files[0]" accept="image/png, image/gif, image/jpeg, image/jpg" required class="block mt-2 w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer focus:outline-none" aria-describedby="file_input_help" id="image">
        <p class="mt-1 text-sm text-gray-500" id="file_input_help">JPG, JPEG, PNG.</p>
        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
        {{ form.progress.percentage }}%
        </progress>
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
