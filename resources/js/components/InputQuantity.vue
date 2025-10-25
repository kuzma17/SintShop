<template>
    <div class="quantity">
        <button class="btn minus1" @click="minus()">
          <svg class="icon"><use xlink:href="#fa-minus"></use></svg>
        </button>
        <input class="quantity"
               min="0"
               v-model="num"
               type="number"
        >
        <button class="btn add1" @click="add()">
          <svg class="icon"><use xlink:href="#fa-plus"></use></svg>
        </button>
    </div>
</template>

<script>
// import {min} from "@popperjs/core/lib/utils/math.js";

export default {
    name: "InputQuantity",
    props: ['modelValue'],
    emits: ['update:modelValue'],
    mounted() {
        this.num = this.modelValue
    },
    data(){
        return{
            num: 1,
        }
    },
    methods:{
        min() {
            return min
        },
        add(){
            this.num++
            this.$emit('update:modelValue', this.num)
        },

        minus(){
            this.num--
            if (this.num < 1){
                this.num = 1
            }
            this.$emit('update:modelValue', this.num)
        }
    }

}
</script>

<style>
.quantity{
    display:flex;
}

/* it will support chrome and firefox */
.quantity input[type=number]::-webkit-inner-spin-button,
.quantity input[type=number]::-webkit-outer-spin-button{
    -webkit-appearance:none;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}

.quantity input{
    width: 50px;
    text-align:center;
    border: none;
}
.quantity button{
    width:50px;
    text-align:center;
    border:1px solid #CCCCCC;
}
button .icon{
  color: white;
}

</style>
