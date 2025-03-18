<template>
  <div>
    <span @click="toggleHtmlView" class="toggle-btn">
      {{ showHtml ? "Вернуться в редактор" : "Просмотр HTML" }}
    </span>

    <div v-if="showHtml">
      <textarea v-model="content" class="html-view"></textarea>
    </div>

<!--    <QuillEditor-->
<!--        v-else-->
<!--        ref="quillEditor"-->
<!--        v-model:content="content"-->
<!--        contentType="html"-->
<!--        theme="snow"-->
<!--        :modules="moduleseditor"-->
<!--    />-->

    <QuillEditor
        :modules="modules"
        v-model:content="content"
        toolbar="full"
        contentType="html"
        theme="snow"
    />
  </div>
</template>

<script>

import { QuillEditor, Quill } from "@vueup/vue-quill";
import ImageUploader from "quill-image-uploader";
import axios from "axios";
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import BlotFormatter from 'quill-blot-formatter'

//Quill.register("modules/imageUploader", ImageUploader);

export default {
  components: {
    QuillEditor,
    Quill
  },
  data() {
    return {
      content: "",
      showHtml: false,
      // moduleseditor: {
      //   // toolbar: [
      //   //   [{header: [1, 2, false]}],
      //   //   ["bold", "italic", "underline"],
      //   //   ["image"], // Кнопка загрузки изображений
      //   //   [{list: "ordered"}, {list: "bullet"}]
      //   // ],
      //   imageUploader: {
      //     upload: this.uploadImage
      //   }
      // }

      modules : {
        name: 'imageUploader',
        module: ImageUploader,
        options: {
          upload: file => {
            return new Promise((resolve, reject) => {
              const formData = new FormData();
              formData.append("image", file);

              console.log('Form '+formData);

              // axios.post('/upload-image', formData)
              //     .then(res => {
              //       console.log(res)
              //       resolve(res.data.url);
              //     })
              //     .catch(err => {
              //       reject("Upload failed");
              //       console.error("Error:", err)
              //     })

              axios.post('/photo/upload', formData, {
                headers: {
                  'Content-Type': 'multipart/form-data'
                }
              }).then(response => {
                 console.log(response.data);
                //this.fileList = this.fileList.concat(response.data);
                //this.$emit('update:modelValue', this.fileList)
               // this.$refs.files.value=''; // zero input files
              }).catch(error => {
                console.log(error);
              });
            })
          }
        },


      }
    };
  },
      methods: {
        toggleHtmlView() {
          this.showHtml = !this.showHtml;
        },

        // Метод для загрузки изображения
        async uploadImage(file) {
          const formData = new FormData();
          formData.append("image", file);

          try {
            const response = await axios.post("/api/upload", formData, {
              headers: {"Content-Type": "multipart/form-data"}
            });

            return response.data.url; // Вставляем URL загруженного изображения
          } catch (error) {
            console.error("Ошибка загрузки", error);
            throw new Error("Ошибка загрузки изображения");
          }
        },

      }
    }

</script>

<style scoped>
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
