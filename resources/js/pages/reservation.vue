<template>
    <div class="container-fluid">
        <div class="row full-height flex-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">Reservation</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Depart Date :</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_DOB
                                        }"
                                        type="date"
                                        class="form-control"
                                        name="DOB"
                                        v-model="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Return Date :</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_DOB
                                        }"
                                        type="date"
                                        class="form-control"
                                        name="DOB"
                                        v-model="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>No. of Passenger : </label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="text"
                                        v-model="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Flight No :</label>
                                    <span class="input-text">
                                        <br />
                                        From :</span
                                    >
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                        v-model="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀ </label>
                                    <span class="input-text">
                                        <br />
                                        To :</span
                                    >
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                        v-model="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Flight No :</label>
                                    <span class="input-text">
                                        <br />
                                        From :</span
                                    >
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                        v-model="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀ </label>
                                    <span class="input-text">
                                        <br />
                                        To :</span
                                    >
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                        v-model="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
                                    </div>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <br />
                                Passenger 1 :
                            </div>
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
                                        name="title"
                                        v-model="title"
                                    >
                                        <option value selected disabled
                                            >Please select</option
                                        >
                                        <option>Mrs.</option>
                                        <option>Ms.</option>
                                        <option>Mr.</option>
                                        <option>Miss</option>
                                    </select>
                                    <span class="invalid-feedback">{{
                                        error_title
                                    }}</span>
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
                                        v-model="name"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_name }}
                                    </div>
                                </span>
                            </div>

                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Surname : </label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_surname
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="surname"
                                        v-model="surname"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_surname }}
                                    </div>
                                </span>
                            </div>

                            <div class="col-md-2">
                                <span class="form-group">
                                    <label
                                        class="col-md-4 control-label"
                                        for="radios"
                                    >
                                        Gender :
                                    </label>
                                    <div class="col-md-8">
                                        <label
                                            class="radio-inline"
                                            for="radios-0"
                                        >
                                            <input
                                                type="radio"
                                                id="radios-0"
                                                name="gender"
                                                checked
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
                                        v-bind:class="{
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                        v-model="DOB"
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
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
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
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Passport :</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
                                    </div>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <br />
                                Passenger 2 :
                            </div>
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
                                        name="title"
                                        v-model="title"
                                    >
                                        <option value selected disabled
                                            >Please select</option
                                        >
                                        <option>Mrs.</option>
                                        <option>Ms.</option>
                                        <option>Mr.</option>
                                        <option>Miss</option>
                                    </select>
                                    <span class="invalid-feedback">{{
                                        error_title
                                    }}</span>
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
                                        v-model="name"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_name }}
                                    </div>
                                </span>
                            </div>

                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Surname : </label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_surname
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="surname"
                                        v-model="surname"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_surname }}
                                    </div>
                                </span>
                            </div>

                            <div class="col-md-2">
                                <span class="form-group">
                                    <label
                                        class="col-md-4 control-label"
                                        for="radios"
                                    >
                                        Gender :
                                    </label>
                                    <div class="col-md-8">
                                        <label
                                            class="radio-inline"
                                            for="radios-0"
                                        >
                                            <input
                                                type="radio"
                                                id="radios-0"
                                                name="gender"
                                                checked
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
                                        v-bind:class="{
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                        v-model="DOB"
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
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
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
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
                                    </div>
                                </span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <span class="form-group">
                                    <label>Passport :</label>
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error_DOB
                                        }"
                                        type="text"
                                        class="form-control"
                                        name="DOB"
                                    />
                                    <div class="invalid-feedback">
                                        {{ error_DOB }}
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer flex-center">
                        <button type="button" class="btn btn-outline-primary">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>

<style></style>
