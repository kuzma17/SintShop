<template>
  <div class="filter">
    <div>
      <button class="btn btn-info" @click="resetSelect()">reset</button>
<!--      <button class="btn btn-info" @click="infoForm()">info</button>-->
    </div>
    <form name="filter">
    <div class="price_block">
      <div class="row">
<!--        <div class="col p-1">-->
<!--          <input type="text" class="form-control form-control-sm" v-model="form.price[0]" @change="handleFormChange">-->
<!--        </div>-->
<!--        <div class="col p-1">-->
<!--          <input type="text" class="form-control form-control-sm" v-model="form.price[1]" @change="handleFormChange">-->
<!--        </div>-->
      </div>
      <br>
<!--      <Slider-->
<!--          v-model="form.price"-->

<!--          :max="max"-->
<!--          :lazy="lazy"-->
<!--          :tooltips="false"-->
<!--          @change="handleFormChange"-->
<!--      ></Slider>-->

      <filter-price
          v-model="form.price"
          :min="min_price"
          :max="max_price"
      ></filter-price>
<!--            <filter-prices-->
<!--                v-model="selected.price"-->
<!--            ></filter-prices>-->
      <br>
    </div>
    <div v-for="(filter, key) in attributes" >
<!--      <div class="filter_name" @click="showBlock(filter.id)" >-->
<!--        {{filter.name}} <i class="fa-solid" :class="iconBlock(filter.id)" style="float: right; margin-top: 5px; color: grey"></i>-->
<!--      </div>-->
<!--      <transition name="slide-fade">-->
<!--      <ul class="attribute_list" v-if="show[filter.id]">-->
<!--        <li v-for="(value, k) in filter.values" :key="k" class="attribute">-->
<!--          <div class="form-check">-->
<!--            <input class="form-check-input" type="checkbox" :value="value.id" :id="'filter-param-'+value.id" v-model="form[filter.slug]"-->
<!--                   @change="handleFormChange">-->
<!--            <label class="form-check-label" :for="'filter-param-'+value.id">-->
<!--&lt;!&ndash;              <span style="font-size: 12px">{{value.values}} ({{value.erc}})</span>&ndash;&gt;-->
<!--              <span class="name_attribute">{{value.values}}</span>-->
<!--            </label>-->
<!--          </div>-->
<!--        </li>-->
<!--      </ul>-->
<!--      </transition>-->

      <filter-attribute
          :filter="filter"
          v-model="form[filter.slug]"
      ></filter-attribute>
    </div>
    </form>
  </div>
</template>

