<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import { Head, Link, router } from '@inertiajs/vue3'
import { ref } from 'vue'

defineOptions({
  name: 'PeopleIndex',
})

const headers = [
  { title: 'Name', key: 'name' },
  { title: 'Gender', key: 'gender' },
  { title: 'Email', key: 'email' },
  { title: 'Phone Number', key: 'phone' },
  { title: 'Created At', key: 'created_at' },
  { title: 'Actions', key: 'action', sortable: false },
]

const breadcrumbs = [
  {
    title: 'Dashboard',
    disabled: false,
    href: '/dashboard',
  },
  {
    title: 'People',
    disabled: true,
  },
]

const items = ref([])
const totalItems = ref(0)
const isLoadingTable = ref(false)
const options = ref({})
const search = ref(null)
const deleteDialog = ref(false)
const isLoading = ref(false)
const deleteId = ref(null)

const loadItems = async () => {
  isLoadingTable.value = true
  const { page, itemsPerPage, sortBy, search } = options.value
  const params = {
    page,
    limit: itemsPerPage,
    sort: sortBy[0],
  }

  if (search) params.search = search

  try {
    const result = await window.axios('/people', {
      params,
    })
    items.value = result.data.data
    totalItems.value = result.data.total
    isLoadingTable.value = false
  } catch (e) {
    console.error(e)
    isLoadingTable.value = false
  }
}

const deleteItem = (item) => {
  deleteId.value = item.id
  deleteDialog.value = true
}

const submitDelete = () => {
  isLoading.value = true
  router.delete(`/people/${deleteId.value}`, {
    preserveState: true,
    preserveScroll: true,
    onSuccess: () => {
      isLoading.value = false
      deleteDialog.value = false
      loadItems()
    },
  })
}
</script>

<template>
  <Head title="People" />
  <AuthenticatedLayout>
    <div class="mb-5">
      <h5 class="text-h5 font-weight-bold">
        People
      </h5>
      <Breadcrumbs
        :items="breadcrumbs"
        class="pa-0 mt-1"
      />
    </div>
    <v-card class="pa-2">
      <v-card-title class="d-flex flex-wrap align-center">
        <v-text-field
          v-model="search"
          clearable
          density="compact"
          label="Search"
          prepend-inner-icon="mdi-magnify"
          single-line
          variant="solo-filled"
        />
        <v-spacer />
        <Link href="/people/create">
          <v-btn color="primary">
            Create
          </v-btn>
        </Link>
      </v-card-title>
      <v-divider />
      <v-data-table-server
        v-model:options="options"
        :headers="headers"
        :items="items"
        :items-length="totalItems"
        :loading="isLoadingTable"
        :search="search"
        @update:options="loadItems"
      >
        <template #[`item.gender`]="{ item }">
          {{ item.gender === 'male' ? 'Male' : 'Female' }}
        </template>
        <template #[`item.action`]="{ item }">
          <Link :href="`/people/${item.id}/edit`">
            <v-btn
              color="warning"
              icon="mdi-pencil"
              size="small"
              variant="text"
            />
          </Link>
          <v-btn
            class="ml-2"
            color="error"
            icon="mdi-delete"
            size="small"
            variant="text"
            @click="deleteItem(item)"
          />
        </template>
      </v-data-table-server>
    </v-card>
    <v-row justify="center">
      <v-dialog
        v-model="deleteDialog"
        persistent
        width="auto"
      >
        <v-card title="Confirm Action">
          <v-card-text>Are you sure you want to delete this item?</v-card-text>
          <v-card-actions>
            <v-spacer />
            <v-btn
              color="error"
              @click="deleteDialog = false"
            >
              Cancel
            </v-btn>
            <v-btn
              :loading="isLoading"
              color="primary"
              @click="submitDelete"
            >
              Delete
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
  </AuthenticatedLayout>
</template>
