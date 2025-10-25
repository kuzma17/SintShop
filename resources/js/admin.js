/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import {createApp} from 'vue';
// import { i18nVue } from 'laravel-vue-i18n'
import mitt from 'mitt';
import { Quill, QuillEditor } from '@vueup/vue-quill'
import ImageUploader from "quill-image-uploader";
import BlotFormatter from 'quill-blot-formatter'


/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

const emitter = mitt();
app.config.globalProperties.emitter = emitter

//==========================================


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

import QuillEditorEl from "./components/admin/QuillEditor.vue";
app.component('quill-editor', QuillEditorEl);

import VideosGood from "./components/admin/VideosGood.vue";
app.component('videos-good', VideosGood);

//-----------------

//========== QuillEditor ==========================

Quill.register('modules/imageUploader', ImageUploader);
Quill.register('modules/blotFormatter', BlotFormatter);

const globalOptions = {
 debug: 'info',
 modules: {
  toolbar: [
   ['bold', 'italic', 'underline'],        // toggled buttons
   // ['blockquote'],
   [{ 'header': 1 }, { 'header': 2 },{ 'header': [1, 2, 3, 4, 5, 6, false] }],  // custom button values
   [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
   [{ 'align': [] }],
   [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
   //[{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
   [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
   [{ 'direction': 'rtl' }],                         // text direction
   [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
   [{ 'font': ['arial', 'times-new-roman', 'courier-new'] }],
   ['link', 'image', 'video'],
   ['clean']                                         // remove formatting button
  ],
  imageUploader: {
   upload: (file) => {
    return new Promise((resolve, reject) => {
     const formData = new FormData();
     formData.append("image", file);
     axios.post('/photo/upload', formData).then(res => {
      //console.log(res.data)
      resolve(res.data.url);
     }).catch(err => {
      reject("Upload failed");
      console.error("Error:", err)
     });
    });
   }
  },
  blotFormatter: {}
 },
 sanitize: "false",
 readOnly: false,
 theme: 'snow',
}

QuillEditor.props.globalOptions.default = () => globalOptions
app.component('QuillEditor', QuillEditor)

 app.mount("#app");



