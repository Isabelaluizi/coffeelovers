<template>
    <div class="container" id="container-coffeecomment">
        <div v-if="this.notComment" class="row justify-content-center align-items-center">
            <div class="col-10 col-xl-4">
                <h5><span class="change-color"><strong>Name: </strong></span>{{coffee.name}}</h5>
                <h5><span class="change-color"><strong>Location: </strong></span>{{coffee.city}},{{coffee.country}}</h5>
            </div>
            <div class="col-10 col-xl-2">
                <img :src="'/storage/' + coffee.picture" class="rounded mx-auto d-block img-fluid">
                <div v-if="this.userLoggedin">
                    <p>Sorry, you need to login to comment</p>
                    <a href="/login">Login</a>
                    <a href="/register">Become a member</a>
                </div>
            </div>
            <div class="col-12 col-xl-12 text-center">
                <button class="btn btn-outline-dark" role="button" id="button-comment" @click="showForm()">Comment</button>
            </div>
            <Comment v-for="comment in getComment" :key="comment.id" :comment="comment" />
        </div>
        <div v-else>
            <p>{{this.userMessage}}</p>
            <p>Name</p>
            <input type="text" v-model="name">
            <p>Comment</p>
            <textarea type="text" v-model="comment"></textarea>
            <star-rating :increment="0.5" :star-size="30" v-model="rating"></star-rating>
            <button @click="storeCommentDB()">Submit</button>
        </div>
    </div>
</template>

<script>
import Comment from './Comment'
export default {
    name:'Coffeecomment',
    components: {
        Comment
    },
    props: {
        coffee: {
            type:Object,
            required: true
        }
    },
    data() {
        return {
            notComment: true,
            userLoggedin:false,
            name:'',
            comments:[],
            rating: 0,
            userMessage:'',
            comment:''
        }
    },
    methods: {
        showForm() {
            axios.get('/APIconfirmLogin')
                .then(response=> {
                    if(!response.data==true){
                        this.userLoggedin=!response.data;
                    } else {
                        this.notComment=false;
                    }
                })
                .catch(error=> {
                    console.log("Error checking user");
                });
        },
        storeCommentDB() {
            axios.post('/storeComment',{name:this.name, comment:this.comment, coffeeId: this.coffee.id, stars: this.rating})
                .then(response=> {
                    if(response.data != "ok"){
                        this.userMessage=response.data;
                        this.notComment=false;
                    } else {
                        this.notComment=true;
                        this.name="";
                        this.comment="";
                        this.rating= 0;
                    }
                })
                .catch(error=> {
                    console.log("Error storing data");
                });
        }
    },
    computed:{
        getComment(){
            axios.post('/getComments', {coffeeId: this.coffee.id})
            .then(response=> {
                this.comments=response.data;
            })
            .catch(error=> {
                console.log("Error getting comment");
            });
            return this.comments;
        }
    }
}

</script>

<style scoped>
#container-coffeecomment{
    margin-top:3vh;
}
.change-color{
     color:#7a2e20;
}
#button-comment{
    margin-top:1.5vh;
    margin-bottom:3vh;
}
</style>
