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

import InputPhotos from "./components/admin/InputPhotos.vue";
app.component('input-photos', InputPhotos);

import InputImage from "./components/admin/InputImage.vue";
app.component('input-image', InputImage);

import InputPhone from './components/InputPhone.vue';
app.component('input-phone', InputPhone);

import CategoryGood from './components/admin/CategoryGood.vue';
app.component('category-good', CategoryGood);

import AttributesGood from "./components/admin/AttributesGood.vue";
app.component('attributes-good', AttributesGood);

import InputFloat from "./components/admin/InputFloat.vue";
app.component('input-float', InputFloat);

import InputString from "./components/admin/InputString.vue";
app.component('input-string', InputString);

import InputBoolean from "./components/admin/InputBoolean.vue";
app.component('input-boolean', InputBoolean);

import InputSet from "./components/admin/InputSet.vue";
app.component('input-set', InputSet);

import TypeAttribute from "./components/admin/TypeAttribute.vue";
app.component('type-attribute', TypeAttribute);

import TextEditor from "./components/admin/TinyEditor.vue";
app.component('text-editor', TextEditor);

import QuillEditor from "./components/admin/QuillEditor.vue";
app.component('quill-editor', QuillEditor);

//-----------------

 app.mount("#app");



