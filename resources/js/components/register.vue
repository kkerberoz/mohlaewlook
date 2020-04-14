<template>
    <div class="container">
        <div class="row flex-center full-height">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info">
                        Register
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Username:</label>
                            <input type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Titile</label>
                            <select class="form-control">
                                <option>Mrs.</option>
                                <option>Ms.</option>
                                <option>Mr.</option>
                                <option>Miss</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Surname:</label>
                            <input type="text" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>DOB:</label>
                            <input type="date" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <input
                            type="button"
                            class="btn btn-block"
                            value="Sign up"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted(){
        console.log("OK");
    }
}
</script>
