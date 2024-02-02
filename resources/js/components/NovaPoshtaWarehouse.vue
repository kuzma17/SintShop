<template>
  <div class="mb-3 row">
     <label class="col-sm-2 star">{{ $t('np_city') }}</label>
     <div class="col-sm-10" style="position: relative">
       <input type="text"
              name="np_city"
              ref="city"
              v-model="city"
              class="form-control"
              @keydown="blockCity()"
              @click="resetData()"
              :placeholder="$t('np_city_placeholder')"
              required>
<!--       <span v-if="errors.np_city" class="invalid-feedback" role="alert">-->
<!--                                <strong>{{ errors.np_city }}</strong>-->
<!--                        </span>-->
       <input type="hidden" name="np_city_ref" :value="city_ref" >
       <div v-if="city_toggle" class="np_select">
         <ul v-if="list_city" class="list" style="padding: 0; margin: 0">
           <li v-for="city in list_city" @click="getCity(city)">{{city.name}}</li>
         </ul>
       </div>
     </div>

      <label class="col-sm-2 star">{{ $t('np_warehouse') }}</label>
      <div class="col-sm-10" style="position: relative">
        <input type="text"
               ref="warehouse"
               @click="blockWarehouse()"
               name="np_warehouse"
               v-model="warehouse_name"
               class="form-control"
               :placeholder="$t('np_warehouse_placeholder')"
               required
        >
<!--        <span v-if="errors.np_warehouse" class="invalid-feedback" role="alert">-->
<!--                                <strong>{{ errors.np_warehouse }}</strong>-->
<!--                        </span>-->
        <input type="hidden" name="np_warehouse_ref" :value="warehouse_ref" >
        <div v-if="warehouse_toggle" class="np_select" @scroll="handleScroll">
          <ul v-if="list_warehouse" class="list">
            <li v-for="warehouse in list_warehouse" @click="getWarehouse(warehouse)">
              {{ warehouse.name }}
            </li>
          </ul>
        </div>
      </div>



<!--      <span v-if="errors.delivery_address" class="invalid-feedback" role="alert">-->
<!--                                <strong>{{ errors.delivery_address }}</strong>-->
<!--                        </span>-->
  </div>
</template>

<script>
import {getActiveLanguage} from "laravel-vue-i18n";

export default {
  name: "NovaPoshtaWarehouse",
  props:[
      'np_city',
      'np_city_ref',
      'np_warehouse',
      'np_warehouse_ref'
  ],
  mounted() {
    if (this.np_city) {
      this.city = this.np_city;
    }
    if (this.np_city_ref) {
      this.city_ref = this.np_city_ref;
    }
    if (this.np_warehouse) {
      this.warehouse_name = this.np_warehouse;
    }
    if (this.np_warehouse_ref) {
      this.warehouse_ref = this.np_warehouse_ref;
    }

  },
  watch: {
    city(after, before) {
      this.searchCity();
    },

    // warehouse(after, before) {
    //   this.searchWarehouses();
    // }
  },
  data(){
    return{
      cities: [],

      city: '',
      warehouse_name: '',

      list_city: false,
      city_ref: false,
      city_toggle: false,
      city_search: false,

      list_warehouse: {},
      warehouse_ref: false,
      warehouse_toggle: false,

      page: 1,

    }
  },
  methods:{

    searchCity(){

      if (this.city.length > 2 && this.city_search) {

        axios.get(this.patchLocale() + '/nova-poshta?city_key=' + this.city)
            .then(response => {
              //console.log(response.data);
              this.city_toggle = true
              this.list_city = response.data
              //this.city_toggle = false
              this.city_search = false
            })
            .catch(error => {
              console.log(error)
            });
      }

    },

    getCity(city){
      this.city = city.name
      this.city_ref = city.ref
      this.city_toggle = false
      this.warehouse_name = ''
      this.listWarehouses()

    },

    blockCity(){
     // this.$refs.city.focus()
       this.city_search = true
      this.list_warehouse = {}
    },

    listWarehouses(){
      axios.get(this.patchLocale() + '/nova-poshta?city_ref='+ this.city_ref+'&page='+this.page)
          .then(response => {
            //console.log(response.data);
            Object.assign(this.list_warehouse, response.data)

          })
          .catch(error => {
            console.log(error)
          });
    },

    getWarehouse(warehouse){
      this.warehouse_name = warehouse.name
      this.warehouse_ref = warehouse.ref
      this.warehouse_toggle = false
    },

    blockWarehouse(){
      this.warehouse_toggle = true
      this.warehouse = ''
      this.$refs.warehouse.focus()
    },

    patchLocale(){
      let locale = getActiveLanguage()
      if(locale === "ru"){
        return '/ru'
      }
      return ''
    },

    handleScroll: function(el) {
      if((el.srcElement.offsetHeight + el.srcElement.scrollTop) >= el.srcElement.scrollHeight) {
        this.page++
        this.listWarehouses()
      }
    },

    resetData(){
      this.city = ''
      this.city_ref = ''
      this.warehouse_name = ''
      this.warehouse_ref = ''
    }



  }
}
</script>

<style>

.np_select{
  position: absolute;
  background-color: white;
  border: 1px solid #CCCCCC;
  max-height: 400px;
  overflow: auto;
  width: 95%;
  z-index: 100;
}
ul.list{
  padding: 0;
  margin: 0
}
ul.list li{
  list-style-type: none;
  padding: 3px 10px !important;
  border-bottom: 1px solid #CCCCCC;
  cursor: pointer;
}
ul.list li:hover{
  background-color: whitesmoke;
}
.form-control{
  margin-bottom: 10px;
}

</style>