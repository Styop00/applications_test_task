<script setup lang="js">
import {ref, watch, defineProps, defineEmits} from 'vue';
import BaseButton from "~/components/UI/buttons/BaseButton.vue";
import BaseModalComponent from "~/components/UI/modals/BaseModalComponent.vue";

const props = defineProps({
  visible: {
    type: Boolean,
    default: false,
  },
  message: {
    type: String,
    default: 'Are you sure you want to proceed?',
  },
});

const emit = defineEmits(['update:visible', 'confirm', "refreshData"]);

const modal = ref(false);

watch(() => props.visible, () => {
  modal.value = props.visible;
});

watch(() => modal.value, () => {
  if (!modal.value) {
    emit('update:visible', false);
  }
});

function confirmAction() {
  emit('confirm');
  modal.value = false;
  emit('refreshData');
}

function cancelAction() {
  modal.value = false;
}
</script>

<template>
  <BaseModalComponent v-model:visible="modal" :width="3">
    <div class="p-4">
      <p class="text-lg text-center mb-4">{{ message }}</p>
      <div class="flex justify-center gap-4">
        <BaseButton @click="cancelAction">
          Cancel
        </BaseButton>
        <BaseButton class="bg-red-600 text-white mr-2" @click="confirmAction">
          Accept
        </BaseButton>
      </div>
    </div>
  </BaseModalComponent>
</template>
