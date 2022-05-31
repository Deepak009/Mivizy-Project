// Utilities
import axios from "axios";
import { make } from "vuex-pathify";

const state = {
    dark: false,
    drawer: {
        image: 0,
        gradient: 0,
        mini: false
    },
    gradients: [
        "rgba(0, 0, 0, .7), rgba(0, 0, 0, .7)",
        "rgba(228, 226, 226, 1), rgba(255, 255, 255, 0.7)",
        "rgba(244, 67, 54, .8), rgba(244, 67, 54, .8)"
    ],
    images: [
        "https://picsum.photos/id/10/300/700",
        "https://picsum.photos/id/1018/300/700",
        "https://picsum.photos/id/1022/300/700"
    ],
    notifications: [],
    user: false,
    selectedUser: {}
};

const mutations = make.mutations(state);

const actions = {
    getUser({ commit, state }) {
        return new Promise(async (resolve, reject) => {
            if (state.user != false) resolve(state.user);
            else {
                axios
                    .get(route("spa.user"))
                    .then(response => {
                        commit("user", response.data);
                        resolve(response.data);
                    })
                    .catch(err => {
                        resolve(false);
                    });
            }
        });
    },
    login({ commit }, payload) {
        return axios.post(route("spa.login"), payload);
    },
    forgotPassword({ commit }, payload) {
        return axios.post(route("spa.forgot-password"), payload);
    },
    resetPassword({ commit }, payload) {
        return axios.post(route("spa.reset-password"), payload);
    },
    updatePassword({ commit }, payload) {
        return axios.post(route("spa.update-password"), payload);
    },
    logout({ commit }) {
        return axios.post(route("spa.logout"));
    },
    getUsersList(context, payload) {
        return axios.get(route("spa.user.index"), { params: payload });
    },
    getUserDetails({ commit }, payload) {
        return axios.get(route("spa.user.show", payload));
    },
    updateUser({ commit }, payload) {
        return axios.put(route("spa.user.update", payload.id), payload);
    },
    createDoctor({ commit }, payload) {

       return axios.post(route("spa.doctors.store"), payload);
    },
    get(context) {
        return axios.get(route("spa.doctors.index"));
    },
    dashboardData({ commit }) {
        return axios.get(route("spa.dashboard.data"));
    }
};

const getters = {
    dark: (state, getters) => {
        return state.dark || getters.gradient.indexOf("255, 255, 255") === -1;
    },
    gradient: state => {
        return state.gradients[state.drawer.gradient];
    },
    image: state => {
        return state.drawer.image === ""
            ? state.drawer.image
            : state.images[state.drawer.image];
    }
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
