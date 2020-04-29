require("./bootstrap");
import swal from "sweetalert2";
window.swal = swal;

window.Vue = require("vue");
import VueRouter from "vue-router";
Vue.use(VueRouter);

const toast = swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;
const swalWithBootstrapButtons = swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger"
    },
    buttonsStyling: false
});
window.swalWithBootstrapButtons = swalWithBootstrapButtons;

import routes from "./routes";

const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component("navbar", require("./components/navbar.vue").default);
Vue.component("app-footer", require("./components/app-footer.vue").default);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

function isLoggedIn() {
    return localStorage.getItem("isLoggedIn");
}
function isAdmin() {
    return localStorage.getItem("isAdmin");
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!isLoggedIn()) {
            next({
                name: "userLogin"
            });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (isLoggedIn()) {
            next({
                name: "info"
            });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.requiresAdmin)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!isAdmin()) {
            next({
                name: "adminLogin"
            });
        } else {
            next();
        }
    } else {
        next(); // make sure to always call next()!
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    data() {
        return {
            navbarlinks: [
                { link: "/reservation", label: "reservation" },
                { link: "/login", label: "login" },
                { link: "/register", label: "register" },
                { link: "/info", label: "info" }
            ],
            footerlinks: [{ link: "/admin", label: "backend" }]
        };
    }
}).$mount("#app");
