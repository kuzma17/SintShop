<template>
    <div class="login">
        <a v-if="auth" :href="patchLocale()+'/user/profile'"><i class="fa-solid fa-user"></i> {{ $t('personal_area') }}</a>
        <span v-else @click="show = !show" ><i class="fa-solid fa-user"></i> {{ $t('login') }}</span>
        <transition name="fade">
        <div v-if="show" class="dropdown-login">
            <div class="container_btn"><span class="close_btn" @click="show = false">x</span></div>
           <div class="body">
               <div class="row mb-3">
                   <div class="col-md-12">
                       <input-phone
                           name="phone"
                           v-model="phone"
                           :class="{'is-invalid': errors.phone}"
                           :placeholder="$t('phone')"
                           autofocus="1"
                           @input="cleanError()"
                       ></input-phone>
                       <span v-if="errors.phone" class="invalid-feedback" role="alert">
                        <strong>{{errors.phone}}</strong>
                    </span>
                   </div>
               </div>

               <div class="row mb-3">
                   <div class="col-md-12">
                       <input id="password"
                              type="password"
                              class="form-control"
                              :class="{'is-invalid': errors.password}"
                              name="password"
                              required
                              autocomplete="current-password"
                              :placeholder="$t('password')"
                              v-model="password"
                              @input="cleanError()"
                       >
                       <span v-if="errors.password" class="invalid-feedback" role="alert">
                        <strong>{{errors.password}}</strong>
                    </span>
                   </div>
               </div>

               <div class="row">
                   <div class="col-md-12">
                       <div class="form-check">
                           <input class="form-check-input" type="checkbox" v-model="remember" name="remember" id="remember">
                           <label class="form-check-label" for="remember">
                               {{ $t('remember') }}
                           </label>
                       </div>
                   </div>
               </div>

               <div class="row mb-3">
                   <div class="col-md-12">
                       <button type="submit" @click="login()" class="btn btn-blue">
                           {{ $t('login') }}
                       </button>
                   </div>
               </div>
               <a class="" :href="patchLocale()+'/password/reset'">
                   {{ $t('forgot_password') }}?
               </a><br>
               <a class="" :href="patchLocale()+'/register'">
                   {{ $t('register') }}
               </a>
           </div>
        </div>
        </transition>
    </div>
</template>

<script>

import {getActiveLanguage} from "laravel-vue-i18n";

export default {
    name: "Login",
    components: {
       // trans
    },
    props: [
        'auth_user',
    ],
    mounted() {
        if(this.auth_user){
            this.auth = this.auth_user
        }
    },
    data(){
        return{
            auth: false,
            show: false,
            phone: '',
            password: '',
            remember: '',
            errors: false,

        }
    },
    methods:{
        getActiveLanguage,
        login(){
            let data = {
                'phone': this.phone,
                'password': this.password,
                'remember': this.remember
            }
            axios.post(this.patchLocale() + '/login', data)
                .then(response => {
                     console.log(response.data);
                   // this.userData(response.data.user)

                    this.auth = true
                    this.show = false
                })
                .catch(error => {
                    console.log(error);
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                        }
                })
        },
        cleanError(){
            this.errors = false
        },
        patchLocale(){
            let locale = getActiveLanguage()
            if(locale === "ru"){
                return '/ru'
            }
            return ''
        }
    }
}
</script>

<style>
.login{
    position: relative;
}
.login span{
    cursor: pointer;
}
.dropdown-login{
    position: absolute;
    width: 250px;
    padding: 5px;
    z-index: 100;
    top: 30px;
    right: -20px;
    background-color: #FFFFFF;
    border: 1px solid #CCCCCC;
    box-shadow: 5px 5px 5px #CCCCCC;
    border-radius: 10px;
}
.container_btn{
    height: 15px;
}
.close_btn{
    position: absolute;
    top: 5px;
    right: 5px;
    width: 20px;
    height: 20px;
    cursor: pointer;
    text-align: center;
}

</style>
