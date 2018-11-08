
<template>
        <a href="#" v-if="isFavorited" @click.prevent="unFavorite(appliance)">
            <i  class="fa fa-heart"></i>
        </a>
        <a href="#" v-else @click.prevent="favorite(appliance)">
            <i  class="fa fa-heart-o"></i>
        </a>
</template>

<script>
    export default {
        props: ['appliance', 'favorited'],

        data: function() {
            return {
                isFavorited: '',
            }
        },

        mounted() {
            this.isFavorited = this.isFavorite ? true : false;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(appliance) {
                axios.post('/addwishlist/'+appliance)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
            },

            unFavorite(appliance) {
                axios.post('/delwishlist/'+appliance)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>
