<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm } from '@inertiajs/vue3';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { watchEffect } from 'vue';

const {contact} = defineProps({
    'contact': {
        type: Object,
        required: true,
    },
})

const form = useForm({
  fb_name: '',
  fb_link: '',
  email: '',
});

const editForm = () => {
  form.fb_name = contact.fb_name || '';
  form.fb_link = contact.fb_link || '';
  form.email = contact.email || '';
};

const storePost = () => {
  form.patch(route("admin.contact.update"), {
    onSuccess: () => {
                  
      toast.success("Saved!", {
        autoClose: 1000,
      });

    },
  });
}

// Use watchEffect to track prop changes
watchEffect(() => {
  editForm();
});

</script>

<template>
        <section class="mt-10">
            <div class="p-4 bg-blue-700 text-white font-bold text-center text-lg">Contact Details</div>
            <div class="flex justify-center" v-if="$page.props.auth.user && $page.props.auth.user.student_id == 0">
                <form @submit.prevent="storePost" class="mt-6 space-y-6 w-full md:w-3/4">
                    <div>
                        <InputLabel for="fb_name" value="FB Name" />
                        <TextInput
                        id="fb_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.fb_name"
                        required
                        />
                        <InputError class="mt-2" :message="form.errors.fb_name" />
                    </div>

                    <div>
                        <InputLabel for="fb_link" value="FB Link" />
                        <TextInput
                        id="fb_link"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.fb_link"
                        required
                        />
                        <InputError class="mt-2" :message="form.errors.fb_link" />
                    </div>

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
            </div>
            <div v-else class="flex flex-col justify-center items-center gap-2 mt-5">
                <div>
                    <div class="flex gap-x-2">
                        <span>Facebook:</span>
                        <a class="text-blue-700 uppercase" :href="contact.fb_link" target="_blank">
                            {{contact.fb_name}}
                        </a>
                    </div>
                    <h1>Email: {{contact.email}}</h1>
                </div>
            </div>
        </section>
</template>