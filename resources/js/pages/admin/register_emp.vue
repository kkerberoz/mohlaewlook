<template>
    <div class="container-fulid">
        <div class="row flex-center">
            <div
                class="col-md-7 order-md-1 justify-content-between align-items-center"
            >
                <form>
                    <h1 class="mb-3" style="display:block ">
                        Employee's Register
                    </h1>
                    <hr class="mb-4" />
                    <h5 class="mb-3">Work Details</h5>
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <span class="col-md-6 mb-2">
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
                                <span class="col-md-6 mb-2">
                                    <label>Salary:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.salary"
                                        required
                                    />
                                    <div class="invalid-feedback">
                                        Please enter salary
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
                                <span class="col-md-6 mb-2">
                                    <label>Work Status:</label>
                                    <select
                                        class="custom-select d-block w-100"
                                        v-model="input.status"
                                        required
                                    >
                                        <option value>Choose</option>
                                        <option>Active.</option>
                                        <option>Left.</option>
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
                                <span class="col-md-4 ">
                                    <label>Gender:</label>
                                    <br />
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="inlineRadioOptions"
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
                                            name="inlineRadioOptions"
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
                                            name="inlineRadioOptions"
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
                                        <option value>Choose</option>
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
                        </div>
                    </form>

                    <hr class="mb-4" />
                    <h5 class="mb-3">Educations History</h5>

                    <form>
                        <div
                            class="form-group"
                            v-for="(edu, counter) in edus"
                            :key="counter"
                        >
                            <div class="row">
                                <di class="col-md-12 mb-2">
                                    <label>Degree:</label>
                                    <select
                                        class="custom-select d-block w-100"
                                        v-model="edu.degree"
                                    >
                                        <option value>Choose</option>
                                        <option>Bachelor's degree</option>
                                        <option>Master's degree</option>
                                        <option>Doctoral degree</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please choose
                                    </div>
                                </di>
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
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label>Faculty:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="edu.faculty"
                                    />
                                    <div class="invalid-feedback">
                                        Faculty is required.
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Department:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="edu.department"
                                    />
                                    <div class="invalid-feedback">
                                        Department is required.
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter
                                    </div>
                                </div>
                            </div>
                            <div class="btn">
                                <i
                                    class="fas fa-minus-circle"
                                    @click="removeedu(counter)"
                                    v-show="
                                        counter || (!counter && edus.length > 1)
                                    "
                                    >DELETE</i
                                >
                                <i
                                    class="fas fa-plus-circle"
                                    @click="addedu(counter)"
                                    v-show="counter == edus.length - 1"
                                    >ADD</i
                                >
                            </div>
                        </div>
                    </form>

                    <hr class="mb-4" />
                    <h5 class="mb-3">Disease info</h5>
                    <form
                        class="form-group"
                        v-for="(disease, k) in diseases"
                        :key="k"
                    >
                        <div>
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
                            <div class="btn">
                                <i
                                    class="fas fa-minus-circle"
                                    @click="remove(k)"
                                    v-show="k || (!k && diseases.length > 1)"
                                    >DELETE</i
                                >
                                <i
                                    class="fas fa-plus-circle"
                                    @click="add(k)"
                                    v-show="k == diseases.length - 1"
                                    >ADD</i
                                >
                            </div>
                        </div>
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
    name: "register_emp",
    data() {
        return {
            input: {
                start_date: "",
                salary: "",
                airport: "",
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
                phone: ""
            },
            edus: [
                {
                    degree: "",
                    university: "",
                    faculty: "",
                    department: ""
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
            this.edu.push([]);
        },
        removeedu(index) {
            this.edu.splice(index, 1);
        },
        add(index) {
            this.disease.push([]);
        },
        remove(index) {
            this.disease.splice(index, 1);
        }
    }
};
</script>

<style></style>
