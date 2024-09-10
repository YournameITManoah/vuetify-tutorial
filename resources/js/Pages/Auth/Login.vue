<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import PasswordField from '@/Components/PasswordField.vue'
import EmailField from '@/Components/EmailField.vue'

defineOptions({
  name: 'LoginPage',
})

defineProps<{
  canResetPassword?: boolean
  status?: string | null
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
    <v-card-title>Login</v-card-title>
    <v-form
      :disabled="form.processing"
      @submit.prevent="submit"
    >
      <v-container>
        <v-row>
          <v-col cols="12">
            <email-field
              v-model="form.email"
              :errors="form.errors.email"
            />
          </v-col>

          <v-col cols="12">
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
            />
          </v-col>
          <v-col
            class="pa-0"
            cols="12"
          >
            <v-checkbox
              v-model="form.remember"
              label="Remember me"
            />
          </v-col>

          <v-col cols="12">
            <v-btn
              :loading="form.processing"
              block
              color="primary"
              type="submit"
            >
              Login
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
    </v-form>
    <v-card-text class="text-center mt-4">
      <Link
        :href="route('register')"
        class="text-primary text-decoration-none"
      >
        Sign up now
        <v-icon icon="mdi-chevron-right" />
      </Link>
    </v-card-text>
  </GuestLayout>
</template>
