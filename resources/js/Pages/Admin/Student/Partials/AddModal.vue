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
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AddCourseModal from './AddCourseModal.vue';

const {showAdd, courses} = defineProps({
  showAdd: {
    type: Boolean,
    required: true
  },
  courses: {
    type: Array<any>,
    required: true,
  }
});

const showAddCourse = ref(false);

const emit = defineEmits(['close']);

const form = useForm({
  first_name: '',
  middle_name: '',
  last_name: '',
  gender: '',
  dob: '',
  email: '',
  mobile: '',
  address: '',
  course_id: '',
  student_number: '',
});

const closeModal = () => {
  emit('close');
  form.reset();
};

const storeStudent = () => {
  form.post(route("admin.student.store"), {
    onSuccess: () => {
      emit('close');
      form.first_name = "";
      form.middle_name = "";
      form.last_name = "";
      form.gender = "";
      form.dob = "";
      form.email = "";
      form.mobile = "";
      form.address = "";
      form.course_id = "";      
      form.student_number = "";
                        
      toast.success("Saved!", {
        autoClose: 1000,
      });

    },
  });
};

const openAddCourseModal = () => {
  showAddCourse.value = true;
};
</script>

<template>
  <Modal :show="showAdd" @close="closeModal">
    <h1 class="text-gray-700 text-2xl font-bold">Add Student</h1>
    <form @submit.prevent="storeStudent" class="mt-6 space-y-6">
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
            <InputLabel for="mobile" value="Mobile"/>
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
            <InputLabel for="student_number" value="Student ID Number" />
            <TextInput
            id="student_number"
            type="text"
            class="mt-1 block w-full"
            v-model="form.student_number"
            required
            autofocus
            autocomplete="student_number"
            />
            <InputError class="mt-2" :message="form.errors.student_number" />
      </div>

      <div>
            <div class="flex items-center gap-x-2">
              <InputLabel for="course_id" value="Course" />
              <button @click.prevent="openAddCourseModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-square text-green-600" viewBox="0 0 16 16">
                  <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
              </button>
            </div>
            <select v-model="form.course_id" class="w-full block mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 py-2" required>
                <option value="" disabled selected>Select course</option>
                <option v-for="course in courses" :value="course.id">{{course.name}}</option>
            </select>
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
  <AddCourseModal :showAdd="showAddCourse" @close="showAddCourse = false" />
</template>
