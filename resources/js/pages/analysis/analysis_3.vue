<template>
    <div class="container-fluid" style="padding:3%">
        <div class="container-xl">
            <div class="row flex-center ">
                <div class="col-md-12 ">
                    <div class="card shadow-lg bg-white">
                        <div class="card-header" style="border-radius: 0px;">
                            <div class="card-title">
                                Analysis 3
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
export default {
    components: { Multiselect },
    data() {
        return {
            isDisable: false,
            input: "",
            data: [],
            errors: [],
            error_input: ""
        };
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
            let data = {
                top: Number(this.input)
            };
            axios
                .post("/api/backend/analytic3_show", data)
                .then(response => {
                    this.data = response.data;
                    console.log(this.data);
                })
                .catch(error => {
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
