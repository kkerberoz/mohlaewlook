<template>
    <div class="container">
        <div class="row flex-center full-height">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-info">
                        Login
                    </div>
                    <div class="card-body ">
                        <div class="form-group">
                            <label for="usr">Username:</label>
                            <input type="text" class="form-control" id="usr" />
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input
                                type="password"
                                class="form-control"
                                id="pwd"
                            />
                        </div>
                    </div>
                    <div class="card-footer">
                        <input
                            type="button"
                            class="btn btn-block"
                            value="Sign in"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
