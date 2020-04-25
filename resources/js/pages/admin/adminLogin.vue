<template>
    <div class="container-fluid" id="adminLogin">
        <div class="row flex-center full-height">
            <div class="col-md-3">
                <form v-on:submit="formSubmit">
                    <div class="card" id="cardLogin">
                        <div class="card-header bg-dark" id="cardLogin">
                            Admin Login
                        </div>
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
                        <div class="card-footer" id="cardLogin">
                            <button
                                id="btnLogin"
                                type="submiit"
                                class="btn btn-block btn-login"
                            >
                                Sign in
                            </button>
                            <button
                                @click="home"
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
</template>

<script>
export default {
    name: "adminLogin",
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
                        .post("/api/admin/login", data)
                        .then(response => {
                            console.log(response.data);
                            this.admin = response.data;
                            swal.fire(
                                "Login Success!",
                                "Cilck the button to continue!",
                                "success"
                            ).then(() => {
                                localStorage.setItem("isAdmin", "true");
                                this.$router.push("/admin");
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
            } else {
                swal.fire(
                    "Please success your form!",
                    "Cilck the button to continue!",
                    "error"
                );
            }
        },
        home() {
            this.$router.push("/");
        }
    }
};
</script>
<style>
#adminLogin {
    background: #4ecdc4;
    background: -webkit-linear-gradient(to right, #556270, #4ecdc4);
    background: linear-gradient(to right, #556270, #4ecdc4);
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
