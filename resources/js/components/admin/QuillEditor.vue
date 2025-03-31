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
        contentType="html"
        :class="this.class"
    />
    <input type="hidden" :name="name" v-model="content">
  </div>
</template>

<script>
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  props: {
    name: String,
    value: String,
    class: String
  },
  mounted() {
    if(this.value){
      this.content = this.value
    }
  },
  data() {
    return {
      content: "",
      showHtml: false,
    };
  },
  methods: {
    toggleHtmlView() {
      this.showHtml = !this.showHtml;
      if (this.showHtml) {
        this.content = this.content || ""; // Заполняем content при переходе в HTML-режим
      }
    },

  }
}
</script>

<style>
.quill_editor{}

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

:deep(.ql-container) {
  font-family: Arial, sans-serif;
  font-size: 16px;
  background-color: #f9f9f9;
  height: 300px; /* Начальная высота */
  min-height: 150px; /* Минимальная высота */
  max-height: 900px; /* Максимальная высота */
  resize: vertical; /* Позволяет изменять размер только по вертикали */
  overflow: auto; /* Добавляет скролл при необходимости */
  border: 1px solid #ccc; /* Граница, чтобы было видно, за что тянуть */
  padding: 5px;
}

.is-invalid {
  border-color: red !important;
}

</style>
