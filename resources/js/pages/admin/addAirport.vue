<template>
    <div
        class="container-xl"
        style="margin-bottom:15%;margin-top:5%;padding:3%"
    >
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            :opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <div class="row flex-center">
            <div
                class="col-md-10 order-md-1 justify-content-between align-items-center"
            >
                <form>
                    <h1 class="mb-3" style="display:block ">Add Airport</h1>
                    <hr class="mb-4" />
                    <h5 class="mb-3">Airport Details</h5>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label>Airport ID:</label>
                                <input
                                    @input="userInput_id"
                                    v-bind:class="{
                                        'is-invalid': error_airportID
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="input.airportID"
                                />
                                <div class="invalid-feedback">
                                    {{ error_airportID }}
                                </div>
                            </div>
                            <div class="col-md-8 mb-2">
                                <label>Airport Name:</label>
                                <input
                                    @input="userInput_name"
                                    v-bind:class="{
                                        'is-invalid': error_airportName
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="input.airportName"
                                />
                                <div class="invalid-feedback">
                                    {{ error_airportName }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <span class="col-md-5 mb-2">
                                <label>Airport Capacity:</label>
                                <input
                                    @input="userInput_cap"
                                    v-bind:class="{
                                        'is-invalid': error_airportCap
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="input.airportCap"
                                />
                                <div class="invalid-feedback">
                                    {{ error_airportCap }}
                                </div>
                            </span>
                            <span class="col-md-7 mb-2">
                                <label>Airport Region:</label>
                                <input
                                    @input="userInput_region"
                                    v-bind:class="{
                                        'is-invalid': error_airportRegion
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="input.airportRegion"
                                />
                                <div class="invalid-feedback">
                                    {{ error_airportRegion }}
                                </div>
                            </span>
                        </div>
                        <div class="row">
                            <span class="col-md-12 mb-2">
                                <label>Airport Address:</label>
                                <input
                                    @input="userInput_address"
                                    v-bind:class="{
                                        'is-invalid': error_airportAddress
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="input.airportAddress"
                                />
                                <div class="invalid-feedback">
                                    {{ error_airportAddress }}
                                </div>
                            </span>
                        </div>
                    </div>

                    <hr class="mb-4" />
                    <button
                        class="btn btn-primary btn-lg btn-block btn-login"
                        @click.prevent="formSubmit"
                        :disabled="isLoading"
                    >
                        <span v-show="!isLoading"> Add Airport</span>
                        <i
                            class="fas fa-spinner fa-pulse"
                            v-show="isLoading"
                        ></i>
                    </button>
                </form>
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
            isLoading: false,
            input: {
                airportID: "",
                airportName: "",
                airportCap: "",
                airportAddress: "",
                airportRegion: ""
            },
            error_airportID: "",
            error_airportName: "",
            error_airportCap: "",
            error_airportAddress: "",
            error_airportRegion: "",
            errors: []
        };
    },
    // beforeMount() {
    //     this.loadingPage = true;
    //     setTimeout(() => {
    //         this.loadingPage = false;
    //     }, 1000);
    // },
    methods: {
        userInput_id() {
            if (this.error_airportID != null) {
                this.error_airportID = null;
            } else if (!this.input.airportID) {
                this.error_airportID = "Please fill your Airport ID.";
                this.errors.push(this.error_airportID);
            }
        },
        userInput_name() {
            if (this.error_airportName != null) {
                this.error_airportName = null;
            } else if (!this.input.airportName) {
                this.error_airportName = "Please fill your Airport Name.";
                this.errors.push(this.error_airportName);
            }
        },
        userInput_cap() {
            if (this.error_airportCap != null) {
                this.error_airportCap = null;
            } else if (!this.input.airportCap) {
                this.error_airportCap = "Please fill your Airport Capacity.";
                this.errors.push(this.error_airportCap);
            }
        },
        userInput_address() {
            if (this.error_airportAddress != null) {
                this.error_airportAddress = null;
            } else if (!this.input.airportAddress) {
                this.error_airportAddress = "Please fill your Airport Address.";
                this.errors.push(this.error_airportAddress);
            }
        },
        userInput_region() {
            if (this.error_airportRegion != null) {
                this.error_airportRegion = null;
            } else if (!this.input.airportRegion) {
                this.error_airportRegion = "Please fill your Airport Region.";
                this.errors.push(this.error_airportRegion);
            }
        },
        formSubmit(e) {
            e.preventDefault();
            this.errors = [];
            this.error_airportID = null;
            this.error_airportName = null;
            this.error_airportCap = null;
            this.error_airportAddress = null;
            this.error_airportRegion = null;

            let data = {
                airportID: this.input.airportID,
                airportName: this.input.airportName,
                airportCap: this.input.airportCap,
                airportAddress: this.input.airportAddress,
                airportRegion: this.input.airportRegion
            };
            this.isLoading = true;
            if (!this.input.airportID) {
                this.error_airportID = "Please fill your Airport ID.";
                this.errors.push(this.error_airportID);
            } else if (this.input.airportID.length != 3) {
                this.error_airportID = "Airport ID must be 3 characters.";
                this.errors.push(this.error_airportID);
            } else if (
                !this.input.airportID == this.input.airportID.toUpperCase()
            ) {
                this.error_airportID = "Airport ID must be upper case.";
                this.errors.push(this.error_airportID);
            } else {
                this.error_airportID = null;
            }

            if (!this.input.airportName) {
                this.error_airportName = "Please fill your Airport Name.";
                this.errors.push(this.error_airportName);
            } else {
                this.error_airportName = null;
            }

            if (!this.input.airportCap) {
                this.error_airportCap = "Please fill you airport Capacity.";
                this.errors.push(this.error_airportCap);
            } else if (isNaN(this.input.airportCap)) {
                this.error_airportCap = "Please fill only number.";
                this.errors.push(this.error_airportCap);
            } else {
                this.error_airportCap = null;
            }

            if (!this.input.airportAddress.trim()) {
                this.error_airportAddress = "Please fill your Airport Address.";
                this.errors.push(this.error_airportAddress);
            } else {
                this.error_airportAddress = null;
            }

            if (!this.input.airportRegion) {
                this.error_airportRegion = "Please fill your Airport Region.";
                this.errors.push(this.error_airportRegion);
            } else {
                this.error_airportRegion = null;
            }
            if (!this.errors.length) {
                axios
                    .post("/api/backend/addAirport", data)
                    .then(response => {
                        swal.fire(
                            "Add Data Success!",
                            "Cilck the button to continue!",
                            "success"
                        ).then(() => {
                            this.isLoading = false;
                            this.$router.go({ name: "addAirport" });
                        });
                    })
                    .catch(error => {
                        this.isLoading = false;
                        if (error.response.status === 408) {
                            swal.fire(
                                "This Airport ID is already exist",
                                "Cilck the button to continue!",
                                "error"
                            ).then(() => {
                                this.errors = [];
                                this.input.airportID = "";
                            });
                        }
                        if (error.response.status === 409) {
                            swal.fire(
                                "This Airport name is already exist",
                                "Cilck the button to continue!",
                                "error"
                            ).then(() => {
                                this.errors = [];
                                this.input.airportName = "";
                            });
                        }
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

<style></style>
