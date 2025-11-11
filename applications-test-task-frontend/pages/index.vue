<script setup lang="js">
import {useApplicationsFetch} from "~/composables/useApplicationsFetch.js";
import Table from "~/components/UI/tables/Table.vue";
import TablePagination from "~/components/UI/pagination/TablePagination.vue";
import Status from "~/components/UI/status/Status.vue";
import BaseButton from "~/components/UI/buttons/BaseButton.vue";
import {useUserStore} from "~/store/user.js";

const page = ref(1)
const totalPages = ref(1)
const applications = ref([])
const {fetchApplications} = useApplicationsFetch()
const loading = ref(true)
const {user} = useUserStore()

const headers = [
  {
    label: 'name',
    dataKey: 'name',
  },
  {
    label: 'city',
    dataKey: 'city',
  },
];

watch([page], () => {
  loadApplications()
})

const loadApplications = async function () {
  try {
    const response = await fetchApplications({page: page.value})
    applications.value = response.data?.map(app => ({
      id: app.id,
      name: app.name,
      status: app.status,
      city: app.city.name,
    }))
    totalPages.value = response.meta?.last_page
    loading.value = false
  } catch (e) {
    console.error('Error fetching applications:', e)
    loading.value = false
  }
}

loadApplications()

definePageMeta({
  layout: 'default',
  publicRoute: true,
})
</script>

<template>
  <BaseButton v-if="user?.id" class="m-6 py-4" @click="navigateTo('/applications')">
    Add Application
  </BaseButton>
  <Table
      :headers="headers"
      :clickable="true"
      :data="applications"
      :loading="loading"
      title="Applications"
      class="bg-white mt-20"
      :fixed-table="true"
      @rowClicked="(id) => navigateTo(`/applications/${id}`)"
  >
    <template #footer>
      <div
          class="flex justify-start mx-2 lg:justify-end items-center gap-6"
      >
        <template v-if="applications?.length">
          <TablePagination
              v-model:page="page"
              :page-count="totalPages"
              @page-changed="loadApplications"
          />
        </template>
      </div>
    </template>
    <template #additionalColumn="{ row }">
      <td class="p-3 text-nowrap lg:text-wrap break-words">
        <Status :name="row?.status?.name" :color="row?.status?.color" />
      </td>
    </template>
    <template #additionalHeader>
      <th
          class="p-3 text-nowrap text-left"
      >
        <div
            class="flex items-center gap-2 w-fit"
        >
          Status
        </div>
      </th>
    </template>
  </Table>
</template>
