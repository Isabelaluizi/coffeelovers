<template>
  <div id="user-page-container">
    <img src="/images/userPage.jpg" class="rounded mx-auto d-block img-fluid" />
    <div class="container">
      <h1 id="greeting-user" class="text-center">Hi, {{auth.name}}</h1>
      <h5 class="text-center">We are very happy to have you here.</h5>
      <div class="row justify-content-center justify-content-xl-center">
        <div class="shadow-lg p-3 mb-5 bg-white rounded col-xl-7 col-11" id="form-add-coffee">
          <h5 class="text-center">Please, send us a new coffee.</h5>
          <div v-if="this.userMessage!=''" class="text-center alert alert-info" role="alert">
            <h6 class="text-center">{{this.userMessage}}</h6>
          </div>
          <div class="form-group">
            <input
              class="form-control"
              type="text"
              placeholder="Coffee's name"
              v-model="coffeeName"
            />
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="City" type="text" v-model="coffeeCity" />
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Country" type="text" v-model="coffeeCountry" />
          </div>
          <div class="input-group">
            <div class="custom-file">
              <input
                type="file"
                name="file"
                ref="file"
                id="file"
                class="custom-file-input"
                accept=".jpg, .png, .gif"
              />
              <label class="custom-file-label" for="file">Select a file to upload</label>
            </div>
          </div>
          <div class="text-center" id="button-submit-coffee">
            <button type="button" class="btn btn-outline-dark" @click="storeCoffee()">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Userprofile",
  props: {
    auth: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      coffeeName: "",
      coffeeCity: "",
      coffeeCountry: "",
      file: null,
      userMessage: ""
    };
  },
  methods: {
    storeCoffee() {
      if (
        confirm(
          "Thank you for your contribution.\nClick OK to confirm your submition."
        )
      ) {
        if (this.coffeeName == "") {
          this.coffeeName = "N/D";
        }
        if (this.coffeeCity == "") {
          this.coffeeCity = "N/D";
        }
        if (this.coffeeCountry == "") {
          this.coffeeCountry = "N/D";
        }
        this.file = this.$refs.file.files[0];
        let formData = new FormData();
        formData.append("file", this.file);
        formData.append("coffeeName", this.coffeeName);
        formData.append("coffeeCity", this.coffeeCity);
        formData.append("coffeeCountry", this.coffeeCountry);
        axios
          .post("/storeCoffeeDB", formData, {
            header: { "Content-Type": "multipart/form-data" }
          })
          .then(response => {
            this.userMessage = response.data;
          })
          .catch(error => {
            console.log("Error checking user");
          });
      }
    }
  }
};
</script>

<style scoped>
#user-page-container {
  margin-top: 0;
  padding-top: 0;
}
#greeting-user {
  color: #7a2e20;
  margin-top: 1vh;
}
#button-submit-coffee {
  margin-top: 1vh;
  margin-bottom: 2vh;
}
#form-add-coffee {
  margin-top: 3vh;
}
</style>

