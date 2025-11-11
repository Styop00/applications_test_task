<script setup lang="js">
import TextInput from '~/components/UI/inputs/TextInput.vue';
import BaseButton from '~/components/UI/buttons/BaseButton.vue';
import {useUserStore} from "~/store/user";

const name = ref('')
const email = ref('')
const password = ref('')
const passwordConfirmation = ref('')
const errors = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const {register} = useUserStore()

async function handleRegister() {
  try {
    errors.value = {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    }
    const response = await register({
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: passwordConfirmation.value,
    })
    if (response.value) {
      navigateTo('/')
    }
  } catch (e) {
    Object.assign(errors.value, e.message ?? {})
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
        <form @submit.prevent="handleRegister">
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
                    label="Name"
                    v-model:value="name"
                    placeholder="Full Name"
                    autocomplete="name"
                    inputClasses="w-full mt-2 text-base !px-4 !py-2 border rounded-[0.35rem] bg-white border-gray-300 outline-none focus:shadow placeholder:text-[13px]"
                />
                <p v-if="errors.name" class="text-red-700 text-xs mb-4">
                  {{ errors.name[0] ?? '' }}
                </p>
                <TextInput
                    class="block font-inter-medium font-intel text-xs mb-3"
                    label="Email"
                    v-model:value="email"
                    placeholder="email"
                    type="email"
                    autocomplete="email"
                    inputClasses="w-full mt-2 text-base !px-4 !py-2 border rounded-[0.35rem] bg-white border-gray-300 outline-none focus:shadow placeholder:text-[13px]"
                />
                <p v-if="errors.email" class="text-red-700 text-xs mb-4">
                  {{ errors.email[0] ?? '' }}
                </p>
                <TextInput
                    class="block font-inter-medium font-intel text-xs mb-3"
                    label="Password"
                    v-model:value="password"
                    placeholder="Password"
                    type="password"
                    autocomplete="password"
                    inputClasses="w-full mt-2 text-base !px-4 !py-2 border rounded-[0.35rem] bg-white border-gray-300 outline-none focus:shadow placeholder:text-[13px]"
                />
                <p v-if="errors.password" class="text-red-700 text-xs mb-4">
                  {{ errors.password[0] ?? '' }}
                </p>
                <TextInput
                    class="block font-inter-medium font-intel text-xs mb-3"
                    label="Password Confirmation"
                    v-model:value="passwordConfirmation"
                    placeholder="Password Confirmation"
                    autocomplete="confirm-apssword"
                    type="password"
                    inputClasses="w-full mt-2 text-base !px-4 !py-2 border rounded-[0.35rem] bg-white border-gray-300 outline-none focus:shadow placeholder:text-[13px]"
                />
                <p v-if="errors.password_confirmation" class="text-red-700 text-xs mb-4">
                  {{ errors.password_confirmation[0] ?? '' }}
                </p>
              </div>
              <div class="mt-4">
                <BaseButton
                    type="submit"
                    class="w-full p-3 text-white"
                >
                  Register
                </BaseButton>
              </div>
            </div>
          </div>
        </form>
        <div class="text-center mt-4">
          <p class="text-sm text-text-muted opacity-[0.7]">
            Already have an account?
            <NuxtLink to="/login" class="text-blue-500 hover:underline">
              Login
            </NuxtLink>
          </p>
        </div>

      </div>
    </div>
  </div>
</template>