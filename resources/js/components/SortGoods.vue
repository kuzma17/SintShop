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
export default {
  name: "SortGoods",
    props: [],
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
      this.show = !this.show
    },

    getUrl(val){
      let url = new URL(window.location.href);
      url.searchParams.set('sort', val);
      let newURL = url.href.replace(/%2C/g, ',');
      //console.log(newURL);
      window.location.href=newURL;
    }

    }
}
</script>

<style scoped>
.sort{
  position: relative;
  float: right;
}
.sort_list{
  position: absolute;
  top: 35px;
  right: 0;
  z-index: 100;
}
.list-group-item{
  background-color: #1a1d20;
  color: white;
}
</style>