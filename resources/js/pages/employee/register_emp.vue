<template>
  <div class="container-fluid">
    <div class="row flex-center full-height">
      <div class="col-md-8 order-md-1 justify-content-between align-items-center">
        <h2 class="mb-3" style="display:block">Employee Register</h2>
        <form>
          <div class="row">
            <div class="col-md-6 mb-2">
              <label>Username:</label>
              <div class="input-group">
                <input type="text" class="form-control" required />
                <div class="invalid-feedback" style="width: 100%;">Your username is required.</div>
              </div>
            </div>
            <div class="col-md-6 mb-2">
              <label>Password:</label>
              <input type="password" class="form-control" required />
              <div class="invalid-feedback">Please enter</div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 mb-2">
              <label for="state">Title:</label>
              <select class="custom-select d-block w-100" required>
                <option value>Choose</option>
                <option>Mrs.</option>
                <option>Ms.</option>
                <option>Mr.</option>
                <option>Miss</option>
              </select>
              <div class="invalid-feedback">Please choose</div>
            </div>
            <div class="col-md-5 mb-2">
              <label>First name:</label>
              <input type="text" class="form-control" required />
              <div class="invalid-feedback">Valid first name is required.</div>
            </div>
            <div class="col-md-5 mb-2">
              <label>Last name:</label>
              <input type="text" class="form-control" required />
              <div class="invalid-feedback">Valid last name is required.</div>
            </div>
          </div>

          <div class="mb-2">
            <span class="col-md-6 mb-2">
              <label>ID-Card:</label>
              <div class="input-group">
                <input type="text" class="form-control" required />
                <div class="invalid-feedback">Your id-card is required.</div>
              </div>
            </span>
          </div>
          <div class="row">
            <span class="col-md-4 mb-2">
              <label>DOB:</label>
              <input type="date" class="form-control" required />
              <div class="invalid-feedback">Please enter date</div>
            </span>
            <span class="col-md-4 mb-2">
              <label>Height:</label>
              <div class="input-group">
                <input type="text" class="form-control" required />
                <div class="invalid-feedback">plz enter height</div>
              </div>
            </span>
            <span class="col-md-4 mb-2">
              <label>Weight:</label>
              <div class="input-group">
                <input type="text" class="form-control" required />
                <div class="invalid-feedback">plz enter weight</div>
              </div>
            </span>
          </div>

          <div class="row">
            <span class="col-md-6 mb-2">
              <label>Email:</label>
              <div class="input-group">
                <input type="email" class="form-control" required />
                <div class="invalid-feedback">Your email is required.</div>
              </div>
            </span>
            <span class="col-md-6 mb-2">
              <label>Phone Number:</label>
              <input type="text" class="form-control" required />
              <div class="invalid-feedback">Please enter Phone</div>
            </span>
          </div>

          <hr class="mb-4" />
          <h5 class="mb-3">Work Details</h5>

          <div class="row">
            <span class="col-md-6 mb-2">
              <label>Start Date:</label>
              <div class="input-group">
                <input type="date" class="form-control" required />
                <div class="invalid-feedback">startdate required.</div>
              </div>
            </span>
            <span class="col-md-6 mb-2">
              <label>Salary:</label>
              <input type="text" class="form-control" required />
              <div class="invalid-feedback">Please enter salary</div>
            </span>
          </div>
          <div class="row">
            <span class="col-md-6 mb-2">
              <label>Airport:</label>
              <select class="custom-select d-block w-100" required>
                <option value>Choose</option>
                <option>Germany.</option>
                <option>Germany.</option>
                <option>Germany.</option>
                <option>Germany</option>
              </select>
              <div class="invalid-feedback">Please choose</div>
            </span>
            <span class="col-md-6 mb-2">
              <label>Work Status:</label>
              <select class="custom-select d-block w-100" required>
                <option value>Choose</option>
                <option>Active.</option>
                <option>Left.</option>
              </select>
              <div class="invalid-feedback">Please choose</div>
            </span>
          </div>

          <hr class="mb-4" />
          <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style></style>
