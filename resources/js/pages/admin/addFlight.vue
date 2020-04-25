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
                                <span class="col-md-6 mb-2">
                                    <label>Aircraft ID:</label>
                                    <multiselect
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
                            <div class="row">
                                <span class="col-md-4 mb-2">
                                    <label>Depart Location:</label>
                                    <multiselect
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
                            <hr class="mb-4" />
                            <h5 class="mb-3">Crew Details</h5>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Captain:</label>
                                        <multiselect
                                            v-model="input.captain"
                                            :options="options"
                                            :searchable="true"
                                            :multiple="false"
                                            :close-on-select="true"
                                            :clear-on-select="false"
                                            :preserve-search="true"
                                            placeholder="Choose"
                                            label="name"
                                            :custom-label="nameWithId"
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
                                        :options="options"
                                        :searchable="true"
                                        :multiple="false"
                                        :close-on-select="true"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        placeholder="Choose"
                                        label="name"
                                        :custom-label="nameWithId"
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
                                            >Avaliable flight adtendant</label
                                        >
                                        <multiselect
                                            v-model="input.crew"
                                            :options="options"
                                            :searchable="true"
                                            :multiple="true"
                                            :close-on-select="false"
                                            :clear-on-select="false"
                                            :preserve-search="true"
                                            placeholder="Choose"
                                            label="name"
                                            :custom-label="nameWithId"
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
                    >
                        Add Flight
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
            input: {
                aircraftID: "",
                flightNo: "",
                departLocation: "",
                departDate: "",
                departTime: "",
                arriveLocation: "",
                arriveDate: "",
                arriveTime: "",
                captain: "",
                coPilot: "",
                crew: []
            },
            options: [
                { id: "1", name: "Boss" },
                { id: "2", name: "Rat" },
                { id: "3", name: "Dive" },
                { id: "4", name: "Jane" },
                { id: "5", name: "O" },
                { id: "6", name: "Pan" },
                { id: "7", name: "Cake" },
                { id: "8", name: "Min" },
                { id: "9", name: "Cream" },
                { id: "10", name: "Jo" },
                { id: "11", name: "Oh" }
            ],
            aircrafts: ["GGF1151", " GGF1152", "GGF1153", "GGF1154"],
            locations: ["Swiss", " Germany", "Thailand", "Kanchanaburi"]
        };
    },
    methods: {
        nameWithId({ name, id }) {
            return `[${id}] - ${name}  `;
        }
    }
};
</script>

<style></style>
