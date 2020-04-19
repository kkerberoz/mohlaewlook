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
                path: "newemployee",
                name: "newemployee",
                component: require("./pages/admin/registerEmployee.vue").default
            },
            {
                path: "addflight",
                name: "addflight",
                component: require("./pages/admin/add_flight.vue").default
            }
        ]
    }
];

export default routes;
