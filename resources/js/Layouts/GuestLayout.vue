<script lang="ts" setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/vue3'
import ApplicationLayout from '@/Layouts/ApplicationLayout.vue'
</script>

<template>
  <application-layout>
    <v-container fluid>
      <v-row
        align="center"
        justify="center"
        style="height: 100vh"
      >
        <v-col
          cols="12"
          lg="3"
          md="10"
          sm="12"
        >
          <div class="d-flex justify-center">
            <Link href="/">
              <ApplicationLogo style="height: 75px" />
            </Link>
          </div>
          <v-card class="px-6 py-4 mt-3 elevation-2 rounded-lg">
            <slot />
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </application-layout>
</template>
