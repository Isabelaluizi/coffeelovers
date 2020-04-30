<template>
    <div>
        <p>Name: {{comment.nickname}}</p>
        <star-rating :rating="comment.stars" :read-only="true" :increment="0.5" :star-size="20" :show-rating="false"></star-rating>
        <p>Date:{{comment.created_at}}</p>
        <p>Comment:{{comment.content}}</p>
    </div>
</template>

<script>
export default {
    name:'Comment',
    props:{
        comment: {
            type:Object,
            required:true
        }
    }

}
</script>
