<template>
    <div class="container-fluid" style="padding:3%; margin-bottom:10%">
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <div class="container-xl">
            <div class="row flex-center ">
                <div class="col-md-12 ">
                    <div class="card shadow-lg bg-white">
                        <div class="card-header" style="border-radius: 0px;">
                            <div class="card-title">
                                Analysis 4
                            </div>
                            <div class="card-subtitle mb-2">
                                สวัสดีครับ
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <span class="col-md-6 mb-2">
                                    <label>Form :{{ selectForm }}</label>

                                    <multiselect
                                        v-model="selectForm"
                                        :options="years"
                                        :searchable="true"
                                        :multiple="false"
                                        :close-on-select="true"
                                        :clear-on-select="false"
                                        placeholder="Choose Year"
                                    ></multiselect>
                                </span>

                                <span class="col-md-6 mb-2">
                                    <label>To :{{ selectTo }}</label>

                                    <multiselect
                                        v-model="selectTo"
                                        @close="Analysis4"
                                        :options="years"
                                        :searchable="true"
                                        :multiple="false"
                                        :close-on-select="true"
                                        :clear-on-select="false"
                                        placeholder="Choose Year"
                                    ></multiselect>
                                </span>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">year</th>
                                            <th scope="col">Male</th>
                                            <th scope="col">Female</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody
                                        v-for="(value, id) in values"
                                        :key="id"
                                    >
                                        <tr>
                                            <th scope="row">
                                                {{ value.year }}
                                            </th>
                                            <td>{{ value.male }}</td>
                                            <td>{{ value.female }}</td>
                                            <td>
                                                {{
                                                    Number(value.male) +
                                                        Number(value.female)
                                                }}
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
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
    components: { Multiselect, Loading },
    data() {
        return {
            loadingPage: false,
            fullPage: true,
            selectForm: "",
            selectTo: "",
            start: null,
            end: null,
            values: []
        };
    },
    computed: {
        years() {
            const year = new Date().getFullYear();
            return Array.from(
                { length: year - 2000 },
                (value, index) => 2001 + index
            );
        }
    },
    methods: {
        Analysis4() {
            this.loadingPage = true;
            console.log("form", this.selectForm);
            console.log("to", this.selectTo);
            // simulate
            this.start = this.selectForm;
            this.end = this.selectTo;

            axios
                .post("/api/backend/analytic4", {
                    start: this.start,
                    end: this.end
                })
                .then(response => {
                    // this.males = response.data.Male;
                    // console.log(response.data);
                    this.values = response.data.value;
                    this.loadingPage = false;
                    // this.females = response.data.Female;
                });
        }
    },
    beforeMount() {
        this.loadingPage = true;
        setTimeout(() => {
            this.loadingPage = false;
        }, 2000);
        // axios.get("/api/backend/analytic1_get").then(response => {
        //     this.years = response.data;
        // });
    }
};
</script>

<style></style>
