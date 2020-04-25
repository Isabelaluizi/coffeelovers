<template>
    <div>
        <h1>Coffee Lovers</h1>
        <h5>This is a collaborative website to help coffee lovers find the perfect coffee</h5>
        <h3>Do you want to contribute to coffee lovers?</h3>
        <a v-if="this.userLoggedin" href="/home">Home</a>
        <a v-else href="/login">Login</a>
        <a href="/register">Become a member</a>
    </div>
</template>

<script>
    export default {
        name:'Introduction',
        data() {
            return {
                userLoggedin: null
            }
        },
        mounted() {
                axios.get('/APIconfirmLogin')
                .then(response=> {
                    console.log(response.data);
                    this.userLoggedin=response.data;
                })
                .catch(error=> {
                    console.log("Error checking user");
                });
        }
    }
</script>
