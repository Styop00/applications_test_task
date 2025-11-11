<script setup lang="js">
import {ref, watch, defineProps, defineEmits} from 'vue';

const props = defineProps({
  modelValue: {
    type: String,
    default: '',
  },
  name: {
    type: String,
    default: '',
  },
  id: {
    type: String,
    default: '',
  },
  placeholder: {
    type: String,
    default: '',
  },
  required: {
    type: Boolean,
    default: false,
  },
  autocomplete: {
    type: String
  }
});

const emit = defineEmits(['update:modelValue']);
const inputType = ref('password');
const internalValue = ref(props.modelValue);

const changeInputType = () => {
  inputType.value = inputType.value === 'text' ? 'password' : 'text';
};

watch(internalValue, (newValue) => {
  emit('update:modelValue', newValue);
});

watch(() => props.modelValue, (newValue) => {
  internalValue.value = newValue;
});
</script>

<template>
  <div class="relative">
    <input
        :type="inputType"
        v-model="internalValue"
        :name="name"
        :id="id"
        :placeholder="placeholder"
        class="w-full px-4 py-2 border rounded-[0.35rem] bg-white border-gray-300 outline-none focus:shadow placeholder:text-[13px] pr-10"
        :required="required"
        :autocomplete="autocomplete"
    />
    <button
        @click="changeInputType"
        class="absolute inset-y-0 right-0 flex items-center p-3 rounded-tr-[0.35rem] rounded-br-[0.35rem] bg-login-reg-bg"
        type="button"
    >
      <font-awesome
          :icon="inputType === 'text' ? 'eye' : 'eye-slash'"
          class="text-[12px]"
      />
    </button>
  </div>
</template>
