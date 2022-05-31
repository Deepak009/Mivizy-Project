import axios from 'axios';
import { make } from 'vuex-pathify'

const state = {
	selectedFood: {}
}

const mutations = make.mutations(state);

const actions = {
	getFoodTypes(){
		return axios.get(route("spa.foods.food-types"));
	},
	getSlots() {
		return axios.get(route("spa.foods.slots"));
	},
    getFoods(context, payload) {
        return axios.get(route("spa.foods.index"), {params: payload});
    },
	getFoodDetails(context, payload) {
		return axios.get(route("spa.foods.show", payload));
	},
	updateFood(context, payload) {
		return axios.put(route("spa.foods.update", payload.id), payload);
	},
	createFood(context, payload) {
		return axios.post(route("spa.foods.store"), payload);
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
