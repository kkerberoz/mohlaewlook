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
            <div class="row flex-center ">
                <div class="col-md-12 " style="padding:10px">
                    <div class="card shadow-lg bg-white">
                        <div class="card-header" style="border-radius: 0px;">
                            <div class="card-title">
                                Analysis 1
                            </div>
                            <div class="card-subtitle mb-2">
                                สวัสดีครับ
                            </div>
                        </div>
                        <div class="card-body">
                            <span class="col-md-4 mb-2">
                                <label>Year :</label>

                                <multiselect
                                    v-model="selected"
                                    label="year"
                                    @input="queryAnalyssis"
                                    :options="years"
                                    :searchable="true"
                                    :multiple="false"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    placeholder="Choose Year"
                                ></multiselect>
                            </span>
                            <div class="table-responsive" v-show="showTotal">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Flight Number</th>
                                            <th scope="col">Count</th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        v-for="(flight, id) in data"
                                        :key="id"
                                    >
                                        <tr>
                                            <th scope="row">
                                                {{ Number(id) + 1 }}
                                            </th>
                                            <td>{{ flight.flight_no }}</td>
                                            <td>
                                                {{ flight.flight_no_count }}
                                            </td>
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
import Multiselect from "vue-multiselect";
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
    components: { Multiselect, Loading },
    data() {
        return {
            loadingPage: false,
            fullPage: true,
            showTotal: false,
            sum: 0,
            selected: "",
            years: [],
            data: []
        };
    },
    methods: {
        queryAnalyssis() {
            if (this.selected == null) {
                this.loadingPage = true;
                setTimeout(() => {
                    this.loadingPage = false;
                }, 500);
                this.showTotal = false;
            } else {
                this.loadingPage = true;
                var year = this.selected;
                this.sum = 0;
                this.showTotal = true;
                axios
                    .post("/api/backend/analytic1_show", year)
                    .then(response => {
                        this.data = response.data.analysis;
                        this.data.forEach(each_data => {
                            this.sum += each_data["flight_no_count"];
                        });
                        this.loadingPage = false;
                        // console.log(this.data);
                    })
                    .catch(error => {
                        this.showTotal = false;
                        swal.fire(
                            "Error.",
                            "Cilck the button to continue!",
                            "error"
                        );
                    });
            }
        }
    },
    beforeMount() {
        this.loadingPage = true;
        this.sum = 0;
        var year = this.selected;
        axios.post("/api/backend/analytic1_show", year).then(response => {
            this.data = response.data.analysis;
            this.selected = [{ year: response.data.year }];
            console.log(this.selected);
            console.log(response.data);
            this.showTotal = true;
            this.data.forEach(each_data => {
                this.sum += each_data["flight_no_count"];
            });
            this.loadingPage = false;
        });
        axios.get("/api/backend/analytic1_get").then(response => {
            this.years = response.data;
        });
    }
};
</script>

<style>
.card-subtitle {
    font-family: "Kanit", sans-serif;
    font-size: 20px;
    color: #fff;
}
</style>
