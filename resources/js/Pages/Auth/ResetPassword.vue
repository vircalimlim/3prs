<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, useForm } from "@inertiajs/vue3";

const props = defineProps<{
  user_key: string;
  token: string;
}>();

const form = useForm({
  token: props.token,
  user_key: props.user_key,
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("password.store"), {
    onFinish: () => {
      form.reset("password", "password_confirmation");
    },
  });
};
</script>

<template>
  <GuestLayout>

    <Head title="Reset Password" />

    <form @submit.prevent="submit">
      <div>
        <InputLabel
          for="user_key"
          value="User Key"
        />

        <TextInput
          id="user_key"
          type="text"
          class="mt-1 block w-full"
          v-model="form.user_key"
          required
          autofocus
          autocomplete="user_key"
        />

        <InputError
          class="mt-2"
          :message="form.errors.user_key"
        />
      </div>

      <div class="mt-4">
        <InputLabel
          for="password"
          value="Password"
        />

        <TextInput
          id="password"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password"
          required
          autocomplete="new-password"
        />

        <InputError
          class="mt-2"
          :message="form.errors.password"
        />
      </div>

      <div class="mt-4">
        <InputLabel
          for="password_confirmation"
          value="Confirm Password"
        />

        <TextInput
          id="password_confirmation"
          type="password"
          class="mt-1 block w-full"
          v-model="form.password_confirmation"
          required
          autocomplete="new-password"
        />

        <InputError
          class="mt-2"
          :message="form.errors.password_confirmation"
        />
      </div>

      <div class="flex items-center justify-end mt-4">
        <PrimaryButton
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Reset Password
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
