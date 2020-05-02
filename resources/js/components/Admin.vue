<template>
    <div>
        <h1>Coffee</h1>
        <p
        >{{this.message}}</p>
        <div v-for="coffee in getCoffeeToReview" :key="coffee.id">
            <input type="checkbox" :id="coffee.id" :value="coffee.id" v-model="checkedCoffees">
            <label :for="coffee.id"></label>
                <p>{{coffee.name}}</p>
                <p>{{coffee.city}}</p>
                <p>{{coffee.country}}</p>
                <img :src="'/storage/' + coffee.picture">
        </div>
        <button @click="reviewedCoffee()">Accept</button>
        <button @click="rejectContribution()">Reject</button>
    </div>
</template>

<script>
export default {
    name: 'Admin',
    data() {
        return {
            coffees: [],
            checkedCoffees:[],
            message:''
        }
    },
    computed: {
        getCoffeeToReview() {
             axios.get('/getCoffeeAdmin')
                .then(response=> {
                  this.coffees=response.data;
                })
                .catch(error=> {
                    console.log("Error checking user");
                });
                return this.coffees;
        }
    },
    methods: {
        reviewedCoffee() {
            axios.post('/changeReviewedCoffee',{reviewedCoffee:this.checkedCoffees})
                .then(response=> {
                  this.message=response.data;
                  this.checkedCoffees=[];
                })
                .catch(error=> {
                    console.log("Error changing coffee");
                });
        },
        rejectContribution() {
            if(confirm('Are you sure you want to reject these contribution')) {
                axios.post('/deleteCoffee',{reviewedCoffee:this.checkedCoffees})
                    .then(response=> {
                    this.message=response.data;
                    this.checkedCoffees=[];
                    })
                    .catch(error=> {
                        console.log("Error changing coffee");
                    });
            }
        }
    }
}
</script>
