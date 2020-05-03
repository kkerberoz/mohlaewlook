<template>
    <div class="container-xl" style="padding:3%">
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
export default {
    data() {
        return {
            user: ""
        };
    },
    mounted() {
        axios
            .get("/api/user")
            .then(response => {
                this.user = response.data;
            })
            .catch(error => {
                if (error.response.status === 401) {
                    swal.fire(
                        "Please log in.",
                        "Cilck the button to continue!",
                        "error"
                    ).then(() => {
                        this.$router.go({ name: "userLogin" });
                    });
                }
            });
    }
};
</script>
