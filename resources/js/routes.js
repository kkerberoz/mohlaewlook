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
        component: require("./pages/admin/adminLogin.vue").default,
        meta: { requiresVisitor: true }
    },
    {
        path: "/admin",
        component: require("./pages/admin/admin_control.vue").default,
        meta: { hideNavigation: true },
        // requiresAdmin: true
        children: [
            {
                path: "",
                name: "adminHome",
                component: require("./pages/info.vue").default
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
            }
        ]
    }
];

export default routes;
