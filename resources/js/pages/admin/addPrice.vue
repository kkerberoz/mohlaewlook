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
                            <div class="card-title">Manage Flight Price</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">
                                                Flight Number
                                            </th>
                                            <th scope="col">
                                                Economy class Price
                                            </th>
                                            <th scope="col">
                                                Business class Price
                                            </th>
                                            <th scope="col">
                                                First class Price
                                            </th>
                                            <th scope="col">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        v-for="(flight, id) in flights"
                                        :key="id"
                                    >
                                        <tr>
                                            <th scope="row">
                                                {{ Number(id) + 1 }}
                                            </th>
                                            <td>
                                                {{ flight.flight_no }}
                                            </td>
                                            <td>
                                                {{ flight.eco_price }}
                                            </td>
                                            <td>{{ flight.bus_price }}</td>
                                            <td>
                                                {{ flight.first_price }}
                                            </td>

                                            <td>
                                                <a
                                                    @click="editPrice(flight)"
                                                    style="color: Dodgerblue;"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
                                v-show="editMode"
                                id="addNewLabel"
                            >
                                Update Flight Price
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
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label>Flight Number: </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-bind:class="{
                                            'is-invalid': error_flightNo
                                        }"
                                        v-model="input.flightNo"
                                        disabled
                                    />
                                    <span class="invalid-feedback">
                                        {{ error_flightNo }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <label>Economy Class Price:</label>
                                    <div class="input-group">
                                        <input
                                            v-bind:class="{
                                                'is-invalid': error_ecoPrice
                                            }"
                                            required
                                            type="text"
                                            class="form-control"
                                            v-model="input.ecoPrice"
                                        />
                                        <span class="invalid-feedback">
                                            {{ error_ecoPrice }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <label>Business Class Price:</label>
                                    <div class="input-group">
                                        <input
                                            v-bind:class="{
                                                'is-invalid': error_businessPrice
                                            }"
                                            required
                                            type="text"
                                            class="form-control"
                                            v-model="input.businessPrice"
                                        />
                                        <span class="invalid-feedback">
                                            {{ error_businessPrice }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <label>First Class Price:</label>
                                    <div class="input-group">
                                        <input
                                            v-bind:class="{
                                                'is-invalid': error_firstPrice
                                            }"
                                            required
                                            type="text"
                                            class="form-control"
                                            v-model="input.firstPrice"
                                        />
                                        <span class="invalid-feedback">
                                            {{ error_firstPrice }}
                                        </span>
                                    </div>
                                </div>
                            </div>
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
                                :disabled="isLoading"
                                type="submit"
                                @click.prevent="handleUpdated"
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
    </div>
</template>

<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
import Multiselect from "vue-multiselect";
export default {
    components: { Multiselect, Loading },
    data() {
        return {
            loadingPage: false,
            fullPage: true,
            isLoading: false,
            editMode: true,
            flights: [],
            errors: [],
            input: {
                flightNo: "",
                ecoPrice: "",
                businessPrice: "",
                firstPrice: ""
            },
            error_flightNo: "",
            error_ecoPrice: "",
            error_businessPrice: "",
            error_firstPrice: ""
        };
    },

    beforeMount() {
        // axios.post("/api/user/reserveSendData").then(response => {
        //     // console.log(response.data);
        // });
        this.loadingPage = true;
        axios
            .get("/api/backend/getPrice")
            .then(response => {
                this.flights = response.data;
                // console.log("flight", this.flights);
                this.loadingPage = false;
            })
            .catch(error => {});
    },
    methods: {
        editPrice(flight) {
            $("#addNew").modal("show");
            this.input.flightNo = flight.flight_no;
            this.input.ecoPrice = flight.eco_price;
            this.input.businessPrice = flight.bus_price;
            this.input.firstPrice = flight.first_price;
        },
        handleUpdated(e) {
            e.preventDefault();
            this.errors = [];
            this.error_flightNo = null;
            this.error_ecoPrice = null;
            this.error_businessPrice = null;
            this.error_firstPrice = null;

            if (!this.input.flightNo) {
                this.error_flightNo = "Please fill Flight number.";
                this.errors.push(this.error_flightNo);
            } else {
                this.error_flightNo = null;
            }

            if (!this.input.ecoPrice) {
                this.error_ecoPrice = "Please fill economic class price.";
                this.errors.push(this.error_ecoPrice);
            } else if (isNaN(this.input.ecoPrice) || this.input.ecoPrice < 0) {
                this.error_ecoPrice =
                    "Please fill only number that is positive number.";
                this.errors.push(this.error_ecoPrice);
            } else {
                this.error_ecoPrice = null;
            }

            if (!this.input.businessPrice) {
                this.error_businessPrice = "Please fill business class price.";
                this.errors.push(this.error_businessPrice);
            } else if (
                isNaN(this.input.businessPrice) ||
                this.input.businessPrice < 0
            ) {
                this.error_businessPrice =
                    "Please fill only number that is positive number.";
                this.errors.push(this.error_businessPrice);
            } else {
                this.error_businessPrice = null;
            }

            if (!this.input.firstPrice) {
                this.error_firstPrice = "Please fill first class price.";
                this.errors.push(this.error_firstPrice);
            } else if (
                isNaN(this.input.firstPrice) ||
                this.input.firstPrice < 0
            ) {
                this.error_firstPrice =
                    "Please fill only number that is positive number.";
                this.errors.push(this.error_firstPrice);
            } else {
                this.error_firstPrice = null;
            }

            // console.log(this.errors);
            if (!this.errors.length) {
                this.isLoading = true;
                let data = { input: this.input };
                axios
                    .post("/api/backend/editPrice", data)
                    .then(response => {
                        swal.fire(
                            "Update Success!",
                            "Cilck the button to continue!",
                            "success"
                        ).then(() => {
                            this.isLoading = false;
                            $("#addNew").modal("hide");
                            this.$router.go({ name: "addPrice" });
                        });
                    })
                    .catch(error => {
                        swal.fire(
                            "Update Fail!",
                            "Cilck the button to continue!",
                            "error"
                        ).then(() => {
                            this.isLoading = false;
                            $("#addNew").modal("hide");
                        });
                    });
            }
        }
    }
};
</script>

<style></style>
