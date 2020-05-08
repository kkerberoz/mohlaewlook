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
                    <!-- <div>
                        <span v-for="(data, i) in selected" :key="i">
                            {{ data.date }}
                        </span>
                    </div> -->

                    <functional-calendar
                        v-on:choseDay="clickDay"
                        class="calendar"
                        v-model="calendar"
                        :configs="calendarConfigs"
                    ></functional-calendar>
                </div>
                <div>
                    <span class="form-group">
                        <div>
                            <label>User ID</label>
                            <input
                                v-bind:class="{
                                    'is-invalid': error_user_id
                                }"
                                type="text"
                                class="form-control"
                                v-model="user_id"
                            />
                            <div class="invalid-feedback">
                                {{ error_user_id }}
                            </div>
                        </div>
                    </span>
                    <button
                        style="padding:20px;margin-top:10px"
                        type="submit"
                        :disabled="isLoading"
                        @click.prevent="submit"
                        class="btn btn-success"
                    >
                        <span v-show="!isLoading"
                            >&nbsp; Find work days &nbsp;</span
                        >
                        <i
                            class="fas fa-spinner fa-pulse"
                            v-show="isLoading"
                        ></i>
                    </button>
                </div>
            </div>
            <hr class="mb-4 mt-4" />
        </div>
        <div class="card-body">
            <div class="table-responsive" v-show="showTotal">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User_id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Work date</th>
                            <th scope="col">Flight ID</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action (cancel)</th>
                        </tr>
                    </thead>
                    <tbody v-for="(work, id) in works" :key="id">
                        <tr>
                            <th scope="row">{{ Number(id) + 1 }}</th>
                            <td>{{ work.user_id }}</td>
                            <td>{{ work.title }}</td>
                            <td>{{ work.name }}</td>
                            <td>{{ work.surname }}</td>
                            <td>{{ work.work_date }}</td>
                            <td>{{ work.flight_id }}</td>
                            <td>{{ work.confirm_status }}</td>
                            <td>
                                <button
                                    class="btn"
                                    @click="cancel(work.work_id)"
                                    style="color: Dodgerblue;"
                                >
                                    <i class="fas fa-window-close fa-2x"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
            showTotal: false,
            isLoading: false,
            loadingPage: false,
            fullPage: true,
            works: [],
            showWork: [],
            data: [],
            id: "",
            user_id: "",
            flights: [],
            selected: [],
            calendar: {},
            calendarConfigs: {
                isMultipleDatePicker: true,
                markedDates: []
            },
            error_user_id: "",
            error_date: ""
        };
    },

    methods: {
        clickDay() {
            this.selected = this.calendar.selectedDates;
        },
        cancel(work_id) {
            swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, change it!"
            }).then(result => {
                if (result.value) {
                    let data = { work_id: work_id };
                    axios
                        .post("/api/backend/updateWorkStatus", data)
                        .then(response => {
                            // console.log(response.data);
                            swal.fire(
                                "Status work has been cancelled",
                                "Cilck the button to continue!",
                                "success"
                            );
                        });
                } else {
                    swal.fire(
                        "Cancelled",
                        "Status work date has not changed.",
                        "error"
                    );
                }
            });
        },
        submit(e) {
            //console.log(this.user_id,this.selected);

            this.isLoading = true;
            if (this.selected.length || this.user_id) {
                e.preventDefault();
                let data = {
                    user_id: this.user_id,
                    array_date: this.selected
                };
                axios
                    .post("/api/backend/getworkday", data)
                    .then(response => {
                        this.works = response.data;
                        // console.log(this.works);
                        this.showTotal = true;
                        this.isLoading = false;
                    })
                    .catch(error => {
                        swal.fire(
                            "Some thing went wrong!",
                            "Cilck the button to continue!",
                            "warning"
                        );
                        this.isLoading = false;
                    });
            } else {
                this.isLoading = false;
                swal.fire(
                    "Please select date or user id before submit!",
                    "Cilck the button to continue!",
                    "warning"
                );
            }
        }
    }
    // beforeMount() {
    //     this.loadingPage = true;
    //     const today = new Date().toLocaleDateString();
    //     this.calendarConfigs.disabledDates.push(today);
    //     axios.get("/api/admin/init").then(response => {
    //         this.id = response.data.id;
    //         axios
    //             .post("/api/backend/getflightdetail", { id: this.id })
    //             .then(response => {
    //                 // console.log(response.data);
    //                 this.user_id = response.data[0];
    //                 this.works = response.data[1];
    //             });

    //         axios
    //             .get(`/api/backend/schedule/${this.id}`)
    //             .then(response => {
    //                 //console.log(response.data);

    //                 response.data.forEach(each_day => {
    //                     var Sdate = each_day["work_date"].split("-");
    //                     var newDate =
    //                         Number(Sdate[2]) +
    //                         "/" +
    //                         Number(Sdate[1]) +
    //                         "/" +
    //                         Sdate[0];

    //                     if (each_day["confirm_status"] == "confirm") {
    //                         this.calendarConfigs.markedDates.push({
    //                             date: newDate,
    //                             class: "green-line"
    //                         });
    //                         this.calendarConfigs.disabledDates.push(newDate);
    //                     } else if (each_day["confirm_status"] == "free") {
    //                         //console.log(newDate);
    //                         this.calendarConfigs.markedDates.push({
    //                             date: newDate,
    //                             class: "grey-line"
    //                         });
    //                         this.calendarConfigs.disabledDates.push(newDate);
    //                     }
    //                 });

    //                 this.loadingPage = false;
    //             })
    //             .catch(error => {
    //                 this.loadingPage = false;
    //             });
    //     });
    // }
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
