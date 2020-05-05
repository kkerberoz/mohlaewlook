let routes = [
    {
        path: "/",
        name: "Home",
        component: require("./pages/home.vue").default
    },
    {
        path: "/login",
        name: "userLogin",
        component: require("./pages/login.vue").default,
        meta: { requiresVisitor: true }
    },
    {
        path: "/register",
        name: "userRegister",
        component: require("./pages/register.vue").default,
        meta: { requiresVisitor: true }
    },
    {
        path: "/info",
        name: "info",
        component: require("./pages/info.vue").default,
        meta: { requiresAuth: true }
    },
    {
        path: "/reservation",
        name: "reservation",
        component: require("./pages/reservation.vue").default,
        meta: { requiresAuth: true }
    },
    {
        path: "/adminLogin",
        name: "adminLogin",
        component: require("./pages/admin/adminLogin.vue").default
    },
    {
        path: "/admin",
        component: require("./pages/admin/adminControl.vue").default,
        meta: { requiresAdmin: true },

        children: [
            {
                path: "",
                name: "adminHome",
                component: require("./pages/admin/adminHome.vue").default
            },
            {
                path: "newEmployee",
                name: "newEmployee",
                component: require("./pages/admin/registerEmployee.vue").default
            },
            {
                path: "addFlight",
                name: "addFlight",
                component: require("./pages/admin/addFlight.vue").default
            },
            {
                path: "addAircraft",
                name: "addAircraft",
                component: require("./pages/admin/addAircraft.vue").default
            },
            {
                path: "addAirport",
                name: "addAirport",
                component: require("./pages/admin/addAirport.vue").default
            },
            {
                path: "customer",
                name: "customerCrud",
                component: require("./pages/admin/customerCrud.vue").default
            },
            {
                path: "addPrice",
                name: "addPrice",
                component: require("./pages/admin/addPrice.vue").default
            },
            {
                path: "workSchedule",
                name: "workSchedule",
                component: require("./pages/admin/workSchedule.vue").default
            },
            {
                path: "analysis_1",
                name: "analysis_1",
                component: require("./pages/analysis/analysis_1.vue").default
            },
            {
                path: "analysis_2",
                name: "analysis_2",
                component: require("./pages/analysis/analysis_2.vue").default
            },
            {
                path: "analysis_3",
                name: "analysis_3",
                component: require("./pages/analysis/analysis_3.vue").default
            },
            {
                path: "analysis_4",
                name: "analysis_4",
                component: require("./pages/analysis/analysis_4.vue").default
            },
            {
                path: "manageSchedule",
                name: "manageSchedule",
                component: require("./pages/admin/manageSchedule.vue").default
            }
        ]
    }
];

export default routes;
