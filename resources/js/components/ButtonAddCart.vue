<template>
    <button class="btn btn-blue" @click="addCart()" v-html="text_button" :disabled="isDisabled"></button>
</template>

<script>
export default {
    name: "ButtonAddCart",
    props: {
        'title': String,
        'title_on': String,
        'id': Number,
        'store_qty': Number,
        'cart_qty': Number,
        'price': Number,
    },
    mounted() {
        if (this.cart_qty){
            this.text_button = this.title_on + ' ' + this.cart_qty
        }else{
            this.text_button = this.title
        }
        if (this.store_qty > 0){
            this.store_good_qty = this.store_qty - this.cart_qty
        }

        this.cart_good_qty = this.cart_qty
    },
    computed:{
        isDisabled(){
            // console.log('strore: '+this.store_good_qty);
            // console.log('cart: '+this.cart_good_qty);
            if(this.store_good_qty > 0){
                return false
            }
            return true
        },
    },
    data(){
        return{
            store_good_qty: 0,
            cart_good_qty: 0,
            text_button: 'buy',
        }
    },
    methods:{
        addCart(){
            let data = {
                'id': this.id,
                'qty': 1,
                'price': this.price
            }
            axios.post('/cart/add', data)
                .then(response => {
                    //console.log(response.data);
                    this.cart_good_qty++
                    this.store_good_qty--
                    this.text_button =   this.title_on + ' ' + response.data.good_qty
                    this.emitter.emit('CartCount', {'cart_count': response.data.cart_count})
                })
                .catch(error => {
                    console.log(error);
                })
        },
    }
}
</script>

<style scoped>

</style>
