<script lang="ts" setup>
import { computed } from 'vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const props = defineProps<{
  status?: string | null
}>()

const form = useForm({})

const submit = () => {
  form.post(route('verification.send'))
}
const verificationLinkSent = computed(() => props.status === 'verification-link-sent')
</script>

<template>
  <GuestLayout>
    <Head title="Email Verification" />
    <v-form
      :disabled="form.processing"
      @submit.prevent="submit"
    >
      <div class="text-subtitle-2 text-medium-emphasis mb-4">
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we we
        just emailed to you? If you didn't receive the email, we will gladly send you another.
      </div>
      <v-alert
        v-if="verificationLinkSent"
        class="mb-4"
      >
        A new verification link has been sent to the email address you provided during registration.
      </v-alert>
      <div class="d-flex justify-space-between align-center">
        <v-btn
          :loading="form.processing"
          color="primary"
          type="submit"
        >
          Resend Verification Email
        </v-btn>
        <Link
          :href="route('logout')"
          class="text-black"
          method="post"
        >
          Log Out
        </Link>
      </div>
    </v-form>
  </GuestLayout>
</template>
