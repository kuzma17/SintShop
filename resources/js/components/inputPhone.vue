<template>
    <input
        :id="id"
        :name="name"
        v-model="value"
        v-imask="mask"
        @accept="
              (e) => {
                value = e.detail.value;
              }
            "
        class="form-control"
        :class="class"
        required
        @change="edit()"
        :placeholder="placeholder"
    />
</template>

<script>

import { IMaskDirective } from 'vue-imask'
export default {
    name: "inputPhone",
    directives: {
        imask: IMaskDirective
    },
    props: [
        'modelValue',
        'placeholder',
        'id',
        'required',
        'class',
        'name'
    ],
    emits: ['update:modelValue'],
    mounted() {
        this.value = this.modelValue
    },
    data(){
        return{
            value: "",
            IsValid: true,
            mask: {
                mask: "+38 (000) 000 00 00",
                lazy: true,
            },
        }
    },
    methods:{
        isValid(reg, input) {
            return input !== "" ? new RegExp(reg).test(input) : true;
        },

        edit(){
            this.num++
            this.$emit('update:modelValue', this.value)
        },
    }
}
</script>

<style scoped>

</style>
