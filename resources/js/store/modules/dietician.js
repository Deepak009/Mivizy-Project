// Utilities
import axios from "axios";
import { make } from "vuex-pathify";

const state = {
};

const mutations = make.mutations(state);

const actions = {
    getDieticiansList(context, payload) {
        return axios.get(route("spa.dietician.index"), { params: payload });
    },
    getDieticianDetails({ commit }, payload) {
        return axios.get(route("spa.dietician.show", payload));
    },
    updateDietician({ commit }, payload) {
        return axios.put(route("spa.dietician.update", payload.id), payload);
    },
    createDietician({ commit }, payload) {
        return axios.post(route("spa.dietician.store"), payload);
    }
};

const getters = {
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
