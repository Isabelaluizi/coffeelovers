<template>
    <div>
        <p>{{name}}</p>
    </div>
</template>

<script>

    export default {
        name:'Coffee',
        props: {
            name: {
                type:String
            }
        }
    }
</script>
