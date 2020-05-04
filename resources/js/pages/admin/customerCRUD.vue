<template>
    <div class="container-fluid" style="padding:3%">
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            :opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <br />
        <div class="col-md-12 full-height">
            <div class="card shadow-lg bg-white">
                <div class="card-header" style="border-radius: 0px;">
                    <div class="card-title">Manage Customer</div>
                </div>
                <div style="padding:20px;" class="float-right">
                    <button class="btn btn-success" @click="newModal">
                        Add New
                        <i class="fas fa-user-plus fa-fw"></i>
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">user_id</th>
                                    <th scope="col">username</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">FirstName</th>
                                    <th scope="col">LastName</th>
                                    <th scope="col">DOB</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody v-for="(user, id) in users" :key="id">
                                <tr>
                                    <th scope="row">{{ Number(id) + 1 }}</th>
                                    <td>{{ user.user_id }}</td>
                                    <td>{{ user.username }}</td>
                                    <td>{{ user.title }}</td>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.surname }}</td>
                                    <td>{{ user.DOB }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>
                                        <a
                                            @click="editCustomer(user, user.id)"
                                            style="color: Dodgerblue;"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        |
                                        <a
                                            @click="deleteCustomer(user.id)"
                                            style="color: Tomato;"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal add new customer -->
        <div
            class="modal fade"
            id="addNew"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5
                            class="modal-title"
                            v-show="!editMode"
                            id="addNewLabel"
                        >
                            New Customer
                        </h5>
                        <h5
                            class="modal-title"
                            v-show="editMode"
                            id="addNewLabel"
                        >
                            Update Customer's Info
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span class="form-group">
                            <label>Username:</label>
                            <input
                                v-bind:class="{
                                    'is-invalid': error_username
                                }"
                                type="text"
                                class="form-control"
                                v-model="input.username"
                                name="username"
                            />
                            <span class="invalid-feedback">
                                {{ error_username }}
                            </span>
                        </span>

                        <span class="form-group">
                            <label v-show="editMode">Change Password:</label>
                            <label v-show="!editMode">Password:</label>
                            <input
                                v-bind:class="{
                                    'is-invalid': error_password
                                }"
                                type="password"
                                class="form-control"
                                v-model="input.password"
                                name="password"
                            />
                            <span class="invalid-feedback">
                                {{ error_password }}
                            </span>
                        </span>
                        <!-- <span class="form-group">
                                <label>Password:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error_password
                                    }"
                                    type="password"
                                    class="form-control"
                                    v-model="input.password"
                                    name="password"
                                    pattern="(?=.[a-z])(?=.*[A-Z]).{6,}"
                                    title="Must contain at least one uppercase and lowercase letter, and at least 6 or more characters "
                                />
                                <span class="invalid-feedback">{{
                                    error_password
                                }}</span>
            </span>-->

                        <span class="form-group">
                            <label>Title</label>
                            <select
                                v-bind:class="{ 'is-invalid': error_title }"
                                class="form-control"
                                name="title"
                                v-model="input.title"
                            >
                                <option value selected disabled
                                    >Please select</option
                                >
                                <option>Mrs.</option>
                                <option>Ms.</option>
                                <option>Mr.</option>
                                <option>Miss</option>
                            </select>
                            <span class="invalid-feedback">
                                {{ error_title }}
                            </span>
                        </span>
                        <span class="form-group">
                            <label>Name:</label>
                            <input
                                v-bind:class="{ 'is-invalid': error_name }"
                                type="text"
                                class="form-control"
                                name="name"
                                v-model="input.name"
                            />
                            <div class="invalid-feedback">{{ error_name }}</div>
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
                                v-model="input.surname"
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
                                v-model="input.DOB"
                            />
                            <div class="invalid-feedback">{{ error_DOB }}</div>
                        </span>
                        <span class="form-group">
                            <label>Email:</label>
                            <input
                                v-model="input.email"
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
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            @click="formSubmit"
                            type="submit"
                            v-show="!editMode"
                            :disabled="isLoading"
                            class="btn btn-primary"
                        >
                            <span v-show="!isLoading">Create</span>
                            <i
                                class="fas fa-spinner fa-pulse"
                                v-show="isLoading"
                            ></i>
                        </button>
                        <button
                            v-show="editMode"
                            @click="updateUser"
                            :disabled="isLoading"
                            type="submit"
                            class="btn btn-success"
                        >
                            <span v-show="!isLoading">Update</span>
                            <i
                                class="fas fa-spinner fa-pulse"
                                v-show="isLoading"
                            ></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
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
            users: [],
            isLoading: false,
            editMode: false,
            input: {
                username: "",
                password: "",
                title: "",
                name: "",
                surname: "",
                DOB: "",
                email: ""
            },
            currentID: "",
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
    beforeMount() {
        this.loadingPage = true;
        axios.get("/api/backend/getCustomer").then(response => {
            this.users = response.data;
            console.log(this.users);
            this.loadingPage = false;
        });
    },
    methods: {
        newModal() {
            this.editMode = false;
            $("#addNew").modal("show");
            this.input.username = "";
            this.input.password = "";
            this.input.title = "";
            this.input.name = "";
            this.input.surname = "";
            this.input.DOB = "";
            this.input.email = "";
        },

        //edit customer
        editCustomer(user) {
            this.editMode = true;
            $("#addNew").modal("show");
            this.input.username = user.username;
            this.input.password = user.password;
            this.input.title = user.title;
            this.input.name = user.name;
            this.input.surname = user.surname;
            this.input.DOB = user.DOB;
            this.input.email = user.email;
            return (this.currentID = user.id);
        },

        //delete customer
        deleteCustomer(id) {
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.value) {
                    axios.get("/sanctum/csrf-cookie").then(response => {
                        axios
                            .delete(`/api/backend/customer/${id}`)
                            .then(() => {
                                swal.fire(
                                    "Deleted!",
                                    "Your customer data has been deleted.",
                                    "success"
                                ).then(() => {
                                    this.$router.go({
                                        name: "customerCRUD"
                                    });
                                });
                            })
                            .catch(() => {
                                swal.fire(
                                    "Failed!",
                                    "There was something wronge.",
                                    "warning"
                                );
                            });
                    });
                } else {
                    swal.fire(
                        "Cancelled",
                        "Your Customer data is safe :)",
                        "error"
                    );
                }
            });
        },

        //update customer
        updateUser() {
            this.errors = [];
            this.error_name = null;
            this.error_surname = null;
            this.error_DOB = null;
            this.error_email = null;
            this.error_username = null;
            this.error_password = null;
            this.error_title = null;

            let currentObj = this;
            if (!this.input.username.trim()) {
                this.error_username = "Please fill your username.";
                this.errors.push(this.error_username);
            } else {
                this.error_username = null;
            }

            if (!this.input.title) {
                this.error_title = "Please select your title.";
                this.errors.push(this.error_title);
            } else {
                this.error_title = null;
            }
            if (!this.input.name.trim()) {
                this.error_name = "Please fill your name.";
                this.errors.push(this.error_name);
            } else {
                this.error_name = null;
            }
            if (!this.input.surname.trim()) {
                this.error_surname = "Please fill your surname.";
                this.errors.push(this.error_surname);
            } else {
                this.error_surname = null;
            }

            if (!this.input.DOB) {
                this.error_DOB = "Please select your Date of Birth.";
                this.errors.push(this.error_DOB);
            } else {
                this.error_DOB = null;
            }
            if (!this.input.email.trim()) {
                this.error_email = "Please fill your E-mail.";
                this.errors.push(this.error_email);
            } else {
                this.error_email = null;
            }
            console.log(this.errors.length);

            if (!this.errors.length) {
                this.isLoading = true;
                let data = {
                    username: this.input.username,
                    password: this.input.password,
                    title: this.input.title,
                    name: this.input.name,
                    surname: this.input.surname,
                    DOB: this.input.DOB,
                    email: this.input.email
                };
                axios.get("/sanctum/csrf-cookie").then(response => {
                    axios
                        .put(`/api/backend/customer/${this.currentID}`, data)
                        .then(response => {
                            swal.fire(
                                "Update Success!",
                                "Cilck the button to continue!",
                                "success"
                            ).then(() => {
                                this.isLoading = false;
                                $("#addNew").modal("hide");
                                this.$router.go({ name: "customerCRUD" });
                            });
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
        },

        // add new customer

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
            if (!this.input.username.trim()) {
                this.error_username = "Please fill your username.";
                this.errors.push(this.error_username);
            } else {
                this.error_username = null;
            }

            if (!this.input.password) {
                //Check password constrain 1!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!1
                this.error_password = "Please fill your password.";
                this.errors.push(this.error_password);
            } else if (this.input.password.length < 6) {
                this.error_password =
                    "Password has to be at least 6 characters long.";
                this.errors.push(this.error_password);
            } else {
                this.error_password = null;
            }

            if (!this.input.title) {
                this.error_title = "Please select your title.";
                this.errors.push(this.error_title);
            } else {
                this.error_title = null;
            }
            if (!this.input.name.trim()) {
                this.error_name = "Please fill your name.";
                this.errors.push(this.error_name);
            } else {
                this.error_name = null;
            }
            if (!this.input.surname.trim()) {
                this.error_surname = "Please fill your surname.";
                this.errors.push(this.error_surname);
            } else {
                this.error_surname = null;
            }

            if (!this.input.DOB) {
                this.error_DOB = "Please select your Date of Birth.";
                this.errors.push(this.error_DOB);
            } else {
                this.error_DOB = null;
            }
            if (!this.input.email.trim()) {
                this.error_email = "Please fill your E-mail.";
                this.errors.push(this.error_email);
            } else {
                this.error_email = null;
            }
            console.log(this.errors.length);

            if (!this.errors.length) {
                this.isLoading = true;
                let data = {
                    username: this.input.username,
                    password: this.input.password,
                    title: this.input.title,
                    name: this.input.name,
                    surname: this.input.surname,
                    DOB: this.input.DOB,
                    email: this.input.email
                };
                axios.get("/sanctum/csrf-cookie").then(response => {
                    axios.post("/api/user/regis", data).then(response => {
                        if (response.data.errorU == 1) {
                            this.isLoading = false;
                            this.input.username = "";
                            this.input.error_username =
                                "This Username is already exist";
                            this.errors.push(this.error_username);
                            this.errors = [];
                        } else if (response.data.errorE == 1) {
                            this.isLoading = false;
                            this.input.email = "";
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
                                $("#addNew").modal("hide");
                                this.$router.go({ name: "customerCRUD" });
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
