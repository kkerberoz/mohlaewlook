<template>
    <div class="container-fulid">
        <div class="row flex-center" style="margin-bottom:3%">
            <div
                class="col-md-7 order-md-1 justify-content-between align-items-center"
            >
                <form>
                    <h1 class="mb-3" style="display:block ">
                        Add aircraft
                    </h1>
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
                                <span class="col-md-6 mb-2">
                                    <label>Brand:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.brand"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </span>
                                <span class="col-md-6 mb-2">
                                    <label>Model:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.model"
                                    />
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
            input: {
                date: "",
                brand: "",
                model: "",
                fuelCap: "",
                numberEng: "",
                typeEng: "",
                ecoCap: "",
                busCap: "",
                firstCap: "",
                ecoPat: "",
                busPat: "",
                firstCap: ""
            }
        };
    },
    methods: {
        handleFormCilcked() {
            console.log("Hello World");
        }
    }
};
</script>

<style></style>
