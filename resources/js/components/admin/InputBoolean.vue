<template>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="switchSizeLargeChecked" v-model="value.values" :checked="value.values" @click="checkBox()"/>
        <input v-if="value.values" type="hidden" :name="'values['+attribute_id+'][0][id]'" :value="value.id">
        <input v-if="value.values" type="hidden" :name="'values['+attribute_id+'][0][values]'" :value="value.values">
    </div>
</template>

<script>
export default {
    name: "InputBoolean",
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
            this.value = this.modelValue[0]
        }
         //console.log(this.value);
    },
    data(){
        return{
            value: {
                id: 0,
                values: 0
            }

        }
    },
    methods:{

        checkBox(){
            let values = this.attributeValues
            let id_checked = values.find(el => el.values === 1).id

            if (this.value.values){
                this.value.values = false
            }else{
                this.value = {
                    id: id_checked,
                    values: true
                }
            }
        }

    }
}
</script>

<style scoped>

</style>
