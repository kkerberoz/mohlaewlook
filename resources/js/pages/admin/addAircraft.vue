<template>
    <div class="container-fulid">
        <div class="row flex-center" style="margin-bottom:3%">
            <div
                class="col-md-7 order-md-1 justify-content-between align-items-center"
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
                                        type="date"
                                        class="form-control"
                                        v-model="input.date"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Brand:</label>
                                    <input
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
                                        Please enter
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Country:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.country"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </span>
                                <span id="watch-example" class="col-md-4 mb-2">
                                    <label>Model:</label>
                                    <input
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
                                        Please enter
                                    </div>
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Fuel Capacity:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.fuelCap"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Number of Engine:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.numberEng"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Type of Engine:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.typeEng"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </span>
                            </div>
                            <hr class="mb-4" />
                            <h5 class="mb-3">Seat Details</h5>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Eco Capacity:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.ecoCap"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Business Capacity:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.busCap"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label>First Capacity:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.firstCap"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Eco Pattern:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.ecoPat"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Business Pattern:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.busPat"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </div>

                                <div class="col-md-4 mb-2">
                                    <label>First Pattern:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.firstPat"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr class="mb-4" />
                    <button
                        class="btn btn-primary btn-lg btn-block btn-login"
                        @click="handleFormCilcked()"
                    >
                        Add Aircraft
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            model_query: [],
            brand_query: [],
            input: {
                date: "",
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
            seenBrand: true
        };
    },
    mounted() {
        axios.get("/api/getModelBrand").then(response => {
            this.model_query = response.data[0];
            this.brand_query = response.data[1];
        });
    },
    methods: {
        handleFormCilcked() {
            // e.preventDefault();
            let data = { input: this.input };

            axios.post("/api/backend/addAircraft", data).then(response => {
                console.log(response.data);

                swal.fire(
                    "Register Success!",
                    "Cilck the button to continue!",
                    "success"
                );
            });
        },
        checkModel() {
            console.log(this.model_query);
            console.log(this.brand_query);
            this.model_query.forEach(each_model => {
                if (this.input.model === each_model["model_name"]) {
                    this.seenModel = false;
                    console.log("find");
                    this.input.Dup_fuelCap = each_model["fuel_capacity"];
                    this.input.Dup_numberEng = each_model["number_of_engine"];
                    this.input.Dup_typeEng = each_model["engine_type"];
                    this.input.Dup_ecoCap = each_model["eco_cap"];
                    this.input.Dup_busCap = each_model["bus_cap"];
                    this.input.Dup_firstCap = each_model["first_cap"];
                    this.input.Dup_ecoPat = each_model["eco_pattern"];
                    this.input.Dup_busPat = each_model["bus_pattern"];
                    this.input.Dup_firstPat = each_model["first_pattern"];
                } else if (!this.input.model) {
                    this.seenModel = true;
                }
            });
        },
        checkBrand() {
            this.brand_query.forEach(each_brand => {
                if (this.input.brand === each_brand["brand_name"]) {
                    this.seenBrand = false;
                    console.log("find");
                    this.input.Dup_country = each_brand["country"];
                } else if (!this.input.brand) {
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
