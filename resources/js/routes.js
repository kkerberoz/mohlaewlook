let routes = [
    {
        path: "/",
        name: "Home",
        component: require("./pages/ExampleComponent.vue").default
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
        path: "/employee",
        name: "employee",
        component: require("./pages/employee/register_emp.vue").default
    },
    {
        path: "/employee/register",
        name: "employeeRegister",
        component: require("./pages/employee/register_emp.vue").default
    }
];

export default routes;
