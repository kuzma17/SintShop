<template>
    <div>
        <Multiselect
            v-model="value"
            mode="tags"
            :close-on-select="false"
            :searchable="true"
            :create-option="true"
            :options="attributeValues"
            label="values"
            valueProp="id"
            :object="true"
        />
        <input v-if="value.values" v-for="(item, key) in value" type="hidden" :name="'values['+attribute_id+']['+key+'][id]'" :value="item.id">
        <input v-if="value.values" v-for="(item, key) in value" type="hidden" :name="'values['+attribute_id+']['+key+'][values]'" :value="item.values">
    </div>
</template>

<script>

import Multiselect from '@vueform/multiselect'
export default {
    name: "InputSet",
    components: {
        Multiselect,
    },
    props: [
        'modelValue',
        'attributeValues',
        'attribute_id'
    ],
    emits: [
        'update:modelValue'
    ],
    mounted() {
        if (this.modelValue){
            this.value = this.modelValue
        }
        //console.log(this.value);
    },
    data(){
        return{
            value: []
        }
    },
    methods:{}
}
</script>

<style src="@vueform/multiselect/themes/default.css">

</style>
