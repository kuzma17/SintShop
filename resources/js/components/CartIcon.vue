<template>
    <div class="cart-icon">
      <svg class="icon">
        <use xlink:href="#fa-cart-arrow-down"></use>
      </svg>
        <div class="cart-count">{{this.good_count}}</div>
    </div>
</template>

<script>
export default {
    name: "CartIcon",
    props: {
        count: {
            type: Number,
            default: 0
        },
    },
    mounted() {
        this.good_count = this.count
    },
    created() {
        this.emitter.on('CartCount', (data) => {
            this.good_count = data.cart_count
        })
    },
    data(){
        return{
            good_count: 0
        }
    },
    methods:{}

}
</script>

<style scoped>
</style>
