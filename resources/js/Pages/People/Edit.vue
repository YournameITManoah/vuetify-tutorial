<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import { Head, Link, router, useForm } from '@inertiajs/vue3'

defineOptions({
  name: 'PeopleEdit',
})

const genders = [
  { text: 'Male', value: 'male' },
  { text: 'Female', value: 'female' },
]

const breadcrumbs = [
  {
    title: 'Dashboard',
    disabled: false,
    href: '/dashboard',
  },
  {
    title: 'People',
    disabled: false,
    href: '/people',
  },
  {
    title: 'Edit',
    disabled: true,
  },
]

const props = defineProps<{
  person: object
}>()

const form = useForm({
  name: props.person.name,
  email: props.person.email,
  phone: props.person.phone,
  gender: props.person.gender,
  address: props.person.address,
})

const submit = () => {
  form.patch(`/people/${props.person.id}`, {
    onSuccess: () => {
      router.visit(route('people.index'))
    },
  })
}
</script>

<template>
  <Head title="Edit People" />
  <AuthenticatedLayout>
    <div class="mb-5">
      <h5 class="text-h5 font-weight-bold">
        Edit People
      </h5>
      <Breadcrumbs
        :items="breadcrumbs"
        class="pa-0 mt-1"
      />
    </div>
    <v-card>
      <v-form
        :disabled="form.processing"
        @submit.prevent="submit"
      >
        <v-card-text>
          <v-row>
            <v-col
              cols="12"
              md="6"
              sm="12"
            >
              <v-text-field
                v-model="form.name"
                :error-messages="form.errors.name"
                label="Name"
              />
            </v-col>
            <v-col
              cols="12"
              md="6"
              sm="12"
            >
              <v-select
                v-model="form.gender"
                :error-messages="form.errors.gender"
                :items="genders"
                item-title="text"
                item-value="value"
                label="Gender"
              />
            </v-col>
            <v-col
              cols="12"
              md="6"
              sm="12"
            >
              <v-text-field
                v-model="form.email"
                :error-messages="form.errors.email"
                label="Email"
                type="email"
              />
            </v-col>
            <v-col
              cols="12"
              md="6"
              sm="12"
            >
              <v-text-field
                v-model="form.phone"
                :error-messages="form.errors.phone"
                label="Phone"
                type="tel"
              />
            </v-col>
            <v-col
              cols="12"
              sm="12"
            >
              <v-textarea
                v-model="form.address"
                :error-messages="form.errors.address"
                label="Address"
              />
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-spacer />
          <Link :href="route('people.index')">
            <v-btn color="error">
              Cancel
            </v-btn>
          </Link>
          <v-btn
            :loading="form.processing"
            color="primary"
            type="submit"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </AuthenticatedLayout>
</template>
