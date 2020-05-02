<template>
    <div>
        <p>Name: {{comment.nickname}}</p>
        <p>Comment:{{comment.content}}</p>
        <star-rating :rating="stars(comment.stars)" :read-only="true" :increment="0.5" :star-size="20" :show-rating="false"></star-rating>
        <p>{{this.date}}</p>
        <button v-if="this.isUser" @click="confirmDelete()">Delete</button>
        <div v-if="this.confirmation">
            <p>Are you sure you want to Delete this comment? </p>
             <button @click="clickedYes()">Yes</button>
             <button @click="clickedNo()">No</button>
        </div>
    </div>
</template>

<script>
var moment = require('moment');
export default {
    name:'Comment',
    props:{
        comment: {
            type:Object,
            required:true
        }
    },
    data() {
        return {
            date:'',
            isUser:false,
            confirmation:false,
            confirmed:false
        }
    },
    methods: {
        stars(stars){
            return parseFloat(stars);
        },
        confirmDelete(){
            this.confirmation=true;
        },
        clickedYes(){
            axios.post('/deleteComment',{commentId: this.comment.id, userId: this.comment.user_id})
                .then(response=> {
                    console.log(response.data);
                })
                .catch(error=> {
                    console.log("Error checking user");
                });
        },
        clickedNo(){
            this.confirmation=false;
        }
    },
    mounted() {
        this.date = moment.parseZone(this.comment.created_at).fromNow();
        axios.post('/checkUserComment',{userId: this.comment.user_id})
                .then(response=> {
                    this.isUser=response.data;
                })
                .catch(error=> {
                    console.log("Error checking user");
                });
    }


}
</script>
