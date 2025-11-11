<script setup lang="js">
const emit = defineEmits(['onClick'])

function clicked() {
  emit('onClick')
}
</script>

<template>
  <button
      @click="clicked"
      class="px-8 bg-purple-400 hover:text-purple-100 text-white rounded-lg transition-colors duration-200 ease-in-out delay-15"
  >
    <slot/>
  </button>
</template>
