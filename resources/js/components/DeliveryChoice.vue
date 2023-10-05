<template>
    <div class="content">
        <ul>
            <li v-for="item in deliveries">
                <input type="radio" :id="'delivery' + item.id" :value="item.id"
                       name="delivery_id"
                       v-model="delivery">
                <label :for="'delivery' + item.id">{{ item.title }}</label>
            </li>
        </ul>
        <div v-if="delivery == 2">
            <div class="mb-3 row">
                <label class="col-sm-2 star">
                    {{ $t('address') }}
                </label>
                <div class="col-sm-10">
                    <input type="text"
                           name="delivery_address"
                           class="form-control"
                           :class="{'is-invalid': errors.delivery_address}"
                           v-model="delivery_address"
                           :required="delivery == 2"
                    >
                    <span v-if="errors.delivery_address" class="invalid-feedback" role="alert">
                                <strong>{{ errors.delivery_address }}</strong>
                        </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DeliveryChoice",
    props:[
        'deliveries',
        'modelValue',
        'address',
        'validate_errors'
    ],
    emits: ['update:modelValue'],
    mounted() {
        if (this.modelValue){
            this.delivery = this.modelValue
        }
        this.delivery_address = this.address

    },
    data(){
        return{
            delivery: 1,
            delivery_address: '',
            errors: false,
            show: false,
        }
    },
    methods:{

    }
}
</script>

<style>
ul li {
    list-style-type: none;
    padding-left: 20px;
}

</style>
