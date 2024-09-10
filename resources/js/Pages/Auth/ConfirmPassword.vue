<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'

defineProps<{
  status?: string | null
}>()

const form = useForm({
  password: '',
})
const showPassword = ref(false)

const submit = () => {
  form.post('/confirm-password', {
    onFinish: () => form.reset(),
  })
}
</script>

<template>
  <GuestLayout>
    <Head title="Confirm Password" />
    <v-form @submit.prevent="submit">
      <div class="text-subtitle-2 text-medium-emphasis mb-4">
        This is a secure area of the application. Please confirm your password before continuing.
      </div>
      <v-text-field
        v-model="form.password"
        :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
        :error-messages="form.errors.password"
        :type="showPassword ? 'text' : 'password'"
        density="compact"
        placeholder="Password"
        variant="outlined"
        @click:append-inner="showPassword = !showPassword"
      />
      <v-btn
        :loading="form.processing"
        block
        class="mt-4"
        color="primary"
        type="submit"
      >
        Confirm
      </v-btn>
    </v-form>
  </GuestLayout>
</template>
