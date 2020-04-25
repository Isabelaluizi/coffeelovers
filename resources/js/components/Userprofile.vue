<template>
    <div>
        <h1>Welcome, {{auth.name}} </h1>
        <h5>We are very happy to have you here</h5>
        <h5>Please, send us your contribution</h5>
        <div>
            <input type="file" name="file" ref="file" id="file" accept=".jpg, .png, .gif">
            <label for="fileupload"> Select a file to upload</label>
            <p>Name:</p>
            <input type="text" v-model="coffeeName">
            <p>City:</p>
            <input type="text" v-model="coffeeCity">
            <p>Country:</p>
            <input type="text" v-model="coffeeCountry">
            <button @click="storeCoffee()">Submit</button>
        </div>
    </div>
</template>

<script>
export default {
    name:'Userprofile',
    props: {
        auth: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            coffeeName:'',
            coffeeCity:'',
            coffeeCountry:'',
            file:null
        }
    },
    methods: {
        storeCoffee() {
            if(confirm("Thank you for your contribution.\nClick OK to confirm your submition.")){
                    if(this.coffeeName=='') {
                        this.coffeeName='N/D';
                    }
                    if(this.coffeeCity=='') {
                        this.coffeeCity='N/D';
                    }
                    if(this.coffeeCountry==''){
                        this.coffeeCountry='N/D';
                    };
                    this.file=this.$refs.file.files[0];
                    let formData = new FormData();
                    formData.append('file',this.file);
                    formData.append('coffeeName',this.coffeeName);
                    formData.append('coffeeCity',this.coffeeCity);
                    formData.append('coffeeCountry',this.coffeeCountry);
                    axios.post('/storeCoffeeDB', formData, { header: {'Content-Type':'multipart/form-data'} })
                        .then(response=> {
                            console.log(response.data[0]);
                        })
                        .catch(error=> {
                            console.log("Error checking user");
                        });
                    }
                }
            }
        }
</script>
