<template>
    <div>
        <h5>
          <svg class="icon"><use xlink:href="#fa-address-card"></use></svg>
          {{ $t('contacts_data') }}</h5>
        <div class="content">
            <div v-if="auth_user" class="auth_user">
                <div class="mb-3 row">
                    <label>
                        {{ $t('user_name') }}:
                    </label>
                    <div class="col">
                        {{ this.name }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label>
                        {{ $t('phone') }}:
                    </label>
                    <div class="col">
                        {{ this.phone }}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label>
                        e-mail:
                    </label>
                    <div class="col">
                        {{ this.email }}
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="user_type">
                    <input type="radio" id="type1" v-model="contacts" value="1">
                    <label for="type1">
                        {{$t('nev_client') }}
                    </label> &nbsp; &nbsp; &nbsp; &nbsp;
                    <input type="radio" id="type2" v-model="contacts" value="2">
                    <label for="type2">
                        {{ $t('have_account') }}
                    </label>
                </div>
                <div v-if="contacts == 1" class="login">
                    <div class="mb-3 row">
                        <label class="col-sm-2 star">
                            {{ $t('user_name') }}:
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" :class="{'is-invalid': errors.name}"
                                   v-model="name" required>
                            <span v-if="errors.name" class="invalid-feedback" role="alert">
                                <strong>{{ errors.name }}</strong>
                        </span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 star">
                            {{ $t('phone') }}:
                        </label>
                        <div class="col-sm-10">
                            <input-phone
                                name="phone"
                                v-model="phone"
                                :class="{'is-invalid': errors.phone}"
                                placeholder=""
                                required="required"
                            ></input-phone>
                            <span v-if="errors.phone" class="invalid-feedback" role="alert">
                                <strong>{{ errors.phone }}</strong>
                        </span>
                        </div>

                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">
                            e-mail
                        </label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" :class="{'is-invalid': errors.email}"
                                   v-model="email">
                            <span v-if="errors.email" class="invalid-feedback" role="alert">
                                <strong>{{ errors.email }}</strong>
                        </span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">
                        </label>
                        <div class="col-sm-10">
                            <a href="register">{{ $t('register') }}</a> &nbsp; <span class="info">({{$t('register_info') }})</span>
                        </div>
                    </div>
                </div>
                <div v-else class="login">
                    <div class="mb-3 row">
                        <label class="col-sm-2 star">
                            {{ $t('phone') }}:
                        </label>
                        <div class="col-sm-10">
                            <input-phone
                                v-model="phone"
                                :class="{'is-invalid': errors.phone}"
                                placeholder=""
                                @input="cleanError()"
                            ></input-phone>
                            <span v-if="errors.phone" class="invalid-feedback" role="alert">
                                <strong>{{ errors.phone }}</strong>
                        </span>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2 star">
                            {{ $t('password') }}:
                        </label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" :class="{'is-invalid': errors.password}"
                                   v-model="password" @input="cleanError()" required>
                            <span v-if="errors.password" class="invalid-feedback" role="alert">
                                <strong>{{ errors.password }}</strong>
                        </span>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10">
                            <span class="btn btn-blue" @click="login()">{{ $t('login') }}</span> &nbsp;
                            <a href="password/reset">{{ $t('forgot_password') }}?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h5>
          <svg class="icon"><use xlink:href="#fa-truck-arrow-right"></use></svg>
          {{ $t('delivery') }}
        </h5>
        <delivery-select
            :deliveries="deliveries"
            v-model="delivery"
            :address="delivery_address"
            :validate_errors="errors"
            :np_city="np_city"
            :np_city_ref="np_city_ref"
            :np_warehouse="np_warehouse"
            :np_warehouse_ref="np_warehouse_ref"
        >
        </delivery-select>
        <h5>
          <svg class="icon"><use xlink:href="#fa-money-bill-1"></use></svg>
          {{ $t('payment') }}
        </h5>
        <div class="content">
            <ul>
                <li v-for="pay in payments">
                    <input type="radio" name="payment_id" :id="'payment'+pay.id" :value="pay.id" v-model="payment">
                    <label :for="'payment'+pay.id">{{ pay.title }}</label>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "CreateOrder",
    props:[
        'deliveries',
        'payments',
        'user',
        'validate_errors'
    ],
    created() {
        if (this.user){
            this.userData(this.user)
        }
        if (this.validate_errors){
            this.errors = this.validate_errors
        }
    },
    data(){
        return{
          contacts: 1,
          delivery: 1,
          payment: 1,
          auth_user: false,
          phone: '',
          password: '',
          name: '',
          email: '',
          delivery_address: '',
          errors: false,
          show: false,
          np_city: '',
          np_city_ref: '',
          np_warehouse: '',
          np_warehouse_ref: '',
        }
    },
    methods:{

        login(){
            let data = {
                'phone': this.phone,
                'password': this.password,
            }
            axios.post('login_order', data)
                .then(response => {
                    // console.log(response.data);
                    this.userData(response.data.user)
                })
                .catch(error => {
                    console.log(error);
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                })
        },

        userData(data){
            this.auth_user = 1
            this.name = data.name
            this.phone = data.phone //
            this.email = data.email
            this.delivery = data.delivery_id
            this.payment = data.payment_id
            this.delivery_address= data.delivery_address
          this.np_city = data.np_city
          this.np_city_ref = data.np_city_ref
          this.np_warehouse = data.np_warehouse
          this.np_warehouse_ref = data.np_warehouse_ref
        },
        cleanError(){
            this.errors = false
        }

    }
}
</script>

<style>

</style>
