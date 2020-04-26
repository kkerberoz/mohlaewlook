<template>
    <div class="container-fulid">
        <div class="row flex-center" style="margin-bottom:3%">
            <div
                class="col-md-7 order-md-1 justify-content-between align-items-center"
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
                                        label = "name"
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
                                        label = "name"
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
                                <span class="col-md-6 mb-2">
                                    <label>Aircraft ID:</label>
                                    <multiselect
                                        label = "name"
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
                            <hr class="mb-4" />
                            <h5 class="mb-3">Crew Details</h5>
                            <div class="row" disabled>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Captain:</label>
                                        <multiselect
                                            label = "name"
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
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Co-pilot:</label>
                                    <multiselect
                                        v-model="input.coPilot"
                                        :options="options_pilot"
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
    </div>
</template>

<script>
import Multiselect from "vue-multiselect";
export default {
    components: { Multiselect },
    data() {
        return {
            isLoading: false,
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
            options_pilot: [],
            options_attendant: [],
            aircrafts: [],
            locations: [],
            date_check: null,
            time_check: null,
            location_check: null,
            both_check: null
        };
    },
    methods: {

    },
    beforeMount() {
        axios.get("/api/backend/getAirports").then(response => {
            (response.data).forEach(airport => {
                this.locations.push({value: airport['airport_id'], name: airport['airport_id'] + " - " + airport['airport_name']});
            });
            // var count = 0;
            // (response.data.Aircraft).forEach(aircraft => {
            //     this.aircrafts.push({value: aircraft['aircraft_id'], name: aircraft['aircraft_id'] + ": " + response.data.Aircraft_Brand[count]['brand_name'] + " " + response.data.Aircraft_Model[count]['model_name']});
            //     count++;
            // });
        });
    },
    beforeUpdate(){
        // if(this.input.departDate == ""){
        //     // alert when didn't select depart date time
        // }
        // else if(this.input.departDate != this.date_check){ // query only work date
        //     this.date_check = this.input.departDate;
        //     // axios.post("/api/backend/getWorkSchedule", {date: this.input.departDate}).then(response => {
        //     //     this.options_attendant = [];
        //     //     (response.data.Attendant).forEach(attendant => {
        //     //         this.options_attendant.push({value: attendant['user_id'], name: attendant['user_id'] + ": " + attendant['name'] + " " + attendant['surname']});
        //     //     });
        //     //     this.options_pilot = [];
        //     //     (response.data.Pilot).forEach(pilot => {
        //     //         this.options_pilot.push({value: pilot['user_id'], name: pilot['user_id'] + " - " + pilot['name'] + " " + pilot['surname']});
        //     //     });
        //     // });
        // }

        // for check depart location, depart date and depart time are selected.
        if(this.input.departLocation == null || this.input.departDate == null || this.input.departTime == null) this.both_check = false;
        else if(this.input.departLocation != null && this.input.departDate != null && this.input.departTime != null) this.both_check  = true;
        // for query when all are selected.
        if(this.both_check && (this.input.departLocation != this.location_check || this.input.departDate != this.date_check || this.input.departTime != this.time_check)){
            this.location_check = this.input.departLocation; this.date_check = this.input.departDate; this.time_check = this.input.departTime;
            axios.post("/api/backend/getAircraftAndCrew", {location: this.input.departLocation['value'], date: this.input.departDate, time: this.input.departTime}).then(response=>{
                console.log(response.data);


            });
        }

    }
};
</script>

<style></style>
