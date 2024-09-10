<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import PasswordField from '@/Components/PasswordField.vue'

const props = defineProps<{
  email: string
  token: string
}>()

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post(route('password.store'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>

<template>
  <GuestLayout>
    <Head title="Reset Password" />
    <v-form
      :disabled="form.processing"
      @submit.prevent="submit"
    >
      <v-text-field
        v-model="form.email"
        :error-messages="form.errors.email"
        autocomplete="username"
        label="Email"
        prepend-inner-icon="mdi-email-outline"
        type="email"
      />
      <password-field
        v-model="form.password"
        :errors="form.errors.password"
        hint="new-password"
        icon="mdi-lock-outline"
      />
      <password-field
        v-model="form.password_confirmation"
        :errors="form.errors.password_confirmation"
        hint="new-password"
        icon="mdi-lock-outline"
        label="Password Confirmation"
      />
      <v-btn
        :loading="form.processing"
        block
        class="mt-4"
        color="primary"
        type="submit"
      >
        Reset Password
      </v-btn>
    </v-form>
  </GuestLayout>
</template>
