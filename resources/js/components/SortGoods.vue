<template>
  <div class="sort">
    <div class="row">
      <label class="col-auto">
        {{ $t('sort') }}:
      </label>
      <div class="col p-0" >
        <div class="select dropdown-toggle"  @click="selectSort()">
          {{ $t(selected) }}
        </div>
        <div v-if="show" class="sort_list">
          <div class="list-group">
            <a v-for="item in list" href="#" @click="getUrl(item)" class="list-group-item">{{ $t(item) }}</a>
<!--            <a href="/priceAsc" class="list-group-item list-group-item-action">{{ $t('priceAsc') }}</a>-->
<!--            <a href="/priceDesc" class="list-group-item list-group-item-action">{{ $t('priceDesc') }}</a>-->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {getActiveLanguage} from "laravel-vue-i18n";

export default {
  name: "SortGoods",
    props: [],
    mounted() {

    //this.selectSort()

      //this.currentUrl = window.location.href;

      //console.log(this.currentUrl);

      // let url = new URL(window.location.href);
      // url.searchParams.set('sort', 'val');
      //
      //
      // console.log(url.href);
    },
    data(){
      return{
        show: false,
        //sort: 'new',
        list: [
            'new',
            'priceAsc',
            'priceDesc'
        ],
        selected: 'new',

        currentUrl: ''
      }
    },
    methods:{

    selectSort(){

      // Создаем объект URL из текущего URL
      //let url = new URL(window.location.href);
      this.show = !this.show

      //this.currentUrl = window.location.href;


// Добавляем новый параметр
    //  url.searchParams.set('key', 'value');
    },

    getUrl(val){

      let url = new URL(window.location.href);
      url.searchParams.set('sort', val);

      let newURL = url.href.replace(/%2C/g, ',');

      console.log(newURL);

      window.location.href=newURL;
      // let prefix = '?';
      // if (url.search){
      //   prefix = '&';
      // }
      //
      // let newURL = url.origin+url.pathname+url.search+prefix+'sort='+val

      //console.log(newURL);

      //window.location.href = newURL

      //window.history.pushState({}, '', newURL);




      //  let url = new URL(${this.currentUrl});
      //  url.searchParams.set('sort', val);
      // return 123;
    }

    }
}
</script>

<style scoped>
.sort_list{
  position: absolute;
  inset: 0px auto auto 0px;
  margin: 0px;
  transform: translate(1443px, 264px);
}
.list-group-item{
  background-color: #1a1d20;
  color: white;
}
</style>