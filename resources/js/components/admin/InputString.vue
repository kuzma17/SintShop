<template>
    <div>
        <div class="input-group mb-3">
            <span class="input-group-text">ru</span>
            <input type="text" v-model="value.values.string_ru" class="form-control" >
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">ua</span>
            <input type="text" v-model="value.values.string_ua" class="form-control" >
        </div>
        <div v-if="value.values.string_ru || value.values.string_ua">
            <input type="hidden" :name="'values['+attribute_id+'][0][id]'" v-model="value.id">
            <input type="hidden" :name="'values['+attribute_id+'][0][values][string_ru]'" class="form-control" v-model="value.values.string_ru" >
            <input type="hidden" :name="'values['+attribute_id+'][0][values][string_ua]'" class="form-control" v-model="value.values.string_ua" >
        </div>
    </div>

</template>

<script>
export default {
    name: "InputString",
    props: [
        'modelValue',
        'num',
        'attribute_id'

    ],
    emits: [
        'update:modelValue'
    ],
    mounted() {
        if (this.modelValue){
            this.value = this.modelValue[0]
        }

        //console.log(this.value);

    },
    created() {

    },
    data(){
        return{
            value:
                {
                    id: 0,
                    values: {
                        string_ru: '',
                        string_ua: ''
                    }
                }
        }
    },
    methods:{

    }
}
</script>

<style scoped>

</style>
