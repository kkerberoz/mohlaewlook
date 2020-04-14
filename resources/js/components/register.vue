<template>
    <div class="container">
        <div class="row flex-center full-height">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info">
                        Register
                    </div>
                    <form v-on:submit.prevent="onSubmit">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Username:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="username"
                                />
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    v-model="password"
                                />
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <select class="form-control" v-model="title">
                                    <option>Mrs.</option>
                                    <option>Ms.</option>
                                    <option>Mr.</option>
                                    <option>Miss</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Name:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="name"
                                />
                            </div>
                            <div class="form-group">
                                <label>Surname:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="surname"
                                />
                            </div>
                            <div class="form-group">
                                <label>DOB:</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    v-model="DOB"
                                />
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    v-model="email"
                                />
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
    name: "register",
    data() {
        return {
            username: "",
            password: "",
            title: "",
            name: "",
            surname: "",
            DOB: "",
            email: ""
        };
    }
    // methods: {
    //     onSubmit() {
    //         let data = {
    //             username: this.username,
    //             password: this.password,
    //             title: this.title,
    //             name: this.name,
    //             surname: this.surname,
    //             DOB: this.DOB,
    //             email: this.email
    //         };
    //         this.app.req.post("register", data).then(response => {
    //             if (response.data.id) {
    //                 this.app.user = response.data;
    //                 this.app.$router.push({ name: "home" });
    //             } else if (response.data.error === "email_taken") {
    //                 this.errorEmail = "This email is taken";
    //                 this.email = "";
    //             }
    //         });
    //     }
    // }
};
</script>
