<template>
  <div v-if="stars==0">
    <h6>
      <i>Be the first one to comment</i>
    </h6>
  </div>
  <div v-else>
    <star-rating
      :rating="stars"
      :read-only="true"
      :increment="0.5"
      :star-size="25"
      :show-rating="false"
    ></star-rating>
  </div>
</template>

<script>
export default {
  name: "Showstar",
  props: {
    coffeeId: {
      type: Number,
      required: true
    }
  },
  data() {
    return {
      stars: null
    };
  },
  mounted() {
    axios
      .post("/getStars", { coffeeId: this.coffeeId })
      .then(response => {
        this.stars = response.data;
        console.log(this.stars);
      })
      .catch(error => {
        console.log("Error getting stars");
      });
  }
};
</script>

<style scoped>
</style>
