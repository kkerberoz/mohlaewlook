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
                { link: "/login", label: "login" },
                { link: "/register", label: "register" },
                { link: "/info", label: "info" }
            ],
            footerlinks: [{ link: "/admin", label: "backend" }]
        };
    }
}).$mount("#app");
