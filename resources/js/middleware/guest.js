import store from "../store";

export default async function auth(to, from, next) {

    let user = await store.dispatch("user/getUser");
    if (user) {
        return next({ name: "dashboard" });
    }
    return next();
}
