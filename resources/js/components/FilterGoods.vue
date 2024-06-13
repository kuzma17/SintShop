<template>
  <div class="filter" style="border: 1px solid #CCCCCC">
    <div v-for="(filter, key) in filters" >
      <div class="filter_name" style="border: 1px solid #CCCCCC;padding: 5px 5px; font-size: 13px;  background-color: #04B4F2; color: #FFFFFF; font-weight: 300">
        {{filter.name}} {{filter.type.title}}
      </div>
      <ul style="margin: 0; padding: 0 0 0 10px">
        <li v-for="(value, k) in filter.values" style="padding: 1px 5px;">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" :id="'filter-param-'+k">
            <label class="form-check-label" :for="'filter-param-'+k">
<!--              <span style="font-size: 12px">{{value.values}} ({{value.erc}})</span>-->
              <span style="font-size: 12px">{{value.values}}</span>
            </label>
          </div>
        </li>
      </ul>
    </div>

  </div>
</template>

<script>

export default {
  name: "FilterGoods",
  props: [
    'attributess',
  ],
  mounted() {
    if (this.attributess){
      this.filters = this.attributess
    }
  },
  data(){
    return{
      filters: [],

    }
  },
  methods:{

  }
}

</script>

<style scoped>

</style>