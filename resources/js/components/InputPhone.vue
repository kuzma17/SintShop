<template>
    <input
        ref="input"
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
        @change="edit()"
        :placeholder="placeholder"
        :required="required"
    />
</template>

<script>
import { IMaskDirective } from 'vue-imask'
export default {
    name: "InputPhone",
    directives: {
        imask: IMaskDirective
    },
    props: [
        'modelValue',
        'placeholder',
        'id',
        'required',
        'autofocus',
        'class',
        'name'
    ],
    emits: ['update:modelValue'],
    mounted() {
        this.value = this.modelValue

        if (this.autofocus){
            this.addFocus()
        }
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
        addFocus(){
            this.$refs.input.focus()
        },
    }
}
</script>

<style scoped>

</style>
