<template>
    <div class="container-fluid" style="padding:3%">
        <div class="container-xl">
            <div class="row flex-center ">
                <div class="col-md-12 ">
                    <div class="card shadow-lg bg-white">
                        <div class="card-header" style="border-radius: 0px;">
                            <div class="card-title">
                                Analysis 1
                            </div>
                        </div>
                        <div class="card-body">
                            <span class="col-md-4 mb-2">
                                <label>Year :</label>

                                <multiselect
                                    v-model="selected"
                                    label="year"
                                    @select="queryAnalyssis"
                                    :options="years"
                                    :searchable="true"
                                    :multiple="false"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    placeholder="Choose Year"
                                ></multiselect>
                            </span>
                            <div class="table-responsive">
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
export default {
    components: { Multiselect },
    data() {
        return {
            selected: "",
            years: [],
            data: []
        };
    },
    methods: {
        queryAnalyssis() {
            var year = this.selected;
            axios
                .post("/api/backend/analytic1_show", year)
                .then(response => {
                    this.data = response.data;
                    console.log(this.data);
                })
                .catch(error => {
                    swal.fire(
                        "Error.",
                        "Cilck the button to continue!",
                        "error"
                    );
                });
        }
    },
    beforeMount() {
        swal.fire(
            "Please select year to show data",
            "Cilck the button to continue!",
            "warning"
        );
        axios.get("/api/backend/analytic1_get").then(response => {
            this.years = response.data;
        });
    }
};
</script>

<style></style>
