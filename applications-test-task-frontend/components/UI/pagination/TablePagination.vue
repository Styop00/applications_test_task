<template>
  <div class="flex items-center justify-between gap-2">
    <div @click="() => setPage(page - 1)"
         :class="page === 1 ? 'opacity-50 bg-gray-200 cursor-not-allowed' : 'cursor-pointer hover:bg-gray-200'"
         class="px-2 py-1 rounded-lg border flex items-center justify-center">
      <font-awesome :icon="['fas', 'chevron-left']" class="text-xs"/>
    </div>
    <template v-for="num in pageCount">
      <template v-if="showPagePagination(num)">
        <div @click="() => setPage(num)"
             :key="num"
             class="px-2 py-1 rounded-lg cursor-pointer border flex items-center justify-center text-sm"
             :class="num === page ? 'text-white bg-black' : 'hover:bg-gray-200'"
        >
          {{ num }}
        </div>
      </template>
      <template v-else-if="showDot(num)">
        <div
             class="px-2 py-1 rounded-lg flex items-center justify-center"
        >
          . . .
        </div>
      </template>
    </template>
    <div @click="() => setPage(page + 1)"
         :class="page === pageCount ? 'opacity-50 bg-gray-200 cursor-not-allowed' : 'cursor-pointer hover:bg-gray-200'"
         class="px-2 py-1 rounded-lg border flex items-center justify-center">
      <font-awesome :icon="['fas', 'chevron-right']" class="text-xs"/>
    </div>
  </div>
</template>

<script setup lang="js">
const props = defineProps({
  pageCount: {
    type: Number,
    required: true
  },
  page: {
    type: Number,
    required: true
  }
})

const emit = defineEmits(['update:page'])
const page = toRef(props.page)

watch(() => props.page, () => {
  if (props.page !== page.value) {
    page.value = props.page
  }
})

watch(() => page.value, () => {
  if(props.page !== page.value) {
    emit('update:page', page.value)
  }
}, {
  deep: true,
  immediate: true
})

function setPage(num) {
  if(page.value !== num && num !== 0 && num <= props.pageCount) {
    page.value = num
  }
}

function showPagePagination(num) {
  if (props.pageCount <= 10) {
    return true
  }

  if (num < 3 || (num - page.value < 2 && num - page.value > -2) || props.pageCount - num < 2) {
    return true
  }
}

function showDot(num) {
  if (num < 4  || props.pageCount - num < 3) {
    return true
  }
}
</script>