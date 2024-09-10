<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import { Head } from '@inertiajs/vue3'

defineOptions({
  name: 'DashboardPage',
})

const breadcrumbs = [
  {
    title: 'Dashboard',
    disabled: true,
  },
]
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <div class="mb-5">
      <h5 class="text-h5 font-weight-bold">
        Dashboard
      </h5>
      <Breadcrumbs
        :items="breadcrumbs"
        class="pa-0 mt-1"
      />
    </div>
    <v-card>
      <v-card-text>
        <v-card-title> Welcome back, {{ $page.props.auth.user.name }}! </v-card-title>
      </v-card-text>
    </v-card>
  </AuthenticatedLayout>
</template>
