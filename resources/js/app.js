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

import DeliverySelect from "./components/DeliverySelect.vue";
app.component('delivery-select', DeliverySelect);

import NovaPoshtaWarehouse from "./components/NovaPoshtaWarehouse.vue";
app.component('nova-poshta-warehouse', NovaPoshtaWarehouse);

import SelectOffice from "./components/SelectOffice.vue";
app.component('select-office', SelectOffice);

import SortGoods from "./components/SortGoods.vue";
app.component('sort-goods', SortGoods);

import FilterGoods from "./components/FilterGoods.vue";
app.component('filter-goods', FilterGoods);

import FilterAttribute from "./components/FilterAttribute.vue";
app.component('filter-attribute', FilterAttribute);

import FilterPrice from "./components/FilterPrice.vue";
app.component('filter-price', FilterPrice);

import CollapseText from "./components/CollapseText.vue";
app.component('collapse-text', CollapseText);

import CallbackButton from "./components/CallbackButton.vue";
app.component('callback-button', CallbackButton);


//-----------------

app.use(i18nVue, {
    resolve: lang => import(`../lang/${lang}.json`),
}).mount('#app');

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
