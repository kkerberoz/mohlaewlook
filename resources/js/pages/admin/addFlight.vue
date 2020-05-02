<template>
    <div class="container-xl" style="padding:3%">
        <div class="row flex-center" style="margin-bottom:3%">
            <div
                class="col-md-10 order-md-1 justify-content-between align-items-center"
            >
                <form>
                    <h1 class="mb-3" style="display:block ">Add flight</h1>
                    <hr class="mb-4" />
                    <h5 class="mb-3">Flight Details</h5>
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Depart Location:</label>
                                    <multiselect
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
                                    <multiselect
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
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Aircraft ID:</label>
                                    <multiselect
                                        v-bind:class="{
                                            active: true
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
                                </span>
                                <span class="col-md-6 mb-2">
                                    <label>Flight Number:</label>
                                    <multiselect
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
                                        Please enter flight number
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
                            <hr class="mb-4" />
                            <h5 class="mb-3">Crew Details</h5>
                            <div class="row" disabled>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Captain:</label>
                                        <multiselect
                                            label="name"
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
                                        <div class="invalid-feedback">
                                            Please choose
                                        </div>
                                        <div
                                            class="static active"
                                            id="pilot_info"
                                        ></div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Co-pilot:</label>
                                    <multiselect
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
                                    <div class="invalid-feedback">
                                        Please choose
                                    </div>
                                    <div
                                        class="static active"
                                        id="copilot_info"
                                    ></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label
                                            >Avaliable Flight Adttendant</label
                                        >
                                        <multiselect
                                            v-model="input.crew"
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
                                            Please choose
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
                            type="text"
                            class="form-control"
                            v-model="input.flightNo"
                        />
                        <div class="invalid-feedback">
                            Please enter flight number
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
                            data-dismiss="modal"
                            @click="handleCloseModal"
                        >
                            Close
                        </button>
                        <button
                            class="btn btn-primary"
                            data-dismiss="modal"
                            @click="handleCreateModal"
                        >
                            <span>Create</span>
                        </button>
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
            modalOpen: false,
            flights: [],
            isLoading: false,
            modalInput: {
                ecoPrice: "",
                businessPrice: "",
                firstPrice: ""
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
            errors: [],
            error_ecoPrice: "",
            error_businessPrice: "",
            error_firstPrice: "",
            options_pilot: [],
            options_copilot: [],
            options_attendant: [],
            aircrafts: [],
            locations: [],
            date_check: null,
            time_check: null,
            location_check: null,
            all_check: null,
            aircraft_array_info: [],
            pilot_on_flight: [],
            crew_array_info: null
        };
    },
    methods: {
        handleShowModal() {
            if (this.modalOpen) {
                $("#addNew").modal("show");
            } else {
                this.input.flightNo = "";
                this.modalInput.ecoPrice = "";
                this.modalInput.businessPrice = "";
                this.modalInput.firstPrice = "";
                $("#addNew").modal("show");
            }
        },
        flightNo({ flight_no }) {
            return `${flight_no} `;
        },
        handleCreateModal() {
            this.modalOpen = true;
            $("#addNew").modal("hide");
        },
        handleCloseModal() {
            this.modalOpen = false;
            this.input.flightNo = "";
            this.modalInput.ecoPrice = "";
            this.modalInput.businessPrice = "";
            this.modalInput.firstPrice = "";
            $("#addNew").modal("hide");
        }
    },
    beforeMount() {
        axios.get("/api/backend/getFlightNo").then(response => {
            this.flights = response.data;
            console.log("flight", this.flights);
        });

        axios.get("/api/backend/getAirports").then(response => {
            response.data.forEach(airport => {
                this.locations.push({
                    value: airport["airport_id"],
                    name:
                        airport["airport_id"] + " - " + airport["airport_name"]
                });
            });
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
            axios.post("/api/backend/getAircraftAndCrew", {
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
                    this.options_attendant = [];
                    var pilot = this.pilot_on_flight = response.data.Pilot;
                    var attendant = response.data.Attendant;
                    this.crew_array_info = response.data.Personal_Detail;
                    // pilot
                    for(var i=0; i<pilot.length; ++i){
                        this.options_pilot.push({
                            value: pilot[i]['data']['user_id'],
                            name: "ID: " + pilot[i]['data']['user_id']
                        });
                    }
                    // co-pilot
                    for(var i=0; i<pilot.length; ++i){
                        this.options_copilot.push({
                            value: pilot[i]['data']['user_id'],
                            name: "ID: " + pilot[i]['data']['user_id']
                        });
                    }
                    for(var i=0; i<attendant.length; ++i){
                        this.options_attendant.push({
                            value: attendant[i]['data']['user_id'],
                            name: "ID: " + attendant[i]['data']['user_id']
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
        if (this.input.captain != null){
            document.getElementById("pilot_info").innerHTML =
            "<b>Name</b>: " + this.crew_array_info[this.input.captain.value]['name'] + " " + this.crew_array_info[this.input.captain.value]['surname'] + "<br>" +
            "<b>Flying experience:</b> " + this.crew_array_info[this.input.captain.value]['count'] + " Times"
            this.options_copilot = [];
            for(var i=0; i<(this.pilot_on_flight).length; ++i){
                if(this.input.captain.value != this.pilot_on_flight[i]['data']['user_id']){
                    this.options_copilot.push({
                            value: this.pilot_on_flight[i]['data']['user_id'],
                            name: "ID: " + this.pilot_on_flight[i]['data']['user_id']
                        });
                }
            }
        }
        else {
            document.getElementById("pilot_info").innerHTML = null;
            this.options_copilot = [];
            for(var i=0; i<(this.pilot_on_flight).length; ++i){
                this.options_copilot.push({
                        value: this.pilot_on_flight[i]['data']['user_id'],
                        name: "ID: " + this.pilot_on_flight[i]['data']['user_id']
                });
            }
        }
        // show information of each co-pilot
        if (this.input.coPilot != null){
            document.getElementById("copilot_info").innerHTML =
            "<b>Name</b>: " + this.crew_array_info[this.input.coPilot.value]['name'] + " " + this.crew_array_info[this.input.coPilot.value]['surname'] + "<br>" +
            "<b>Flying experience:</b> " + this.crew_array_info[this.input.coPilot.value]['count'] + " Times"
        }
        else {
            document.getElementById("copilot_info").innerHTML = null;
        }
    }
};
</script>

<style></style>
