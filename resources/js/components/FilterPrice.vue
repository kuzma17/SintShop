<template>
  <div>
    <div class="row">
      <div class="col p-1">
        <input type="text" class="form-control form-control-sm" v-model="price_min" @change="changeminmax">
      </div>
      <div class="col p-1">
        <input type="text" class="form-control form-control-sm" v-model="price_max" @change="changeminmax">
      </div>
    </div>
    <br>
    <Slider
        v-model="price"
        :min="min"
        :max="max"
        :lazy="false"
        :tooltips="false"
        @change="handleFormChange"
    ></Slider>
  </div>

</template>

<script>
  import Slider from '@vueform/slider'
  export default {
  name: "FilterPrice",
  components: {
  Slider,
}, props: {
    modelValue: {
      type: Array,
      default: [0, 0]
    },
    min: {
      type: Number,
      default: 0
    },
    max: {
      type: Number,
      default: 0
    }
},
  created() {

    this.price = this.modelValue

    if (this.price[0] === 0 || this.price[0] < this.min){
      this.price[0] = this.min
    }
    if (this.price[1] === 0 || this.price[1] > this.max){
      this.price[1] = this.max
    }

    this.price_min = this.price[0]
    this.price_max = this.price[1]

  },
  data(){
    return{
      price: [0,0],
      price_min: 0,
      price_max: 0,
    }
  },
    watch: {
      modelValue(newVal) {
        this.price = newVal; // Обновление переменной data при изменении props
      }
    },
  emits: ['update:modelValue'],
  methods:{
    handleFormChange(){

      this.price_min = this.price[0]
      this.price_max = this.price[1]

      let result = this.price

      if (this.price[0] === this.min && this.price[1] === this.max){
        result = 0;
      }

      this.$emit('update:modelValue', result);
    },
    changeminmax(){


      if (this.price_min < this.min){
        this.price_min = this.min
      }

      if (this.price_max > this.max){
        this.price_max = this.max
      }

      this.price[0] = this.price_min
      this.price[1] = this.price_max

      this.handleFormChange()
    },

  }
}
</script>

<style lang="css">
@import '@vueform/slider/themes/default.css';
:root {
--slider-connect-bg: #04b4f2;
--slider-bg: #cccccc;
--slider-height: 7px;
--slider-handle-width: 15px;
--slider-handle-height: 15px;
--slider-handle-bg: radial-gradient(circle, rgb(255, 255, 255) 40%, rgb(4, 179, 240) 60%);
--slider-tooltip-bg: #04b3f0;

--slider-handle-ring-width: 3px;
--slider-handle-ring-color: #a594fe30;
}

</style>