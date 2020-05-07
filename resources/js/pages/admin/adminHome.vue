<template>
    <div class="container-fluid full-height">
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            :opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <div class="container-xl" style="margin-top:10%;margin-bottom:10%">
            <h1 class="mb-3" style="display:block ">
                Dashboard
            </h1>
            <hr class="mb-4" />
            <div class="row flex-center">
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Customer</h6>
                            <h2 class="text-right mt-4">
                                <i class="fa fa-users f-left"></i>
                                <span>{{ count.user }}</span>
                            </h2>
                            <!-- <p class="m-b-0">
                                Available
                                <span class="f-right">351</span>
                            </p> -->
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-green order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Employee</h6>
                            <h2 class="text-right mt-4">
                                <i class="fa fa-user-tie f-left"></i>
                                <span>{{ count.employee }}</span>
                            </h2>
                            <!-- <p class="m-b-0">
                                Available
                                <span class="f-right">4,050</span>
                            </p> -->
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Airplane</h6>
                            <h2 class="text-right mt-4">
                                <i class="fa fa-plane f-left"></i>
                                <span>{{ count.aircraft }}</span>
                            </h2>
                            <!-- <p class="m-b-0">
                                Available
                                <span class="f-right">27</span>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row flex-center">
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Pilot</h6>
                            <h2 class="text-right mt-4">
                                <i class="fa fa-blind f-left"></i>
                                <span>{{ count.pilot }}</span>
                            </h2>
                            <!-- <p class="m-b-0">
                                Available
                                <span class="f-right">28</span>
                            </p> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Flight Attendant</h6>
                            <h2 class="text-right mt-4">
                                <i class="fa fa-blind f-left"></i>
                                <span>{{ count.air }}</span>
                            </h2>
                            <!-- <p class="m-b-0">
                                Available
                                <span class="f-right">28</span>
                            </p> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Staff</h6>
                            <h2 class="text-right mt-4">
                                <i class="fas fa-users-cog f-left"></i>
                                <span>{{ count.staff }}</span>
                            </h2>
                            <!-- <p class="m-b-0">
                                Available
                                <span class="f-right">28</span>
                            </p> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Airport</h6>
                            <h2 class="text-right mt-4">
                                <i class="fas fa-map-marked-alt f-left"></i>

                                <span>{{ count.airport }}</span>
                            </h2>
                            <!-- <p class="m-b-0">
                                Available
                                <span class="f-right">28</span>
                            </p> -->
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
            count: []
        };
    },
    // mounted() {
    //     this.loadingPage = true;
    //     setTimeout(() => {
    //         this.loadingPage = false;
    //     }, 1000);
    // },

    beforeMount() {
        this.loadingPage = true;
        axios
            .get("/api/backend/getCount")
            .then(response => {
                this.count = response.data;
                console.log(this.count);
                this.loadingPage = false;
            })
            .catch(error => {
                this.loadingPage = false;
            });
    }
};
</script>
<style>
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg, #4099ff, #59e0c5);
}

.bg-c-green {
    background: linear-gradient(45deg, #2ed8b6, #ffcb80);
}

.bg-c-yellow {
    background: linear-gradient(45deg, #ffb64d, #ff869a);
}

.bg-c-pink {
    background: linear-gradient(45deg, #ff5370, pink);
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
</style>
