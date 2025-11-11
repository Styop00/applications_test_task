<script setup lang="js">
import {useApplicationsFetch} from "~/composables/useApplicationsFetch.js";
import Status from "~/components/UI/status/Status.vue";
import BaseButton from "~/components/UI/buttons/BaseButton.vue";
import {useUserStore} from "~/store/user.js";
import ConfirmationDeleteModal from "~/components/UI/modals/ConfirmationDeleteModal.vue";

const route = useRoute()
const id = route.params.applicationId
const {isAdmin, user} = useUserStore()
const showConfirmModal = ref(false)

const {fetchApplicationById, deleteApplication} = useApplicationsFetch()
const application = reactive({})

const fetchApplication = async function () {
  try {
    const response = await fetchApplicationById(id)
    Object.assign(application, response.data)
  } catch (e) {
    console.log(e);
  }
}

const canDelete = computed(() => {
  return user?.id === application?.author?.id || isAdmin
})

const canEdit = computed(() => {
  return user?.id === application?.author?.id
})

const destroyApplication = async function () {
  try {
    await deleteApplication(id)
    // Redirect to applications list after deletion
    navigateTo('/')
  } catch (e) {
    console.log(e);
  }
}

fetchApplication()

definePageMeta({
  layout: 'default',
  publicRoute: false,
})
</script>

<template>
  <div class="mt-4 text-center w-2/3 mx-auto">
    <h2>{{ application?.name }}</h2>
    <p class="w-1/2 mx-auto mt-4">
      {{ application?.description }}
    </p>
    <div class="mt-8 flex flex-col justify-start items-start w-1/2 mx-auto">
      <p>
        City: {{ application?.city?.name }}
      </p>
      <p class="flex items-center justify-center">
        <span>Status: </span>
        <Status :color="application?.status?.color" :name="application?.status?.name"/>
      </p>
      <p>
        Author: {{ application?.author?.name }} ({{ application?.author?.email }})
      </p>
      <div class="flex items-center gap-5 mt-4">
        <BaseButton v-if="canEdit" @onClick="() => navigateTo(`/applications/${application.id}/edit`)">
          Edit Application
        </BaseButton>
        <BaseButton v-if="canDelete" @onClick="()=> showConfirmModal = true">
          Delete Application
        </BaseButton>
      </div>
    </div>
    <ConfirmationDeleteModal
        v-model:visible="showConfirmModal"
        message="Are you sure you want to delete this application?"
        @confirm="destroyApplication"
    />
  </div>
</template>