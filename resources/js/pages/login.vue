<template>
    <div class="container">
        <div class="row flex-center full-height">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-info">
                        Login
                    </div>
                    <div class="card-body ">
                        <div class="form-group">
                            <label for="usr">Username:</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="username"
                            />
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input
                                type="password"
                                class="form-control"
                                v-model="password"
                            />
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-block">
                            Sign in
                        </button>
                    </div>
                </div>
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
            errors: []
        };
    }
    // mounted() {
    //     if (this.app.user) {
    //         this.$router.push({ name: "home" });
    //     }
    // },
    // methods: {
    //     onSubmit() {
    //         this.errors = [];
    //         if (!this.email && this.email.length < 6) {
    //             this.errorEmail = "Email has to be at least 6 characters long.";
    //             this.errors.push(this.errorEmail);
    //         } else {
    //             this.errorEmail = null;
    //         }
    //         if (!this.password && this.password.length < 6) {
    //             this.errorPassword =
    //                 "Password has to be at least 6 characters long.";
    //             this.errors.push(this.errorPassword);
    //         } else {
    //             this.errorPassword = null;
    //         }
    //         if (!this.errors.length) {
    //             this.loading = true;
    //             let data = {
    //                 email: this.email,
    //                 password: this.password
    //             };
    //             this.app.req.post("login", data).then(response => {
    //                 this.loading = false;
    //                 if (response.data.id) {
    //                     this.app.user = response.data;
    //                     this.$router.push({
    //                         name: "home"
    //                     });
    //                 } else if (response.data.error === 401) {
    //                     this.errorPassword = "Could not log you in.";
    //                     this.password = "";
    //                 }
    //             });
    //         }
    //     }
    // }
};
</script>
