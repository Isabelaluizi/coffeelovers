<template>
    <div>
        <div v-if="this.notComment">
            <img :src="'/storage/' + coffee.picture">
            <h6>Name: {{coffee.name}}</h6>
            <h6>Location:{{coffee.city}},{{coffee.country}}</h6>
            <div v-if="this.userLoggedin">
                <p>Sorry, you need to login to comment</p>
                <a href="/login">Login</a>
                <a href="/register">Become a member</a>
            </div>
            <button @click="showForm()">Comment</button>
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
