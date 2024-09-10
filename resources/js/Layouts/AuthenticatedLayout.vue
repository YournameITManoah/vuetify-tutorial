<script lang="ts" setup>
import NavigationMenu from '@/Components/NavigationMenu.vue'
import { Link } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import { useDisplay } from 'vuetify'
import ApplicationLayout from '@/Layouts/ApplicationLayout.vue'

const { mobile } = useDisplay()

const drawer = ref(!mobile.value)

watch(mobile, (val) => {
  if (!val) drawer.value = true
})
</script>

<template>
  <application-layout>
    <template #app>
      <v-navigation-drawer
        v-model="drawer"
        :permanent="!mobile"
        :rail="!mobile"
        expand-on-hover
      >
        <v-list>
          <v-list-item
            :subtitle="$page.props.auth.user.email"
            :title="$page.props.auth.user.name"
            prepend-icon="mdi-account"
          >
            <template #append>
              <v-list-item-action>
                <Link
                  :href="route('logout')"
                  as="button"
                  method="post"
                >
                  <v-icon icon="mdi-logout" />
                </Link>
              </v-list-item-action>
            </template>
          </v-list-item>
        </v-list>
        <v-divider />
        <navigation-menu />
      </v-navigation-drawer>
      <v-app-bar color="primary">
        <v-app-bar-nav-icon
          v-if="mobile"
          @click.stop="drawer = !drawer"
        />
        <v-toolbar-title text="Laravel" />
      </v-app-bar>
    </template>
    <v-container>
      <slot />
    </v-container>
  </application-layout>
</template>
