<script setup lang="js">

import TextInput from "~/components/UI/inputs/TextInput.vue";
import BaseButton from "~/components/UI/buttons/BaseButton.vue";
import Select from "~/components/UI/inputs/Select.vue";
import TextArea from "~/components/UI/inputs/TextArea.vue";
import {useCitiesFetch} from "~/composables/useCitiesFetch.js";
import {useStatusesFetch} from "~/composables/useStatusesFetch.js";

const props = defineProps({
  value: {
    type: Object,
    required: true
  },
  errors: {
    type: Object,
    required: true
  },
})

const cities = reactive([])
const statuses = reactive([])
const selectRef = ref(null)
const cityLoading = ref(false)
const {fetchCities} = useCitiesFetch()
const {fetchStatuses} = useStatusesFetch()
const emit = defineEmits(['update:value', 'submit'])

const application = toRef(props.value)
const initialValue = toRef(props.value)

const fetchCitiesPaginated = async function () {
  if (cityLoading.value) return
  try {
    cityLoading.value = true
    const response = await fetchCities({skip: cities?.length})
    cities.push(...(response.data).map(city => ({
      label: city.name,
      value: city.id
    })))
    cityLoading.value = false;
  } catch (e) {
    console.log(e);
  }
}

const fetchStatusOptions = async function () {
  try {
    const response = await fetchStatuses()
    statuses.push(...(response.data).map(status => ({
      label: status.name,
      value: status.id
    })))
  } catch (e) {
    console.log(e);
  }
}

fetchCitiesPaginated()
fetchStatusOptions()

function handleSelectScroll(e) {
  const element = e.srcElement;
  if (element.scrollTop + element.clientHeight > element.scrollHeight - 50) {
    fetchCitiesPaginated()
  }
}

watch(initialValue, () => {
  application.value = initialValue.value
}, {deep: true, immediate: true})

watch(application, (value, oldValue) => {
  if (value || oldValue) {
    emit('update:value', application.value)
  }
})

watch([selectRef], function () {
  if (selectRef?.value?.scrollbarRef) {
    selectRef?.value?.scrollbarRef.addEventListener('scroll', handleSelectScroll)
  }
}, {
  deep: true
})
</script>

<template>
  <form @submit.prevent="() => emit('submit')">
    <div>
      <p
          class="text-[20px] font-inter-medium text-center mb-1 text-gray-700"
      >
        Edit Application
      </p>
      <div class="p-3">
        <div class="flex flex-col gap-4">
          <TextInput
              class="block font-inter-medium font-intel text-xs mb-3"
              label="Application name"
              v-model:value="application.name"
              placeholder="Application name"
              type="text"
              inputClasses="w-full mt-2 text-base !px-4 !py-2 border rounded-[0.35rem] bg-white border-gray-300 outline-none focus:shadow placeholder:text-[13px]"
          />
          <p v-if="errors?.name" class="text-red-700 text-xs">
            {{ errors?.name[0] }}
          </p>
          <TextArea v-model:value="application.description"
                    label="Application description"
                    placeholder="Application description"
          />
          <p v-if="errors?.description" class="text-red-700 text-xs">
            {{ errors?.description[0] }}
          </p>
          <Select :options="cities"
                  v-model:value="application.city"
                  label="City"
                  ref="selectRef"
                  @scrolling="handleSelectScroll"
                  placeholder="Select city"
          />
          <p v-if="errors?.city_id" class="text-red-700 text-xs">
            {{ errors?.city_id[0] }}
          </p>
          <Select :options="statuses"
                  v-model:value="application.status"
                  label="Status"
                  placeholder="Select status"
          />
          <p v-if="errors?.status_id" class="text-red-700 text-xs">
            {{ errors?.status_id[0] }}
          </p>
        </div>

        <div class="mt-4">
          <BaseButton
              type="submit"
              class="w-full p-3 text-white"
          >
            Submit
          </BaseButton>
        </div>
      </div>
    </div>
  </form>
</template>
