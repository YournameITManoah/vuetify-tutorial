<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'

defineProps<{
  status: string | null
}>()

const form = useForm({
  email: '',
})

const submit = () => {
  form.post(route('password.email'))
}
</script>

<template>
  <GuestLayout>
    <Head title="Forgot Password" />
    <v-form
      :disabled="form.processing"
      @submit.prevent="submit"
    >
      <div class="text-subtitle-2 text-medium-emphasis mb-4">
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset
        link that will allow you to choose a new one.
      </div>
      <v-alert
        v-if="status"
        :text="status"
      />
      <v-text-field
        v-model="form.email"
        :error-messages="form.errors.email"
        autocomplete="username"
        label="Email"
        prepend-inner-icon="mdi-email-outline"
        type="email"
      />
      <v-btn
        :loading="form.processing"
        block
        class="mt-4"
        color="primary"
        type="submit"
      >
        Email Password Reset Link
      </v-btn>
    </v-form>
  </GuestLayout>
</template>
