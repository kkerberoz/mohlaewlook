<template>
    <div
        class="container-fluid reservation"
        style="padding-top:5%;padding-bottom:10%;"
    >
        <div class="container-xl" style="margin-top:5%;padding-bottom:5%;">
            <div class="row flex-center">
                <div class="col-md-12">
                    <div class="card" id="card-reservation">
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Depart Date :</label>
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
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Return Date :</label>
                                        <input
                                            v-bind:class="{
                                                'is-invalid': error_returnDate
                                            }"
                                            type="date"
                                            class="form-control"
                                            v-model="input.returnDate"
                                        />
                                        <div class="invalid-feedback">
                                            {{ error_returnDate }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
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
                            </div>
                            <hr class="mb-4" />
                            <div class="row">
                                <div class="col-md-2">
                                    <br />
                                    <br />
                                    <h5>&nbsp; &nbsp; &nbsp;Depart:</h5>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Flight No :</label>
                                        <span class="input-text">
                                            <br />From :
                                        </span>
                                        <input
                                            v-bind:class="{
                                                'is-invalid': error_flightFrom
                                            }"
                                            type="text"
                                            class="form-control"
                                            v-model="input.flightFrom"
                                        />
                                        <div class="invalid-feedback">
                                            {{ error_flightFrom }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀</label>
                                        <span class="input-text">
                                            <br />To :
                                        </span>
                                        <input
                                            v-bind:class="{
                                                'is-invalid': error_flightTo
                                            }"
                                            type="text"
                                            class="form-control"
                                            v-model="input.flightTo"
                                        />
                                        <div class="invalid-feedback">
                                            {{ error_flightTo }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="col-md-2">
                                    <br />
                                    <br />
                                    <h5>&nbsp; &nbsp; &nbsp;Return:</h5>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Flight No :</label>
                                        <span class="input-text">
                                            <br />From :
                                        </span>
                                        <input
                                            v-bind:class="{
                                                'is-invalid': error_flightFrom2
                                            }"
                                            type="text"
                                            class="form-control"
                                            v-model="input.flightFrom2"
                                        />
                                        <div class="invalid-feedback">
                                            {{ error_flightFrom2 }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀</label>
                                        <span class="input-text">
                                            <br />To :
                                        </span>
                                        <input
                                            v-bind:class="{
                                                'is-invalid': error_flightTo2
                                            }"
                                            type="text"
                                            class="form-control"
                                            v-model="input.flightTo2"
                                        />
                                        <div class="invalid-feedback">
                                            {{ error_flightTo2 }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
                            </div>
                            <hr class="mb-4" />
                            <div
                                class="form-group"
                                v-for="(passenger, counter) in passengers"
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
                                                v-model="passenger.title"
                                                :options="titles"
                                                :searchable="false"
                                                :show-labels="false"
                                                :multiple="false"
                                                :close-on-select="true"
                                                :clear-on-select="false"
                                                placeholder=""
                                                :preselect-first="false"
                                            ></multiselect>

                                            <span class="invalid-feedback">{{
                                                error_title
                                            }}</span>
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
                                            <div class="invalid-feedback">
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
                                                v-model="passenger.surname"
                                            />
                                            <div class="invalid-feedback">
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
                                            <label>Date of Birth :</label>
                                            <input
                                                v-bind:class="{
                                                    'is-invalid': error_dob
                                                }"
                                                type="date"
                                                class="form-control"
                                                v-model="passenger.dob"
                                            />
                                            <div class="invalid-feedback">
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
                                                v-model="passenger.national"
                                            />
                                            <div class="invalid-feedback">
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
                                                v-model="passenger.idcard"
                                            />
                                            <div class="invalid-feedback">
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
                                                v-model="passenger.passport"
                                            />
                                            <div class="invalid-feedback">
                                                {{ error_passport }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>

                        <!-- page 2 --><!-- page 2 --><!-- page 2 --><!-- page 2 --><!-- page 2 --><!-- page 2 --><!-- page 2 --><!-- page 2 --><!-- page 2 -->

                        <div
                            class="card-body"
                            id="card-reservation"
                            v-show="!changePage"
                        >
                            <div class="row">
                                <div class="col-md-12">
                                    Mohalewlook
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
export default {
    components: { Multiselect },
    data() {
        return {
            changePage: true,
            counter: "",
            titles: ["Mr.", "Mrs.", "Ms.", "Miss"],

            input: {
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
    methods: {
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
.reservation {
    background-color: #4bb4de;
}
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
