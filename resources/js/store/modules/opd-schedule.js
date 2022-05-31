import axios from 'axios';
import { make } from 'vuex-pathify'

const state = {
	selected: {}
}

const mutations = make.mutations(state);

const actions = {
	getOPDCategories(){
		return axios.get(route("spa.opd-schedules.opd-categories"));
	},
    index(context, payload) {
        return axios.get(route("spa.opd-schedules.index"), {params: payload});
    },
	get(context, payload) {
		return axios.get(route("spa.opd-schedules.show", payload));
	},
	update(context, payload) {
		return axios.put(route("spa.opd-schedules.update", payload.id), payload);
	},
	create(context, payload) {
		return axios.post(route("spa.opd-schedules.store"), payload);
	},
	delete(context, payload) {
		return axios.delete(route("spa.opd-schedules.destroy", payload.id), payload);
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
