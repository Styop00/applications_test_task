import {useUserStore} from "~/store/user";

export default defineNuxtRouteMiddleware(async (to, from) => {
    let id = null

    if (import.meta.server) {
        const res = await useFetch('/api/auth-user')
        id = res?.data?.value
    } else {
        const store = useUserStore()
        id = store.user?.id
    }

    if (!to.meta.publicRoute) {
        if (!to.meta.guestRoute && !id) {
            abortNavigation()
            return navigateTo('/login')
        } else if (to.meta.guestRoute && id) {
            abortNavigation()
            return navigateTo('/')
        }
    }
})