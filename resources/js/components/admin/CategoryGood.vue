<template>
    <div class="row mb-3">
        <label class="col-2 star">
            Категория
        </label>
        <div class="col-9">
            <select name="category_id" class="form-control" v-model="model" @change="select()">
<!--                <option value="" >Выберите категорию</option>-->
                <option v-for="item in categories" :value="item.id">{{item.title_ru}}</option>
            </select>
        </div>
    </div>
</template>

<script>
export default {
    name: "CategoryGood",
    props: [
        'categories',
        'category'
    ],
    mounted() {
        if (this.category){
            this.model = this.category
        }else{
          this.model = this.categories[0].id;
        }
      this.select()
    },
    data(){
        return{
            model: 0
        }
    },
    methods:{
        select(){
            this.emitter.emit('selectCategory', this.model)
        }

    }
}
</script>

<style scoped>

</style>
