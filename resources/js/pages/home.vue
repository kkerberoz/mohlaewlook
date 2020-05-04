<template>
    <div class="container-fluid reservation">
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            :opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <div class="container-xl" style="padding:20px">
            <div class="row flex-center full-height">
                <img
                    src="/assets/undraw_air_support_wy1q.svg"
                    alt="Monkey face"
                    style="width: 100%; height: auto;  max-width:900px"
                    class="center"
                />
                <!-- <img
                    src="/assets/undraw_aircraft_fbvl.svg"
                    alt="Monkey face"
                    style="width:100%; height: auto; max-width:500px"
                    class="float-left"
        />-->

                <div class="col-md-12 center">
                    <h1
                        style="font-size:7vw;color:#fff ; text-shadow: 2px 2px 10px rgba(150, 150, 150, 1);"
                        class="flex-center font-weight-bold"
                    >
                        Welcome To
                        <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        Mohlaewlook
                    </h1>
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
        return { loadingPage: false, fullPage: true };
    },
    beforeMount() {
        this.loadingPage = true;
        setTimeout(() => {
            this.loadingPage = false;
        }, 2000);
    }
};
</script>
<style>
.reservation {
    /* background-color: #4bb4de; */
    background: #ff7e5f;
    background: -webkit-linear-gradient(to left, #feb47b, #ff7e5f);
    background: linear-gradient(to left, #feb47b, #ff7e5f);

    /* background: #ff512f;
    background: -webkit-linear-gradient(to right, #f09819, #ff512f);
    background: linear-gradient(to right, #f09819, #ff512f); */
}
</style>
