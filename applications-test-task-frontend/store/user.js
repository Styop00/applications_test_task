import {defineStore} from "pinia";
import {useApiFetch} from "~/composables/useApiFetch";

export const useUserStore = defineStore(
    "user",
    () => {
        const user = ref();
        const token = useCookie("accessToken", {
            maxAge: 2592000,
        });

        const setUser = (data) => (user.value = data);
        const setToken = (data) => (token.value = data);
        const register = function (
            data
        ) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await useApiFetch("/auth/register", {
                        method: "post",
                        body: data,
                    });

                    if (!response.data.value) {
                        reject(response.error?.value?.data);
                        return
                    }

                    const {token, user} = response.data.value;
                    setToken(token);
                    setUser(user);
                    resolve(response.data);
                } catch (error) {
                    console.log(error);
                    if (error instanceof Error) {
                        console.error(error.message);
                        reject(error.message);
                    } else {
                        console.error("An unknown error occurred");
                        reject("An unknown error occurred");
                    }
                }
            });
        };

        const login = function (
            email,
            password
        ) {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await useApiFetch("/auth/login", {
                        method: "post",
                        body: {
                            email: email,
                            password: password,
                        },
                    });


                    if (!response.data.value) {
                        reject("Incorrect values.");
                    } else {
                        const {token, user} = response.data.value;
                        setToken(token);
                        setUser(user);
                        resolve(response.data);
                    }
                } catch (error) {
                    console.log(error);
                    setToken(null);
                    setUser(null);
                    reject(error);
                }
            });
        };

        const logout = async function () {
            return new Promise(async (resolve, reject) => {
                try {
                    const response = await useApiFetch("/auth/logout", {
                        method: "get",
                    });

                    resetState()
                    navigateTo('/login')
                    resolve(response.data);
                } catch (error) {
                    console.log(error);
                    setToken(null);
                    setUser(null);
                    reject(error);
                }
            });
        };

        const getMe = function () {
            return new Promise(async (resolve, reject) => {
                try {
                    const {data} = await useApiFetch("/auth/me");

                    if (data.value.data) {
                        setUser(data.value.data);
                    }

                    resolve(data);
                } catch (error) {
                    console.log(error);
                    reject(error);
                }
            });
        };

        const resetState = function () {
            setUser(null);
            setToken(null);
            const authToken = useCookie("authToken", {
                maxAge: 2592000,
            });
            authToken.value = null;
        };

        const getUserRoleNames = () => {
            if (user.value) {
                return user.value.roles.map((role) => role.name);
            }
            return [];
        };

        const isAdmin = computed(() => {
            return (
                getUserRoleNames().includes("admin")
            );
        });

        return {
            user,
            token,
            setUser,
            setToken,
            login,
            logout,
            resetState,
            getMe,
            getUserRoleNames,
            register,
            isAdmin,
        };
    },
    {
        persist: {
            paths: ["token"],
        },
    }
);
