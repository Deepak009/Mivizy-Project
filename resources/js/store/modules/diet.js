import axios from "axios";
import { commit, make } from "vuex-pathify";

const state = {
    questionFeedback: {
        user: {},
        feedback: []
    },
    chart: {
        id: null,
        diet_question_feedback_id: null,
        remarks: null,
        valid_from: null,
        valid_upto: null,
        diet_chart_items: []
    },
    foods: {},
    templates: [],
};

const getters = {
    emptyChart(state) {
        return {
            id: null,
            diet_question_feedback_id: null,
            remarks: null,
            valid_from: null,
            valid_upto: null,
            diet_chart_items: []
        };
    }
};

const mutations = make.mutations(state);

const actions = {
    getQuestionFeedbackList(context, payload) {
        return axios.get(route("spa.diet-question-feedback.index"), {
            params: payload
        });
    },
    async getTemplates({commit}) {
        let response = await axios.get(route("spa.diet-charts.template.index"));
        commit("templates", response.data);
    },
    getQuestionFeedbackDetails({ commit }, id) {
        axios
            .get(route("spa.diet-question-feedback.show", id))
            .then(response => {
                commit("questionFeedback", response.data);
            })
            .catch(err =>
                store.dispatch("app/error", "Failed to load Question Feedback")
            );
    },
    getDietChart({ commit, state, getters }, id) {
        axios
            .get(route("spa.diet-charts.get-by-feedback-id", id))
            .then(resp => {
                if (resp.data) {
                    commit("chart", resp.data);
                    this.showChart = true;
                } else {
                    let chart = getters.emptyChart;
                    chart.diet_question_feedback_id = id;
                    commit("chart", chart);
                }
            })
            .catch(err =>
                store.dispatch("app/error", "Failed to load Diet chart")
            );
    },
    async getAllFoods({ commit }) {
        let foods = (await axios.get(route("spa.foods.get-time-slot-wise")))
            .data;

        commit("foods", foods);
    },
    updateChartItem({}, item) {
        axios
            .post(route("spa.diet-charts.update-item"), item)
            .catch(err => store.dispatch("app/error", "Failed to update item"));
    },
    deleteChartItem({}, item) {
        axios
            .delete(
                route("spa.diet-charts.delete-item", {
                    chart: item.diet_chart_id,
                    item: item.id
                })
            )
            .catch(err => store.dispatch("app/error", "Failed to delete item"));
    },
    saveChart({ commit, state }) {
        let payload = _.cloneDeep(state.chart);
        if (state.chart.id) {
            delete payload["diet_chart_items"];
        }
        axios.post(route("spa.diet-charts.save"), payload).then(resp => {
            if (!state.chart.id) {
                state.chart.id = resp.data.id;
            }
            store.dispatch("app/success", "Successfully Saved");
        });
    },
    saveChartAsTemplate({ commit, state }, name) {
        let payload = _.cloneDeep(state.chart);
        payload.name = name;

        return axios.post(route("spa.diet-charts.template.store"), payload)
    }
};


export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
