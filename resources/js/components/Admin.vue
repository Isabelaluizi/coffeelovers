<template>
    <div>
        <div v-for="coffee in getCoffeeToReview" :key="coffee.id">
            <input type="checkbox" id="checkbox" v-model="checkedCoffees">
            <label for="checkbox">{{ checkedCoffees }}
                <p>{{coffee.name}}</p>
                <p>{{coffee.city}}</p>
                <p>{{coffee.country}}</p>
                <img :src="'/storage/' + coffee.picture">
            </label>

        </div>
    </div>
</template>

<script>
export default {
    name: 'Admin',
    data() {
        return {
            coffees: [],
            checkedcoffees:[]
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
    }

}
</script>
