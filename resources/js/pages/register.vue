<template>
    <div class="container">
        <div class="row flex-center full-height">
            <div class="col-md-6">
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
                            <div class="form-group">
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
                                <div class="invalid-feedback">
                                    {{ error_username }}
                                </div>
                            </div>

                            <div class="form-group">
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
                                <div class="invalid-feedback">
                                    {{ error_password }}
                                </div>
                            </div>

                            <div class="form-group">
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
                                <div class="invalid-feedback">
                                    {{ error_title }}
                                </div>
                            </div>
                            <div class="form-group">
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
                            </div>
                            <div class="form-group">
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
                            </div>
                            <div class="form-group">
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
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input
                                    v-bind:class="{ 'is-invalid': error_email }"
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    v-model="email"
                                />
                                <div class="invalid-feedback">
                                    {{ error_email }}
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-block">
                                Sign up
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
            error_email: ""
        };
    },
    methods: {
        formSubmit(e) {
            e.preventDefault();
            let currentObj = this;
            if (!isNaN(this.username)) {
                this.error_username = "Please fill your username.";
                this.errors.push(this.error_username);
            } else {
                this.error_username = null;
            }

            if (!isNaN(this.password)) {
                this.error_password = "Please fill your password.";
                this.errors.push(this.error_password);
            } else if (this.password.length < 6) {
                this.error_password =
                    "Password has to be at least 6 characters long.";
                this.errors.push(this.error_password);
            } else {
                this.error_password = null;
            }

            if (!isNaN(this.title)) {
                this.error_title = "Please select your title.";
                this.errors.push(this.error_title);
            } else {
                this.error_title = null;
            }
            if (!isNaN(this.name)) {
                this.error_name = "Please fill your name.";
                this.errors.push(this.error_name);
            } else {
                this.error_name = null;
            }
            if (!isNaN(this.surname)) {
                this.error_surname = "Please fill your surname.";
                this.errors.push(this.error_surname);
            } else {
                this.error_surname = null;
            }

            if (!isNaN(this.DOB)) {
                this.error_DOB = "Please select your Date of Birth.";
                this.errors.push(this.error_DOB);
            } else {
                this.error_DOB = null;
            }
            if (!isNaN(this.email)) {
                this.error_email = "Please fill your E-mail.";
                this.errors.push(this.error_email);
            } else {
                this.error_email = null;
            }
            if (!this.errors) {
                let data = {
                    username: this.username,
                    password: this.password,
                    title: this.title,
                    name: this.name,
                    surname: this.surname,
                    DOB: this.DOB,
                    email: this.email
                };
                axios.post("/api/regis", data).then(response => {
                    currentObj.output = response.data;
                    swal.fire(
                        "Register Success!",
                        "Cilck the button to continue!",
                        "success"
                    ).then(() => {
                        this.$router.push({ name: "Home" });
                    });
                });
                // .catch(function (error) {
                //     currentObj.output = error;
                //     var val = [];
                //     var err = ["Username", "Password", "Title", "Name",
                //                 "Surname", "Date of Birth", "E-mail"];

                //     var show_error = "";
                //     for(var i=1; i<=7; ++i){
                //         val[i] = document.getElementById("0" + i).value;
                //         if(!isNaN(val[i])) show_error +=  err[i - 1]  + "<br>" ;
                //     }

                //     swal.fire(
                //         "Please fill",
                //          show_error,
                //         "error"
                //     )
                // });
            }
        }
    }
};
</script>
