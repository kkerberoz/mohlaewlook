<template>
    <div class="container-fluid adminLogin">
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            :opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <div class="container-xl">
            <div class="row flex-center full-height">
                <div class="col-md-5">
                    <form v-on:submit="formSubmit">
                        <div class="card shadow-lg bg-white" id="cardLogin">
                            <div class="card-header bg-dark" id="cardLogin">
                                Admin Login
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Username:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        :class="{
                                            'is-invalid': error_username
                                        }"
                                        v-model="username"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_username }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Password:</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        :class="{
                                            'is-invalid': error_password
                                        }"
                                        v-model="password"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_password }}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" id="cardLogin">
                                <button
                                    id="btnLogin"
                                    type="submiit"
                                    :disabled="isLoading"
                                    class="btn btn-block btn-login"
                                >
                                    <span v-show="!isLoading">Sign in</span>
                                    <i
                                        class="fas fa-spinner fa-pulse"
                                        v-show="isLoading"
                                    ></i>
                                </button>
                                <button
                                    @click.prevent="home"
                                    :disabled="isLoading"
                                    id="btnLogin2"
                                    class="btn btn-block btn-login"
                                >
                                    HOME
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
    name: "adminLogin",
    components: { Loading },
    data() {
        return {
            loadingPage: false,
            fullPage: true,
            isLoading: false,
            username: "",
            password: "",
            error_username: "",
            error_password: "",
            errors: []
        };
    },
    // beforeMount() {
    //     this.loadingPage = true;
    //     setTimeout(() => {
    //         this.loadingPage = false;
    //     }, 1000);
    // },
    methods: {
        home() {
            this.isLoading = true;
            this.$router.push("/");
        },
        formSubmit(e) {
            this.errors = [];
            this.error_username = null;
            this.error_password = null;

            e.preventDefault();
            let currentObj = this;
            if (!this.username.trim()) {
                this.error_username = "Please fill your username.";
                this.errors.push(this.error_username);
            } else {
                this.error_username = null;
            }

            if (!this.password) {
                this.error_password = "Please fill your password.";
                this.errors.push(this.error_password);
            } else if (this.password.length < 6) {
                this.error_password =
                    "Password has to be at least 6 characters long.";
                this.errors.push(this.error_password);
            } else {
                this.error_password = null;
            }

            if (!this.errors.length) {
                this.isLoading = true;
                let data = {
                    username: this.username,
                    password: this.password
                };
                axios.get("/sanctum/csrf-cookie").then(response => {
                    axios
                        .post("/api/admin/login", data)
                        .then(response => {
                            // console.log(response.data);
                            this.admin = response.data;
                            swal.fire(
                                "Login Success!",
                                "Cilck the button to continue!",
                                "success"
                            ).then(() => {
                                if (response.data.employee_role === "staff") {
                                    localStorage.setItem("isAdmin", "true");
                                    localStorage.setItem("isRole", "staff");
                                    this.$router.push("/admin");
                                } else if (
                                    response.data.employee_role ===
                                    "flight_attendant"
                                ) {
                                    localStorage.setItem("isAdmin", "true");
                                    localStorage.setItem(
                                        "isRole",
                                        "flight_attendant"
                                    );
                                    this.$router.push("/admin");
                                } else if (
                                    response.data.employee_role ===
                                    "human_resource"
                                ) {
                                    localStorage.setItem("isAdmin", "true");
                                    localStorage.setItem(
                                        "isRole",
                                        "human_resource"
                                    );
                                    this.$router.push("/admin");
                                } else if (
                                    response.data.employee_role === "pilot"
                                ) {
                                    localStorage.setItem("isAdmin", "true");
                                    localStorage.setItem("isRole", "pilot");
                                    this.$router.push("/admin");
                                } else if (
                                    response.data.employee_role ===
                                    "human_resource"
                                ) {
                                    localStorage.setItem("isAdmin", "true");
                                    localStorage.setItem(
                                        "isRole",
                                        "human_resource"
                                    );
                                    this.$router.push("/admin");
                                } else if (
                                    response.data.employee_role === "admin"
                                ) {
                                    localStorage.setItem("isAdmin", "true");
                                    localStorage.setItem("isRole", "admin");
                                    this.$router.push("/admin");
                                } else if (
                                    response.data.employee_role ===
                                    "flight_manager"
                                ) {
                                    localStorage.setItem("isAdmin", "true");
                                    localStorage.setItem(
                                        "isRole",
                                        "flight_manager"
                                    );
                                    this.$router.push("/admin");
                                }
                            });
                        })
                        .catch(error => {
                            this.isLoading = false;
                            if (error.response.status === 401) {
                                swal.fire(
                                    "Could not log you in.",
                                    "Cilck the button to continue!",
                                    "error"
                                ).then(() => {
                                    this.errors = [];
                                    this.password = "";
                                    this.username = "";
                                });
                            }
                        });
                });
            }
        }
    }
};
</script>
<style>
.adminLogin {
    width: 100%;
    background: #1d976c;
    background: -webkit-linear-gradient(to right, #93f9b9, #1d976c);
    background: linear-gradient(to right, #93f9b9, #1d976c);
}
#cardLogin {
    border: none;
    border-radius: 0px;
}
#btnLogin {
    border: none;
    background: #56ab2f;
    background: -webkit-linear-gradient(to right, #a8e063, #56ab2f);
    background: linear-gradient(to right, #a8e063, #56ab2f);

    border-radius: 0px;
}
#btnLogin:hover {
    border: none;
    transition: 0.7s;
    background: #56ab2f;
    background: -webkit-linear-gradient(to left, #a8e063, #56ab2f);
    background: linear-gradient(to left, #a8e063, #56ab2f);
    border-radius: 0px;
}
#btnLogin2 {
    border: none;
    border-radius: 0px;
}
#btnLogin2:hover {
    border: none;
    transition: 0.7s;
    border-radius: 0px;
}
</style>
