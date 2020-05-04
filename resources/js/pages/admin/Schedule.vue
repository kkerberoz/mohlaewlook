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
            <span v-for="(data, i) in selected" :key="i">{{ data.date }}</span>
          </div>
          <div></div>
          <functional-calendar
            v-on:choseDay="clickDay"
            class="calendar"
            v-model="calendar"
            :is-multiple-date-picker="true"
            :is-dark="true"
            
          ></functional-calendar>
          <highlight-code
            lang="html"
            code="<functional-calendar :is-dark='true'></functional-calendar>"
          ></highlight-code>
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
      calendar: {}
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
