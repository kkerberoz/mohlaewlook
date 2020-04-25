<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 full-height">
                <div class="title ">Welcome : {{ user.username }}</div>
                <div class="title">role :{{ user.employee_role }}</div>
            </div>
            <div class="col-md-12">
                <div class="title flex-center full-height">Created by</div>

                <div class="content m-b-md">mohlaewlook group</div>
            </div>
            <div class="col-md-12">
                <div class="title flex-center full-height">
                    Example Component
                </div>
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
        axios.get("/api/admin/init").then(response => {
            this.user = response.data;
        });
    }
};
</script>
