<template>
    <div class="input-group">
        <span class="input-group-text">{{format}}</span>
        <input type="text" class="form-control" v-model="value.values" aria-describedby="basic-addon1">
        <input v-if="value.values > 0" type="hidden" :name="'values['+attribute_id+'][0][id]'" v-model="value.id">
        <input v-if="value.values > 0" type="hidden" :name="'values['+attribute_id+'][0][values]'" :value="value.values">
    </div>
</template>

<script>
export default {
    name: "InputFloat",
    props: [
        'modelValue',
        'format',
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

       // console.log(this.value);

    },
    created() {

    },
    data(){
        return{
            value:
                {
                    id: 0,
                    values: 0
                }
        }
    },
    methods:{

    }
}
</script>

<style scoped>

</style>
