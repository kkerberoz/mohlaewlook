<template>
    <div class="container-fluid " style="padding:20px">
        <div class="container-xl">
            <div class="row full-height ">
                <div class="col-md-12 centerWithText">
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
</template>
<script>
export default {
    data() {
        return {
            user: ""
        };
    },
    mounted() {
        axios.get("/api/admin/init").then(response => {
            this.user = response.data;
        });
    }
};
</script>
<style></style>
