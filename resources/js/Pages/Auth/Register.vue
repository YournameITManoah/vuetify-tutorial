<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import PasswordField from '@/Components/PasswordField.vue'

defineOptions({
  name: 'RegisterPage',
})

defineProps<{
  canResetPassword?: boolean
  status: string | null
}>()

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>
<template>
  <GuestLayout>
    <Head title="Register" />
    <v-form
      :disabled="form.processing"
      @submit.prevent="submit"
    >
      <v-text-field
        v-model="form.name"
        :error-messages="form.errors.name"
        label="Name"
        prepend-inner-icon="mdi-account"
        type="text"
      />
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
        hint="new-password"
        icon="mdi-lock-outline"
      />
      <password-field
        v-model="form.password_confirmation"
        hint="new-password"
        icon="mdi-lock-outline"
        label="Password Confirmation"
      />
      <v-btn
        :loading="form.processing"
        block
        class="mb-5 mt-3"
        color="primary"
        type="submit"
      >
        Register
      </v-btn>
    </v-form>
    <v-card-text class="text-center">
      <Link
        :href="route('login')"
        class="text-blue text-decoration-none"
      >
        Already registered?
      </Link>
    </v-card-text>
  </GuestLayout>
</template>
