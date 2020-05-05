<template>
    <div class="container-xl" style="padding:3%">
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            :opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <div class="row flex-center" style="margin-bottom:3%">
            <div
                class="col-md-10 order-md-1 justify-content-between align-items-center"
            >
                <form>
                    <h1 class="mb-3" style="display:block ">Add Route</h1>
                    <hr class="mb-4" />
                    <h5 class="mb-3">Flight Details</h5>
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Depart Location:</label>
                                    <multiselect
                                        v-bind:class="{
                                            'is-invalid': error_departLocation
                                        }"
                                        label="name"
                                        v-model="input.departLocation"
                                        :options="locations"
                                        :searchable="true"
                                        :multiple="false"
                                        :show-labels="false"
                                        :close-on-select="true"
                                        :clear-on-select="false"
                                        placeholder="Choose"
                                        :preselect-first="false"
                                    ></multiselect>
                                    <div class="invalid-feedback">
                                        {{ error_departLocation }}
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Depart Date:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_departDate
                                        }"
                                        type="date"
                                        class="form-control"
                                        v-model="input.departDate"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_departDate }}
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Depart Time:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_departTime
                                        }"
                                        type="time"
                                        class="form-control"
                                        v-model="input.departTime"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_departTime }}
                                    </div>
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Arrive Location:</label>
                                    <multiselect
                                        v-bind:class="{
                                            'is-invalid': error_arriveLocation
                                        }"
                                        label="name"
                                        v-model="input.arriveLocation"
                                        :options="locations"
                                        :searchable="true"
                                        :multiple="false"
                                        :show-labels="false"
                                        :close-on-select="true"
                                        :clear-on-select="false"
                                        placeholder="Choose"
                                        :preselect-first="false"
                                    ></multiselect>
                                    <div class="invalid-feedback">
                                        {{ error_arriveLocation }}
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Arrive Date:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_arriveDate
                                        }"
                                        type="date"
                                        class="form-control"
                                        v-model="input.arriveDate"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_arriveDate }}
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Arrive Time:</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_arriveTime
                                        }"
                                        type="time"
                                        class="form-control"
                                        v-model="input.arriveTime"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_arriveTime }}
                                    </div>
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Aircraft ID:</label>
                                    <multiselect
                                        v-bind:class="{
                                            'is-invalid': error_aircraftID
                                        }"
                                        label="name"
                                        v-model="input.aircraftID"
                                        :options="aircrafts"
                                        :searchable="true"
                                        :multiple="false"
                                        :show-labels="false"
                                        :close-on-select="true"
                                        :clear-on-select="false"
                                        placeholder="Choose"
                                        :preselect-first="false"
                                    ></multiselect>
                                    <div
                                        class="static active"
                                        id="aircraft_info"
                                    ></div>
                                    <div class="invalid-feedback">
                                        {{ error_aircraftID }}
                                    </div>
                                </span>
                                <span class="col-md-6 mb-2">
                                    <label>Flight Number:</label>
                                    <multiselect
                                        v-bind:class="{
                                            'is-invalid': error_flightNo
                                        }"
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
                                    <div class="invalid-feedback">
                                        {{ error_flightNo }}
                                    </div>
                                </span>
                                <span class="col-md-2 mb-2">
                                    <label>Other Flight:</label>
                                    <div
                                        @click="handleShowModal"
                                        class="btn btn-info btn-block"
                                        style="color:#fff"
                                    >
                                        NewFlight
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter flight number
                                    </div>
                                </span>
                            </div>
                            <div v-show="all_check">
                                <hr class="mb-4" />
                                <h5 class="mb-3">Crew Details</h5>
                                <div class="row" disabled>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label>Captain:</label>
                                            <multiselect
                                                v-bind:class="{
                                                    'is-invalid': error_captain
                                                }"
                                                label="name"
                                                @select="showCo"
                                                v-model="input.captain"
                                                :options="options_pilot"
                                                :searchable="true"
                                                :multiple="false"
                                                :close-on-select="true"
                                                :clear-on-select="false"
                                                :preserve-search="true"
                                                placeholder="Choose"
                                                track-by="name"
                                                :preselect-first="false"
                                            ></multiselect>
                                            <div
                                                class="static active"
                                                id="pilot_info"
                                            ></div>
                                            <div class="invalid-feedback">
                                                {{ error_captain }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>Co-pilot:</label>
                                        <multiselect
                                            v-bind:class="{
                                                'is-invalid': error_coPilot
                                            }"
                                            :disabled="waitPilot"
                                            v-model="input.coPilot"
                                            :options="options_copilot"
                                            :searchable="true"
                                            :multiple="false"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            :preserve-search="true"
                                            placeholder="Choose"
                                            label="name"
                                            :preselect-first="false"
                                        ></multiselect>
                                        <div
                                            class="static active"
                                            id="copilot_info"
                                        ></div>
                                        <div class="invalid-feedback">
                                            {{ error_coPilot }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label
                                                >Avaliable Flight
                                                Adttendant</label
                                            >
                                            <multiselect
                                                v-bind:class="{
                                                    'is-invalid': error_crew
                                                }"
                                                v-model="input.crew"
                                                :disabled="waitPilot"
                                                :options="options_attendant"
                                                :searchable="true"
                                                :multiple="true"
                                                :close-on-select="false"
                                                :clear-on-select="false"
                                                :preserve-search="true"
                                                placeholder="Choose"
                                                label="name"
                                                track-by="name"
                                                :preselect-first="false"
                                                :max="6"
                                            >
                                                <template
                                                    slot="selection"
                                                    slot-scope="{
                                                        values,
                                                        search,
                                                        isOpen
                                                    }"
                                                >
                                                    <span
                                                        class="multiselect__single"
                                                        v-if="values.length &amp;&amp; !isOpen"
                                                    >
                                                        {{ values.length }} crew
                                                        selected
                                                    </span>
                                                </template>
                                            </multiselect>

                                            <div class="invalid-feedback">
                                                {{ error_crew }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr class="mb-4" />
                    <button
                        class="btn btn-primary btn-lg btn-block btn-login"
                        type="submit"
                        @click.prevent="formSubmit"
                        :disabled="isLoading"
                    >
                        <span v-show="!isLoading"> Add Flight</span>
                        <i
                            class="fas fa-spinner fa-pulse"
                            v-show="isLoading"
                        ></i>
                    </button>
                </form>
            </div>
        </div>
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
                        <h5 class="modal-title" id="addNewLabel">
                            New Flight
                        </h5>
                    </div>
                    <span class="col-md-12 mt-2 mb-2">
                        <label>Flight Number:</label>
                        <input
                            v-bind:class="{
                                'is-invalid': error_newFlightNo
                            }"
                            type="text"
                            class="form-control"
                            v-model="input.flightNo"
                        />
                        <div class="invalid-feedback">
                            {{ error_newFlightNo }}
                        </div>
                    </span>
                    <div class="col-md-12 mt-2 mb-2">
                        <label>Economy Class Price:</label>
                        <div class="input-group">
                            <input
                                v-bind:class="{
                                    'is-invalid': error_ecoPrice
                                }"
                                required
                                type="text"
                                class="form-control"
                                v-model="modalInput.ecoPrice"
                            />
                            <span class="invalid-feedback">
                                {{ error_ecoPrice }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2 mb-2">
                        <label>Business Class Price:</label>
                        <div class="input-group">
                            <input
                                v-bind:class="{
                                    'is-invalid': error_businessPrice
                                }"
                                required
                                type="text"
                                class="form-control"
                                v-model="modalInput.businessPrice"
                            />
                            <span class="invalid-feedback">
                                {{ error_businessPrice }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2 mb-2">
                        <label>First Class Price:</label>
                        <div class="input-group">
                            <input
                                v-bind:class="{
                                    'is-invalid': error_firstPrice
                                }"
                                required
                                type="text"
                                class="form-control"
                                v-model="modalInput.firstPrice"
                            />
                            <span class="invalid-feedback">
                                {{ error_firstPrice }}
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            datadismiss="modal"
                            @click="handleCloseModal"
                        >
                            Close
                        </button>
                        <button
                            class="btn btn-primary"
                            @click.prevent="handleNewFlight"
                        >
                            <span v-show="!isLoading">Create</span>
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
            waitPilot: true,
            modalOpen: false,
            flights: [],
            isLoading: false,
            modalInput: {
                ecoPrice: null,
                businessPrice: null,
                firstPrice: null
            },
            input: {
                aircraftID: null,
                flightNo: null,
                departLocation: null,
                departDate: null,
                departTime: null,
                arriveLocation: null,
                arriveDate: null,
                arriveTime: null,
                captain: null,
                coPilot: null,
                crew: []
            },
            errors_newFlight: null,
            error_newFlightNo: null,
            error_ecoPrice: null,
            error_businessPrice: null,
            error_firstPrice: null,
            options_pilot: [],
            options_copilot: [],
            options_attendant: [],
            aircrafts: [],
            locations: [],
            date_check: null,
            time_check: null,
            location_check: null,
            all_check: false,
            aircraft_array_info: [],
            pilot_on_flight: [],
            crew_array_info: null,
            caption_check: null,
            // error input
            errors_input: null,
            error_departLocation: null,
            error_departDate: null,
            error_departTime: null,
            error_arriveLocation: null,
            error_arriveDate: null,
            error_arriveTime: null,
            error_aircraftID: null,
            error_flightNo: null,
            error_captain: null,
            error_coPilot: null,
            error_crew: null
        };
    },
    methods: {
        showCo() {
            this.waitPilot = false;
        },
        handleShowModal() {
            if (this.modalOpen) {
                $("#addNew").modal("show");
            } else {
                this.input.flightNo = null;
                this.modalInput.ecoPrice = null;
                this.modalInput.businessPrice = null;
                this.modalInput.firstPrice = null;
                $("#addNew").modal("show");
            }
        },
        flightNo({ flight_no }) {
            return `${flight_no} `;
        },
        handleCloseModal() {
            this.modalOpen = false;
            this.input.flightNo = null;
            this.modalInput.ecoPrice = null;
            this.modalInput.businessPrice = null;
            this.modalInput.firstPrice = null;
            this.error_newFlightNo = this.error_ecoPrice = this.error_businessPrice = this.error_firstPrice = null;
            $("#addNew").modal("hide");
        },
        handleNewFlight(e) {
            e.preventDefault();
            this.modalOpen = true;
            this.isLoading = true;
            let data = {
                flight_no: this.input.flightNo,
                input: this.modalInput
            };
            this.errors_newFlight = true;
            this.error_newFlightNo = !this.input.flightNo
                ? "Please fill flight number"
                : null;
            this.error_ecoPrice = !this.modalInput.ecoPrice
                ? "Please fill economy class price"
                : null;
            this.error_businessPrice = !this.modalInput.businessPrice
                ? "Please fill business class price"
                : null;
            this.error_firstPrice = !this.modalInput.firstPrice
                ? "Please fill first class price"
                : null;
            //**/
            this.error_ecoPrice =
                !this.error_ecoPrice && isNaN(this.modalInput.ecoPrice)
                    ? "economy class price must be number"
                    : this.error_ecoPrice;
            this.error_businessPrice =
                !this.error_businessPrice &&
                isNaN(this.modalInput.businessPrice)
                    ? "business class price must be number"
                    : this.error_businessPrice;
            this.error_firstPrice =
                !this.error_firstPrice && isNaN(this.modalInput.firstPrice)
                    ? "first class price must be number"
                    : this.error_firstPrice;
            //**/
            this.error_ecoPrice =
                !this.error_ecoPrice && this.modalInput.ecoPrice < 0
                    ? "economy class price must be not less than 0"
                    : this.error_ecoPrice;
            this.error_businessPrice =
                !this.error_businessPrice && this.modalInput.businessPrice < 0
                    ? "business class price must be not less than 0"
                    : this.error_businessPrice;
            this.error_firstPrice =
                !this.error_firstPrice && this.modalInput.firstPrice < 0
                    ? "first class price must be not less than 0"
                    : this.error_firstPrice;
            this.errors_newFlight =
                !this.errors_newFlight ||
                this.error_newFlightNo ||
                this.error_ecoPrice ||
                this.error_businessPrice ||
                this.error_firstPrice
                    ? false
                    : true;
            if (this.errors_newFlight) {
                axios.post("/api/backend/addPrice", data).then(response => {
                    swal.fire(
                        "Create Success!",
                        "Cilck the button to continue!",
                        "success"
                    ).then(() => {
                        this.isLoading = false;
                        $("#addNew").modal("hide");
                        // this.$router.go({ name: "addFlight" });
                    });
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
        formSubmit(e) {
            e.preventDefault();
            this.errors_input = true;
            // condition for input
            this.error_departLocation = !this.input.departLocation
                ? "Please select the depart location."
                : null;
            this.error_departDate = !this.input.departDate
                ? "Please fill the depart date."
                : null;
            this.error_departTime = !this.input.departTime
                ? "Please fill the depart time."
                : null;
            /**/ this.errors_input =
                !this.errors_input ||
                this.error_departLocation ||
                this.error_departDate ||
                this.error_departTime
                    ? false
                    : true;
            this.error_arriveLocation = !this.input.arriveLocation
                ? "Please select the arrive location."
                : null;
            this.error_arriveDate = !this.input.arriveDate
                ? "Please fill the arrive date."
                : null;
            this.error_arriveTime = !this.input.arriveTime
                ? "Please fill the arrive time."
                : null;
            /**/ this.errors_input =
                !this.errors_input ||
                this.error_arriveLocation ||
                this.error_arriveDate ||
                this.error_arriveTime
                    ? false
                    : true;
            this.error_aircraftID = !this.input.aircraftID
                ? "Please select aircraft ID"
                : null;
            this.error_flightNo = !this.input.flightNo
                ? "Please select flight number"
                : null;
            /**/ this.errors_input =
                !this.errors_input ||
                this.error_aircraftID ||
                this.error_flightNo
                    ? false
                    : true;
            this.error_captain = !this.input.captain
                ? "Please select captain"
                : null;
            this.error_coPilot = !this.input.coPilot
                ? "Please select co-pilot"
                : null;
            this.error_crew = !this.input.crew.length
                ? "Please select flight attendant"
                : null;
            /**/ this.errors_input =
                !this.errors_input ||
                this.error_captain ||
                this.error_coPilot ||
                this.error_crew
                    ? false
                    : true;
            // another condition
            this.error_arriveLocation =
                !this.error_arriveLocation &&
                !this.error_departLocation &&
                this.input.arriveLocation.value ==
                    this.input.departLocation.value
                    ? "The arrive location must be different form the depart location"
                    : this.error_arriveLocation;
            this.error_arriveDate =
                !this.error_arriveDate &&
                !this.error_departDate &&
                this.input.arriveDate < this.input.departDate
                    ? "The arrive date must be not less than the depart date"
                    : this.error_arriveDate;
            this.error_arriveTime =
                !this.error_arriveDate &&
                !this.error_departDate &&
                !this.error_arriveTime &&
                !this.error_departTime &&
                this.input.arriveDate == this.input.departDate &&
                this.input.arriveTime <= this.input.departTime
                    ? "On the same day, The arrive time must be more than the depart time"
                    : this.error_arriveTime;
            /**/ this.errors_input =
                !this.errors_input ||
                this.error_arriveLocation ||
                this.error_arriveDate ||
                this.error_arriveTime
                    ? false
                    : true;
            if (this.errors_input) {
                axios
                    .post("/api/backend/addFlight", this.input)
                    .then(response => {
                        console.log(response.data);
                        swal.fire(
                            "Register Success!",
                            "Cilck the button to continue!",
                            "success"
                        ).then(() => {
                            this.$router.go({ name: "addFlight" });
                        });
                    });
            } else {
                swal.fire(
                    "Please success your form!",
                    "Cilck the button to continue!",
                    "error"
                );
            }
        }
    },
    beforeMount() {
        this.loadingPage = true;
        axios.get("/api/backend/getAirports").then(response => {
            response.data.forEach(airport => {
                this.locations.push({
                    value: airport["airport_id"],
                    name:
                        airport["airport_id"] + " - " + airport["airport_name"]
                });
            });
            this.loadingPage = false;
        });
        axios.get("/api/backend/getFlightNo").then(response => {
            this.flights = response.data;
        });
    },
    beforeUpdate() {
        // for check depart location, depart date and depart time are selected.
        if (
            this.input.departLocation == null ||
            this.input.departDate == null ||
            this.input.departTime == null
        ) {
            this.aircrafts = [];
            this.options_pilot = [];
            this.options_attendant = [];
            this.location_check = this.input.departLocation;
            this.all_check = false;
        } else if (
            this.input.departLocation != null &&
            this.input.departDate != null &&
            this.input.departTime != null
        )
            this.all_check = true;
        // for query when all are selected.
        if (
            this.all_check &&
            (this.input.departLocation != this.location_check ||
                this.input.departDate != this.date_check ||
                this.input.departTime != this.time_check)
        ) {
            this.location_check = this.input.departLocation;
            this.date_check = this.input.departDate;
            this.time_check = this.input.departTime;
            axios
                .post("/api/backend/getAircraftAndCrew", {
                    location: this.input.departLocation.value,
                    date: this.input.departDate,
                    time: this.input.departTime
                })
                .then(response => {
                    console.log(response.data);

                    // show aircraft
                    var aircraft = response.data.Aircraft;
                    var aircraft_brand = response.data.Aircraft_Brand;
                    var aircraft_model = response.data.Aircraft_Model;
                    var flight_info = response.data.Flight_Info;
                    var flight_time = response.data.Flight_Time;
                    var other_aircraft = response.data.Other_Aircraft;
                    var other_brand = response.data.Other_Brand;
                    var other_model = response.data.Other_Model;
                    this.input.aircraftID = null; // clear aircraft id
                    document.getElementById("aircraft_info").innerHTML = null;
                    this.aircrafts = [];

                    for (var i = 0; i < aircraft.length; ++i) {
                        this.aircrafts.push({
                            value: aircraft[i]["aircraft_id"],
                            name:
                                "ID: " +
                                aircraft[i]["aircraft_id"] +
                                " - " +
                                aircraft_brand[i]["brand_name"] +
                                " " +
                                aircraft_model[i]["model_name"]
                        });
                        this.aircraft_array_info[aircraft[i]["aircraft_id"]] =
                            "<b>Number of Flight Times:</b> " +
                            flight_time[i] +
                            " Times <br>" +
                            "<b>Last Flight</b>: " +
                            flight_info[i]["flight_no"] +
                            "<b> from</b> " +
                            flight_info[i]["depart_location"] +
                            "  <b>to</b>  " +
                            flight_info[i]["arrive_location"] +
                            "<br>" +
                            "<b>When:</b> " +
                            flight_info[i]["depart_datetime"] +
                            "<b> To:</b>  " +
                            flight_info[i]["arrive_datetime"];
                    }
                    for (var i = 0; i < other_aircraft.length; ++i) {
                        this.aircrafts.push({
                            value: other_aircraft[i]["aircraft_id"],
                            name:
                                "ID: " +
                                other_aircraft[i]["aircraft_id"] +
                                " - " +
                                other_brand[i]["brand_name"] +
                                " " +
                                other_model[i]["model_name"]
                        });
                        this.aircraft_array_info[
                            other_aircraft[i]["aircraft_id"]
                        ] = "Never Used to Flight";
                    }
                    this.options_pilot = [];
                    this.input.captain = null;
                    document.getElementById("pilot_info").innerHTML = null;
                    this.options_attendant = [];
                    this.input.coPilot = null;
                    document.getElementById("copilot_info").innerHTML = null;
                    var pilot = (this.pilot_on_flight = response.data.Pilot);
                    var attendant = response.data.Attendant;
                    this.input.crew = [];
                    this.crew_array_info = response.data.Personal_Detail;
                    // pilot
                    for (var i = 0; i < pilot.length; ++i) {
                        this.options_pilot.push({
                            value: pilot[i]["data"]["user_id"],
                            name: "ID: " + pilot[i]["data"]["user_id"],
                            work_id: pilot[i]["data"]["work_id"],
                            type: pilot[i]["type"]
                        });
                    }
                    // co-pilot
                    for (var i = 0; i < pilot.length; ++i) {
                        this.options_copilot.push({
                            value: pilot[i]["data"]["user_id"],
                            name: "ID: " + pilot[i]["data"]["user_id"],
                            work_id: pilot[i]["data"]["work_id"],
                            type: pilot[i]["type"]
                        });
                    }
                    // attendant
                    for (var i = 0; i < attendant.length; ++i) {
                        this.options_attendant.push({
                            value: attendant[i]["data"]["user_id"],
                            name:
                                "ID: " +
                                attendant[i]["data"]["user_id"] +
                                ", " +
                                "Name: " +
                                this.crew_array_info[
                                    attendant[i]["data"]["user_id"]
                                ]["name"] +
                                " " +
                                this.crew_array_info[
                                    attendant[i]["data"]["user_id"]
                                ]["surname"],
                            work_id: attendant[i]["data"]["work_id"],
                            type: attendant[i]["type"]
                        });
                    }
                });
        }
        // show information of each aircraft
        if (this.input.aircraftID != null)
            document.getElementById(
                "aircraft_info"
            ).innerHTML = this.aircraft_array_info[this.input.aircraftID.value];
        else document.getElementById("aircraft_info").innerHTML = null;
        // show information of each pilot
        if (this.input.captain != this.caption_check) {
            this.caption_check = this.input.captain;
            console.log(this.input.captain);

            if (this.input.captain) {
                document.getElementById("pilot_info").innerHTML =
                    "<b>Name</b>: " +
                    this.crew_array_info[this.input.captain.value]["name"] +
                    " " +
                    this.crew_array_info[this.input.captain.value]["surname"] +
                    "<br>" +
                    "<b>Flying experience:</b> " +
                    this.crew_array_info[this.input.captain.value]["count"] +
                    " Times";
                this.options_copilot = [];
                document.getElementById("copilot_info").innerHTML = null;
                this.input.coPilot = null;
                for (var i = 0; i < this.pilot_on_flight.length; ++i) {
                    if (
                        this.input.captain.value !=
                        this.pilot_on_flight[i]["data"]["user_id"]
                    ) {
                        this.options_copilot.push({
                            value: this.pilot_on_flight[i]["data"]["user_id"],
                            name:
                                "ID: " +
                                this.pilot_on_flight[i]["data"]["user_id"],
                            work_id: this.pilot_on_flight[i]["data"]["work_id"],
                            type: this.pilot_on_flight[i]["type"]
                        });
                    }
                }
            } else {
                document.getElementById("pilot_info").innerHTML = null;
                document.getElementById("copilot_info").innerHTML = null;
                this.input.coPilot = null;
                this.waitPilot = true;
            }
        }
        // show information of each co-pilot
        if (this.input.coPilot != null) {
            document.getElementById("copilot_info").innerHTML =
                "<b>Name</b>: " +
                this.crew_array_info[this.input.coPilot.value]["name"] +
                " " +
                this.crew_array_info[this.input.coPilot.value]["surname"] +
                "<br>" +
                "<b>Flying experience:</b> " +
                this.crew_array_info[this.input.coPilot.value]["count"] +
                " Times";
        } else {
            document.getElementById("copilot_info").innerHTML = null;
        }
    }
};
</script>

<style></style>
