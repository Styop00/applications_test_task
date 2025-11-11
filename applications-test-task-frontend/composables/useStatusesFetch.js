export function useStatusesFetch() {
    const fetchStatuses = async (data) => {
        try {
            const response = await useApiFetch("/statuses", {
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

    return {
        fetchStatuses
    };
}