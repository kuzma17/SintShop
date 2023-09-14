/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler.js';
import { i18nVue } from 'laravel-vue-i18n'

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});


import mitt from 'mitt';
const emitter = mitt();
app.config.globalProperties.emitter = emitter


//--- Components ---
import PhotosGood from './components/PhotosGood.vue';
app.component('photos-good', PhotosGood);

import ButtonAddCart from './components/ButtonAddCart.vue';
app.component('button-add-cart', ButtonAddCart);

// import ExistenceGood from './components/ExistenceGood.vue';
// app.component('existence-good', ExistenceGood);

import CartIcon from './components/CartIcon.vue';
app.component('cart-icon', CartIcon);

import Cart from './components/Cart.vue';
app.component('cart', Cart);

import InputQuantity from './components/InputQuantity.vue';
app.component('input-quantity', InputQuantity);

import InputPhone from './components/inputPhone.vue';
app.component('input-phone', InputPhone);

// import CheckoutOrder from './components/CheckoutOrder.vue';
// app.component('checkout-order', CheckoutOrder);

import CreateOrder from './components/CreateOrder.vue';
app.component('create-order', CreateOrder);

import Login from "./components/Login.vue";
app.component('login', Login);

import DeliveryChoice from "./components/DeliveryChoice.vue";
app.component('delivery-choice', DeliveryChoice);



//-----------------

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.use(i18nVue, {
        resolve: async lang => {
            const langs = import.meta.glob('../lang/*.json');
            return await langs[`../lang/${lang}.json`]();
        }
    }).mount('#app');

// app.mount("#app");

const myCollapsible = document.getElementById('collapseOrder');
if(myCollapsible){
    myCollapsible.addEventListener('shown.bs.collapse', event => {
        document.querySelectorAll(".button_order_create").forEach(button_order_create => { button_order_create.style.display = "none" });
    });
};
