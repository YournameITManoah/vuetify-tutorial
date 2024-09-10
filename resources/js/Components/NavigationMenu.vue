<script lang="ts" setup>
import { Link } from '@inertiajs/vue3'

interface NavItem {
  title: string
  icon: string
  to: string
  exact?: boolean
}

const navigation: NavItem[] = [
  {
    title: 'Dashboard',
    icon: 'mdi-view-dashboard',
    to: route('dashboard'),
  },
  {
    title: 'People',
    icon: 'mdi-account-group',
    to: route('people.index'),
  },
]
</script>

<template>
  <v-list nav>
    <!-- List Menu -->
    <Link
      v-for="(item, key) in navigation"
      :key="key"
      :href="item.to"
      as="div"
    >
      <v-list-item
        :class="{ 'v-list-item--active': $page.url.startsWith(item.to) }"
        :exact="item.exact"
        :prepend-icon="item.icon"
        :title="item.title"
        link
      />
    </Link>
  </v-list>
</template>
