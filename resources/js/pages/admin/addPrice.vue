<template>
    <div class="container-fluid" style="padding:3%">
        <div class="container-xl">
            <div class="row flex-center ">
                <div class="col-md-12 ">
                    <div class="card shadow-lg bg-white">
                        <div class="card-header" style="border-radius: 0px;">
                            <div class="card-title">Manage Flight Price</div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label
                                        >Flignt Number:
                                        {{ input.flightNo.flight_no }}</label
                                    >
                                    <multiselect
                                        @select="handleSelect"
                                        :custom-label="flightNo"
                                        v-model="input.flightNo"
                                        :options="flights"
                                        :searchable="true"
                                        :multiple="false"
                                        :close-on-select="true"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        placeholder="Choose"
                                        :preselect-first="false"
                                    ></multiselect>
                                    <span class="invalid-feedback">
                                        {{ error_flightNo }}
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-2">
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
                                <div class="col-md-4 mt-2">
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
                                <div class="col-md-4 mt-2">
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
                        <div class="card-footer">
                            <hr class="mb-4" />
                            <button
                                class="btn btn-primary btn-lg btn-block btn-login"
                                @click.prevent="formSubmit"
                            >
                                <span>Submit</span>
                            </button>
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
            flights: [],
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
        axios.get("/api/backend/getFlightNo").then(response => {
            this.flights = response.data;
            console.log("flight", this.flights);
        });
    },
    methods: {
        formSubmit(e) {
            e.preventDefault();
            let data = { input: this.input };
            axios.post("/api/backend/addPrice", data).then(response => {
                console.log(response.data);
                swal.fire(
                    "Update Success!",
                    "Cilck the button to continue!",
                    "success"
                ).then(() => {
                    this.$router.push({ name: "addPrice" });
                });
            });
        },
        flightNo({
            flight_no,
            depart_location,
            arrive_location,
            depart_datetime,
            arrive_datetime
        }) {
            return `[${flight_no}] - ${depart_location} to ${arrive_location}`;
        },
        // handleModal() {
        //     swal.fire(
        //         "Please success your form!",
        //         "Cilck the button to continue!",
        //         "error"
        //     );
        // },
        handleSelect(option) {
            return option;
        }
    }
};
</script>

<style></style>
