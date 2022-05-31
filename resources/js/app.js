require("./bootstrap");

import Vue from "vue";
import router from "./router";
import vuetify from "./plugins/vuetify";
// import "./plugins";
import store from "./store";
import { sync } from "vuex-router-sync";
import _ from "lodash";

Vue.config.productionTip = true;
window.store = store;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


const files = require.context("@/components", true, /\.vue$/i);

files.keys().map(key => {
    const componentConfig = files(key);
    let name =
        componentConfig.default.name ||
        key
            .split("/")
            .pop()
            .split(".")[0];
    Vue.component(name, files(key).default);
});

Vue.component("app", require("./App.vue").default);
Vue.component(
    "dashboard-layout",
    require("./layouts/dashboard/Index.vue").default
);
Vue.component("empty-layout", require("./layouts/EmptyLayout.vue").default);

sync(store, router);

axios.interceptors.response.use(
    function(response) {
        return response;
    },
    function(error) {
        if (error.response.status === 401) {
            store.dispatch("user/logout");
        }
        return Promise.reject(error);
    }
);

new Vue({
    router,
    vuetify,
    store
}).$mount("#app");
