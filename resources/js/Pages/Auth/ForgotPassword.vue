<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import EmailField from '@/Components/EmailField.vue'

defineProps<{
  status?: string | null
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
    <v-card-title>Forgot Password</v-card-title>
    <v-form
      :disabled="form.processing"
      @submit.prevent="submit"
    >
      <v-container>
        <v-row>
          <v-col
            class="py-0"
            cols="12"
          >
            <div class="text-subtitle-2 text-medium-emphasis mb-4">
              Forgot your password? No problem. Just let us know your email address and we will email you a password
              reset link that will allow you to choose a new one.
            </div>
          </v-col>
          <v-col
            v-if="status"
            cols="12"
          >
            <v-alert :text="status" />
          </v-col>
          <v-col cols="12">
            <email-field
              v-model="form.email"
              :errors="form.errors.email"
            />
          </v-col>
          <v-col cols="12">
            <v-btn
              :loading="form.processing"
              block
              color="primary"
              type="submit"
            >
              Email Password Reset Link
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
  </GuestLayout>
</template>
