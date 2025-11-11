<script setup lang="js">

import {useApplicationsFetch} from "~/composables/useApplicationsFetch.js";
import ApplicationForm from "~/components/Applications/Form/ApplicationForm.vue";


const {createApplication} = useApplicationsFetch()
const application = reactive({
  name: '',
  description: '',
  city: {
    value: null,
    label: ''
  },
  status: {
    value: null,
    label: ''
  },
})

const errors = ref({
  name: null,
  description: null,
  city_id: null,
  status_id: null,
})

const handleSubmit = async function () {
  try {
    errors.value = {
      name: null,
      description: null,
      city_id: null,
      status_id: null,
    }
    const response = await createApplication({
      name: application.name,
      description: application.description,
      city_id: application.city?.value,
      status_id: application.status?.value,
    })

    if (response?.data?.id) {
      navigateTo(`/applications/${response.data.id}`)
    }

    if (response.data?.type === 'error') {
      errors.value = response.data.message
    }
  } catch (e) {
    console.log(e.data);
  }
}

definePageMeta({
  layout: 'default',
  publicRoute: false,
})
</script>

<template>
  <div class="w-1/2 mx-auto mt-8">
    <ApplicationForm v-model:value="application" @submit="handleSubmit" :errors="errors"/>
  </div>
</template>