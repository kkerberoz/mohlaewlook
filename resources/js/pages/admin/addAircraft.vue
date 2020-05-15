<template>
    <div class="container-xl" style="padding:5%;">
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
                    <h1 class="mb-3" style="display:block ">Add aircraft</h1>
                    <hr class="mb-4" />
                    <h5 class="mb-3">Aircraft Details</h5>
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Start Date:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_date
                                        }"
                                        type="date"
                                        class="form-control"
                                        v-model="input.date"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_date }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Brand:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_brand
                                        }"
                                        @input="checkBrand"
                                        type="text"
                                        class="form-control"
                                        v-model="input.brand"
                                    />
                                    <span v-show="!seenBrand">
                                        <a
                                            style="color:#56ab2f;"
                                            class="btn btn-lg btn-block"
                                            @click="matchBrand"
                                        >
                                            Match brand
                                        </a>
                                    </span>
                                    <div class="invalid-feedback">
                                        {{ error_brand }}
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Country:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_country
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.country"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_country }}
                                    </div>
                                </span>
                                <span id="watch-example" class="col-md-4 mb-2">
                                    <label>Model:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_model
                                        }"
                                        @input="checkModel"
                                        type="text"
                                        class="form-control"
                                        v-model="input.model"
                                    />
                                    <span v-show="!seenModel">
                                        <a
                                            class="btn btn-lg btn-block "
                                            @click="matchModel"
                                        >
                                            Match model
                                        </a>
                                    </span>
                                    <div class="invalid-feedback">
                                        {{ error_model }}
                                    </div>
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Fuel Capacity:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_fuelCap
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.fuelCap"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_fuelCap }}
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Number of Engine:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_numberEng
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.numberEng"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_numberEng }}
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Type of Engine:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_typeEng
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.typeEng"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_typeEng }}
                                    </div>
                                </span>
                            </div>
                            <hr class="mb-4" />
                            <h5 class="mb-3">Seat Details</h5>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Eco Capacity:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_ecoCap
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.ecoCap"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_ecoCap }}
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Business Capacity:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_busCap
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.busCap"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_busCap }}
                                    </div>
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label>First Capacity:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_firstCap
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.firstCap"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_firstCap }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Eco Pattern:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_ecoPat
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.ecoPat"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_ecoPat }}
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Business Pattern:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_busPat
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.busPat"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_busPat }}
                                    </div>
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label>First Pattern:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_firstPat
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.firstPat"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_firstPat }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr class="mb-4" />
                    <button
                        class="btn btn-primary btn-lg btn-block btn-login"
                        @click.prevent="handleFormCilcked"
                        :disabled="isLoading"
                    >
                        <span v-show="!isLoading">Add Aircraft</span>
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
            model_query: [],
            brand_query: [],
            input: {
                date: new Date().toISOString().slice(0, 10),
                brand: "",
                model: "",
                country: "",
                fuelCap: "",
                numberEng: "",
                typeEng: "",
                ecoCap: "",
                busCap: "",
                firstCap: "",
                ecoPat: "",
                busPat: "",
                firstPat: "",

                Dup_date: "",
                Dup_brand: "",
                Dup_model: "",
                Dup_country: "",
                Dup_fuelCap: "",
                Dup_numberEng: "",
                Dup_typeEng: "",
                Dup_ecoCap: "",
                Dup_busCap: "",
                Dup_firstCap: "",
                Dup_ecoPat: "",
                Dup_busPat: "",
                Dup_firstPat: ""
            },
            seenModel: true,
            seenBrand: true,
            errors: [],
            error_date: "",
            error_brand: "",
            error_model: "",
            error_country: "",
            error_fuelCap: "",
            error_numberEng: "",
            error_typeEng: "",
            error_ecoCap: "",
            error_busCap: "",
            error_firstCap: "",
            error_ecoPat: "",
            error_busPat: "",
            error_firstPat: ""
        };
    },
    mounted() {
        this.loadingPage = true;
        axios.get("/api/backend/getModelBrand").then(response => {
            this.model_query = response.data[0];
            this.brand_query = response.data[1];
            this.loadingPage = false;
        });
    },
    methods: {
        handleFormCilcked(e) {
            e.preventDefault();
            let data = { input: this.input };

            this.errors = [];
            this.error_date = null;
            this.error_brand = null;
            this.error_model = null;
            this.error_country = null;
            this.error_fuelCap = null;
            this.error_numberEng = null;
            this.error_typeEng = null;
            this.error_ecoCap = null;
            this.error_busCap = null;
            this.error_firstCap = null;
            this.error_ecoPat = null;
            this.error_busPat = null;
            this.error_firstPat = null;

            if (!this.input.date) {
                this.error_date = "Please select start date.";
                this.errors.push(this.error_date);
            } else {
                this.error_date = null;
            }

            if (!this.input.brand.trim()) {
                this.error_brand = "Please fill the aircraft brand.";
                this.errors.push(this.error_brand);
            } else {
                this.error_brand = null;
            }

            if (!this.input.model.trim()) {
                this.error_model = "Please fill the aircraft model.";
                this.errors.push(this.error_model);
            } else {
                this.error_model = null;
            }

            if (!this.input.country.trim()) {
                this.error_country = "Please fill the country.";
                this.errors.push(this.error_country);
            } else {
                this.error_country = null;
            }

            if (!this.input.fuelCap) {
                this.error_fuelCap = "Please fill the fuel capacity.";
                this.errors.push(this.error_fuelCap);
            } else if (isNaN(this.input.fuelCap)) {
                this.error_fuelCap = "Please fill only number.";
                this.errors.push(this.error_fuelCap);
            } else {
                this.error_fuelCap = null;
            }

            if (!this.input.numberEng) {
                this.error_numberEng = "Please fill the number of engine.";
                this.errors.push(this.error_numberEng);
            } else if (isNaN(this.input.numberEng)) {
                this.error_numberEng = "Please fill only number.";
                this.errors.push(this.error_numberEng);
            } else {
                this.error_numberEng = null;
            }

            if (!this.input.typeEng.trim()) {
                this.error_typeEng = "Please fill the types of engine.";
                this.errors.push(this.error_typeEng);
            } else {
                this.error_typeEng = null;
            }

            if (!this.input.ecoCap) {
                this.error_ecoCap = "Please fill the economic class capacity.";
                this.errors.push(this.error_ecoCap);
            } else if (isNaN(this.input.ecoCap)) {
                this.error_ecoCap = "Please fill only number.";
                this.errors.push(this.error_ecoCap);
            } else {
                this.error_ecoCap = null;
            }

            if (!this.input.busCap) {
                this.error_busCap = "Please fill the bussiness class capacity.";
                this.errors.push(this.error_busCap);
            } else if (isNaN(this.input.busCap)) {
                this.error_busCap = "Please fill only number.";
                this.errors.push(this.error_busCap);
            } else {
                this.error_busCap = null;
            }

            if (!this.input.firstCap) {
                this.error_firstCap = "Please fill the first class capacity.";
                this.errors.push(this.error_firstCap);
            } else if (isNaN(this.input.firstCap)) {
                this.error_firstCap = "Please fill only number.";
                this.errors.push(this.error_firstCap);
            } else {
                this.error_firstCap = null;
            }

            if (!this.input.ecoPat.trim()) {
                this.error_ecoPat = "Please fill the economic class pattern.";
                this.errors.push(this.error_ecoPat);
            } else {
                this.error_ecoPat = null;
            }

            if (!this.input.busPat.trim()) {
                this.error_busPat = "Please fill the bussiness class pattern.";
                this.errors.push(this.error_busPat);
            } else {
                this.error_busPat = null;
            }

            if (!this.input.firstPat.trim()) {
                this.error_firstPat = "Please fill the first class pattern.";
                this.errors.push(this.error_firstPat);
            } else {
                this.error_firstPat = null;
            }

            if (!this.errors.length) {
                this.isLoading = true;
                axios
                    .post("/api/backend/addAircraft", data)
                    .then(response => {
                        // console.log(response.data);
                        swal.fire(
                            "Register Success!",
                            "Cilck the button to continue!",
                            "success"
                        ).then(() => {
                            this.isLoading = false;
                            this.$router.go({ name: "addAircraft" });
                        });
                    })
                    .catch(error => {
                        this.isLoading = false;
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
        checkModel() {
            // console.log(this.model_query);
            // console.log(this.brand_query);
            this.model_query.forEach(each_model => {
                if (this.input.model === each_model["model_name"]) {
                    this.seenModel = false;
                    // console.log("find");
                    this.input.Dup_fuelCap = each_model["fuel_capacity"];
                    this.input.Dup_numberEng = each_model["number_of_engine"];
                    this.input.Dup_typeEng = each_model["engine_type"];
                    this.input.Dup_ecoCap = each_model["eco_cap"];
                    this.input.Dup_busCap = each_model["bus_cap"];
                    this.input.Dup_firstCap = each_model["first_cap"];
                    this.input.Dup_ecoPat = each_model["eco_pattern"];
                    this.input.Dup_busPat = each_model["bus_pattern"];
                    this.input.Dup_firstPat = each_model["first_pattern"];
                } else {
                    this.seenModel = true;
                }
            });
        },
        checkBrand() {
            this.brand_query.forEach(each_brand => {
                if (this.input.brand === each_brand["brand_name"]) {
                    this.seenBrand = false;
                    // console.log("find");
                    this.input.Dup_country = each_brand["country"];
                } else {
                    this.seenBrand = true;
                }
            });
        },
        matchModel() {
            this.input.fuelCap = this.input.Dup_fuelCap;
            this.input.numberEng = this.input.Dup_numberEng;
            this.input.typeEng = this.input.Dup_typeEng;
            this.input.ecoCap = this.input.Dup_ecoCap;
            this.input.busCap = this.input.Dup_busCap;
            this.input.firstCap = this.input.Dup_firstCap;
            this.input.ecoPat = this.input.Dup_ecoPat;
            this.input.busPat = this.input.Dup_busPat;
            this.input.firstPat = this.input.Dup_firstPat;
            this.seenModel = true;
        },
        matchBrand() {
            this.input.country = this.input.Dup_country;
            this.seenBrand = true;
        }
    }
};
</script>

<style></style>
