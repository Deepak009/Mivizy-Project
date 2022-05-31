import axios from 'axios';
import { make } from 'vuex-pathify'

const state = {}

const mutations = make.mutations(state);

const actions = {
    getCustomers(context, payload) {
        return axios.get(route("spa.customers.index"), {params: payload});
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
