import axios from "axios";
import { make } from "vuex-pathify";

const state = {
};

const mutations = make.mutations(state);

const actions = {
    get(context) {
        return axios.get(route("spa.banner.index"));
    },
    show(context, payload) {
        return axios.get(route("spa.banner.show", payload));
    },
    update(context, payload) {
        var bodyFormData = new FormData();
        bodyFormData.append("id", payload.id);
        bodyFormData.append("description", payload.description);
        bodyFormData.append("order", payload.order);
        if(payload.imageFile) bodyFormData.append("image", payload.imageFile);

        return axios.post(
            route("spa.banner.store"),
            bodyFormData,
            { headers: { "Content-Type": "multipart/form-data" }}
        );
    },
};

const getters = {};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
