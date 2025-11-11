<script setup lang="js">

const props = defineProps({
  name: {
    required: true
  },
  color: {
    required: true
  }
})

</script>

<template>
<p class="flex items-center">
  {{name}}
  <span class="inline-block w-3 h-3 ml-2 rounded-full" :style="`background-color: ${color}`"/>
</p>
</template>