<template>
    <div class="container-xl" style="padding:3%">
        <loading
            :active.sync="loadingPage"
            :can-cancel="false"
            :is-full-page="fullPage"
            :opacity="0.9"
            color="#f87a2b"
            loader="bars"
            background-color="#fff"
        ></loading>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="title flex-center full-height">
                    Logged in as: {{ user.username }}
                </div>

                <div class="flex-center title m-b-md">info</div>
            </div>
            <div class="col-md-12">
                <div class="title flex-center full-height">Created by</div>

                <div class="content m-b-md">mohlaewlook group</div>
            </div>
            <div class="col-md-12">
                <div class="title flex-center full-height">
                    Example Component
                </div>

                <div class="content m-b-md">I'm an example component.</div>
            </div>
            <div class="col-md-12">
                <div class="title flex-center full-height">info</div>

                <div class="flex-center title m-b-md">info</div>
            </div>
            <div class="col-md-12">
                <div class="title flex-center full-height">
                    Example Component
                </div>

                <div class="content m-b-md">I'm an example component.</div>
            </div>
            <div class="col-md-12">
                <div class="title flex-center full-height">
                    Example Component
                </div>

                <div class="content m-b-md">I'm an example component.</div>
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
        axios
            .get("/api/user")
            .then(response => {
                this.user = response.data;
                this.loadingPage = false;
            })
            .catch(error => {
                this.loadingPage = false;
                if (error.response.status === 401) {
                    swal.fire(
                        "Please log in.",
                        "Cilck the button to continue!",
                        "error"
                    ).then(() => {
                        axios.get("/sanctum/csrf-cookie").then(response => {
                            axios.post("/api/user/logout").then(() => {
                                localStorage.removeItem("isLoggedIn");
                                this.$router.go({ name: "userLogin" });
                            });
                        });
                    });
                }
            });
    }
};
</script>
