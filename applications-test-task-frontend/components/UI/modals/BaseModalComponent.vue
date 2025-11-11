<script setup lang="js">

const props = defineProps({
  visible: {
    type: Boolean,
    default: false,
  },
  width: {
    type: Number,
    default: 3,
  },
  name: {
    type: String,
    default: '',
  },
  isOverflowVisible: {
    type: Boolean,
    default: false
  }
})

const emit = defineEmits([
  'update:visible'
])

const modal = ref(false)

watch(() => props.visible, () => {
  modal.value = props.visible
})

watch(() => modal.value, () => {
  if (!modal.value) {
    emit('update:visible', false)
  }
})
const widthStyles = computed(() => {
  switch (props.width) {
    case 1 :
      return 'w-[200px]';
    case 2 :
      return 'w-[350px]';
    case 3 :
      return 'w-[500px]';
    case 4 :
      return 'w-[700px]';
    case 5 :
      return 'w-[900px]';
    default :
      return 'w-[1500px]';
  }
})
</script>

<template>
  <div
      class="fixed top-0 left-0 w-screen h-screen bg-black/50 z-[9999]"
      v-show="visible"
      @click="() => modal = false"
  >
    <div
        @click.stop
        :id="'modal-body' + name"
        :class="[
        'bg-white absolute p-3 rounded-2xl top-1/2 left-1/2 -translate-y-1/2 max-w-full -translate-x-1/2 small-scrollbar',
        widthStyles,
        isOverflowVisible ? 'overflow-visible' : 'overflow-hidden'
      ]"
        style="max-height: 80vh;">
      <slot />
    </div>
  </div>
</template>
