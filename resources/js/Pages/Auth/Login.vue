<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import PasswordField from '@/Components/PasswordField.vue'

defineOptions({
  name: 'LoginPage',
})

defineProps<{
  canResetPassword?: boolean
  status: string | null
}>()

const form = useForm({
  email: 'john@example.com',
  password: 'password',
  remember: false,
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}
</script>
<template>
  <GuestLayout>
    <Head title="Log in" />
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
      <div class="d-flex align-center justify-end">
        <Link
          :href="route('password.request')"
          class="text-caption text-decoration-none text-blue"
          rel="noopener noreferrer"
          target="_blank"
        >
          Forgot password?
        </Link>
      </div>
      <password-field
        v-model="form.password"
        :errors="form.errors.password"
        hint="current-password"
        icon="mdi-lock-outline"
      />
      <v-checkbox
        v-model="form.remember"
        label="Remember me"
      />

      <v-btn
        :loading="form.processing"
        block
        class="mb-8"
        color="primary"
        type="submit"
      >
        Login
      </v-btn>
    </v-form>
    <v-card-text class="text-center">
      <Link
        :href="route('register')"
        class="text-blue text-decoration-none"
      >
        Sign up now
        <v-icon icon="mdi-chevron-right" />
      </Link>
    </v-card-text>
  </GuestLayout>
</template>
