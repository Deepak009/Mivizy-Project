import axios from 'axios';
import { make } from 'vuex-pathify'

const state = {
	selected: {}
}

const mutations = make.mutations(state);

const actions = {
	getBloodGroups(){
		return axios.get(route("spa.blood-donors.blood-groups"));
	},
    index(context, payload) {
        return axios.get(route("spa.blood-donors.index"), {params: payload});
    },
	get(context, payload) {
		return axios.get(route("spa.blood-donors.show", payload));
	},
	update(context, payload) {
		return axios.put(route("spa.blood-donors.update", payload.id), payload);
	},
	create(context, payload) {
		return axios.post(route("spa.blood-donors.store"), payload);
	}
};

const getters = {};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
