<template>
    <div class="container xl" style="padding:3%">
        <input type="hidden" name="_token" v-bind:value="csrf" />
        <br />
        <div>
            <div class="card">
                <div class="card-header bg-info">
                    <h2>Customer list</h2>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">FirstName</th>
                                <th scope="col">LastName</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["csrf", "oldName"],
    data() {
        return {};
    },
    mounted() {
        axios.get("/sanctum/csrf-cookie").then(response => {
            axios.get("api/user/getCustomer").then(response => {
                console.log(response.data);
            });
        });
    }
};
</script>
