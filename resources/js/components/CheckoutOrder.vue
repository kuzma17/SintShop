<template>
    <div>
        <div v-if="!show" style="text-align: center; padding: 20px">
            <button @click="show=true" class="btn btn-blue">Оформить заказ</button>
        </div>
        <div v-if="show">
            <h4>Оформление заказа</h4>

        <div class="checkout_order">
            <h5><i class="fa-regular fa-address-card"></i> Контактные данные</h5>
            <div class="content_checkout">

                <div v-if="auth_user" class="auth_user">

                    <div class="mb-3 row">
                        <label class="col-sm-2">
                            ФИО:
                        </label>
                        <div class="col-sm-10">
                            {{ this.name }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">
                            Телефон:
                        </label>
                        <div class="col-sm-10">
                            {{ this.phone }}
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-sm-2">
                            e-mail:
                        </label>
                        <div class="col-sm-10">
                            {{ this.email }}
                        </div>
                    </div>

                </div>
                <div v-else>
                    <div class="user_type">
                        <input type="radio" id="type1" v-model="contacts" value="1">
                        <label for="type1">
                            Я новый покупатель
                        </label> &nbsp; &nbsp; &nbsp; &nbsp;
                        <input type="radio" id="type2" v-model="contacts" value="2">
                        <label for="type2">
                            У меня есть аккаунт
                        </label>
                    </div>

                    <div v-if="contacts == 1" class="login">
                        <div class="mb-3 row">
                            <label class="col-sm-2 star">
                                ФИО
                            </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" :class="{'is-invalid': errors.name}" v-model="name" required>
                                <span v-if="errors.name" class="invalid-feedback" role="alert">
                                <strong>{{ errors.name }}</strong>
                            </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 star">
                                Телефон
                            </label>
                            <div class="col-sm-10">
                                <!--                            <input type="text"  class="form-control" v-model="phone">-->
                                <input-phone
                                    v-model="phone"
                                    :class="{'is-invalid': errors.phone}"
                                    placeholder="Пример: +38 (099) 999 99 99"
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
                                <input type="email" class="form-control" :class="{'is-invalid': errors.email}" v-model="email" >
                                <span v-if="errors.email" class="invalid-feedback" role="alert">
                                <strong>{{ errors.email }}</strong>
                            </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2">
                            </label>
                            <div class="col-sm-10">
                                <a href="register">Регистрация</a> (Регистрация позволяет зайти в личный кабинет,
                                отслеживать свои покупки)
                            </div>
                        </div>

                    </div>
                    <div v-else class="login">
                        <div class="mb-3 row">
                            <label class="col-sm-2 star">
                                Телефон
                            </label>
                            <div class="col-sm-10">
                                <input-phone
                                    v-model="phone"
                                    :class="{'is-invalid': errors.phone}"
                                    placeholder="Пример: +38 (099) 999 99 99"
                                ></input-phone>
                                <span v-if="errors.phone" class="invalid-feedback" role="alert">
                                <strong>{{ errors.phone }}</strong>
                            </span>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 star">
                                Пароль
                            </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" :class="{'is-invalid': errors.password}"
                                       v-model="password" required>
                                <span v-if="errors.password" class="invalid-feedback" role="alert">
                                <strong>{{ errors.password }}</strong>
                            </span>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                <span class="btn btn-blue" @click="login()">Войти</span>
                                <a href="password/reset">Забыли пароль?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h5><i class="fa-solid fa-truck-arrow-right"></i> Доставка</h5>

            <div class="content_checkout">
                <ul>
                    <li v-for="item in deliveries">
                        <input type="radio" :id="'delivery' + item.id" :value="item.id"
                               v-model="delivery">
                        <label :for="'delivery' + item.id">{{ item.title }}</label>
                    </li>

                </ul>

                <div v-if="delivery == 2">
                    <div class="mb-3 row">
                        <label class="col-sm-2 star">
                            Адрес
                        </label>
                        <div class="col-sm-10">
                            <input type="text"
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
            <h5><i class="fa-regular fa-money-bill-1"></i> Способ оплаты</h5>
            <div class="content_checkout">
                <ul>
                    <li v-for="pay in payments">
                        <input type="radio" :id="'payment'+pay.id" :value="pay.id" v-model="payment">
                        <label :for="'payment'+pay.id">{{ pay.title }}</label>
                    </li>
                </ul>
            </div>
            <div class="mb-3 row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <button @click="saveOrder()" class="btn btn-blue">Сохранить</button>
                </div>

            </div>
        </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "CheckoutOrder",
    props:[
        'deliveries',
        'payments',
        'errors_list',
        'user'
    ],
    mounted() {
        if (this.user){
            this.userData(this.user)
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
            //csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

        }
    },
    methods:{

        login(){
            let data = {
                'phone': this.phone,
                'password': this.password,
            }
            axios.post('login', data)
                .then(response => {
                  // console.log(response.data);
                  //   this.auth_user = 1
                  //   this.name = response.data.user.name
                  //   this.phone = response.data.user.phone //
                  //   this.email = response.data.user.email
                  //   this.delivery = response.data.user.delivery_id
                  //   this.payment = response.data.user.payment_id
                  //   this.delivery_address= response.data.user.delivery_address

                    this.userData(response.data.user)

                })
                .catch(error => {
                    console.log(error);
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                })
        },

        saveOrder(){
            if((this.contacts == 1 && this.name && this.phone) || (this.contacts == 2 && this.auth_user)){

                let data = {
                    'name': this.name,
                    'phone': this.phone,
                    'email': this.email,
                    'password': this.password,
                    'delivery_id': this.delivery,
                    'payment_id': this.payment,
                    'delivery_address': this.delivery_address,
                }
                axios.post('order/store', data)
                    .then(response => {
                        console.log(response.data);

                        // window.location.href = '/';

                    })
                    .catch(error => {
                        console.log(error);
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    })
            }
        },

        userData(data){
            this.auth_user = 1
            this.name = data.name
            this.phone = data.phone //
            this.email = data.email
            this.delivery = data.delivery_id
            this.payment = data.payment_id
            this.delivery_address= data.delivery_address
        }

    }
}
</script>

<style scoped>

</style>
