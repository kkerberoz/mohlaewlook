<template>
    <div class="container-fulid">
        <div class="row flex-center" style="margin-bottom:3%">
            <div
                class="col-md-7 order-md-1 justify-content-between align-items-center"
            >
                <form>
                    <h1 class="mb-3" style="display:block ">
                        Add flight
                    </h1>
                    <hr class="mb-4" />
                    <h5 class="mb-3">Flight Details</h5>
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <span class="col-md-6 mb-2">
                                    <label>Aircraft ID:</label>
                                    <select
                                        class="custom-select d-block w-100"
                                        v-model="input.aircraftID"
                                    >
                                        <option value>Choose</option>
                                        <option>GGF1151</option>
                                        <option>GGF1152</option>
                                        <option>GGF1153</option>
                                        <option>GGF1154</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose
                                    </div>
                                </span>
                                <span class="col-md-6 mb-2">
                                    <label>Flight Number:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.flightNo"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter flight number
                                    </div>
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Depart Location:</label>
                                    <select
                                        class="custom-select d-block w-100"
                                        v-model="input.departLocation"
                                    >
                                        <option value>Choose</option>
                                        <option>Germany.</option>
                                        <option>Germany.</option>
                                        <option>Germany.</option>
                                        <option>Germany</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Depart Date:</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        v-model="input.departDate"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Depart Time:</label>
                                    <input
                                        type="time"
                                        class="form-control"
                                        v-model="input.departTime"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Arrive Location:</label>
                                    <select
                                        class="custom-select d-block w-100"
                                        v-model="input.arriveLocation"
                                    >
                                        <option value>Choose</option>
                                        <option>Germany.</option>
                                        <option>Germany.</option>
                                        <option>Germany.</option>
                                        <option>Germany</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Arrive Date:</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        v-model="input.arriveDate"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Arrive Time:</label>
                                    <input
                                        type="time"
                                        class="form-control"
                                        v-model="input.arriveTime"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter flight number
                                    </div>
                                </span>
                            </div>
                            <hr class="mb-4" />
                            <h5 class="mb-3">Crew Details</h5>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Captain:</label>
                                        <select
                                            class="custom-select d-block w-100"
                                            v-model="input.captain"
                                        >
                                            <option value>Choose</option>
                                            <option>Germany.</option>
                                            <option>Germany.</option>
                                            <option>Germany.</option>
                                            <option>Germany</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please choose
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Co-pilot:</label>
                                        <select
                                            class="custom-select d-block w-100"
                                            v-model="input.coPilot"
                                        >
                                            <option value>Choose</option>
                                            <option>Germany.</option>
                                            <option>Germany.</option>
                                            <option>Germany.</option>
                                            <option>Germany</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please choose
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect2"
                                            >Avaliable flight adtendant</label
                                        >
                                        <select
                                            multiple
                                            class="form-control"
                                            id="exampleFormControlSelect2"
                                            v-model="input.crew"
                                        >
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr class="mb-4" />
                    <button
                        class="btn btn-primary btn-lg btn-block btn-login"
                        type="submit"
                    >
                        Add Flight
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
                aircraftID: "",
                flightNo: "",
                departLocation: "",
                departDate: "",
                departTime: "",
                arriveLocation: "",
                arriveDate: "",
                arriveTime: "",
                captain: "",
                coPilot: "",
                crew: []
            }
        };
    }
};
</script>

<style></style>
