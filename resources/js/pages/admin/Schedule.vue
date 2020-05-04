<template>
    <div class="container-fulid">
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            :opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <div class="container-xl">
            <h1>Work Schedule</h1>
            <hr class="mb-4 mt-4" />
            <div class="row flex-center">
                <div class="col-md-6">
                    <div>
                        <span v-for="(data, i) in selected" :key="i">
                            {{ data.date }}
                        </span>
                    </div>

                    <functional-calendar
                        v-on:choseDay="clickDay"
                        class="calendar"
                        v-model="calendar"
                        :configs="calendarConfigs"
                    ></functional-calendar>
                </div>
                <button type="submit" @click="submit" class="btn btn-success">
                    <span>Submit free day</span>
                </button>
            </div>
            <hr class="mb-4 mt-4" />
        </div>

        <div class="container-xl" style="margin-top:2%;margin-bottom:10%">
            <div class="row-reservation">
                <div class="column" v-for="(showWork, i) in works" :key="i">
                    <div class="card-reservation">
                        <h4>Flight Number: {{ showWork.flight_no }}</h4>
                        <h5>
                            Depart: {{ showWork.depart_location }}-{{
                                showWork.depart_datetime
                            }}
                        </h5>
                        <h5>
                            Arrive: {{ showWork.arrive_location }}-{{
                                showWork.arrive_datetime
                            }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { FunctionalCalendar } from "vue-functional-calendar";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
    components: { FunctionalCalendar, Loading },
    data() {
        return {
            loadingPage: false,
            fullPage: true,
            works: [],
            showWork: [],
            data: [],
            id: "",
            selected: [],
            datePick: [],
            calendar: {},
            calendarConfigs: {
                disabledDates: ["beforeToday"],
                isMultipleDatePicker: true,
                markedDates: []
            }
        };
    },
    methods: {
        clickDay() {
            this.selected = this.calendar.selectedDates;
            // console.log(this.selected);
            // console.log(this.calendar.selectedDates);
        },
        submit() {
            console.log("!!!!!!!!!!!!!!!!!");

            let data = {
                id: this.id,
                array_date: this.selected
            };
            axios.post("/api/backend/addNewWork", data).then(response => {
                console.log(response.data);
                this.loadingPage = false;
            });
        }
    },
    beforeMount() {
        this.loadingPage = true;
        axios.get("/api/admin/init").then(response => {
            this.id = response.data.id;
            axios
                .post("/api/backend/getflightdetail", { id: this.id })
                .then(response => {
                    this.works = response.data;
                    console.log(response.data);
                });

            axios
                .get(`/api/backend/schedule/${this.id}`)
                .then(response => {
                    //console.log(response.data);

                    response.data.forEach(each_day => {
                        var Sdate = each_day["work_date"].split("-");
                        var newDate =
                            Number(Sdate[2]) +
                            "/" +
                            Number(Sdate[1]) +
                            "/" +
                            Sdate[0];
                        if (each_day["confirm_status"] == "confirm") {
                            this.calendarConfigs.markedDates.push({
                                date: newDate,
                                class: "green-line"
                            });
                        } else if (each_day["confirm_status"] == "free") {
                            //console.log(newDate);
                            this.calendarConfigs.markedDates.push({
                                date: newDate,
                                class: "grey-line"
                            });
                        }
                    });
                    this.loadingPage = false;
                })
                .catch(error => {
                    this.loadingPage = false;
                });
        });
    }
};
</script>

<style lang="scss">
* {
    box-sizing: border-box;
}
/* Float four columns side by side */
.column {
    float: left;
    width: 50%;
    padding: 0 10px;
    margin-top: 10px;
}

/* Remove extra left and right margins, due to padding */
.row-reservation {
    margin: 0 -5px;
}

/* Clear floats after the columns */
.row-reservation:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
    .column {
        width: 100%;
        display: block;
        margin-bottom: 20px;
    }
}

/* Style the counter cards */
.card-reservation {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    padding: 16px;
    text-align: center;
    color: #fff;
    background-color: #f79c65;
}
.green-line {
    width: 30px;
    line-height: 30px;
    color: #ffffff;
    background-color: #45cc0d;
    border-radius: 100%;
    margin: 0 auto;
}

.grey-line {
    width: 30px;
    line-height: 30px;
    color: #ffffff;
    background-color: #a9a9a9;
    border-radius: 100%;
    margin: 0 auto;
}

.green-point {
    position: absolute;
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background-color: #45cc0d;
    bottom: 3px;
    left: calc(50% - 4px);
}

.orange-point {
    position: absolute;
    width: 4px;
    height: 4px;
    border-radius: 50%;
    background-color: #ebae05;
    bottom: 3px;
    left: calc(50% - 4px);
}
</style>
