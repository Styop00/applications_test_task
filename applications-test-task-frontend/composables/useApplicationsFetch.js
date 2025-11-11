export function useApplicationsFetch() {
    const fetchApplications = async (data) => {
        try {
            const response = await useApiFetch("/applications", {
                method: "get",
                params: data
            });
            return response.data.value;
        } catch (error) {
            if (error instanceof Error) {
                console.error(error.message);
                throw new Error(error.message);
            } else {
                console.error("An unknown error occurred");
                throw new Error("An unknown error occurred");
            }
        }
    };

    const fetchApplicationById = async (id) => {
        try {
            const route = useRoute()
            const response = await useApiFetch(`/applications/${id}`, {
                method: "get",
                key: route.fullPath,
                cache: 'no-cache',
            });
            return response.data.value;
        } catch (error) {
            console.log(error);
            if (error instanceof Error) {
                console.error(error.message);
                throw new Error(error.message);
            } else {
                console.error("An unknown error occurred");
                throw new Error("An unknown error occurred");
            }
        }
    };

    const deleteApplication = async (id) => {
        try {
            const response = await useApiFetch(`/applications/${id}`, {
                method: "delete",
            });
            return response.data.value;
        } catch (error) {
            console.log(error);
        }
    };

    const updateApplication = async (id, data) => {
        try {
            const response = await useApiFetch(`/applications/${id}`, {
                method: "put",
                body: data
            });
            return response.data.value;
        } catch (error) {
            return error
        }
    };

    const createApplication = async (data) => {
        try {
            const response = await useApiFetch(`/applications`, {
                method: "post",
                body: data
            });

            if (response.error.value) {
                throw response.error.value;
            }

            return response.data.value
        } catch (error) {
            return error
        }
    };

    return {
        fetchApplications,
        fetchApplicationById,
        deleteApplication,
        updateApplication,
        createApplication
    };
}