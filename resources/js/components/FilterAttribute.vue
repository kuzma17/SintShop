<template>
  <div>
    <div class="filter_name" @click="show = !show" >
      {{filter.name}}
      <i class="fa-solid" :class="iconBlock(filter.id)" style="float: right; margin-top: 5px; color: grey"></i>
    </div>
    <transition name="slide-fade">
      <ul class="attribute_list" v-if="show">
        <li v-for="(value, k) in filter.values" :key="k" class="attribute" >
          <div class="form-check">
            <input class="form-check-input" type="checkbox" :value="value.id" :id="'filter-param-'+value.id"
                   v-model="selected"
                   @change="handleFormChange">
            <label class="form-check-label" :for="'filter-param-'+value.id">
              <span class="name_attribute" >
                {{value.values}} <span class="countval" :class="value.count > 0? 'color_blue': 'color_grey'" >({{value.count}})</span>
              </span>
            </label>
          </div>
        </li>
      </ul>
    </transition>
  </div>
</template>

<script>
export default {
  name: "FilterAttribute",
  props: {
    filter: {
      type: Object,
      required: true
    },
    modelValue: {
      type: Array,
      default: []
    }
  },
  created() {

    this.selected = this.modelValue

    if (this.selected.length){
      this.show = true
    }

  },
  data(){
    return{
      show: false,
      selected: []
    }
  },
  watch: {
    modelValue(newVal) {
      this.selected = newVal; // Обновление переменной data при изменении props
    }
  },
  emits: ['update:modelValue'],
  methods:{
    handleFormChange(){
      this.$emit('update:modelValue', this.selected);
    },
    iconBlock(id){
      if(this.show){
        return 'fa-chevron-up'
      }
      return 'fa-chevron-down'
    },

  }
}
</script>

<style>
  .filter_name{
    cursor: pointer;
  }
  .countval{
    padding-left: 10px;

  }
  .color_blue{
    color: #04B4F2;
  }
  .color_grey{
    color: #989898;
  }

  .form-check-input {
    margin-right: 10px;
    cursor: pointer;
  }

  li.attribute:hover .countval {
    padding-left: 15px;
  }

  .form-check-label {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

</style>