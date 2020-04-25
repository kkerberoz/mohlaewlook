<template>
    <div class="container-fluid">
        <div class="row flex-center full-height">
            <div class="col-md-3">
                <form v-on:submit="formSubmit">
                    <div class="card">
                        <div class="card-header bg-info">Login</div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Username:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="{ 'is-invalid': error_username }"
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
                                    :class="{ 'is-invalid': error_password }"
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
                                class="btn btn-block btn-login"
                            >
                                Sign in
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "login",
    data() {
        return {
            username: "",
            password: "",
            error_username: "",
            error_password: "",
            errors: []
        };
    },
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
                axios.get("/sanctum/csrf-cookie").then(response => {
                    axios
                        .post("/api/login", data)
                        .then(response => {
                            this.customer = response.data;
                            swal.fire(
                                "Login Success!",
                                "Cilck the button to continue!",
                                "success"
                            ).then(() => {
                                localStorage.setItem("isLoggedIn", "true");
                                this.$router.go({ name: "info" });
                            });
                        })
                        .catch(error => {
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
