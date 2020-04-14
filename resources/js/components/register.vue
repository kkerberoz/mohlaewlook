<template>
    <div class="container">
        <div class="row flex-center full-height">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info">
                        Register
                    </div>
                    <form v-on:submit.prevent="formSubmit">
                    <!-- <form method="post" action="/regis"> -->
                    <input type="hidden" name="_token" v-bind:value="csrf">
                        <div class="card-body">
                            <div class="form-group" >
                                <label>Username:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="username"
                                    name="username"
                                />
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    v-model="password"
                                    name="password"
                                />
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <select class="form-control" name="title" v-model="title">
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
                                    name="name"
                                    v-model="name"
                                />
                            </div>
                            <div class="form-group">
                                <label>Surname:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="surname"
                                    v-model="surname"
                                />
                            </div>
                            <div class="form-group">
                                <label>DOB:</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    name="DOB"
                                    v-model="DOB"
                                />
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    v-model="email"
                                />
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-block" >
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
    props: ['csrf', 'oldName'],
    data()
    {
        return {
            username: "",
            password: "",
            title: "",
            name: "",
            surname: "",
            DOB: "",
            email: ""
        };
    },
    methods:
    {
        formSubmit(e) {
            e.preventDefault();
            let currentObj = this;
            axios.post('/regis', {
                username: this.username,
                password: this.password,
                title: this.title,
                name: this.name,
                surname: this.surname,
                DOB: this.DOB,
                email: this.email
            })
            .then(function (response) {
                currentObj.output = response.data;
                swal.fire("Good job!", "You clicked the button!", "success").then(function() {window.location = "/";});
            })
            .catch(function (error) {
                currentObj.output = error;

            });
        }

    }

   }

</script>



