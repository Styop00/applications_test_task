<script setup lang="js">
const props = defineProps({
  placeholder: {
    type: String,
    default: ''
  },
  label: {
    type: String,
    default: ''
  },
  value: {
    type: String,
    required: true
  },
  inputClasses: {
    type: String,
    defaultValue: ''
  },
  name: {
    type: String,
    defaultValue: ''
  },
  required: {
    type: Boolean,
    defaultValue: false
  },
  disabled: {
    type: Boolean,
    default: false
  },
  rows: {
    type: Number,
    default: 4
  }
})
const emit = defineEmits(['update:value'])

const inputValue = toRef(props.value)

watch(() => props.value, () => {
  inputValue.value = props.value
}, {deep: true, immediate: true})

watch(inputValue, () => {
  if (inputValue.value !== props.value) {
    emit('update:value', inputValue.value)
  }
})
</script>

<template>
  <label class="flex flex-col text-sm font-inter-medium">
    {{ props.label }}
    <textarea
        :placeholder="props.placeholder"
        class="px-3 py-2 border w-full p-3 rounded-[0.35rem] bg-white border-gray-300 outline-none focus:shadow resize-none small-scrollbar"
        :class="props.inputClasses"
        v-model="inputValue"
        :name="name"
        :required="required"
        :disabled="disabled"
        :rows="rows"
    />
  </label>
</template>