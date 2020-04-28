<template>
    <div>
        <img v-if="this.notComment" :src="'/storage/' + coffee.picture">
        <h6 v-if="this.notComment">Name: {{coffee.name}}</h6>
        <h6 v-if="this.notComment">Location:{{coffee.city}},{{coffee.country}}</h6>
        <button v-if="this.notComment" @click="showForm()">Comment</button>
        <div v-else>
            <p>Name</p>
            <input type="text" v-model="name">
            <p>Comment</p>
            <textarea type="text" v-model="comment"></textarea>
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
        },
        name: {
            type:String,
            required:true
        },
        comment: {
            type:String,
            required:true
        }
    },
    data() {
        return {
            notComment: true
        }
    },
    methods: {
        showForm() {
            this.notComment=false;
        },
        storeCommentDB() {
            this.notComment=true;
        }
    }
}
</script>
