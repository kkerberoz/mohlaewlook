<template>
    <div class="container-fluid">
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            :opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <div class="container-xl" style="padding:2%">
            <div class="row flex-center full-height">
                <div class="col-md-5 ">
                    <form v-on:submit="formSubmit">
                        <div class="card shadow-lg bg-white">
                            <div
                                class="card-header"
                                style="border-radius: 0px;"
                            >
                                Login
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
                            <div class="card-footer">
                                <button
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
    name: "login",
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
    //     }, 2000);
    // },
    methods: {
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
                let data = {
                    username: this.username,
                    password: this.password
                };
                this.isLoading = true;
                axios.get("/sanctum/csrf-cookie").then(response => {
                    axios
                        .post("/api/user/login", data)
                        .then(response => {
                            this.customer = response.data;
                            swal.fire(
                                "Login Success!",
                                "Cilck the button to continue!",
                                "success"
                            ).then(() => {
                                localStorage.setItem("isLoggedIn", "true");
                                this.$router.go({ name: "reservation" });
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
