<script lang="ts" setup>
import { Head, Link } from '@inertiajs/vue3'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import VuetifyLogo from '@/Components/VuetifyLogo.vue'

defineOptions({
  name: 'WelcomePage',
})

defineProps<{
  canLogin?: boolean
  canRegister?: boolean
  laravelVersion: string
  phpVersion: string
}>()
</script>

<template>
  <Head title="Welcome" />
  <v-app class="bg-grey-lighten-4">
    <v-main>
      <v-container>
        <v-row
          align="center"
          justify="center"
          style="height: 100vh"
        >
          <v-col
            cols="12"
            lg="4"
            md="10"
            sm="12"
          >
            <v-card class="pa-3 rounded-lg elevation-8">
              <v-card-title>
                <div class="d-flex justify-center mb-4">
                  <ApplicationLogo
                    class="mr-1"
                    style="height: 75px"
                  />
                  <VuetifyLogo
                    class="ml-1"
                    style="height: 75px"
                  />
                </div>
                <span class="text-h5">Welcome to Laravel + Vuetify</span>
              </v-card-title>
              <v-card-text>
                <p class="text-body-2">
                  Laravel has wonderful documentation covering every aspect of the framework. Whether you are a newcomer
                  or have prior experience with Laravel, we recommend reading our documentation from beginning to end.
                </p>
              </v-card-text>
              <v-card-actions>
                <template v-if="$page.props.auth.user">
                  <Link
                    :href="route('dashboard')"
                    as="div"
                  >
                    <v-btn color="primary">
                      Dashboard
                    </v-btn>
                  </Link>
                </template>
                <template v-else>
                  <Link
                    v-if="canLogin"
                    :href="route('login')"
                    as="div"
                    class="mr-2"
                  >
                    <v-btn color="primary">
                      Login
                    </v-btn>
                  </Link>
                  <Link
                    v-if="canRegister"
                    :href="route('register')"
                    as="div"
                  >
                    <v-btn color="secondary">
                      Sign Up
                    </v-btn>
                  </Link>
                </template>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>
