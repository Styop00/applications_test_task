import {useUserStore} from "~/store/user";

export default defineNuxtPlugin(async (nuxtApp) => {
    const userStore = useUserStore()

    if (!userStore.user && userStore.token) {
        await userStore.getMe()
    }
})