<template>
  <div class="col-12">
    <div class="container">
      <div
        class="row justify-content-xl-start shadow-lg p-3 mb-5 bg-white rounded"
        id="row-comment"
      >
        <div class="col-7 col-xl-2">
          <h5>{{comment.nickname}}</h5>
        </div>
        <div class="col-5 col-xl-2">
          <star-rating
            :rating="stars(comment.stars)"
            :read-only="true"
            :increment="0.5"
            :star-size="20"
            :show-rating="false"
          ></star-rating>
        </div>
        <div class="col-12 col-xl-12 text-center align-self-center">
          <h5>{{comment.content}}</h5>
        </div>
        <div class="col-12 col-xl-12 text-right">
          <p>{{this.date}}</p>
        </div>
        <div class="col-12 col-xl-12 text-center">
          <button
            class="btn btn-light"
            id="button-delete"
            role="button"
            v-if="this.isUser"
            @click="confirmDelete()"
          >
            <i class="fas fa-trash-alt"></i> Delete
          </button>
        </div>
        <div
          v-if="this.confirmation"
          class="alert alert-danger col-12 col-xl-12 text-center"
          role="alert"
          id="alert-delete"
        >
          <p>Are you sure you want to delete this comment?</p>
          <button type="button" class="btn btn-outline-danger btn-sm" @click="clickedYes()">Yes</button>
          <button type="button" class="btn btn-outline-danger btn-sm" @click="clickedNo()">No</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
var moment = require("moment");
export default {
  name: "Comment",
  props: {
    comment: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      date: "",
      isUser: false,
      confirmation: false,
      confirmed: false
    };
  },
  methods: {
    stars(stars) {
      return parseFloat(stars);
    },
    confirmDelete() {
      this.confirmation = true;
    },
    clickedYes() {
      axios
        .post("/deleteComment", {
          commentId: this.comment.id,
          userId: this.comment.user_id
        })
        .then(response => {
          console.log(response.data);
        })
        .catch(error => {
          console.log("Error checking user");
        });
    },
    clickedNo() {
      this.confirmation = false;
    }
  },
  mounted() {
    this.date = moment.parseZone(this.comment.created_at).fromNow();
    axios
      .post("/checkUserComment", { userId: this.comment.user_id })
      .then(response => {
        this.isUser = response.data;
      })
      .catch(error => {
        console.log("Error checking user");
      });
  }
};
</script>

<style scoped>
#alert-delete {
  margin-top: 1vh;
}
</style>
