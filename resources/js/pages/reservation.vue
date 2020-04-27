<template>
    <div class="container-xl" style="padding-top:10%;padding-bottom:5%;">
        <div class="row flex-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Reservation</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <span class="form-group">
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
                                </span>
                            </div>
                            <div class="col-md-2">
                                <span class="form-group">
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
                                </span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>No. of Passenger :</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_noPass
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.noPass"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_noPass }}
                                    </div>
                                </span>
                            </div>
                        </div>
                        <hr class="mb-4" />
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <span class="form-group">
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
                                </span>
                            </div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀</label>
                                    <span class="input-text"> <br />To : </span>
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
                                </span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <span class="form-group">
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
                                </span>
                            </div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀</label>
                                    <span class="input-text"> <br />To : </span>
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
                                </span>
                            </div>
                        </div>
                        <hr class="mb-4" />
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-2"><br />Passenger 1 :</div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-1">
                                <span class="form-group">
                                    <label>Title</label>
                                    <select
                                        v-bind:class="{
                                            'is-invalid': error_title
                                        }"
                                        class="form-control"
                                        v-model="passenger.title"
                                    >
                                        <option value selected disabled
                                            >Please select</option
                                        >
                                        <option>Mrs.</option>
                                        <option>Ms.</option>
                                        <option>Mr.</option>
                                        <option>Miss</option>
                                    </select>
                                    <span class="invalid-feedback">
                                        {{ error_title }}
                                    </span>
                                </span>
                            </div>
                            <div class="col-md-2">
                                <span class="form-group">
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
                                </span>
                            </div>

                            <div class="col-md-2">
                                <span class="form-group">
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
                                </span>
                            </div>

                            <div class="col-md-2">
                                <span class="form-group">
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
                                                v-model="passenger.gender"
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
                                                v-model="passenger.gender"
                                                value="Female"
                                            />
                                            Female
                                        </label>
                                    </div>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Date of Birth :</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_DOB
                                        }"
                                        type="date"
                                        class="form-control"
                                        v-model="passenger.DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Nationality :</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_national
                                        }"
                                        type="country"
                                        class="form-control"
                                        v-model="passenger.national"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_national }}
                                    </div>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <span class="form-group">
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
                                </span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <span class="form-group">
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
                                </span>
                            </div>
                        </div>
                        <hr class="mb-4" />
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-2"><br />Passenger 2 :</div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-1">
                                <span class="form-group">
                                    <label>Title</label>
                                    <select class="form-control">
                                        <option value selected disabled
                                            >Please select</option
                                        >
                                        <option>Mrs.</option>
                                        <option>Ms.</option>
                                        <option>Mr.</option>
                                        <option>Miss</option>
                                    </select>
                                    <span class="invalid-feedback">
                                        <!-- // -->
                                    </span>
                                </span>
                            </div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Name :</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="name"
                                    />
                                    <div class="invalid-feedback">
                                        <!-- // -->
                                    </div>
                                </span>
                            </div>

                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Surname :</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="surname"
                                    />
                                    <div class="invalid-feedback">
                                        <!-- // -->
                                    </div>
                                </span>
                            </div>

                            <div class="col-md-2">
                                <span class="form-group">
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
                                                name="gender"
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
                                                name="gender"
                                                value="Female"
                                            />
                                            Female
                                        </label>
                                    </div>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Date of Birth :</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        name="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        <!-- // -->
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Nationality :</label>
                                    <input
                                        type="country"
                                        class="form-control"
                                    />
                                    <div class="invalid-feedback">
                                        <!-- // -->
                                    </div>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>ID card :</label>
                                    <input type="text" class="form-control" />
                                    <div class="invalid-feedback">
                                        <!-- // -->
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Passport :</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        <!-- // -->
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4" />
                    <div class="card-footer flex-center">
                        <button
                            type="button"
                            class="btn btn-block btn-outline-primary"
                        >
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            input: {
                departDate: "",
                returnDate: "",
                noPass: "",
                flightTo: "",
                flightFrom: "",
                flightTo2: "",
                flightFrom2: ""
            },
            passenger: {
                title: "",
                name: "",
                surname: "",
                gender: "",
                DOB: "",
                national: "",
                idcard: "",
                passport: ""
            },
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
            error_DOB: "",
            error_national: "",
            error_idcard: "",
            error_passport: ""
        };
    }
};
</script>

<style>
.card-header {
    background-color: #f85e09;
    display: block;
}
</style>
