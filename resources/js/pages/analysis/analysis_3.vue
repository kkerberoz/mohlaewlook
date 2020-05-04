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
        <div class="container-xl">
            <div class="row flex-center ">
                <div class="col-md-12 ">
                    <div class="card shadow-lg bg-white">
                        <div class="card-header" style="border-radius: 0px;">
                            <div class="card-title">
                                Analysis 3
                            </div>
                            <div class="card-subtitle mb-2">
                                สวัสดีครับ
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-md-3 mb-2 float-right">
                                <label>Top :{{ input }}</label>

                                <input
                                    v-bind:class="{
                                        'is-invalid': error_input
                                    }"
                                    type="text"
                                    @input="inputNumber"
                                    v-model="input"
                                    class="form-control"
                                />
                                <span class="invalid-feedback">
                                    {{ error_input }}
                                </span>
                                <button
                                    :disabled="isDisable"
                                    @click="queryAnalysis"
                                    class="btn btn-block btn-login mt-1"
                                >
                                    search
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">User_id</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">
                                                Reservetion Count
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        v-for="(flight, id) in data"
                                        :key="id"
                                    >
                                        <tr>
                                            <th scope="row">
                                                {{ Number(id) + 1 }}
                                            </th>
                                            <td>{{ flight.user_id }}</td>
                                            <td>{{ flight.username }}</td>
                                            <td>
                                                {{ flight.reserve_count }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from "vue-multiselect";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
    components: { Multiselect, Loading },
    data() {
        return {
            loadingPage: false,
            fullPage: true,
            isDisable: false,
            input: "",
            data: [],
            errors: [],
            error_input: ""
        };
    },
    beforeMount() {
        this.loadingPage = true;
        setTimeout(() => {
            this.loadingPage = false;
        }, 2000);
    },
    methods: {
        inputNumber() {
            if (isNaN(this.input) || this.input < 0) {
                this.isDisable = true;
                this.error_input =
                    "Please fill only number that is positive number.";
                this.errors.push(this.error_input);
            } else {
                this.isDisable = false;
                this.error_input = null;
            }
        },
        queryAnalysis() {
            this.loadingPage = true;
            let data = {
                top: Number(this.input)
            };
            axios
                .post("/api/backend/analytic3_show", data)
                .then(response => {
                    this.data = response.data;
                    console.log(this.data);
                    this.loadingPage = false;
                })
                .catch(error => {
                    this.loadingPage = false;
                    swal.fire(
                        "Error.",
                        "Cilck the button to continue!",
                        "error"
                    );
                });
        }
    }
};
</script>

<style></style>
