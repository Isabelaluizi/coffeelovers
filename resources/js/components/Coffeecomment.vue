<template>
  <div>
    <div v-if="!this.notComment" class="overlay-paper" @click="changenotComment()"></div>
    <div class="container" id="container-coffeecomment">
      <div class="row justify-content-center align-items-center">
        <div class="col-10 col-xl-4 col-md-4">
          <h5>
            <span class="change-color">
              <strong>Name:</strong>
            </span>
            {{coffee.name}}
          </h5>
          <h5>
            <span class="change-color">
              <strong>Location:</strong>
            </span>
            {{coffee.city}},{{coffee.country}}
          </h5>
          <Showstar :coffeeId="coffee.id" />
        </div>
        <div class="col-10 col-xl-2 col-md-2">
          <img :src="'/storage/' + coffee.picture" class="rounded mx-auto d-block img-fluid" />
        </div>
        <div class="col-12 col-xl-12 col-md-12 text-center">
          <button
            class="btn btn-outline-dark"
            role="button"
            id="button-comment"
            @click="showForm()"
          >Comment</button>
          <div class="alert alert-info login-alert" role="alert" v-if="this.userLoggedin">
            <p>Sorry, you need to login to comment</p>
            <a class="btn btn-outline-info" role="button" href="/login">Login</a>
            <a class="btn btn-outline-info" role="button" href="/register">Become a member</a>
          </div>
        </div>
        <Comment v-for="comment in getComment" :key="comment.id" :comment="comment" />
      </div>
      <div
        v-if="!this.notComment"
        id="comment-form"
        class="shadow-lg p-3 mb-5 bg-white rounded row justify-content-center justify-content-xl-center"
      >
        <h5 class="change-color text-center">
          <strong>
            <u>Comment</u>
          </strong>
        </h5>
        <p>{{this.userMessage}}</p>
        <div class="input-group mb-3">
          <input
            type="text"
            v-model="name"
            placeholder="Name"
            class="form-control"
            aria-label="Username"
            aria-describedby="basic-addon1"
          />
        </div>
        <div class="input-group">
          <textarea
            class="form-control"
            v-model="comment"
            placeholder="Comment"
            type="text"
            aria-label="With textarea"
            rows="5"
          ></textarea>
        </div>
        <div class="col-10 col-xl-2">
          <star-rating :increment="0.5" :star-size="30" v-model="rating"></star-rating>
        </div>
        <div class="col-12 col-xl-12 text-center button-submit-comment">
          <button class="btn btn-outline-dark" @click="storeCommentDB()">Submit</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Comment from "./Comment.vue";
import Showstar from "./Showstar.vue";
export default {
  name: "Coffeecomment",
  components: {
    Comment,
    Showstar
  },
  props: {
    coffee: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      notComment: true,
      userLoggedin: false,
      name: "",
      comments: [],
      rating: 0,
      userMessage: "",
      comment: ""
    };
  },
  methods: {
    showForm() {
      axios
        .get("/APIconfirmLogin")
        .then(response => {
          if (!response.data == true) {
            this.userLoggedin = !response.data;
          } else {
            this.notComment = false;
          }
        })
        .catch(error => {
          console.log("Error checking user");
        });
    },
    storeCommentDB() {
      axios
        .post("/storeComment", {
          name: this.name,
          comment: this.comment,
          coffeeId: this.coffee.id,
          stars: this.rating
        })
        .then(response => {
          if (response.data != "ok") {
            this.userMessage = response.data;
            this.notComment = false;
          } else {
            this.notComment = true;
            this.name = "";
            this.comment = "";
            this.rating = 0;
          }
        })
        .catch(error => {
          console.log("Error storing data");
        });
    },
    changenotComment() {
      this.notComment = true;
      console.log(this.notComment);
    }
  },
  computed: {
    getComment() {
      axios
        .post("/getComments", { coffeeId: this.coffee.id })
        .then(response => {
          this.comments = response.data;
        })
        .catch(error => {
          console.log("Error getting comment");
        });
      return this.comments;
    }
  }
};
</script>

<style scoped>
#container-coffeecomment {
  margin-top: 3vh;
}
.change-color {
  color: #7a2e20;
}
#button-comment {
  margin-top: 1.5vh;
  margin-bottom: 3vh;
}
.login-alert {
  margin-top: 2vh;
}
.overlay-paper {
  position: fixed;
  width: 100vw;
  height: 100vh;
  background-color: black;
  opacity: 0.5;
  top: 0;
  z-index: 100;
}
#comment-form {
  position: fixed;
  top: 20vh;
  right: 20vw;
  left: 20vw;
  background-color: white;
  z-index: 1000;
}
.button-submit-comment {
  margin-top: 2vh;
}
</style>
