<template>
  <div class="filter">
    <form name="filter">
    <div class="price_block">
      <filter-price
          v-model="form.price"
          :min="min_price"
          :max="max_price"
      ></filter-price>
      <br>
    </div>
    <div v-for="(filter, key) in filters" >
      <filter-attribute
          :filter="filter"
          v-model="form[filter.slug]"
      ></filter-attribute>
    </div>
    </form>
    <div>
      <button class="btn btn-blue" style="width: 100%" @click="resetSelect()">reset</button>
    </div>
  </div>
</template>

<script>
import Slider from '@vueform/slider'
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
    Object.entries(this.selected).forEach(([key, value]) => {
      this.form[key] = value
    });

  },
  mounted() {
    if (this.attributes){
      this.filters = this.attributes
    }

    this.isLoaded = true;
  },
  data(){
    return{
      filters: [],
      form: {},
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
      const form = this.form

      if((form.price === 0)){ // delete price no edit
        delete form.price;
      }

      const currentUrl = new URL(window.location.href);
      let newURL = currentUrl.origin+currentUrl.pathname+'?'
      // Attribute
      Object.entries(form).forEach(([key, value]) => {
        if (value.length){
          newURL = newURL+key+'='+value+'&'
        }
      });

      newURL = newURL.slice(0, -1);
      history.pushState({}, "", newURL); // Edit Current Url

      axios.get(newURL)
          .then(response => {
            //console.log(response.data);
            const container = document.querySelector('#catalog');
            container.innerHTML = response.data.content
            this.filters = response.data.filters
          })
          .catch(error => {
            console.log(error)
          });
    },

    resetSelect(){
      this.form = {}
      this.handleFormChange()
    },

  }
}

</script>

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