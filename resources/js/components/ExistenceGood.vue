<template>
    <div class="existence">
        <span :class="addClass">{{this.text()}}</span>
<!--        <span style="color: red">@lang('catalog.end_good') {{$good->quantity}} шт.</span>-->
<!--        <span>@lang('catalog.expected')</span>-->
    </div>
</template>

<script>
export default {
    name: "ExistenceGood",
    props:{
        'quantity': Number,
        'text_store': String,
        'text_end_store':String,
        'text_no_store': String
    },
    mounted() {
        this.qty = this.quantity
    },
    computed:{
        addClass(){
            if (this.qty > 0 && this.qty > 10) {
                return 'existence-green'
            }
            if (this.qty > 0 && this.qty <= 10) {
                return 'existence-red'
            }

            return false
        }
    },
    data(){
        return{
            qty:0
        }
    },
    methods:{
        text(){

            if (this.qty > 0 && this.qty > 10) {
                return this.text_store
            }
            if (this.qty > 0 && this.qty <= 10) {
                return this.text_end_store + ' ' + this.qty + 'шт.'
            }

            return this.text_no_store
        }
    }
}
</script>

<style scoped>
.existence-green{
    color: green;
}
.existence-red{
    color: red;
}

</style>
