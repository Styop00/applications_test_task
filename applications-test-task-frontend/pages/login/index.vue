<script setup lang="js">
import TextInput from '~/components/UI/inputs/TextInput.vue';
import PasswordInput from '~/components/UI/inputs/PasswordInput.vue';
import BaseButton from '~/components/UI/buttons/BaseButton.vue';
import {useUserStore} from "~/store/user";

const email = ref('')
const emailError = ref('')
const password = ref('')
const loginError = ref('');

const {login} = useUserStore()

async function handleLogin() {
  try {
    loginError.value = ''
    const response = await login(email.value, password.value)
    if (response.value) {
      navigateTo('/')
    }
  } catch (e) {
    loginError.value = e.toString()
  }
}

definePageMeta({
  layout: 'default',
  guestRoute: true,
})
</script>

<template>
  <div
      class="w-full min-h-screen flex items-center justify-center bg-login-reg-bg"
  >
    <div class="w-full max-w-lg p-4 sm:p-8 md:p-12 rounded-lg">
      <div
          class="w-full max-w-md p-4 sm:p-8 md:p-12 bg-white shadow-sm rounded-lg"
      >
        <form @submit.prevent="handleLogin">
          <div>
            <p
                class="text-[20px] font-inter-medium text-center mb-1 text-gray-700"
            >
              Sign In
            </p>
            <div class="p-3">
              <div>
                <TextInput
                    class="block font-inter-medium font-intel text-xs mb-3"
                    label="User Email"
                    v-model:value="email"
                    placeholder="User email"
                    type="email"
                    autocomplete="email"
                    inputClasses="w-full mt-2 text-base !px-4 !py-2 border rounded-[0.35rem] bg-white border-gray-300 outline-none focus:shadow placeholder:text-[13px]"
                />
                <p v-if="emailError" class="text-red-700 text-xs mb-4">
                  {{ emailError }}
                </p>
              </div>
              <div class="flex-column items-center justify-between">
                <div class="flex items-center justify-between">
                  <label
                      for="signup-password"
                      class="block mb-2 font-inter-medium font-intel text-xs"
                  >
                    Password
                  </label>
                </div>
                <PasswordInput
                    type="password"
                    v-model="password"
                    name="psw"
                    id="password"
                    autocomplete="password"
                    placeholder="Password"
                    required
                />
              </div>
              <p v-if="loginError" class="text-red-700 text-xs mt-1">
                {{ loginError }}
              </p>
              <div class="mt-4">
                <BaseButton
                    type="submit"
                    class="w-full p-3 text-white"
                >
                  Sign In
                </BaseButton>
              </div>
            </div>
          </div>
        </form>

        <div class="text-center mt-4">
          <p class="text-sm text-text-muted opacity-[0.7]">
            Don't have an account?
            <NuxtLink to="/register" class="text-blue-500 hover:underline">
              Sign Up
            </NuxtLink>
          </p>
        </div>

      </div>
    </div>
  </div>
</template>