<template>
  <div class="container-fluid" style="padding:3%">
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
      <div class="row flex-center">
        <div class="col-md-12">
          <div class="card shadow-lg bg-white">
            <div class="card-header" style="border-radius: 0px;">
              <div class="card-title">Seat Level</div>
              <div class="card-subtitle mb-2">จำนวนการเข้าใช้บริการในแต่ละระดับที่นั่ง</div>
            </div>
            <div class="card-body">
              <div class="row flex-center">
                <div class="col-md-4 mb-4">
                  <label>
                    From :
                    {{
                    this.calendar_from.selectedDate
                    }}
                  </label>
                  <functional-calendar
                    v-on:choseDay="clickDay"
                    class="calendar"
                    v-model="calendar_from"
                    :configs="calendarConfigs"
                  ></functional-calendar>
                </div>
                <div class="col-md-4 mb-4">
                  <label>
                    To :
                    {{
                    this.calendar_to.selectedDate
                    }}
                  </label>
                  <functional-calendar
                    v-on:choseDay="clickDay"
                    class="calendar"
                    v-model="calendar_to"
                    :configs="calendarConfigs2"
                  ></functional-calendar>
                </div>
              </div>

              <div class="table-responsive" style="padding:10px" v-show="showTotal">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Class</th>
                      <th scope="col">Count</th>
                    </tr>
                  </thead>
                  <tbody v-for="(flight, id) in data" :key="id">
                    <tr>
                      <th scope="row">{{ Number(id) + 1 }}</th>
                      <td>{{ flight.class_name }}</td>
                      <td>{{ flight.class_count }}</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td>&nbsp;</td>
                      <td>Total</td>
                      <td>{{ sum }}</td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
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
import Multiselect from "vue-multiselect";
export default {
  components: { Multiselect, FunctionalCalendar, Loading },
  data() {
    return {
      loadingPage: false,
      fullPage: true,
      showTotal: false,
      data: [],
      calendar_from: {},
      calendar_to: {},
      sum: 0,
      calendarConfigs: {
        isDatePicker: true,
        dateFormat: "yyyy-mm-dd 00:00:00"
      },
      calendarConfigs2: {
        isDatePicker: true,
        dateFormat: "yyyy-mm-dd 23:59:59"
      }
    };
  },
  beforeMount() {
    this.loadingPage = true;
    setTimeout(() => {
      this.loadingPage = false;
    }, 2000);
  },
  methods: {
    clickDay() {
      if (!this.calendar_from.selectedDate) {
        this.loadingPage = false;
        this.showTotal = false;
        swal.fire(
          "Please Selete start day first",
          "Cilck the button to continue!",
          "warning"
        );
      } else if (
        this.calendar_from.selectedDate &&
        this.calendar_to.selectedDate
      ) {
        this.loadingPage = true;
        this.sum = 0;
        let scope = {
          first: this.calendar_from.selectedDate,
          second: this.calendar_to.selectedDate
        };
        axios
          .post("/api/backend/analytic2_show", scope)
          .then(response => {
            this.showTotal = true;
            this.data = response.data;
            console.log(this.data);
            this.data.forEach(each_data => {
              this.sum += each_data["class_count"];
            });
            this.loadingPage = false;
          })
          .catch(error => {
            this.loadingPage = false;
            this.showTotal = false;
            swal.fire("Error.", "Cilck the button to continue!", "error");
          });
      }
    }
  }
};
</script>

<style></style>
