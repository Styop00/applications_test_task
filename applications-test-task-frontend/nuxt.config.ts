// https://nuxt.com/docs/api/configuration/nuxt-config
import vueJsx from '@vitejs/plugin-vue-jsx'

export default defineNuxtConfig({
    compatibilityDate: '2025-07-15',
    devtools: {enabled: true},
    ssr: false,
    modules: ['@pinia/nuxt', '@nuxtjs/tailwindcss', '@vesp/nuxt-fontawesome'],
    vite: {
        plugins: [vueJsx()],
    },
    runtimeConfig: {
        public: {
            apiRoute: import.meta.env.API_ROUTE,
            backendURL: import.meta.env.BACKEND_URL,
        },
    },
    components: false,
    fontawesome: {
        icons: {
            solid: [
                "xmark",
                "eye-slash",
                "eye",
                "chevron-left",
                "chevron-right",
                "spinner",
                "angle-down",
                "angle-up"
            ],
            regular: ["user", "circle-user"],
        },
    },
})