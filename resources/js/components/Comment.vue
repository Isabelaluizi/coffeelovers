<template>
    <div>
        <p>Name: {{comment.nickname}}</p>
        <p>Comment:{{comment.content}}</p>
        <star-rating :rating="stars(comment.stars)" :read-only="true" :increment="0.5" :star-size="20" :show-rating="false"></star-rating>
        <p>{{this.date}}</p>
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
            date:''
        }
    },
    methods: {
        stars(stars){
            return parseFloat(stars);
        }
    },
    mounted() {
        this.date = moment.parseZone(this.comment.created_at).fromNow();
    }


}
</script>
