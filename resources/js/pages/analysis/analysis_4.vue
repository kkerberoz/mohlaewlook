<template>
    <div class="container-fluid" style="padding:3%">
        <div class="container-xl">
            <div class="row flex-center ">
                <div class="col-md-12 ">
                    <div class="card shadow-lg bg-white">
                        <div class="card-header" style="border-radius: 0px;">
                            <div class="card-title">
                                Analysis 4
                            </div>
                        </div>
                        <div class="card-body">
                            <span class="col-md-4 mb-2">
                                <label>Year :</label>

                                <multiselect
                                    v-model="selected"
                                    label="year"
                                    @close ="Analysis4"
                                    :options="years"
                                    :searchable="true"
                                    :multiple="false"
                                    :close-on-select="true"
                                    :clear-on-select="false"
                                    placeholder="Choose Year"
                                ></multiselect>
                            </span>
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
            start: null,
            end: null,
            years: [],
            male: [],
            female: [],
        };
    },
    methods: {
        Analysis4(){
            // simulate
            this.start = 2015;
            this.end = 2020;
            //
            axios.post("/api/backend/analytic4", {'start': this.start, 'end': this.end}).then(response => {
                console.log(response.data);
            });
        }
    },
    beforeMount(){
        axios.get("/api/backend/analytic1_get").then(response => {
            this.years = response.data;
        });
    }
};
</script>

<style></style>
