<template>
    <div class="container" id="inside-container">
        <h3 class="text-center change-color">Plese, select coffee</h3>
        <div v-if="this.message!=''" class="alert alert-info" id="styled-alert" role="alert">
            <p class="text-center">{{this.message}}.</p>
        </div>
        <div class="card bg-light mb-3" v-for="coffee in getCoffeeToReview" :key="coffee.id">
            <div class="card-header">
                <input type="checkbox" :id="coffee.id" :value="coffee.id" v-model="checkedCoffees">
                <label :for="coffee.id"></label>
                <span id="change-font-size">{{coffee.name}}</span>
            </div>
            <div class="card-body row">
                <div class="col-4 col-xl-1">
                    <img class="img-fluid" :src="'/storage/' + coffee.picture">
                </div>
                <div class="col-8 col-xl-11">
                    <h5><span class="change-color">City:</span> {{coffee.city}}</h5>
                    <h5><span class="change-color">Country:</span> {{coffee.country}}</h5>
                </div>
            </div>
        </div>
        <div class="row justify-content-center justify-content-xl-center">
            <div class="col-3 col-xl-2">
                <button class="btn btn-dark button-styled" @click="reviewedCoffee()">Accept</button>
            </div>
            <div class="col-3 col-xl-2">
                <button class="btn btn-dark button-styled" @click="rejectContribution()">Reject</button>
            </div>
        </div>
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
            if(this.checkedCoffees.length==0){
                this.message= "Please, select coffee to be accepted"
            } else {
                axios.post('/changeReviewedCoffee',{reviewedCoffee:this.checkedCoffees})
                    .then(response=> {
                    this.message=response.data;
                    this.checkedCoffees=[];
                    })
                    .catch(error=> {
                        console.log("Error changing coffee");
                    });
            }
        },
        rejectContribution() {
             if(this.checkedCoffees.length==0){
                this.message= "Please, select coffee to be rejected"
            } else {
                if(confirm('Are you sure you want to reject these coffee from database')) {
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
}
</script>

<style scoped>
#change-font-size{
    font-size:20px;
}
#inside-container{
        margin-top:3vh;
        padding-bottom:2vh;
    }
.change-color{
    color:#7a2e20;
}
#styled-alert{
    position:sticky;
    top:0;
    z-index: 1000;
}
</style>
