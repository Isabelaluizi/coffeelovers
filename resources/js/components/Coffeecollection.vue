<template>
    <div>
        <form class="form-inline">
            <input type="text" v-model="search" placeholder="Search">
        </form>
        <div>
            <ul>
                <li v-for="coffee in filteredCoffees" :key="coffee.id">
                    <div>
                        Name:{{coffee.name}}
                    </div>
                    <div>
                        Location:{{coffee.city}},{{coffee.country}}
                    </div>
                    <div>
                        <a :href="'/showCoffeeComments/'+ coffee.id">Comment</a>
                    </div>
                    <div>
                        <img :src="'/storage/' + coffee.picture">
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name:'Coffeecollection',
        data() {
            return {
                coffees: [],
                search: ""
                }
        },
        mounted() {
            axios.get('/APIGetCoffeeDB')
                .then(response=> {
                    this.coffees=response.data
                })
                .catch(error=> {
                    console.log("Error");
                });
        },
        computed: {
            filteredCoffees: function () {
                var self = this
                var matcher = new RegExp(self.search, 'i')
                return self.coffees.filter(function(coffee){
                    return matcher.test([coffee.name, coffee.city, coffee.country].join())
                })
            }
        }
}
</script>
