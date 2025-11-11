export default defineEventHandler(async (event) => {
    event.context.authToken = getCookie(event, "accessToken");
});