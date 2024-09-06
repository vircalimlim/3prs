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

const {showEdit, student} = defineProps({
  showEdit: {
    type: Boolean,
    required: true
  },
  student: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['close']);

const form = useForm({
  id: '',
  first_name: '',
  middle_name: '',
  last_name: '',
  gender: '',
  dob: '',
  email: '',
  mobile: '',
  address: '',
});

const closeModal = () => {
  emit('close');
  form.reset();
};

const editForm = () => {
  form.first_name = student.first_name || '';
  form.middle_name = student.middle_name || '';
  form.last_name = student.last_name || '';
  form.gender = student.gender || '';
  form.dob = student.dob || '';
  form.email = student.email || '';
  form.mobile = student.mobile || '';
  form.address = student.address || '';
  form.id = student.id || '';
};

const updateStudent = () => {
  form.patch(route("admin.student.update"), {
    onSuccess: () => {
      emit('close');
      form.first_name = '';
      form.middle_name = '';
      form.last_name = '';
      form.gender = '';
      form.dob = '';
      form.email = '';
      form.mobile = '';
      form.address = '';
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
    <h1 class="text-gray-700 text-2xl font-bold">Add Student</h1>
    <form @submit.prevent="updateStudent" class="mt-6 space-y-6">
      <div class="grid gap-6 md:grid-cols-3">
        <div>
            <InputLabel for="first_name" value="First Name" />
            <TextInput
            id="first_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.first_name"
            required
            autofocus
            autocomplete="first_name"
            />
            <InputError class="mt-2" :message="form.errors.first_name" />
        </div>

        <div>
            <InputLabel for="middle_name" value="Middle Name" />
            <TextInput
            id="middle_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.middle_name"
            required
            />
            <InputError class="mt-2" :message="form.errors.middle_name" />
        </div>

        <div>
            <InputLabel for="last_name" value="Last Name" />
            <TextInput
            id="last_name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.last_name"
            required
            />
            <InputError class="mt-2" :message="form.errors.last_name" />
        </div>
      </div>

      <div class="grid gap-6 md:grid-cols-2">
        <div>
            <InputLabel for="email" value="Email" />
            <TextInput
            id="email"
            type="text"
            class="mt-1 block w-full"
            v-model="form.email"
            required
            />
            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div>
            <InputLabel for="mobile" value="Mobile" />
            <TextInput
            id="mobile"
            type="text"
            maxLength="11"
            class="mt-1 block w-full"
            v-model="form.mobile"
            />
            <InputError class="mt-2" :message="form.errors.mobile" />
        </div>
      </div>

      <div>
        <InputLabel for="address" value="Address" />
        <TextInput
          id="address"
          type="text"
          class="mt-1 block w-full"
          v-model="form.address"
          required
        />
        <InputError class="mt-2" :message="form.errors.address" />
      </div>

      <div>
            <InputLabel for="dob" value="Date of Birth" />
            <TextInput
            id="dob"
            type="date"
            class="mt-1 block w-full"
            v-model="form.dob"
            required
            />
            <InputError class="mt-2" :message="form.errors.dob" />
      </div>

      <div>
        <InputLabel for="gender" value="Gender" />

        <div class="flex items-center mb-4">
            <input v-model="form.gender" id="gender-1" value="male" type="radio" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
            <label for="gender-1" class="ms-2 text-sm font-medium text-gray-900">Male</label>
        </div>
        <div class="flex items-center">
            <input v-model="form.gender" id="gender-2" value="female" type="radio" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
            <label for="gender-2" class="ms-2 text-sm font-medium text-gray-900">Female</label>
        </div>

        <InputError class="mt-2" :message="form.errors.gender" />
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
