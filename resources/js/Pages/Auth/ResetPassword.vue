<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import PasswordField from '@/Components/PasswordField.vue'
import EmailField from '@/Components/EmailField.vue'

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
    <v-card-title>Reset Password</v-card-title>
    <v-form
      :disabled="form.processing"
      @submit.prevent="submit"
    >
      <v-col>
        <email-field
          v-model="form.email"
          :errors="form.errors.email"
        />
      </v-col>
      <v-col>
        <password-field
          v-model="form.password"
          :errors="form.errors.password"
          hint="new-password"
        />
      </v-col>
      <v-col>
        <password-field
          v-model="form.password_confirmation"
          :errors="form.errors.password_confirmation"
          hint="new-password"
          label="Password Confirmation"
        />
      </v-col>
      <v-col cols="12">
        <v-btn
          :loading="form.processing"
          block
          color="primary"
          type="submit"
        >
          Reset Password
        </v-btn>
      </v-col>
    </v-form>
  </GuestLayout>
</template>
