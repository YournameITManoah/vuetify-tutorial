<script lang="ts" setup>
import NavigationMenu from '@/Components/NavigationMenu.vue'
import { onMounted, ref } from 'vue'
import { useDisplay } from 'vuetify'

const drawer = ref(false)
const rail = ref(false)

onMounted(() => {
  drawer.value = useDisplay().mobile.value
})
</script>

<template>
  <v-app class="bg-grey-lighten-4">
    <v-navigation-drawer
      v-model="drawer"
      :rail="rail"
      permanent
    >
      <v-list>
        <v-list-item
          :subtitle="$page.props.auth.user.email"
          :title="$page.props.auth.user.name"
        />
      </v-list>
      <v-divider />
      <NavigationMenu />
    </v-navigation-drawer>
    <v-app-bar color="primary">
      <v-app-bar-nav-icon
        v-if="$vuetify.display.mobile"
        @click.stop="drawer = !drawer"
      />
      <v-app-bar-nav-icon
        v-else
        @click.stop="rail = !rail"
      />
      <v-toolbar-title text="Laravel" />
    </v-app-bar>
    <v-main>
      <v-container>
        <slot />
      </v-container>
    </v-main>
  </v-app>
</template>
