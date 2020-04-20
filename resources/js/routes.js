let routes = [
    {
        path: "/",
        name: "Home",
        component: require("./pages/home.vue").default
    },
    {
        path: "/login",
        name: "userLogin",
        component: require("./pages/login.vue").default
    },
    {
        path: "/register",
        name: "userRegister",
        component: require("./pages/register.vue").default
    },
    {
        path: "/info",
        name: "info",
        component: require("./pages/info.vue").default
    },
    {
        path: "/admin",
        component: require("./pages/admin/admin_control.vue").default,
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
