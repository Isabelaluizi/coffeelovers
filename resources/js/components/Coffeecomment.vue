<template>
    <div>
        <div v-if="this.notComment">
            <img :src="'/storage/' + coffee.picture">
            <h6>Name: {{coffee.name}}</h6>
            <h6>Location:{{coffee.city}},{{coffee.country}}</h6>
            <button @click="showForm()">Comment</button>
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
export default {
    name:'Coffeecomment',
    props: {
        coffee: {
            type:Object,
            required: true
        }
    },
    data() {
        return {
            notComment: true,
            name:'',
            comment:'',
            rating: 0,
            userMessage:''
        }
    },
    methods: {
        showForm() {
            this.notComment=false;
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


        },
    }
}
</script>
