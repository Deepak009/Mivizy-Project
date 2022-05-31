// Imports
import Vue from "vue";
import Router from "vue-router";
import auth from "../middleware/auth";
import guest from "../middleware/guest";
import admin from "../middleware/admin";
import dietician from "../middleware/dietician";
import VueRouteMiddleware from "vue-route-middleware";

Vue.use(Router);

const router = new Router({
    mode: "history",
    base: process.env.BASE_URL,
    scrollBehavior: (to, from, savedPosition) => {
        if (to.hash) return { selector: to.hash };
        if (savedPosition) return savedPosition;

        return { x: 0, y: 0 };
    },
    routes: [
        {
            path: "/login",
            component: () => import("../pages/auth/Login.vue"),
            name: "login",
            meta: {
                middleware: [guest]
            }
        },
        {
            path: "/forgot-password",
            component: () => import("../pages/auth/ForgotPassword.vue"),
            name: "forgot-password",
            meta: {
                middleware: [guest]
            }
        },
        {
            path: "/reset-password",
            component: () => import("../pages/auth/ResetPassword.vue"),
            name: "reset-password",
            meta: {
                middleware: [guest]
            }
        },
        {
            path: "/",
            component: () => import("../layouts/dashboard/Index.vue"),
            meta: {
                middleware: [auth]
            },
            children: [
                {
                    path: "",
                    name: "dashboard",
                    component: () => import("../pages/dashboard/Dashboard.vue")
                },
                {
                    path: "change-password",
                    name: "change-password",
                    component: () =>
                        import("../pages/account/ChangePassword.vue")
                },
                {
                    path: "customers",
                    name: "customers.list",
                    meta: {
                        title: "Customers",
                        middleware: [admin]
                    },
                    component: () => import("../pages/customers/List.vue")
                },
                {
                    path: "foods",
                    name: "foods",
                    meta: {
                        middleware: [admin]
                    },
                    component: () => import("../pages/foods/List.vue")
                },
                {
                    path: "foods/create",
                    name: "foods.create",
                    meta: {
                        title: "Foods Create",
                        middleware: [admin]
                    },
                    component: () => import("../pages/foods/Form.vue")
                },
                {
                    path: "foods",
                    name: "foods.list",
                    meta: {
                        title: "Foods List",
                        middleware: [admin]
                    },
                    component: () => import("../pages/foods/List.vue")
                },
                {
                    path: "foods/:id",
                    name: "foods.view",
                    meta: {
                        title: "Foods Details/Edit",
                        middleware: [admin]
                    },
                    component: () => import("../pages/foods/Form.vue")
                },
                {
                    path: "blood-donors/create",
                    name: "blood-donors.create",
                    meta: {
                        title: "Blood Donor Create",
                        middleware: [admin]
                    },
                    component: () => import("../pages/blood-donors/Form.vue")
                },
                {
                    path: "blood-donors",
                    name: "blood-donors.list",
                    meta: {
                        title: "Blood Donor List",
                        middleware: [admin]
                    },
                    component: () => import("../pages/blood-donors/List.vue")
                },
                {
                    path: "blood-donors/:id",
                    name: "blood-donors.view",
                    meta: {
                        title: "Blood Donor Details/Edit",
                        middleware: [admin]
                    },
                    component: () => import("../pages/blood-donors/Form.vue")
                },
                {
                    path: "blood-requests",
                    name: "blood-requests.list",
                    meta: {
                        title: "Blood Request List",
                        middleware: [admin]
                    },
                    component: () => import("../pages/blood-requests/List.vue")
                },
                {
                    path: "blood-requests/:id",
                    name: "blood-requests.view",
                    meta: {
                        title: "Blood Request Details/Edit",
                        middleware: [admin]
                    },
                    component: () => import("../pages/blood-requests/Form.vue")
                },
                {
                    path: "opd-schedules/create",
                    name: "opd-schedules.create",
                    meta: {
                        title: "OPD Schedule Create",
                        middleware: [admin]
                    },
                    component: () => import("../pages/opd-schedules/Form.vue")
                },
                {
                    path: "opd-schedules",
                    name: "opd-schedules.list",
                    meta: {
                        title: "OPD Schedule List",
                        middleware: [admin]
                    },
                    component: () => import("../pages/opd-schedules/List.vue")
                },
                {
                    path: "opd-schedules/:id",
                    name: "opd-schedules.view",
                    meta: {
                        title: "OPD Schedule Details/Edit",
                        middleware: [admin]
                    },
                    component: () => import("../pages/opd-schedules/Form.vue")
                },
                {
                    path: "diet-question-feedbacks",
                    name: "diet-question-feedbacks.list",
                    component: () =>
                        import("../pages/diet-question-feedbacks/List.vue")
                },
                {
                    path: "diet-question-feedbacks/:id",
                    name: "diet-question-feedbacks.view",
                    component: () =>
                        import("../pages/diet-question-feedbacks/View.vue")
                },
                {
                    path: "users",
                    name: "users.list",
                    meta: {
                        middleware: [admin]
                    },
                    component: () => import("../pages/users/List.vue")
                },
                {
                    path: "users/create",
                    name: "users.create",
                    meta: {
                        middleware: [admin]
                    },
                    component: () => import("../pages/users/Form.vue")
                },
                {
                    path: "users/:id",
                    name: "users.edit",
                    meta: {
                        middleware: [admin]
                    },
                    component: () => import("../pages/users/Form.vue")
                },
                {
                    path: "dieticians",
                    name: "dieticians.list",
                    meta: {
                        middleware: [admin]
                    },
                    component: () => import("../pages/dieticians/List.vue")
                },
                {
                    path: "dieticians/create",
                    name: "dieticians.create",
                    meta: {
                        middleware: [admin]
                    },
                    component: () => import("../pages/dieticians/Form.vue")
                },
                {
                    path: "dieticians/:id",
                    name: "dieticians.edit",
                    meta: {
                        middleware: [admin]
                    },
                    component: () => import("../pages/dieticians/Form.vue")
                },
                {
                    path: "banner",
                    name: "banner.list",
                    meta: {
                        middleware: [admin]
                    },
                    component: () => import("../pages/banner/List.vue")
                },
                {
                    path: "doctors",
                    name: "doctors.list",
                    meta: {
                        middleware: [admin]
                    },
                    component: () => import("../pages/doctors/List.vue")
                },
                {
                    path: "doctor/create",
                    name: "doctor.create",
                    meta: {
                        middleware: [admin]
                    },
                    component: () => import("../pages/doctors/Form.vue")
                },
                {
                    path: "banner/create",
                    name: "banner.create",
                    meta: {
                        middleware: [admin]
                    },
                    component: () => import("../pages/banner/Form.vue")
                },
                {
                    path: "banner/:id",
                    name: "banner.edit",
                    meta: {
                        middleware: [admin]
                    },
                    component: () => import("../pages/banner/Form.vue")
                }
            ]
        }
    ]
});

router.beforeEach(VueRouteMiddleware());

export default router;
