/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import {createApp} from 'vue';
// import { i18nVue } from 'laravel-vue-i18n'

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

import InputPhotos from "./components/inputPhotos.vue";
app.component('input-photos', InputPhotos);

import InputImage from "./components/inputImage.vue";
app.component('input-image', InputImage);




//-----------------

 app.mount("#app");

