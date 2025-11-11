<script setup lang="js">
const props = defineProps({
  value: {
    type: Object,
    required: true
  },
  options: {
    type: Array,
    required: true,
  },
  direction: {
    type: String,
    default: 'bottom',
  },
  label: {
    type: String,
  },
  disabled: {
    type: Boolean,
    default: false
  },
  required: {
    type: Boolean,
    default: false
  },
  size: {
    type: String,
    default: 'normal'
  },
  disableAutoSelect: {
    type: Boolean,
    default: false
  }
})
const dropdownOpened = ref(false)
const emit = defineEmits(['update:value', 'scrolling'])
const selectOptions = ref([])
const scrollbarRef = ref(null)

const inputValue = toRef(props.value)
const initialValue = toRef(props.value)

watch(initialValue, () => {
  inputValue.value = initialValue.value
}, {deep: true, immediate: true})

watch(inputValue, (value, oldValue) => {
  if (value || oldValue) {
    emit('update:value', inputValue.value)
  }
})

watch(() => props.options, () => {
  if (props.options?.length === 1 && !props.disableAutoSelect) {
    setOption(props.options[0])
    selectOptions.value = props.options;
  } else if (props.options?.length > 1 || (props.options?.length === 1 && props.disableAutoSelect)) {
    selectOptions.value = props.direction === 'top' ? props.options.toReversed() : props.options
  }
}, {
  deep: true,
  immediate: true
})

const selectStyles = computed(() => {
  return {
    'bg-disabled-gray/30': props.disabled,
    'cursor-pointer': !props.disabled,
    'text-xs': props.size === 'small',
    'text-sm': props.size === 'normal'
  }
})

function setOption(optionValue) {
  if (!optionValue.disabled) {
    emit('update:value', optionValue)
  }
}

function onScroll(e) {
  emit('scrolling', e)
}

function closeDropdown() {
  dropdownOpened.value = false
}

function openDropdown() {
  if (props.disabled) {
    return
  }
  setTimeout(() => {
    dropdownOpened.value = true
  }, 50)
  document.body.addEventListener('click', closeDropdown)
  const modal = document.querySelector('#modal-body')
  if (modal) {
    modal.addEventListener('click', closeDropdown)
  }
}

defineExpose({
  scrollbarRef,
})
</script>

<template>
  <div class="w-full relative text-sm">
    <p class="font-inter-medium">
      {{ label }}
      <span v-if="required && label"
            class="text-red-600"
      >
        *
      </span>
    </p>
    <div
        class="flex items-center border border-gray-300 px-3 py-2 gap-2 justify-between w-full rounded-[0.35rem] min-h-11 cursor-pointer"
        :class="selectStyles"
        @click="openDropdown">
      {{ value?.label }}
      <template v-if="!dropdownOpened">
        <font-awesome :icon="['fas', 'angle-down']" class="ml-auto"/>
      </template>
      <template v-else>
        <font-awesome
            :icon="['fas', 'angle-up']"
            @click.stop="() => dropdownOpened = false"
            class="cursor-pointer ml-auto"
        />
      </template>
    </div>
    <div
        v-if="dropdownOpened"
        :class="direction === 'bottom' ? 'top-full' : 'bottom-11'"
        @scroll="onScroll"
        ref="scrollbarRef"
        class="absolute shadow border w-full text-sm max-h-52 overflow-y-auto small-scrollbar bg-white z-[100]"
    >
      <template v-for="option in selectOptions">
        <p
            class="p-2 border-b bg-white"
            @click="setOption(option)"
            :class="!option.disabled ? 'cursor-pointer hover:bg-gray-100' : '!bg-gray-200'"
        >
          {{ option.label }}
        </p>
      </template>
    </div>
  </div>
</template>
