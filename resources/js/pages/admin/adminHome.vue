<template>
    <div class="container-fluid ">
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
export default {
    data() {
        return {
            user: ""
        };
    },
    beforeMount() {
        axios.get("/api/admin/init").then(response => {
            this.user = response.data;
        });
    }
};
</script>
<style></style>
