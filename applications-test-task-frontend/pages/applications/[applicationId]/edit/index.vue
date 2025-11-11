<script setup lang="js">

import {useUserStore} from "~/store/user.js";
import {useApplicationsFetch} from "~/composables/useApplicationsFetch.js";
import ApplicationForm from "~/components/Applications/Form/ApplicationForm.vue";

const route = useRoute()
const id = route.params.applicationId
const {user} = useUserStore()

const {fetchApplicationById, updateApplication} = useApplicationsFetch()
const application = reactive({})

const fetchApplication = async function () {
  try {
    const response = await fetchApplicationById(id)
    Object.assign(application, response.data)

    application.city = {
      value: application.city.id,
      label: application.city.name,
    }

    application.status = {
      value: application.status.id,
      label: application.status.name,
    }
  } catch (e) {
    console.log(e);
  }
}

await fetchApplication()

const handleSubmit = async function () {
  const response = await updateApplication(id, {
    name: application.name,
    description: application.description,
    city_id: application.city.value,
    status_id: application.status.value,
  })

  if (response.id) {
    navigateTo(`/applications/${id}`)
  }
}

const canEdit = computed(() => {
  return user?.id === application?.author_id
})

if (!canEdit.value) {
  navigateTo('/')
}

definePageMeta({
  layout: 'default',
  publicRoute: false,
})
</script>

<template>
  <div class="w-1/2 mx-auto mt-8">
    <ApplicationForm v-model:value="application" @submit="handleSubmit"/>
  </div>
</template>