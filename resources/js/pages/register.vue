<template>
    <div class="container-fluid" id="content">
        <div class="row flex-center full-height">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-info">Register</div>
                    <form v-on:submit="formSubmit">
                        <!-- <form method="post" action="/regis"> -->
                        <input
                            type="hidden"
                            name="_token"
                            v-bind:value="csrf"
                        />
                        <div class="card-body">
                            <span class="form-group">
                                <label>Username:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error_username
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="username"
                                    name="username"
                                />
                                <span class="invalid-feedback">{{
                                    error_username
                                }}</span>
                            </span>

                            <span class="form-group">
                                <label>Password:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error_password
                                    }"
                                    type="password"
                                    class="form-control"
                                    v-model="password"
                                    name="password"
                                />
                                <span class="invalid-feedback">{{
                                    error_password
                                }}</span>
                            </span>
                            <!-- <span class="form-group">
                                <label>Password:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error_password
                                    }"
                                    type="password"
                                    class="form-control"
                                    v-model="password"
                                    name="password"
                                    pattern="(?=.[a-z])(?=.*[A-Z]).{6,}"
                                    title="Must contain at least one uppercase and lowercase letter, and at least 6 or more characters "
                                />
                                <span class="invalid-feedback">{{
                                    error_password
                                }}</span>
                            </span> -->

                            <span class="form-group">
                                <label>Title</label>
                                <select
                                    v-bind:class="{ 'is-invalid': error_title }"
                                    class="form-control"
                                    name="title"
                                    v-model="title"
                                >
                                    <option value selected disabled
                                        >Please select</option
                                    >
                                    <option>Mrs.</option>
                                    <option>Ms.</option>
                                    <option>Mr.</option>
                                    <option>Miss</option>
                                </select>
                                <span class="invalid-feedback">{{
                                    error_title
                                }}</span>
                            </span>
                            <span class="form-group">
                                <label>Name:</label>
                                <input
                                    v-bind:class="{ 'is-invalid': error_name }"
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    v-model="name"
                                />
                                <div class="invalid-feedback">
                                    {{ error_name }}
                                </div>
                            </span>
                            <span class="form-group">
                                <label>Surname:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error_surname
                                    }"
                                    type="text"
                                    class="form-control"
                                    name="surname"
                                    v-model="surname"
                                />
                                <div class="invalid-feedback">
                                    {{ error_surname }}
                                </div>
                            </span>
                            <span class="form-group">
                                <label>DOB:</label>
                                <input
                                    v-bind:class="{ 'is-invalid': error_DOB }"
                                    type="date"
                                    class="form-control"
                                    name="DOB"
                                    v-model="DOB"
                                />
                                <div class="invalid-feedback">
                                    {{ error_DOB }}
                                </div>
                            </span>
                            <span class="form-group">
                                <label>Email:</label>
                                <input
                                    v-model="email"
                                    v-bind:class="{ 'is-invalid': error_email }"
                                    type="email"
                                    class="form-control"
                                    name="email"
                                />
                                <div class="invalid-feedback">
                                    {{ error_email }}
                                </div>
                            </span>
                        </div>

                        <div class="card-footer">
                            <button
                                type="submit"
                                :disabled="isLoading"
                                class="btn btn-block btn-login"
                            >
                                <span v-show="!isLoading"> Sign up</span>
                                <i
                                    class="fas fa-spinner fa-pulse"
                                    v-show="isLoading"
                                ></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["csrf", "oldName"],
    data() {
        return {
            isLoading: false,
            username: "",
            password: "",
            title: "",
            name: "",
            surname: "",
            DOB: "",
            email: "",
            error_username: "",
            error_password: "",
            error_title: "",
            error_name: "",
            error_surname: "",
            error_DOB: "",
            error_email: "",
            errors: []
        };
    },
    methods: {
        formSubmit(e) {
            e.preventDefault();
            this.errors = [];

            this.error_name = null;
            this.error_surname = null;
            this.error_DOB = null;
            this.error_email = null;
            this.error_username = null;
            this.error_password = null;
            this.error_title = null;

            let currentObj = this;
            if (!this.username.trim()) {
                this.error_username = "Please fill your username.";
                this.errors.push(this.error_username);
            } else {
                this.error_username = null;
            }

            if (!this.password) {
                //Check password constrain 1!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
                this.error_password = "Please fill your password.";
                this.errors.push(this.error_password);
            } else if (this.password.length < 6) {
                this.error_password =
                    "Password has to be at least 6 characters long.";
                this.errors.push(this.error_password);
            } else {
                this.error_password = null;
            }

            if (!this.title) {
                this.error_title = "Please select your title.";
                this.errors.push(this.error_title);
            } else {
                this.error_title = null;
            }
            if (!this.name.trim()) {
                this.error_name = "Please fill your name.";
                this.errors.push(this.error_name);
            } else {
                this.error_name = null;
            }
            if (!this.surname.trim()) {
                this.error_surname = "Please fill your surname.";
                this.errors.push(this.error_surname);
            } else {
                this.error_surname = null;
            }

            if (!this.DOB) {
                this.error_DOB = "Please select your Date of Birth.";
                this.errors.push(this.error_DOB);
            } else {
                this.error_DOB = null;
            }
            if (!this.email.trim()) {
                this.error_email = "Please fill your E-mail.";
                this.errors.push(this.error_email);
            } else {
                this.error_email = null;
            }
            console.log(this.errors);

            if (!this.errors.length) {
                this.isLoading = true;
                let data = {
                    username: this.username,
                    password: this.password,
                    title: this.title,
                    name: this.name,
                    surname: this.surname,
                    DOB: this.DOB,
                    email: this.email
                };
                axios.get("/sanctum/csrf-cookie").then(response => {
                    axios.post("/api/user/regis", data).then(response => {
                        if (response.data.errorU == 1) {
                            this.isLoading = false;
                            this.username = "";
                            this.error_username =
                                "This Username is already exist";
                            this.errors.push(this.error_username);
                            this.errors = [];
                        } else if (response.data.errorE == 1) {
                            this.isLoading = false;
                            this.email = "";
                            this.error_email = "This E-mail is already exist";
                            this.errors.push(this.error_email);
                            this.errors = [];
                        } else if (
                            response.data.errorU == 0 &&
                            response.data.errorE == 0
                        ) {
                            currentObj.output = response.data;
                            swal.fire(
                                "Register Success!",
                                "Cilck the button to continue!",
                                "success"
                            ).then(() => {
                                this.$router.push({ name: "userLogin" });
                            });
                        }
                    });
                });
            } else {
                this.isLoading = false;
                swal.fire(
                    "Please success your form!",
                    "Cilck the button to continue!",
                    "error"
                );
            }
        }
    }
};
</script>
