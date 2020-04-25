<template>
  <div class="container-fulid" style="margin-bottom:15%;margin-top:5%">
    <div class="row flex-center" style="margin-bottom:3%">
      <div class="col-md-7 order-md-1 justify-content-between align-items-center">
        <form>
          <h1 class="mb-3" style="display:block ">Add Airport</h1>
          <hr class="mb-4" />
          <h5 class="mb-3">Airport Details</h5>
          <div class="form-group">
            <div class="row">
              <div class="col-md-4 mb-2">
                <label>Airport ID:</label>
                <input type="text" class="form-control" v-model="input.airportID" />
                <div class="invalid-feedback">Please enter</div>
              </div>
              <div class="col-md-8 mb-2">
                <label>Airport Name:</label>
                <input type="text" class="form-control" v-model="input.airportName" />
                <div class="invalid-feedback">Please enter</div>
              </div>
            </div>
            <div class="row">
              <span class="col-md-5 mb-2">
                <label>Airport Capacity:</label>
                <input type="text" class="form-control" v-model="input.airportCap" />
                <div class="invalid-feedback">Please enter</div>
              </span>
              <span class="col-md-7 mb-2">
                <label>Airport Region:</label>
                <input type="text" class="form-control" v-model="input.airportRegion" />
                <div class="invalid-feedback">Please enter</div>
              </span>
            </div>
            <div class="row">
              <span class="col-md-12 mb-2">
                <label>Airport Address:</label>
                <input type="text" class="form-control" v-model="input.airportAddress" />
                <div class="invalid-feedback">Please enter</div>
              </span>
            </div>
          </div>
          <hr class="mb-4" />
          <button class="btn btn-primary btn-lg btn-block btn-login" @click="formSubmit">Add Airport</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      input: {
        airportID: "",
        airportName: "",
        airportCap: "",
        airportAddress: "",
        airportRegion: ""
      }
    };
  },
  methods: {
    formSubmit(e) {
      let data = {
        airportID: this.input.airportID,
        airportName: this.input.airportName,
        airportCap: this.input.airportCap,
        airportAddress: this.input.airportAddress,
        airportRegion: this.input.airportRegion
      };
      axios
        .post("/api/backend/addAirport", data)
        .then(response => {
          console.log(response.data);
          swal
            .fire(
              "Add data Success!",
              "Cilck the button to continue!",
              "success"
            )
            .then(() => {
              this.$router.push("/adminHome");
            });
        })
        .catch(error => {
          if (error.response.status === 409) {
            swal.fire(
              "Can't add you data",
              "Cilck the button to continue!",
              "error"
            );
          }
        });
    }
  }
};
</script>

<style></style>
