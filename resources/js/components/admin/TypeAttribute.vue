<template>
    <div>
        <div class="row mb-3">
            <label class="col-2 star">
                Тип
            </label>
            <div class="col-9">
                <select name="type_id" class="form-control" v-model="type" @click="changeType(type)">
                    <option v-for="type in typesAttribute" :value="type.id">{{type.title}}</option>
                </select>
                <input type="hidden" name="prev_type_id" :value="modelValue">
            </div>
        </div>
        <div v-if="type == 1" class="row mb-3">
            <label class="col-2 star">
                Значения
            </label>
            <div class="col-9">
                <div :id="key" v-for="(value, key) in values" class="value-item">
                    <input type="hidden" :name="'values['+key+'][id]'" :value="value.id">
                    <div class="row">
                        <div class="col-11">
                            <div class="row">
                                <div class="col-2">
                                    <label class="">value_ru</label>
                                </div>
                                <div class="col-10 p-0">
                                    <input type="text" :name="'values['+key+'][string_ru]'" v-model="value.string_ru" class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <label class="">value_ua</label>
                                </div>
                                <div class="col-10 p-0">
                                    <input type="text" :name="'values['+key+'][string_ua]'" v-model="value.string_ua" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 delete-value">
                            <i class="fa-regular fa-trash-can" @click="delValue(key)"></i>
                        </div>
                    </div>
                </div>
                <div class="">
                    <span class="btn btn-light" style="float: right" @click="addValue()">Добавить value</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TypeAttribute",
    props: [
        'modelValue',
        'typesAttribute',
        'valuesAttribute'
    ],
    mounted() {
        if (this.modelValue){
            this.type = this.modelValue
        }

        if (this.valuesAttribute){
            this.values = this.valuesAttribute
        }
    },
    created() {

    },
    data(){
        return{
            type: 1,

            // optionsType:[
            //     {id: 1, title: 'set'},
            //     {id: 2, title: 'string'},
            //     {id: 3, title: 'float'},
            //     {id: 4, title: 'boolean'}
            //     ],
            values: [],
        }
    },
    methods:{

        addValue(){
            this.values.push([
                {
                    string_ru: '',
                    string_ua: ''
                }
            ])
        },

        delValue(key){

            if (confirm('Вы действительно хотите удалить элемент?')){

                this.values.splice(key, 1)
            }
            return false
        },

        changeType(t){
            if (confirm('Вы действительно хотите изменить элемент?')){
                return true
            }
            this.type = t
            return false
        },

    }
}
</script>

<style>
.value-item{
    border: 1px solid #CCCCCC;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 10px;
}
.delete-value{
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: red;
}

</style>
