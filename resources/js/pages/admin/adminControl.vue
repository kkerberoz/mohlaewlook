<template>
    <div class="admin">
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            :opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <div class="page-wrapper default-theme sidebar-bg bg1 toggled">
            <div class="btn btn-lg btn-dark btn-admin">
                <a id="show-sidebar" @click="closeMenu">
                    <i class="fas fa-compress-alt fa-2x"></i>
                </a>
            </div>

            <nav id="sidebar" class="sidebar-wrapper">
                <div class="sidebar-content hide-scroll">
                    <!-- sidebar-brand  -->
                    <div class="sidebar-item sidebar-brand">
                        <a>Admin Control</a>

                        <div id="close-sidebar" @click="closeMenu">
                            <i class="fas fa-times"></i>
                        </div>
                    </div>
                    <!-- sidebar-header  -->
                    <div class="sidebar-item sidebar-header">
                        <!-- <div class="user-pic">
                            <img
                                class="img-responsive img-rounded"

                                alt="User picture"
                            />
            </div>-->

                        <div class="user-info">
                            <span class="user-name">
                                <strong>{{
                                    user.name + " " + user.surname
                                }}</strong>
                            </span>
                            <span class="user-status">
                                <i class="fa fa-circle"></i>
                                <span>Online</span>
                            </span>
                        </div>
                    </div>
                    <!-- sidebar-menu  -->
                    <div class="sidebar-item sidebar-menu">
                        <ul>
                            <li class="header-menu">
                                <span>Menu</span>
                            </li>

                            <li>
                                <router-link to="/">
                                    <i class="fas fa-home"></i>
                                    <span>Homepage</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link :to="{ name: 'adminHome' }">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                </router-link>
                            </li>

                            <li>
                                <!-- <a
                                    :href="
                                        $router.resolve({ name: 'newEmployee' })
                                            .href
                                    "
                                >
                                    <i class="far fa-address-card"></i>
                                    <span>Add Employee</span>
                </a>-->
                                <router-link
                                    :to="{ name: 'newEmployee' }"
                                    v-show="
                                        role === 'human_resource' ||
                                        role === 'admin'
                                            ? true
                                            : false
                                    "
                                >
                                    <i class="far fa-address-card"></i>
                                    <span>Add Employee</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    :to="{ name: 'manageSchedule' }"
                                    v-show="
                                        role === 'human_resource' ||
                                        role === 'admin'
                                            ? true
                                            : false
                                    "
                                >
                                    <i class="fas fa-chart-line"></i>
                                    <span>Manage Schedule</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    :to="{ name: 'manageCustomer' }"
                                    v-show="
                                        role === 'staff' || role === 'admin'
                                            ? true
                                            : false
                                    "
                                >
                                    <i class="fas fa-user-edit"></i>
                                    <span>Manage Customer</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    :to="{ name: 'addPrice' }"
                                    v-show="
                                        role === 'flight_manager' ||
                                        role === 'admin'
                                            ? true
                                            : false
                                    "
                                >
                                    <i class="fas fa-dollar-sign"></i>
                                    <span>Manage Flight Price</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    :to="{ name: 'addFlight' }"
                                    v-show="
                                        role === 'flight_manager' ||
                                        role === 'admin'
                                            ? true
                                            : false
                                    "
                                >
                                    <i class="fas fa-plane-departure"></i>
                                    <span>Add Route</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    :to="{ name: 'addAircraft' }"
                                    v-show="
                                        role === 'flight_manager' ||
                                        role === 'admin'
                                            ? true
                                            : false
                                    "
                                >
                                    <i class="fas fa-plane"></i>
                                    <span>Add Aircraft</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    :to="{ name: 'workSchedule' }"
                                    v-show="
                                        role === 'pilot' ||
                                        role === 'flight_attendant'
                                            ? true
                                            : false
                                    "
                                >
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Schedule</span>
                                </router-link>
                            </li>

                            <li>
                                <router-link
                                    :to="{ name: 'addAirport' }"
                                    v-show="
                                        role === 'flight_manager' ||
                                        role === 'admin'
                                            ? true
                                            : false
                                    "
                                >
                                    <i class="fas fa-map-marked-alt"></i>
                                    <span>Add Airport</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    :to="{ name: 'analysis_1' }"
                                    v-show="
                                        role === 'flight_manager' ||
                                        role === 'admin'
                                            ? true
                                            : false
                                    "
                                >
                                    <i class="fas fa-chart-line"></i>
                                    <span>Number of domestic flight</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    :to="{ name: 'analysis_2' }"
                                    v-show="
                                        role === 'flight_manager' ||
                                        role === 'staff' ||
                                        role === 'admin'
                                            ? true
                                            : false
                                    "
                                >
                                    <i class="fas fa-chart-line"></i>
                                    <span
                                        >Number of access in each seat
                                        class</span
                                    >
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    :to="{ name: 'analysis_3' }"
                                    v-show="
                                        role === 'staff' ||
                                        role === 'admin' ||
                                        role === 'human_resource'
                                            ? true
                                            : false
                                    "
                                >
                                    <i class="fas fa-chart-line"></i>
                                    <span>Most reserved account</span>
                                </router-link>
                            </li>
                            <li>
                                <router-link
                                    :to="{ name: 'analysis_4' }"
                                    v-show="
                                        role === 'flight_manager' ||
                                        role === 'admin'
                                            ? true
                                            : false
                                    "
                                >
                                    <i class="fas fa-chart-line"></i>
                                    <span>Number of passengers</span>
                                </router-link>
                            </li>
                            <li style="margin-top:10px; padding:10px">
                                <div
                                    id="btnLogout"
                                    @click.prevent="logout"
                                    class="btn btn-block"
                                >
                                    <span v-show="!isLoading"
                                        ><i class="fas fa-power-off"></i>
                                        <span>Logout</span></span
                                    >
                                    <i
                                        class="fas fa-spinner fa-pulse"
                                        v-show="isLoading"
                                    ></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- sidebar-menu  -->
                </div>
            </nav>
            <br />
            <!-- sidebar-content  -->
            <main class="page-content">
                <router-view></router-view>
                <hr />
                <footer class="pt-xl-5 text-center">
                    <p class="mb-1">&copy; 2020 Mohlaewlook</p>
                </footer>
            </main>
            <!-- page-content" -->
        </div>
        <!-- page-wrapper -->
    </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
    components: { Loading },
    data() {
        return {
            loadingPage: false,
            fullPage: true,
            isLoading: false,
            user: "",
            get role() {
                return localStorage.getItem("isRole");
            }
        };
    },

    mounted() {
        axios
            .get("/api/admin/init")
            .then(response => {
                this.user = response.data;
            })
            .catch(error => {
                if (error.response.status === 401) {
                    this.loadingPage = false;
                    swal.fire(
                        "Please log in.",
                        "Cilck the button to continue!",
                        "error"
                    ).then(() => {
                        this.$router.go({ name: "adminLogin" });
                    });
                }
            });
    },
    methods: {
        closeMenu() {
            $(".page-wrapper").toggleClass("toggled");
        },
        logout(e) {
            e.preventDefault();
            this.isLoading = true;
            axios.get("/sanctum/csrf-cookie").then(response => {
                axios
                    .post("/api/admin/logout")
                    .then(() => {
                        this.isLoading = false;
                        localStorage.removeItem("isAdmin");
                        localStorage.removeItem("isRole");
                        this.$router.push({ name: "adminLogin" });
                    })
                    .catch(error => {
                        this.isLoading = false;
                        this.loadingPage = false;
                    });
            });
        }
    }
};
</script>
<style>
.btn-admin {
    color: #fff;
    border: none;
    border-radius: 0px;
    display: inline-flex;
}
.btn-admin:hover {
    color: #fff;
    border: none;
    border-radius: 0px;
    font-size: 30px;
    transition: 0.3s;
    display: inline-flex;
}
.hide-scroll::-webkit-scrollbar {
    overflow-y: hidden; /* Hide vertical scrollbar */
    overflow-x: hidden;
    display: none;
}

#btnLogout {
    border: none;
    border-radius: 0px;
    background: #eb3349;
    background: -webkit-linear-gradient(to right, #f45c43, #eb3349);
    background: linear-gradient(to right, #f45c43, #eb3349);
}
#btnLogout:hover {
    border: none;
    transition: 0.7s;
    border-radius: 0px;
    background: #eb3349;
    background: -webkit-linear-gradient(to left, #f45c43, #eb3349);
    background: linear-gradient(to left, #f45c43, #eb3349);
}
</style>
