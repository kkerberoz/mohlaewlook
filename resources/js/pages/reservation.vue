<template>
    <div class="container-fluid " style="padding-top:5%;padding-bottom:10%;">
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            :opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <div class="container-xl" style="margin-top:5%;padding-bottom:5%;">
            <div class="row flex-center">
                <div class="col-md-12">
                    <div class="card shadow-lg bg-white" id="card-reservation">
                        <div class="card-header" id="card-reservation">
                            Reservation
                        </div>
                        <div
                            class="card-body"
                            id="card-reservation"
                            v-show="changePage"
                        >
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div
                                    class="col-md-3"
                                    style="margin-top:15px;padding:30px;margin-right:20x;"
                                >
                                    <label class="container-ratio">
                                        One Way
                                        <input
                                            type="radio"
                                            name="radio"
                                            @click="showOneway"
                                        />
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div
                                    class="col-md-2"
                                    style="margin-top:15px;padding:30px;margin-right:20x;"
                                >
                                    <label class="container-ratio">
                                        Return
                                        <input
                                            type="radio"
                                            name="radio"
                                            @click="showReturn"
                                        />
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Number of Passenger :</label>

                                        <div>
                                            &nbsp; &nbsp; &nbsp;
                                            <button
                                                class=" btn fas fa-minus-circle"
                                                style="color:#ED4337;"
                                                @click="removePass(counter)"
                                            ></button>
                                            {{ passengers.length }}
                                            <button
                                                class="btn fas fa-plus-circle"
                                                style="color:#4BB543;"
                                                @click="addPass(counter)"
                                            ></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Class :</label>
                                        <multiselect
                                            v-model="input.class"
                                            :options="allClass"
                                            :show-labels="false"
                                            :searchable="true"
                                            :multiple="false"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            placeholder="Choose Class"
                                        ></multiselect>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <div class="row flex-center" v-show="back">
                                <div class="col-md-4 mb-4">
                                    <label>
                                        From :
                                        {{ this.calendar_from.selectedDate }}
                                    </label>
                                    <functional-calendar
                                        v-on:choseDay="clickDay"
                                        class="calendar"
                                        v-model="calendar_from"
                                        :configs="calendarConfigs"
                                    ></functional-calendar>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label>
                                        To :
                                        {{ this.calendar_to.selectedDate }}
                                    </label>
                                    <functional-calendar
                                        v-on:choseDay="clickDay"
                                        class="calendar"
                                        v-model="calendar_to"
                                        :configs="calendarConfigs"
                                    ></functional-calendar>
                                </div>
                            </div>
                            <div class="row flex-center" v-show="oneway">
                                <div class="col-md-4 mb-4">
                                    <label>
                                        Date :
                                        {{ this.calendar_from.selectedDate }}
                                    </label>
                                    <functional-calendar
                                        v-on:choseDay="clickDay"
                                        class="calendar"
                                        v-model="calendar_from"
                                        :configs="calendarConfigs"
                                    ></functional-calendar>
                                </div>
                            </div>
                            <hr class="mb-4" />
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label> Depart Flight No :</label>
                                        <span class="input-text">
                                            <br />From :
                                        </span>
                                        <multiselect
                                            v-model="input.flightFrom"
                                            :options="allClass"
                                            :show-labels="false"
                                            :searchable="true"
                                            :multiple="false"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            placeholder="Choose Flight"
                                        ></multiselect>
                                        <div class="invalid-feedback">
                                            {{ error_flightFrom }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀</label>
                                        <span class="input-text">
                                            <br />To :
                                        </span>
                                        <multiselect
                                            v-model="input.flightTo"
                                            :options="allClass"
                                            :show-labels="false"
                                            :searchable="true"
                                            :multiple="false"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            placeholder="Choose Class"
                                        ></multiselect>
                                        <div class="invalid-feedback">
                                            {{ error_flightTo }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <br />
                            <div class="row" v-show="back">
                                <div class="col-md-1"></div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label> Return Flight No :</label>
                                        <span class="input-text">
                                            <br />From :
                                        </span>
                                        <multiselect
                                            v-model="input.flightFrom"
                                            :options="allClass"
                                            :show-labels="false"
                                            :searchable="true"
                                            :multiple="false"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            placeholder="Choose Flight"
                                        ></multiselect>
                                        <div class="invalid-feedback">
                                            {{ error_flightFrom }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀</label>
                                        <span class="input-text">
                                            <br />To :
                                        </span>
                                        <multiselect
                                            v-model="input.flightTo"
                                            :options="allClass"
                                            :show-labels="false"
                                            :searchable="true"
                                            :multiple="false"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            placeholder="Choose Class"
                                        ></multiselect>
                                        <div class="invalid-feedback">
                                            {{ error_flightTo }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                            <hr class="mb-4" />
                        </div>

                        <!-- page 2 --><!-- page 2 --><!-- page 2 --><!-- page 2 --><!-- page 2 --><!-- page 2 --><!-- page 2 --><!-- page 2 --><!-- page 2 -->

                        <div
                            class="card-body"
                            id="card-reservation"
                            v-show="!changePage"
                        >
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="plane">
                                        <div class="cockpit">
                                            <h2 style="margin-top:80px">
                                                Please select a seat
                                            </h2>
                                        </div>
                                        <div
                                            class="exit exit--front fuselage"
                                        ></div>
                                        <ol class="cabin fuselage">
                                            <li
                                                class="row row--1"
                                                style="padding-left:35px"
                                            >
                                                <ol class="seats" type="A">
                                                    <li class="seat">
                                                        <input
                                                            type="checkbox"
                                                            id="1A"
                                                        />
                                                        <label
                                                            style="padding:5px; color:#fff"
                                                            for="1A"
                                                            >1A</label
                                                        >
                                                    </li>
                                                    <li class="seat">
                                                        <input
                                                            type="checkbox"
                                                            id="1B"
                                                        />
                                                        <label
                                                            style="padding:5px; color:#fff"
                                                            for="1B"
                                                            >1B</label
                                                        >
                                                    </li>
                                                    <li class="seat">
                                                        <input
                                                            type="checkbox"
                                                            id="1C"
                                                        />
                                                        <label
                                                            style="padding:5px; color:#fff"
                                                            for="1C"
                                                            >1C</label
                                                        >
                                                    </li>
                                                    <li class="seat">
                                                        <input
                                                            type="checkbox"
                                                            disabled
                                                            id="1D"
                                                        />
                                                        <label
                                                            style="padding:5px; color:#fff"
                                                            for="1D"
                                                            >Occupied</label
                                                        >
                                                    </li>
                                                    <li class="seat">
                                                        <input
                                                            type="checkbox"
                                                            id="1E"
                                                        />
                                                        <label
                                                            style="padding:5px; color:#fff"
                                                            for="1E"
                                                            >1E</label
                                                        >
                                                    </li>
                                                    <li class="seat">
                                                        <input
                                                            type="checkbox"
                                                            id="1F"
                                                        />
                                                        <label
                                                            style="padding:5px; color:#fff"
                                                            for="1F"
                                                            >1F</label
                                                        >
                                                    </li>
                                                </ol>
                                            </li>

                                            <li
                                                class="row row--2"
                                                style="padding-left:35px"
                                            >
                                                <ol class="seats" type="A">
                                                    <li class="seat">
                                                        <input
                                                            type="checkbox"
                                                            id="2A"
                                                        />
                                                        <label
                                                            style="padding:5px; color:#fff"
                                                            for="2A"
                                                            >2A</label
                                                        >
                                                    </li>
                                                    <li class="seat">
                                                        <input
                                                            type="checkbox"
                                                            id="2B"
                                                        />
                                                        <label
                                                            style="padding:5px; color:#fff"
                                                            for="2B"
                                                            >2B</label
                                                        >
                                                    </li>
                                                    <li class="seat">
                                                        <input
                                                            type="checkbox"
                                                            id="2C"
                                                        />
                                                        <label
                                                            style="padding:5px; color:#fff"
                                                            for="2C"
                                                            >2C</label
                                                        >
                                                    </li>
                                                    <li class="seat">
                                                        <input
                                                            type="checkbox"
                                                            id="2D"
                                                        />
                                                        <label
                                                            style="padding:5px; color:#fff"
                                                            for="2D"
                                                            >2D</label
                                                        >
                                                    </li>
                                                    <li class="seat">
                                                        <input
                                                            type="checkbox"
                                                            id="2E"
                                                        />
                                                        <label
                                                            style="padding:5px; color:#fff"
                                                            for="2E"
                                                            >2E</label
                                                        >
                                                    </li>
                                                    <li class="seat">
                                                        <input
                                                            type="checkbox"
                                                            id="2F"
                                                        />
                                                        <label
                                                            style="padding:5px; color:#fff"
                                                            for="2F"
                                                            >2F</label
                                                        >
                                                    </li>
                                                </ol>
                                            </li>
                                        </ol>
                                        <div
                                            class="exit exit--back fuselage"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4" />
                            <div class="row">
                                <div class="col-md-12">
                                    <div
                                        class="form-group"
                                        v-for="(passenger,
                                        counter) in passengers"
                                        :key="counter"
                                    >
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-2">
                                                <h5>
                                                    <br />Passenger
                                                    {{ Number(counter) + 1 }} :
                                                </h5>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <multiselect
                                                        v-bind:class="{
                                                            'is-invalid': error_title
                                                        }"
                                                        v-model="
                                                            passenger.title
                                                        "
                                                        :options="titles"
                                                        :searchable="false"
                                                        :show-labels="false"
                                                        :multiple="false"
                                                        :close-on-select="true"
                                                        :clear-on-select="false"
                                                        placeholder=""
                                                        :preselect-first="false"
                                                    ></multiselect>

                                                    <span
                                                        class="invalid-feedback"
                                                        >{{ error_title }}</span
                                                    >
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Name :</label>
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid': error_name
                                                        }"
                                                        type="text"
                                                        class="form-control"
                                                        name="name"
                                                        v-model="passenger.name"
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ error_name }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Surname :</label>
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid': error_surname
                                                        }"
                                                        type="text"
                                                        class="form-control"
                                                        name="surname"
                                                        v-model="
                                                            passenger.surname
                                                        "
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ error_surname }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label
                                                        class="col-md-6 control-label"
                                                        for="radios"
                                                        >Gender :</label
                                                    >
                                                    <div class="col-md-12">
                                                        <label
                                                            class="radio-inline"
                                                            for="radios-0"
                                                        >
                                                            <input
                                                                type="radio"
                                                                id="radios-0"
                                                                v-model="
                                                                    passenger.gender
                                                                "
                                                                value="Male"
                                                            />
                                                            Male
                                                        </label>
                                                        <label
                                                            class="radio-inline"
                                                            for="radios-1"
                                                        >
                                                            <input
                                                                type="radio"
                                                                id="radios-1"
                                                                v-model="
                                                                    passenger.gender
                                                                "
                                                                value="Female"
                                                            />
                                                            Female
                                                        </label>
                                                        <label
                                                            class="radio-inline"
                                                            for="radios-2"
                                                        >
                                                            <input
                                                                type="radio"
                                                                id="radios-1"
                                                                v-model="
                                                                    passenger.gender
                                                                "
                                                                value="Other"
                                                            />
                                                            Other
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label
                                                        >Date of Birth :</label
                                                    >
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid': error_dob
                                                        }"
                                                        type="date"
                                                        class="form-control"
                                                        v-model="passenger.dob"
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ error_dob }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Nationality :</label>
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid': error_national
                                                        }"
                                                        class="form-control"
                                                        v-model="
                                                            passenger.national
                                                        "
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ error_national }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>ID card :</label>
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid': error_idcard
                                                        }"
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            passenger.idcard
                                                        "
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ error_idcard }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Passport :</label>
                                                    <input
                                                        v-bind:class="{
                                                            'is-invalid': error_passport
                                                        }"
                                                        type="text"
                                                        class="form-control"
                                                        v-model="
                                                            passenger.passport
                                                        "
                                                    />
                                                    <div
                                                        class="invalid-feedback"
                                                    >
                                                        {{ error_passport }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer flex-center">
                            <button
                                v-show="changePage"
                                style="color:#fff"
                                id="card-reservation"
                                type="button"
                                @click="changePage = !changePage"
                                class="btn btn-block btn-login"
                            >
                                Next
                            </button>
                            <button
                                v-show="!changePage"
                                style="color:#fff"
                                id="card-reservation"
                                type="button"
                                @click="changePage = !changePage"
                                class="btn btn-block btn-success"
                            >
                                Back
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
import { FunctionalCalendar } from "vue-functional-calendar";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
    components: { Multiselect, Loading, FunctionalCalendar },
    data() {
        return {
            oneway: false,
            back: false,
            loadingPage: false,
            fullPage: true,
            changePage: true,
            counter: "",
            allClass: ["Economy", "Business", "First"],
            titles: ["Mr.", "Mrs.", "Ms.", "Miss"],
            calendar_from: {},
            calendar_to: {},
            calendarConfigs: {
                disabledDates: ["beforeToday"],
                isDatePicker: true
            },
            input: {
                class: "",
                departDate: "",
                returnDate: "",
                noPass: "",
                flightTo: "",
                flightFrom: "",
                flightTo2: "",
                flightFrom2: ""
            },
            passengers: [
                {
                    title: "",
                    name: "",
                    surname: "",
                    gender: "",
                    dob: "",
                    national: "",
                    idcard: "",
                    passport: ""
                }
            ],

            error_departDate: "",
            error_returnDate: "",
            error_noPass: "",
            error_flightTo: "",
            error_flightFrom: "",
            error_flightTo2: "",
            error_flightFrom2: "",
            error_title: "",
            error_name: "",
            error_surname: "",
            error_gender: "",
            error_dob: "",
            error_national: "",
            error_idcard: "",
            error_passport: ""
        };
    },
    // beforeMount() {
    //     this.loadingPage = true;
    //     setTimeout(() => {
    //         this.loadingPage = false;
    //     }, 2000);
    // },
    methods: {
        showReturn() {
            this.back = true;
            this.oneway = false;
        },
        showOneway() {
            this.back = false;
            this.oneway = true;
        },

        addPass(index) {
            this.passengers.push({
                title: "",
                name: "",
                surname: "",
                gender: "",
                dob: "",
                national: "",
                idcard: "",
                passport: ""
            });
        },
        removePass(index) {
            this.passengers.splice(index, 1);
        }
    }
};
</script>

<style>
/* .reservation {
    background-color: #4bb4de;
} */
.card-header {
    border: none;
    border-radius: 0;
    background-color: #f79c65;
    display: block;
}
/* #f8d49b */
#card-reservation {
    border: none;
    border-radius: 0;
}
</style>
