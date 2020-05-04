<template>
    <div class="container mt-5 mb-5">
        <div class="row row-eq-height">
            <div class="col-md-12 mb-5">
                <h1>VueJS Functional Calendar</h1>
                <h5>
                    Developed By
                    <a href="https://github.com/ManukMinasyan"
                        >Manuk Minasyan (GitHub)</a
                    >
                </h5>
            </div>
            <div class="col-md-4">
                <h4>Sample Calendar</h4>
                <h5>...</h5>
                <functional-calendar class="calendar"></functional-calendar>
                <highlight-code
                    lang="html"
                    code="<functional-calendar :configs='{}'></functional-calendar>"
                ></highlight-code>
            </div>
            <div class="col-md-4">
                <h4>Dark theme</h4>
                <h5>...</h5>
                <functional-calendar
                    :change-month-function="true"
                    :change-year-function="true"
                    :is-date-range="true"
                    :is-dark="true"
                    class="calendar"
                ></functional-calendar>
                <highlight-code
                    lang="html"
                    code="<functional-calendar :is-dark='true'></functional-calendar>"
                ></highlight-code>
            </div>

            <div class="col-md-4">
                <h4>Date Picker</h4>
                <h5>...</h5>
                <functional-calendar
                    class="calendar"
                    v-model="calendar"
                    :is-date-picker="true"
                ></functional-calendar>
                <highlight-code
                    lang="html"
                    code="<functional-calendar :is-date-picker='true'></functional-calendar>"
                ></highlight-code>
            </div>

            <div class="col-md-4">
                <h4>Multiple Date Picker</h4>
                <h5>...</h5>
                <functional-calendar
                    class="calendar"
                    v-model="calendar"
                    :is-multiple-date-picker="true"
                ></functional-calendar>
                <highlight-code
                    lang="html"
                    code="<functional-calendar :is-multiple-date-picker='true'></functional-calendar>"
                ></highlight-code>
            </div>

            <div class="col-md-4">
                <h4>Multiple Date Picker With Time</h4>
                <h5>...</h5>
                <functional-calendar
                    class="calendar"
                    v-model="calendar"
                    :is-multiple-date-picker="true"
                    :with-time-picker="true"
                ></functional-calendar>
                <highlight-code
                    lang="html"
                    code="<functional-calendar :is-multiple-date-picker='true' :with-time-picker='true'></functional-calendar>"
                ></highlight-code>
            </div>

            <div class="col-md-12">
                <h4>Mutliple Calendars</h4>
                <functional-calendar
                    class="calendar multiple"
                    :is-date-range="true"
                    :is-multiple="true"
                    :calendars-count="2"
                ></functional-calendar>
                <highlight-code
                    lang="html"
                    code="<functional-calendar :is-multiple='true' :calendars-count='2' :is-date-range='true'></functional-calendar>"
                ></highlight-code>
            </div>
            <div class="col-md-12">
                <h4>API</h4>
                <div class="mb-5">
                    <button
                        class="btn btn-sm btn-primary m-1"
                        @click="preMonth"
                    >
                        Pre Month
                    </button>
                    <button
                        class="btn btn-sm btn-primary m-1"
                        @click="nextMonth"
                    >
                        Next Month
                    </button>
                    <button class="btn btn-sm btn-primary m-1" @click="preYear">
                        Pre Year
                    </button>
                    <button
                        class="btn btn-sm btn-primary m-1"
                        @click="nextYear"
                    >
                        Next Year
                    </button>
                    <button
                        class="btn btn-sm btn-primary m-1"
                        @click="chooseDate('31/06/2020')"
                    >
                        Change Date (31/06/2020)
                    </button>
                </div>
                <div class="col-md-6">
                    <functional-calendar
                        class="calendar multiple"
                        ref="Calendar"
                        :is-date-picker="true"
                    ></functional-calendar>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { FunctionalCalendar } from "vue-functional-calendar";

export default {
    name: "App",
    data() {
        return {
            calendar: {},
            data: {
                clieckedToday: false
            },
            markedDateRange: {
                start: "2/" + this.getCurrentMonth() + "/2020",
                end: "7/" + this.getCurrentMonth() + "/2020"
            },
            markedDates: [
                "16/" + this.getCurrentMonth() + "/2020",
                "18/" + this.getCurrentMonth() + "/2020",
                "20/" + this.getCurrentMonth() + "/2020",
                "21/" + this.getCurrentMonth() + "/2020"
            ]
        };
    },
    methods: {
        preMonth() {
            this.$refs.Calendar.PreMonth();
        },
        nextMonth() {
            this.$refs.Calendar.NextMonth();
        },
        preYear() {
            this.$refs.Calendar.PreYear();
        },
        nextYear() {
            this.$refs.Calendar.NextYear();
        },
        chooseDate(date) {
            this.$refs.Calendar.ChooseDate(date);
        },
        getCurrentMonth() {
            return new Date().getMonth() + 1;
        }
    },
    components: {
        FunctionalCalendar
    }
};
</script>

<style lang="scss">
.green-line {
    width: 15px;
    position: absolute;
    height: 2px;
    background-color: #45cc0d;
    bottom: 3px;
    left: calc(50% - 7.5px);
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
