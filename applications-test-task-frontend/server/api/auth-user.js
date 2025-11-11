
export default defineEventHandler(async (event) => {
    const config = useRuntimeConfig()
    let baseUrl = config.public.apiRoute

    try {
        const res = await $fetch(
            '/auth/me', {
                baseURL: baseUrl,
                headers: {
                    Authorization: event.context.authToken ? `Bearer ${event.context.authToken}` : ''
                },
            })

        return res?.id
    } catch (error) {
        return null
    }
})