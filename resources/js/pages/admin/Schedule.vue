<template>
    <div class="container-fulid">
        <div class="container-xl">
            <div class="row flex-center">
                <div class="col-md-6">
                    <h4>Multiple Date Picker</h4>
                    <!-- <div
                        v-for="(selected, i) in calendar.selectedDates"
                        :key="i"
                    >
                        <h4>{{ selected.date }}</h4>
          </div>-->

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
            </div>
        </div>
    </div>
</template>

<script>
import { FunctionalCalendar } from "vue-functional-calendar";

export default {
    components: { FunctionalCalendar },
    data() {
        return {
            data: [],
            selected: [],
            datePick: [],
            calendar: {},
            calendarConfigs: {
                disabledDates: ["beforeToday"],
                isMultipleDatePicker: true,
                markedDates: [
                    { date: "10/5/2020", class: "green-line" },
                    { date: "12/5/2020", class: "green-line" }
                ]
            }
        };
    },
    methods: {
        clickDay() {
            this.selected = this.calendar.selectedDates;
        }
    }
};
</script>

<style lang="scss">
.green-line {
    width: 30px;
    line-height: 30px;
    color: #ffffff;
    background-color: #45cc0d;
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
