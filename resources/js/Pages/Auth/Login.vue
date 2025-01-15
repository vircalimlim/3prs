<script setup lang="ts">
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

defineProps<{
  canResetPassword?: boolean;
  status?: string;
}>();

const form = useForm({
  login: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => {
      form.reset("password");
    },
  });
};
</script>

<template>
  <GuestLayout class="px-2 md:px-0 bg-center bg-no-repeat bg-[url('/images/login-bg.png')] bg-cover bg-gray-400 bg-blend-multiply">

    <Head title="Log in" />

    <div
      v-if="status"
      class="mb-4 font-medium text-sm text-green-600"
    >
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <div class="text-center pb-5">
        <img
          class="inline-block p-2 rounded h-18 fill-current text-gray-500"
          src="/images/logo.png"
          alt="logo"
        >
      </div>
      <div>
        <InputLabel
          for="login"
          value="Unique ID"
        />

        <TextInput
          maxLength="10"
          id="login"
          type="text"
          class="mt-1 block w-full"
          v-model="form.login"
          required
          autofocus
          autocomplete="username"
        />

        <InputError
          class="mt-2"
          :message="form.errors.login"
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
          autocomplete="current-password"
        />

        <InputError
          class="mt-2"
          :message="form.errors.password"
        />
      </div>

      <!-- <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div> -->

      <div class="flex items-center justify-between mt-4">
        <Link
          v-if="canResetPassword"
          :href="route('password.request')"
          class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
        >
        Forgot your password?
        </Link>

        <PrimaryButton
          class="ms-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Log in
        </PrimaryButton>
      </div>
    </form>
  </GuestLayout>
</template>
