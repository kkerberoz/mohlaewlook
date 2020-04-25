<template>
    <div class="container-fulid">
        <div class="row flex-center" style="margin-bottom:3%">
            <div
                class="col-md-7 order-md-1 justify-content-between align-items-center"
            >
                <form>
                    <input
                            type="hidden"
                            name="_token"
                            v-bind:value="csrf"
                    />
                    <h1 class="mb-3" style="display:block ">
                        Employee's Register
                    </h1>
                    <hr class="mb-4" />
                    <h5 class="mb-3">Work Details</h5>

                    <div class="form-group">
                        <div class="row">
                            <span class="col-md-4 mb-2">
                                <label>Start Date:</label>
                                <div class="input-group">
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error.error_start_date
                                        }"
                                        required
                                        type="date"
                                        class="form-control"
                                        v-model="input.start_date"
                                    />
                                    <span class="invalid-feedback">{{
                                        error.error_start_date
                                    }}</span>
                                </div>
                            </span>
                            <span class="col-md-4 mb-2">
                                <label>Salary:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error.error_salary
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="input.salary"
                                />
                                <div class="invalid-feedback">
                                    {{error.error_salary}}
                                </div>
                            </span>
                            <span class="col-md-4 mb-2">
                                <label>Role:</label>

                                <multiselect
                                    label="name"
                                    v-bind:class="{
                                        'is-invalid': error.error_role
                                    }"
                                    v-model="input.role"
                                    :options="roles"
                                    :searchable="true"
                                    :multiple="false"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    :show-labels="false"
                                    placeholder="Choose"
                                    :preselect-first="false"
                                >
                                </multiselect>

                                <div class="invalid-feedback">
                                    {{error.error_role}}
                                </div>
                            </span>
                        </div>
                        <div class="row">
                            <span class="col-md-6 mb-2">
                                <label>Airport:</label>

                                <multiselect

                                    :custom-label="airportName"
                                    v-model="input.airport"
                                    :options="airports"
                                    :searchable="true"
                                    :multiple="false"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    :preserve-search="true"
                                    placeholder="Choose"
                                    :preselect-first="false"
                                >
                                </multiselect>

                            </span>
                            <span class="col-md-6 mb-2">
                                <label>Work Status:</label>
                                <multiselect
                                    label="name"
                                    v-bind:class="{
                                        'is-invalid': error.error_status
                                    }"
                                    v-model="input.status"
                                    :options="status"
                                    :searchable="true"
                                    :multiple="false"
                                    :show-labels="false"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    placeholder="Choose"
                                    :preselect-first="false"
                                >
                                </multiselect>
                                <div class="invalid-feedback">
                                    {{error.error_status}}
                                </div>
                            </span>
                        </div>
                        <hr class="mb-4" />
                        <h5 class="mb-3">Personal Details</h5>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Username:</label>
                                <div class="input-group">
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error.error_username
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.username"
                                        required
                                    />
                                    <div
                                        class="invalid-feedback"
                                        style="width: 100%;"
                                    >
                                        {{error.error_username}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Password:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error.error_password
                                    }"
                                    type="password"
                                    class="form-control"
                                    v-model="input.password"
                                    required
                                />
                                <div class="invalid-feedback">
                                    {{error.error_password}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <span class="col-md-8 mb-2">
                                <label>ID-Card:</label>
                                <div class="input-group">
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error.error_idcard
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.idcard"
                                        required
                                    />
                                    <div class="invalid-feedback">
                                        {{error.error_idcard}}
                                    </div>
                                </div>
                            </span>
                            <span class="col-md-4">
                                <label>Gender:</label>
                                <br />
                                <div class="form-check form-check-inline">
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error.error_gender
                                        }"
                                        class="form-check-input"
                                        type="radio"
                                        value="male"
                                        v-model="input.gender"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="inlineRadio1"
                                        >Male</label
                                    >
                                </div>
                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        value="female"
                                        v-model="input.gender"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="inlineRadio2"
                                        >Female</label
                                    >
                                </div>
                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        value="other"
                                        v-model="input.gender"
                                    />
                                    <label
                                        class="form-check-label"
                                        for="inlineRadio3"
                                        >other</label
                                    >
                                </div>
                            </span>
                            <div class="invalid-feedback">
                                    {{ error.error_gender }}
                                </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 mb-2">
                                <label for="state">Title:</label>
                                <multiselect
                                     v-bind:class="{
                                        'is-invalid': error.error_title
                                    }"
                                    label="title"
                                    v-model="input.title"
                                    :options="titles"
                                    :searchable="true"
                                    :show-labels="false"
                                    :multiple="false"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    placeholder="Choose"
                                    :preselect-first="false"
                                >
                                </multiselect>
                                <div class="invalid-feedback">
                                    {{error.error_title}}
                                </div>
                            </div>
                            <div class="col-md-5 mb-2">
                                <label>First name:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error.error_firstname
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="input.firstname"
                                    required
                                />
                                <div class="invalid-feedback">
                                    {{error.error_firstname}}
                                </div>
                            </div>
                            <div class="col-md-5 mb-2">
                                <label>Last name:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error.error_lastname
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="input.lastname"
                                    required
                                />
                                <div class="invalid-feedback">
                                    {{error.error_lastname}}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <span class="col-md-4 mb-2">
                                <label>Date of Birth:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error.error_DOB
                                    }"
                                    type="date"
                                    class="form-control"
                                    v-model="input.DOB"
                                    required
                                />
                                <div class="invalid-feedback">
                                    {{error.error_DOB}}
                                </div>
                            </span>
                            <span class="col-md-4 mb-2">
                                <label>Height:</label>
                                <div class="input-group">
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error.error_height
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.height"
                                        required
                                    />
                                    <div class="invalid-feedback">
                                        {{error.error_height}}
                                    </div>
                                </div>
                            </span>
                            <span class="col-md-4 mb-2">
                                <label>Weight:</label>
                                <div class="input-group">
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error.error_weight
                                        }"
                                        type="text"
                                        class="form-control"
                                        v-model="input.weight"
                                        required
                                    />
                                    <div class="invalid-feedback">
                                        {{error.error_weight}}
                                    </div>
                                </div>
                            </span>
                        </div>

                        <div class="row">
                            <span class="col-md-6 mb-2">
                                <label>Email:</label>
                                <div class="input-group">
                                    <input

                                        type="email"
                                        class="form-control"
                                        v-model="input.email"
                                    />
                                </div>
                            </span>
                            <span class="col-md-6 mb-2">
                                <label>Phone Number:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error.error_phone
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="input.phone"
                                    required
                                />
                                <div class="invalid-feedback">
                                    {{error.error_phone}}
                                </div>
                            </span>
                        </div>
                        <div class="row">
                            <span class="col-md-12 mb-2">
                                <label>Address:</label>
                                <div class="input-group">
                                    <input
                                        v-bind:class="{
                                            'is-invalid': error.error_address
                                        }"
                                        type="email"
                                        class="form-control"
                                        v-model="input.address"
                                    />
                                    <div class="invalid-feedback">
                                        {{error.error_address}}
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>

                    <hr class="mb-4" />
                    <h5 class="mb-3">Educations History</h5>

                    <div
                        class="form-group"
                        v-for="(edu, counter) in edus"
                        :key="counter"
                    >
                        <hr
                            class="mb-4"
                            v-show="counter || (!counter && edus.length > 1)"
                        />
                        <h5
                            class="mb-3"
                            v-show="counter || (!counter && edus.length > 1)"
                        >
                            Educations {{ Number(counter) + 1 }} :
                        </h5>

                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label>Degree:</label>
                                <multiselect
                                    v-bind:class="{
                                        'is-invalid': error.error_edus
                                    }"
                                    v-model="edu.degree"
                                    :options="degrees"
                                    :searchable="true"
                                    :multiple="false"
                                    :show-labels="false"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    placeholder="Choose"
                                    :preselect-first="false"
                                >
                                </multiselect>
                                <div class="invalid-feedback">
                                    {{error.error_edus}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label>University:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error.error_edus
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="edu.university"
                                />
                                <div class="invalid-feedback">
                                    {{error.error_edus}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label>Faculty:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error.error_edus
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="edu.faculty"
                                />
                                <div class="invalid-feedback">
                                    {{error.error_edus}}
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Department:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error.error_edus
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="edu.department"
                                />
                                <div class="invalid-feedback">
                                    {{error.error_edus}}
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>GPA:</label>
                                <input
                                    v-bind:class="{
                                        'is-invalid': error.error_edus
                                    }"
                                    type="text"
                                    class="form-control"
                                    v-model="edu.gpa"
                                />
                                <div class="invalid-feedback">
                                    {{error.error_edus}}
                                </div>
                            </div>
                        </div>
                        <span>
                            <i
                                class="fas fa-plus-circle"
                                style="color:#4BB543;"
                                @click="addedu(counter)"
                                v-show="counter == edus.length - 1"
                            ></i>
                            <i
                                class="fas fa-minus-circle"
                                style="color:#ED4337;"
                                @click="removeedu(counter)"
                                v-show="
                                    counter || (!counter && edus.length > 1)
                                "
                            ></i>
                        </span>
                    </div>

                    <hr class="mb-4" />
                    <h5 class="mb-3">Diseases</h5>
                    <span id="app" @click="seen = !seen"
                        ><i
                            v-show="seen"
                            class="fas fa-plus-circle"
                            style="color:#4BB543;"
                            >ADD</i
                        >
                        <i
                            class="fas fa-minus-circle"
                            style="color:#ED4337;"
                            v-show="!seen"
                            >REMOVE</i
                        ></span
                    >

                    <div v-if="!seen" id="hide">
                        <form
                            class="form-group"
                            v-for="(disease, k) in diseases"
                            :key="k"
                        >
                            <hr
                                class="mb-4"
                                v-show="k || (!k && diseases.length > 1)"
                            />
                            <h5
                                class="mb-3"
                                v-show="k || (!k && diseases.length > 1)"
                            >
                                Disease info {{ Number(k) + 1 }} :
                            </h5>
                            <div class="row">
                                <span class="col-md-6 mb-2">
                                    <label>Disease:</label>
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="disease.info"
                                        />
                                        <div class="invalid-feedback">
                                            Please enter
                                        </div>
                                    </div>
                                </span>
                                <span class="col-md-6 mb-2">
                                    <label>Note:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="disease.note"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </span>
                            </div>
                            <span>
                                <i
                                    class="fas fa-plus-circle"
                                    style="color:#4BB543;"
                                    @click="add(k)"
                                    v-show="k == diseases.length - 1"
                                ></i>
                                <i
                                    class="fas fa-minus-circle"
                                    style="color:#ED4337;"
                                    @click="remove(k)"
                                    v-show="k || (!k && diseases.length > 1)"
                                ></i>
                            </span>
                        </form>
                    </div>

                    <hr class="mb-4" />
                    <button
                        @click="formSubmit"
                        class="btn btn-primary btn-lg btn-block btn-login"
                        type="submit"
                    >
                        Register
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Multiselect from "vue-multiselect";
export default {
    name: "registerEmployee",
    components: { Multiselect },
    props: ["csrf", "oldName"],
    data() {
        return {
            input: {
                start_date: "",
                salary: "",
                airport: "",
                role: "",
                status: "",
                username: "",
                password: "",
                idcard: "",
                gender: "",
                title: "",
                firstname: "",
                lastname: "",
                DOB: "",
                height: "",
                weight: "",
                email: "",
                address: "",
                phone: ""
            },
            edus: [
                {
                    degree: "",
                    university: "",
                    faculty: "",
                    department: "",
                    gpa: ""
                }
            ],
            diseases: [
                {
                    info: "",
                    note: ""
                }
            ],
            airports: [],
            roles: [
                { name: "Staff" },
                { name: "Pilot" },
                { name: "Flight Attendant" }
            ],
            status: [
                { value: 1, name: "Active" },
                { value: 0, name: "Left" }
            ],
            titles: [
                { title: "Mr." },
                { title: "Mrs." },
                { title: "Mr." },
                { title: "Mr." }
            ],
            degrees: [
                "Bachelor's degree",
                "Master's degree",
                "Doctoral degree"
            ],

            error : [
                {
                    error_start_date: "",
                    error_salary: "",
                    error_airport: "",
                    error_role: "",
                    error_status: "",
                    error_username: "",
                    error_password: "",
                    error_idcard: "",
                    error_gender: "",
                    error_title: "",
                    error_firstname: "",
                    error_lastname: "",
                    error_DOB: "",
                    error_height: "",
                    error_weight: "",
                    error_email: "",
                    error_address: "",
                    error_phone: "",
                    error_degree: "",
                    error_university: "",
                    error_faculty: "",
                    error_department: "",
                    error_gpa: "",
                    error_info: "",
                    error_note: "",
                    errors: []
                }
            ],
            seen: true,

        };
    },
    mounted() {
        axios.get("/api/backend/getAirports").then(response => {
            // show all airports onto option
            var AirportID = response.data; // get all aiport
            this.airports = AirportID;
        });
    },

    methods: {
        airportName({ airport_id, airport_name }) {
            return `[${airport_id}] - ${airport_name}  `;
        },
        addedu(index) {
            this.edus.push({
                degree: "",
                university: "",
                faculty: "",
                department: "",
                gpa: ""
            });
        },
        removeedu(index) {
            this.edus.splice(index, 1);
        },
        add(index) {
            this.diseases.push({
                info: "",
                note: ""
            });
        },
        remove(index) {
            this.diseases.splice(index, 1);
        },
        formSubmit(e) {
            this.error.error_start_date=null;//
            this.error.error_salary=null;//
            this.error.error_airport=null;//////
            this.error.error_role=null;//
            this.error.error_status=null;//
            this.error.error_username=null;//
            this.error.error_password=null;//
            this.error.error_idcard=null;//
            this.error.error_gender=null;//
            this.error.error_title=null;//
            this.error.error_firstname=null;//
            this.error.error_lastname=null;//
            this.error.error_DOB=null;//
            this.error. error_height=null;//
            this.error.error_weight=null;//
            this.error.error_email=null;///////
            this.error.error_address=null;//
            this.error.error_phone=null;//
            this.error.error_edus=null;//
            this.error.errors = [];
            e.preventDefault();
            let details = {
                start_date: this.input.start_date,
                salary: this.input.salary,
                airport: this.input.airport.airport_id,
                role: this.input.role.name,
                status: this.input.status.value,
                username: this.input.username,
                password: this.input.password,
                idcard: this.input.idcard,
                gender: this.input.gender,
                title: this.input.title.title,
                firstname: this.input.firstname,
                lastname: this.input.lastname,
                DOB: this.input.DOB,
                height: this.input.height,
                weight: this.input.weight,
                email: this.input.email,
                address: this.input.address,
                phone: this.input.phone
            }; // data in detail
            var educations = this.edus; // data in education
            var diseases = this.diseases; // data in diseases
            let data = {
                details: details,
                educations: educations,
                diseases: diseases
            };

            if (!this.input.start_date) {
                this.error.error_start_date = "Please select your start date.";
                this.error.errors.push(this.error.error_start_date);
            } else {
                this.error.error_start_date = null;
            }

            if(!this.input.salary){
                this.error.error_salary = "Please fill the salary.";
                this.error.errors.push(this.error.error_salary);
            }else if(isNaN(this.input.salary)){
                this.error.error_salary = "Please fill only number.";
                this.error.errors.push(this.error.error_salary);
            }else{
                this.error.error_salary = null;
            }

            if (!this.input.role) {
                this.error.error_role = "Please select your role.";
                this.error.errors.push(this.error.error_role);
            } else {
                this.error.error_role = null;
            }

            if (!this.input.status) {
                this.error.error_status = "Please select your work status.";
                this.error.errors.push(this.error.error_status);
            } else {
                this.error.error_status = null;
            }


            if (!this.input.username.trim()) {
                this.error_username = "Please fill your username.";
                this.errors.push(this.error.error_username);
            }else {
                this.error.error_username = null;
            }


            if (!this.input.password) {
                this.error.error_password = "Please fill your password.";
                this.error.errors.push(this.error.error_password);
            } else if (this.input.password.length < 6) {
                this.error.error_password ="Password has to be at least 6 characters long.";
                this.error.errors.push(this.error.error_password);
            } else {
                this.error.error_password = null;
            }

            if (!this.input.idcard) {
                this.error.error_idcard = "Please fill your id card.";
                this.error.errors.push(this.error.error_idcard);
            } else if (this.input.idcard.length != 13) {
                this.error.error_idcard ="Password must be 13 characters.";
                this.error.errors.push(this.error.error_idcard);
            } else {
                this.error.error_idcard = null;
            }

            if(!this.input.gender){
                this.error.error_gender = "Please select the gender.";
                this.error.errors.push(this.error.error_gender);
            }else{
                this.input.error_gender = null;
            }



            if (!this.input.title.title) {
                this.error.error_title = "Please select your title.";
                this.error.errors.push(this.error.error_title);
            } else {
                this.error.error_title = null;
            }


            if (!this.input.firstname.trim()) {
                this.error.error_name = "Please fill your first name.";
                this.error.errors.push(this.error.error_name);
            } else {
                this.error.error_name = null;
            }


            if (!this.input.lastname.trim()) {
                this.error.error_surname = "Please fill your last name.";
                this.error.errors.push(this.error.error_surname);
            } else {
                this.error.error_surname = null;
            }

            if (!this.input.DOB) {
                this.error.error_DOB = "Please select your Date of Birth.";
                this.error.errors.push(this.error.error_DOB);
            } else {
                this.error.error_DOB = null;
            }

            if (!this.input.address.trim()) {
                this.error.error_address = "Please fill your address.";
                this.error.errors.push(this.error.error_address);
            } else {
                this.error.error_address = null;
            }


            if(!this.input.phone.trim()){
                this.error.error_phone = "Please fill your phone number.";
                this.error.errors.push(this.error.error_phone);
            }else{
                this.error.errors.push(this.error.error_phone);
            }


            if(!this.input.height){
                this.error.error_height = "Please fill you height.";
                this.error.errors.push(this.error.error_height);
            }else if(isNaN(this.input.height)){
                this.error.error_height = "Please fill only number.";
                this.error.errors.push(this.error.error_height);
            }else{
                this.error.error_height = null;
            }

            if(!this.input.weight){
                this.error.error_weight = "Please fill you weight.";
                this.error.errors.push(this.error.error_weight);
            }else if(isNaN(this.input.weight)){
                this.error.error_weight = "Please fill only number.";
                this.error.errors.push(this.error.error_weight);
            }else{
                this.error.error_weight = null;
            }


            if (!this.edus) {
                this.error.error_edus = "Please fill the detail.";
                this.error.errors.push(this.error.error_edus);
            } else {
                this.error.error_edus = null;
            }

            console.log(errors);


            if(!this.error.errors.lenght)
            {
                axios.get("/sanctum/csrf-cookie").then(response => {
                    axios.post("/api/admin/addEmployee", data).then(response => {
                        swal.fire(
                            "Register Success!",
                            "Cilck the button to continue!",
                            "success"
                        ).then(() => {
                            this.$router.push({ name: "/adminHome" });
                        });
                    });
                });
            }

        }
    }
};
</script>

<style></style>
