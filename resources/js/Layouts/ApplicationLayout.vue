<script lang="ts" setup>
import { onMounted } from 'vue'
import { useTheme } from 'vuetify'

const theme = useTheme()

onMounted(() => {
  theme.global.name.value = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light'
})
</script>

<template>
  <v-app :class="{ 'bg-grey-lighten-4': !theme.current.value.dark }">
    <slot name="app" />
    <v-main>
      <slot />
    </v-main>
  </v-app>
</template>
