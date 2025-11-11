import {useUserStore} from "~/store/user";

export const useApiFetch = (request, opts) => {
    const store = useUserStore()
    const config = useRuntimeConfig()

    const accessToken = computed(() => store.token)

    let baseUrl = config.public.apiRoute

    return useFetch(request,
        {
            baseURL: baseUrl,
            headers: {
                Accept: 'application/json',
                Authorization: accessToken.value ? `Bearer ${accessToken.value}` : ''
            },
            onResponseError({ response }) {
                if (response.status === 401) {
                    store.resetState()
                    navigateTo('/login')
                }

                // Throw to propagate error up to caller
                return response._data
            },
            ...opts
        })
}