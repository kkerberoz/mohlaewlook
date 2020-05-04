<template>
    <div class="container-fluid ">
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
            <div class="row full-height ">
                <div class="col-md-12 centerWithText" style="color:#ff7e5f ">
                    <div class="card ">
                        <div class="card-body">
                            <div style="font-size:5vw;">
                                Welcome : {{ user.username }}
                            </div>
                            <div style="font-size:5vw;">
                                Role :{{ user.employee_role }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
    components: { Loading },
    data() {
        return {
            loadingPage: false,
            fullPage: true,
            user: ""
        };
    },
    beforeMount() {
        this.loadingPage = true;
        axios.get("/api/admin/init").then(response => {
            this.user = response.data;
            this.loadingPage = false;
        });
    }
};
</script>
<style></style>
