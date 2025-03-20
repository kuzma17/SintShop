<template>
  <div class="quill_editor">
    <span @click="toggleHtmlView" class="toggle-btn">
      {{ showHtml ? "editor" : "html" }}
    </span>

    <div v-if="showHtml">
      <textarea v-model="content" class="html-view"></textarea>
    </div>
    <QuillEditor
        v-if="!showHtml"
        v-model:content="content"
        toolbar="full"
        contentType="html"
        theme="snow"
        :modules="modules"
    />
    <input type="hidden" :name="this.name" v-model="content">
  </div>
</template>

<script>

import {Quill,QuillEditor} from "@vueup/vue-quill";
import ImageUploader from "quill-image-uploader";
import BlotFormatter from 'quill-blot-formatter'
import axios from "axios";
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  components: {
    QuillEditor,
    Quill
  },
  props:[
    'name',
    'value'
  ],
  mounted() {
    if(this.value){
      this.content = this.value
    }
  },
  data() {
    return {
      content: "",
      showHtml: false,
      modules: [
        {
          name: 'imageUploader',
          module: ImageUploader,
          options: {
            upload: file => {
              return new Promise((resolve, reject) => {
                const formData = new FormData();
                formData.append("image", file);

                axios.post('/photo/upload', formData)
                    .then(res => {
                      //console.log(res.data)
                      resolve(res.data.url);
                    })
                    .catch(err => {
                      reject("Upload failed");
                      console.error("Error:", err)
                    })
              })
            }
          },
        },
        {
          name: 'blotFormatter',
          module: BlotFormatter,
          options: {/* options */}
        }
      ]
    };
  },
  methods: {
    toggleHtmlView() {
      this.showHtml = !this.showHtml;
    },


  }
}

</script>

<style scoped>
.quill_editor{

}
.toggle-btn {
  margin-bottom: 10px;
  padding: 5px 10px;
  background: #007bff;
  color: white;
  border: none;
  cursor: pointer;
  border-radius: 4px;
}

.html-view {
  width: 100%;
  height: 300px;
  border: 1px solid #ddd;
  padding: 10px;
  font-family: monospace;
}
</style>
