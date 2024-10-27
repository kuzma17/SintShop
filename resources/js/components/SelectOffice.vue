<template>
  <div class="select-office" ref="dropdown">
    <div class="office">

      <div style="cursor: pointer" @click="showList()" :title="$t('select_office')">
        <i class="fa-solid" :class="icon"></i> {{branch.name}}
      </div>
      <div class="phone">
        <a :href="'tel:' + branch.phone_url"><i class="fa-solid fa-phone"></i> {{branch.phone}}</a>
      </div>
      <div>
        <a :href="patchLocale() +'/contacts/#office_' + branch.id"><i class="fa-solid fa-location-dot"></i> {{ branch.location }}</a>
      </div>

    </div>
    <div v-if="show_list" class="list">
      <div v-for="(item, key) in branches" @click="selectBranch(key)" class="office">

        <div>
          <i class="fa-solid fa-chevron-down"></i> {{item.name}}
        </div>
        <div class="phone">
          <i class="fa-solid fa-phone"></i> {{item.phone}}
        </div>
        <div>
          <i class="fa-solid fa-location-dot"></i> {{ item.location }}
        </div>

      </div>

    </div>
  </div>
</template>

<script>
import {getActiveLanguage} from "laravel-vue-i18n";

export default {
  name: "SelectOffice",
  props: [
      'offices'
  ],
  mounted() {
    if(this.offices){
      this.branches = this.offices
      this.branch = this.branches[0]
    }

    document.addEventListener('click', this.handleClickOutside);

  },
  beforeDestroy() {
    document.removeEventListener('click', this.handleClickOutside);
  },

  data(){
    return{
      branches: {},
      branch: [],
      icon: 'fa-chevron-right',
      show_list: false
    }
  },
  methods:{

    showList(){
      this.show_list = !this.show_list
      this.icon = this.iconDown()
    },

    iconDown(){
      if (this.show_list){
        return 'fa-chevron-down'
      }
      return 'fa-chevron-right'
    },

    handleClickOutside(event) {
      if (!this.$refs.dropdown.contains(event.target)) {
        this.show_list = false;
        this.icon = this.iconDown()
      }
    },

    selectBranch(id){
      this.branch = this.branches[id]
      this.show_list = false
      this.icon = this.iconDown()
    },

    patchLocale(){
      let locale = getActiveLanguage()
      if(locale === "ru"){
        return '/ru'
      }
      return ''
    },

  }
}
</script>

<style>
.select-office{
  position: relative;
  z-index: 100
}
.office {
  border: 1px solid lightgray;
  border-radius: 5px;
  padding: 5px 7px;
  font-size: 15px;
}
.office:hover{
  background-color: whitesmoke;
}
.office i{
  color: #04B3F1;
}
.office a{
  text-decoration: none;
}
.office a:hover{
  text-decoration: underline;
}
.phone{
  font-size: 16px;
  font-weight: 700;
  color: #5c636a;
}
.select-office .list{
  position: absolute;
  width: 100%;
  background-color: #FFFFFF
}
.list .office{
  margin-top: 5px;
  cursor: pointer;
}

</style>
