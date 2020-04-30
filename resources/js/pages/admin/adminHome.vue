<template>
    <div class="container-fluid ">
        <div class="container-xl">
            <div class="row full-height ">
                <img
                    src="/assets/undraw_journey_lwlj.svg"
                    alt="Monkey face"
                    style="width:100%;  max-width: 80%;height: auto; "
                    class=" center"
                />
                <div class="col-md-12 centerWithText" style="color:#ff7e5f">
                    <div class="card">
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
    mounted() {
        axios.get("/api/admin/init").then(response => {
            this.user = response.data;
        });
    }
};
</script>
<style></style>
