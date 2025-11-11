<template>
  <div class="min-w-full shadow-lg rounded-2xl overflow-x-auto">
    <div>
      <div class="flex justify-between items-center px-2">
        <p
            class="text-base font-bold py-4 flex items-center justify-start tracking-widest"
            v-if="title"
        >
        <span
            class="inline-block w-1 h-6 rounded-2xl bg-gradient-to-b from-violet-500/50 to-sky-400/50 mr-3"
        />
          {{ title }}
        </p>
      </div>
      <div class="relative">
        <table class="bg-white w-full border-t rounded-2xl"
               :class="{'lg:table-fixed': fixedTable, 'opacity-30': loading}">
          <thead>
          <template v-for="header in headers">
            <th
                class="p-3 text-nowrap text-left"
            >
              <div
                  class="flex items-center gap-2 w-fit"
              >
                {{ header.label }}
              </div>
            </th>
          </template>
          <slot name="additionalHeader"/>
          </thead>
          <tbody>
          <template v-if="!data.length && !loading">
            <tr>
              <td :colspan="headers.length">
                <p class="p-4 font-bold text-xl text-center">No data founds.</p>
              </td>
            </tr>
          </template>
          <template v-for="row in data">
            <tr
                class="hover:!bg-[#f7f8f9] border-y border-gray-100"
                :class="clickable ? 'cursor-pointer' : ''"
                @click="() => clicked(row.id)"
            >
              <template v-for="header in headers">
                <td class="p-3 text-nowrap lg:text-wrap break-words" :class="header.className">
                  <span
                      v-html="row[header.dataKey]"
                  ></span>
                </td>
              </template>
              <slot name="additionalColumn" :row="row"/>
            </tr>
          </template>
          </tbody>
        </table>
        <template v-if="loading">
          <div class="p-4 text-center absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            <font-awesome
                :icon="['fas', 'spinner']"
                class="fa-spin text-2xl"
            />
            <p>Loading data...</p>
          </div>
        </template>
      </div>
    </div>
    <template v-if="data.length">
      <slot name="footer"/>
    </template>
  </div>
</template>

<script setup lang="js">

const props = defineProps({
  headers: {
    default: []
  },
  data: {
    default: []
  },
  clickable: {
    default: false
  },
  title: {
    default: ''
  },
  loading: {
    default: false,
  },
  fixedTable: {
    default: true,
  },
})

const emit = defineEmits([
  'rowClicked',
  'dataClicked'
])

function clicked(id) {
  if (!props.clickable) {
    return
  }

  emit('rowClicked', id)
}

</script>

<style scoped>
tr:nth-of-type(odd) {
  background-color: #f3f6f880;
}

td, th {
  vertical-align: middle;
}

tr {
  height: auto;
}
</style>
