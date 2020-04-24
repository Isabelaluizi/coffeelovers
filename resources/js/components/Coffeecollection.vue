<template>
    <div>
        {{ getCoffeeDB() }}
        <Coffee v-for="coffee in coffees" :name="coffee.name" :key="coffee.id" />
    </div>
</template>

<script>

import Coffee from './Coffee.vue'

    export default {
        name:'Coffeecollection',
        components: {
            Coffee
        },
        data() {
            return {
                coffees: {}
                }
        },
        methods: {
            getCoffeeDB() {
             axios.get('/APIGetCoffeeDB')
                .then(response=> {
                    this.coffees=response.data;
                })
                .catch(error=> {
                    console.log("Error checking user");
                });
            }

        }
    }
</script>
