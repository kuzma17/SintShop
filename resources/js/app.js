/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

//import {createApp} from 'vue/dist/vue.esm-bundler.js';
import {createApp} from 'vue';
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

import PhotosGallery from './components/PhotosGallery.vue';
app.component('photos-gallery', PhotosGallery);

import ButtonAddCart from './components/ButtonAddCart.vue';
app.component('button-add-cart', ButtonAddCart);

import CartIcon from './components/CartIcon.vue';
app.component('cart-icon', CartIcon);

import Cart from './components/Cart.vue';
app.component('cart', Cart);

import InputQuantity from './components/InputQuantity.vue';
app.component('input-quantity', InputQuantity);

import InputPhone from './components/InputPhone.vue';
app.component('input-phone', InputPhone);

import CreateOrder from './components/CreateOrder.vue';
app.component('create-order', CreateOrder);

import Login from "./components/Login.vue";
app.component('login', Login);

import DeliveryChoice from "./components/DeliveryChoice.vue";
app.component('delivery-choice', DeliveryChoice);


//-----------------

// app.use(i18nVue, {
//         resolve: async lang => {
//             const langs = import.meta.glob('../lang/*.json');
//             return await langs[`../lang/${lang}.json`]();
//         }
//     }).mount('#app');

app.use(i18nVue, {
    resolve: lang => import(`../lang/${lang}.json`),
}).mount('#app');

// app.mount("#app");

// Button cart
const myCollapsible = document.getElementById('collapseOrder');
if(myCollapsible){
    myCollapsible.addEventListener('shown.bs.collapse', event => {
        document.querySelectorAll(".button_order_create").forEach(button_order_create => { button_order_create.style.display = "none" });
    });
}

// Preloader
const fadeOut = (el, timeout) => {
    el.style.opacity = 1;
    el.style.transition = `opacity ${timeout}ms`;
    el.style.opacity = 0;

    setTimeout(() => {
        el.style.display = 'none';
    }, timeout);
};

const Preloader = document.getElementById('preloader');
if(Preloader){
    fadeOut(Preloader, 300);
}

// Top Scroll

function scrollFunction() {
    const TopScroll = document.getElementById('top-scroll');

    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        TopScroll.style.display = "block";
    } else {
        TopScroll.style.display = "none";
    }
}

window.onscroll = function() {scrollFunction()};
