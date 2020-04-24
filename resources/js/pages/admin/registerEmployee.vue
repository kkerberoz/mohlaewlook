<template>
    <div class="container-fulid">
        <div class="row flex-center" style="margin-bottom:3%">
            <div
                class="col-md-7 order-md-1 justify-content-between align-items-center"
            >
                <form v-on:submit="formSubmit">
                    <h1 class="mb-3" style="display:block ">
                        Employee's Register
                    </h1>
                    <hr class="mb-4" />
                    <h5 class="mb-3">Work Details</h5>
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Start Date:</label>
                                    <div class="input-group">
                                        <input
                                            type="date"
                                            class="form-control"
                                            v-model="input.start_date"
                                            required
                                        />
                                        <div class="invalid-feedback">
                                            start date required.
                                        </div>
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Salary:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.salary"
                                    />
                                    <div class="invalid-feedback">
                                        Please enter salary
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Role:</label>
                                    <select
                                        class="custom-select d-block w-100"
                                        v-model="input.role"
                                        required
                                    >
                                        <option value selected disabledd
                                            >Choose</option
                                        >
                                        <option value="staff">Staff</option>
                                        <option value="pilot">Pilot</option>
                                        <option value="flight_attendant"
                                            >Flight Attendant</option
                                        >
                                    </select>

                                    <div class="invalid-feedback">
                                        Please enter role
                                    </div>
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-md-6 mb-2">
                                    <label>Airport:</label>
                                    <select
                                        class="custom-select d-block w-100"
                                        v-model="input.airport"
                                        required
                                        id="airport"
                                    >
                                        <option value selected disabledd
                                            >Choose</option
                                        >
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose
                                    </div>
                                </span>
                                <span class="col-md-6 mb-2">
                                    <label>Work Status:</label>
                                    <select
                                        class="custom-select d-block w-100"
                                        v-model="input.status"
                                        required
                                    >
                                        <option value selected disabledd
                                            >Choose</option
                                        >
                                        <option value="1">Active</option>
                                        <option value="0">Left</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose
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
                                            type="text"
                                            class="form-control"
                                            v-model="input.username"
                                            required
                                        />
                                        <div
                                            class="invalid-feedback"
                                            style="width: 100%;"
                                        >
                                            Your username is required.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Password:</label>
                                    <input
                                        type="password"
                                        class="form-control"
                                        v-model="input.password"
                                        required
                                    />
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <span class="col-md-8 mb-2">
                                    <label>ID-Card:</label>
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="input.idcard"
                                            required
                                        />
                                        <div class="invalid-feedback">
                                            Your id-card is required.
                                        </div>
                                    </div>
                                </span>
                                <span class="col-md-4">
                                    <label>Gender:</label>
                                    <br />
                                    <div class="form-check form-check-inline">
                                        <input
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
                            </div>

                            <div class="row">
                                <div class="col-md-2 mb-2">
                                    <label for="state">Title:</label>
                                    <select
                                        class="custom-select d-block w-100"
                                        v-model="input.title"
                                        required
                                    >
                                        <option value selected disabled
                                            >Choose</option
                                        >
                                        <option>Mrs.</option>
                                        <option>Ms.</option>
                                        <option>Mr.</option>
                                        <option>Miss</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose
                                    </div>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <label>First name:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.firstname"
                                        required
                                    />
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <label>Last name:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.lastname"
                                        required
                                    />
                                    <div class="invalid-feedback">
                                        Valid last name is required.
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Date of Birth:</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        v-model="input.DOB"
                                        required
                                    />
                                    <div class="invalid-feedback">
                                        Please enter date
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Height:</label>
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="input.height"
                                            required
                                        />
                                        <div class="invalid-feedback">
                                            Please enter height
                                        </div>
                                    </div>
                                </span>
                                <span class="col-md-4 mb-2">
                                    <label>Weight:</label>
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="input.weight"
                                            required
                                        />
                                        <div class="invalid-feedback">
                                            plz enter weight
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
                                            required
                                        />
                                        <div class="invalid-feedback">
                                            Your email is required.
                                        </div>
                                    </div>
                                </span>
                                <span class="col-md-6 mb-2">
                                    <label>Phone Number:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.phone"
                                        required
                                    />
                                    <div class="invalid-feedback">
                                        Please enter Phone
                                    </div>
                                </span>
                            </div>
                            <div class="row">
                                <span class="col-md-12 mb-2">
                                    <label>Address:</label>
                                    <div class="input-group">
                                        <input
                                            type="email"
                                            class="form-control"
                                            v-model="input.address"
                                        />
                                        <div class="invalid-feedback">
                                            Your address is required.
                                        </div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </form>
                    <form>
                        <hr class="mb-4" />
                        <h5 class="mb-3">Educations History</h5>

                        <div
                            class="form-group"
                            v-for="(edu, counter) in edus"
                            :key="counter"
                        >
                            <hr
                                class="mb-4"
                                v-show="
                                    counter || (!counter && edus.length > 1)
                                "
                            />
                            <h5
                                class="mb-3"
                                v-show="
                                    counter || (!counter && edus.length > 1)
                                "
                            >
                                Educations {{ Number(counter) + 1 }} :
                            </h5>

                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label>Degree:</label>
                                    <select
                                        class="custom-select d-block w-100"
                                        v-model="edu.degree"
                                    >
                                        <option value selected disabled
                                            >Choose</option
                                        >
                                        <option>Bachelor's degree</option>
                                        <option>Master's degree</option>
                                        <option>Doctoral degree</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label>University:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="edu.university"
                                    />
                                    <div class="invalid-feedback">
                                        university is required.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label>Faculty:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="edu.faculty"
                                    />
                                    <div class="invalid-feedback">
                                        Faculty is required.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>Department:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="edu.department"
                                    />
                                    <div class="invalid-feedback">
                                        Department is required.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label>GPA:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="edu.gpa"
                                    />
                                    <div class="invalid-feedback">
                                        DPA is required.
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
                    </form>

                    <hr class="mb-4" />
                    <h5 class="mb-3">Diseases</h5>
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
                                        startdate required.
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
                                    Please enter salary
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

                    <hr class="mb-4" />
                    <button
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
export default {
    name: "registerEmployee",
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
            ]
        };
    },
    methods: {
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
            e.preventDefault();
            var details = this.input; // data in detail
            var educations = this.edus; // data in education
            var diseases = this.diseases; // data in diseases
            let data = {
                details: details,
                educations: educations,
                diseases: diseases
            };
            axios.post("/api/addEmployee", data).then(response => {
                console.log(response.data.test);
            });
        }
    },
    mounted() {
        axios.get("/api/getAirports").then(response => {
            // show all airports onto option
            var AirportID = response.data[0];
            var select = document.getElementById("airport");
            for (var i = 0; i < AirportID.length; ++i) {
                var option = document.createElement("option");
                option.text =
                    AirportID[i]["airport_id"] +
                    ": " +
                    AirportID[i]["airport_name"];
                option.value = AirportID[i]["airport_id"];
                select.add(option);
            }
        });
    }
};
</script>

<style></style>
