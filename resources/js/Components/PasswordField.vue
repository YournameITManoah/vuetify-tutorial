<script lang="ts" setup>
import { ref } from 'vue'

withDefaults(
  defineProps<{
    label?: string
    icon?: string
    errors?: string
    hint: 'current-password' | 'new-password' | 'cc-number' | 'cc-csc'
  }>(),
  {
    icon: undefined,
    errors: undefined,
    label: 'Password',
  },
)

const model = defineModel<string | null>()
const showPassword = ref(false)
</script>

<template>
  <v-text-field
    v-model="model"
    :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
    :autocomplete="autocomplete"
    :error-messages="errors"
    :label="label"
    :prepend-inner-icon="icon"
    :type="showPassword ? 'text' : 'password'"
    @click:append-inner="showPassword = !showPassword"
  />
</template>
