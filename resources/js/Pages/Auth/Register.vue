<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import PasswordField from '@/Components/PasswordField.vue'
import EmailField from '@/Components/EmailField.vue'

defineOptions({
  name: 'RegisterPage',
})

defineProps<{
  canResetPassword?: boolean
  status?: string | null
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
    <v-card-title>Register</v-card-title>
    <v-form
      :disabled="form.processing"
      @submit.prevent="submit"
    >
      <v-container>
        <v-row>
          <v-col cols="12">
            <v-text-field
              v-model="form.name"
              :error-messages="form.errors.name"
              label="Name"
              prepend-inner-icon="mdi-account"
              type="text"
            />
          </v-col>
          <v-col cols="12">
            <email-field
              v-model="form.email"
              :errors="form.errors.email"
            />
          </v-col>
          <v-col cols="12">
            <password-field
              v-model="form.password"
              :errors="form.errors.password"
              hint="new-password"
            />
          </v-col>
          <v-col cols="12">
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
              Register
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
    <v-card-text class="text-center mt-4">
      <Link
        :href="route('login')"
        class="text-primary text-decoration-none"
      >
        Already registered?
      </Link>
    </v-card-text>
  </GuestLayout>
</template>