<script>
import Slider from '@vueform/slider'
import {toRef} from "vue";
export default {
  name: "FilterGoods",
  components: {
    Slider,
  },
  props: [
      'attributes',
      'selected',
      'min_price',
      'max_price'
  ],
  created() {
    // if (this.attributes){
    //   this.filters = this.attributes
    // }
    // if (this.min_price){
    //   this.min = this.min_price
    // }
    // if (this.max_price){
    //   this.max = this.max_price
    // }


    // Object.values(this.filters).forEach(value => {
    //   this.form[value.slug] = []
    //   //this.show[value.id] = false
    // });

    //this.form = this.selected

    Object.entries(this.selected).forEach(([key, value]) => {
      this.form[key] = value
    });



    // if (this.form.price[0] === 0){
    //   this.form.price[0] = this.min
    // }
    //
    // if (this.form.price[1] === 0){
    //   this.form.price[1] = this.max
    // }

    // Object.entries(this.form).forEach(([key, value]) => {
    //   console.log(key + ': ' + value);
    //
    // });

     console.log('==================')
    // this.form = this.selected
    //
     console.log(this.selected);
      console.log(this.form);
    //
    //
    // this.active = 1

  },
  mounted() {
    // Установите флаг в true после начальной загрузки компонента
    this.isLoaded = true;
  },
  data(){
    return{
      //filters: [],
      //min: 0,
      //max: 0,
      form: {},
      //show: [],
      //active: 0,
      //lazy: false,
      isLoaded: false
    }
  },
  watch: {
    form: {
      handler: function (newVal, oldVal) {
        if (this.isLoaded) {
          this.handleFormChange();
        }
      },
      deep: true
    }
  },
  methods:{
    handleFormChange() {

      console.log('active');

      //const form = Object.assign({}, this.form); // clone this.form
      const form = this.form

      if((form.price === 0)){ // delete price no edit
        delete form.price;
      }

      //console.log(form);

      const currentUrl = new URL(window.location.href);


      let newURL = currentUrl.origin+currentUrl.pathname+'?'
      // Attribute
      Object.entries(form).forEach(([key, value]) => {
        if (value.length){
          newURL = newURL+key+'='+value+'&'
        }
      });

      newURL = newURL.slice(0, -1);
      //console.log(newURL);

      // let url = new URL(window.location.href);
      // Object.entries(form).forEach(([key, value]) => {
      //         //if (value.length){
      //           url.search.set(key, value);
      //        // }
      //       });
      //
      // let newURL = url.href.replace(/%2C/g, ',');
      //
      // console.log(newURL);

      history.pushState({}, "", newURL); // Edit Current Url

      window.location.href=newURL;


    },

    // getUrl(val){
    //   let url = new URL(window.location.href);
    //   url.searchParams.set('key', val);
    //
    // },

    // handleSubmit() {
    //   // Действия при отправке формы
    //   console.log('Form submitted with:');
    // },

    // showBlock(id){
    //   this.show[id] = !this.show[id]
    // },
    //
    // iconBlock(id){
    //   if(this.show[id]){
    //     return 'fa-chevron-up'
    //   }
    //   return 'fa-chevron-down'
    // },

    resetSelect(){
      // Object.entries(this.selected).forEach(([key, value]) => {
      //   this.selected[key] = []
      // });
     // this.form.price = [0,this.max]
      //Object.assign(this.selected, {});

      //Object.keys(this.form).forEach(key => delete this.form[key]);
      this.form = {}
      console.log(this.form);

      this.handleFormChange()
    },

    infoForm(){
      console.log(this.form);
    }

  }
}

</script>

<!--<style lang="css">-->
<!--  @import '@vueform/slider/themes/default.css';-->
<!--  :root {-->
<!--    &#45;&#45;slider-connect-bg: #04b4f2;-->
<!--    &#45;&#45;slider-bg: #cccccc;-->
<!--    &#45;&#45;slider-height: 7px;-->
<!--    &#45;&#45;slider-handle-width: 15px;-->
<!--    &#45;&#45;slider-handle-height: 15px;-->
<!--    &#45;&#45;slider-handle-bg: radial-gradient(circle, rgb(255, 255, 255) 40%, rgb(4, 179, 240) 60%);-->
<!--    &#45;&#45;slider-tooltip-bg: #04b3f0;-->

<!--    &#45;&#45;slider-handle-ring-width: 3px;-->
<!--    &#45;&#45;slider-handle-ring-color: #a594fe30;-->
<!--  }-->

<style>

  .collapse-enter-active, .collapse-leave-active {
    transition: max-height 2s ease;
  }
  .collapse-enter, .collapse-leave-to {
    max-height: 0;
    overflow: hidden;
  }
  .collapsible-content {
    max-height: 500px; /* Ensure this is large enough to fit the content */
    overflow: hidden;
  }

  .slide-fade-enter-active {
    transition: all 0.3s ease-out;
  }

  .slide-fade-leave-active {
    transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
  }

  .slide-fade-enter-from,
  .slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
  }

  .filter{
    border: 1px solid #e7e7e7
  }
  .filter .price_block{
    padding: 0 10px;
  }
  .filter .filter_name{
    border-top: 1px solid #e7e7e7;
    padding: 5px 5px;
    font-size: 13px;
    background-color: #FFFFFF;
    color: #04B4F2;
    font-weight: 600;
  }
  .filter .attribute_list{
    border-top: 1px solid #e7e7e7;
    margin: 0;
    padding: 0 0 0 10px
  }
  .filter .attribute{
    padding: 1px 5px;
  }
  .filter .name_attribute{
    font-size: 12px
  }

</style>