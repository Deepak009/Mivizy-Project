import store from "../store";

export default async function auth(to, from, next) {

    let user = await store.dispatch("user/getUser");
    if (!user.is_admin) {
        store.dispatch('app/error', 'Unauthorized Access!');
        return next({ name: "dashboard" });
    }
    return next();
}
