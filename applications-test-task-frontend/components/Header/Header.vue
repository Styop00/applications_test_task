<script setup lang="js">
import {useUserStore} from "~/store/user";
import BaseButton from "~/components/UI/buttons/BaseButton.vue";

const userStore = useUserStore()
const { user } = storeToRefs(userStore);

</script>

<template>
  <div class="w-full flex justify-between items-center border-b border-purple-200 px-4 h-[60px]">
    <NuxtLink class="flex justify-center items-center gap-1.5" to="/">
      <span class="text-xl"> Home </span>
    </NuxtLink>
    <NuxtLink class="flex justify-center items-center gap-1.5" to="/login" v-if="!user">
      <span class="text-xl"> LogIn </span>
    </NuxtLink>
    <BaseButton class="flex justify-center items-center gap-1.5 !bg-transparent !text-black"
                v-if="user"
                @onClick="userStore.logout()"
    >
      <span class="text-xl"> Logout </span>
    </BaseButton>
  </div>
</template>