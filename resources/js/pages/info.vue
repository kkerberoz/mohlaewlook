<template>
    <div class="container-fulid" style="padding-top:7%;padding-bottom:10%;">
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            :opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <div class="container-xl" style="margin-top:5%;margin-bottom:5%;">
            <br />
            <h1>about us</h1>
            <hr class="mb-4 mt-4" />
            <div class="row flex-center">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">Mheey</div>
                        <div class="card-footer">
                            <img
                                src="/assets/Mheee.jpg"
                                alt="test"
                                style="width:100%;height: auto;"
                            />
                            Krittaphon Raksakul
                            <br />61070501003 <br />SECTION A
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">Bossy</div>
                        <div class="card-footer">
                            <img
                                src="/assets/Boss.jpg"
                                alt="test"
                                style="width:100%;height: auto;"
                            />
                            Narawit Wongnom
                            <br />61070501029 <br />SECTION A
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">Ratty</div>
                        <div class="card-footer">
                            <img
                                src="/assets/Ratty.jpg"
                                alt="test"
                                style="width:100%;height: 215px;"
                            />
                            Wasurat Chaiyapumsakul
                            <br />61070501049 <br />SECTION B
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">Divefy</div>
                        <div class="card-footer">
                            <img
                                src="/assets/Divee.jpg"
                                alt="test"
                                style="width:100%;height: auto;"
                            />
                            Kasidit Sang-Utai
                            <br />61070501057 <br />SECTION B
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mb-4 mt-4" />
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
            fullPage: true
        };
    },
    beforeMount() {
        this.loadingPage = true;
        setTimeout(() => {
            this.loadingPage = false;
        }, 1000);
    }
};
</script>
