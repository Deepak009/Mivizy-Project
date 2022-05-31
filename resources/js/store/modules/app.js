// Pathify
import { make } from 'vuex-pathify'

// Data
const state = {
    drawer: null,
    drawerImage: true,
    mini: false,
    items: [
        {
            title: "Dashboard",
            icon: "mdi-view-dashboard",
            to: "/",
            can: user => true
        },
        {
            title: "Users",
            icon: "mdi-account-group",
            to: "/users",
            can: user => user.is_admin
        },
        {
            title: "Dieticians",
            icon: "mdi-account-multiple",
            to: { name: "dieticians.list" },
            can: user => user.is_admin
        },
        {
            title: "Foods",
            icon: "mdi-food-apple",
            to: { name: "foods.list" },
            can: user => user.is_admin
        },
        {
            title: "Customers",
            icon: "mdi-account",
            to: { name: "customers.list" },
            can: user => user.is_admin
        },
        {
            title: "OPD Schedules",
            icon: "mdi-calendar-arrow-left",
            to: { name: "opd-schedules.list" },
            can: user => user.is_admin
        },
        {
            title: "Diet Question Feedback",
            icon: "mdi-forum",
            to: { name: "diet-question-feedbacks.list" },
            can: user => true
        },
        {
            title: "Blood Donor",
            icon: "mdi-image",
            to: { name: "blood-donors.list" },
            can: user => user.is_admin
        },
        {
            title: "Blood Request",
            icon: "mdi-image",
            to: { name: "blood-requests.list" },
            can: user => user.is_admin
        }
        ,
        {
            title: "Banner",
            icon: "mdi-image",
            to: { name: "banner.list" },
            can: user => user.is_admin
        }
        ,
        {
            title: "Doctors",
            icon: "mdi-image",
            to: { name: "doctors.list" },
            can: user => user.is_admin
        }
        
       
    ],
    notification: {
        show: false,
        type: "success",
        message: "Success"
    },
    pageTitle: ""
};

const mutations = make.mutations(state)

const actions = {
  ...make.actions(state),
  init: async (context) => {
    // context.dispatch("user/loadUser");
  },
  success({commit}, message) {
      commit("notification", {
          show: true,
          type: "success",
          message: message
      });
  },
  error({commit}, message) {
      commit("notification", {
          show: true,
          type: "error",
          message: message
      });
  }
}

const getters = {}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters,
}
