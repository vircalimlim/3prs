<script setup lang="ts">
import { ref, defineEmits, watch } from 'vue';
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { useForm, usePage } from '@inertiajs/vue3';
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
  name: '',
  start_date: '',
  end_date: '',
});

const closeModal = () => {
  emit('close');
  form.reset();
}

const storeSemester = () => {
  form.post(route("semester.store"), {
    onSuccess: () => {
      emit('close');
      form.name = "";
      form.start_date = "";
      form.end_date = "";
                        
      toast.success("Saved!", {
        autoClose: 1000,
      });

    },
  });
}
</script>

<template>
  <Modal :show="showAdd" @close="closeModal">
    <h1 class="text-gray-700 text-2xl font-bold">Add semester</h1>
    <form @submit.prevent="storeSemester" class="mt-6 space-y-6">
      <div>
        <InputLabel for="name" value="Name" />
        <TextInput
          id="name"
          type="text"
          class="mt-1 block w-full"
          v-model="form.name"
          required
          autofocus
          autocomplete="name"
        />
        <InputError class="mt-2" :message="form.errors.name" />
      </div>

      <div>
        <InputLabel for="start_date" value="Start Date" />
        <TextInput
          id="start_date"
          type="date"
          class="mt-1 block w-full"
          v-model="form.start_date"
          required
          autocomplete="userstart_date"
        />
        <InputError class="mt-2" :message="form.errors.start_date" />
      </div>

      <div>
        <InputLabel for="end_date" value="End Date" />
        <TextInput
          id="end_date"
          type="date"
          class="mt-1 block w-full"
          v-model="form.end_date"
          required
          autocomplete="userend_date"
        />
        <InputError class="mt-2" :message="form.errors.end_date" />
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
