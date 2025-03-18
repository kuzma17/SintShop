<template>
  <div class="editor-container">
    <!-- Панель инструментов -->
    <div v-if="editor" class="toolbar">
      <button type="button" @click="toggleBold" :class="{ active: editor.isActive('bold') }">B</button>
      <button type="button" @click="toggleItalic" :class="{ active: editor.isActive('italic') }">I</button>
      <button type="button" @click="toggleHeading" :class="{ active: editor.isActive('heading', { level: 2 }) }">H2</button>
      <button type="button" @click="toggleBulletList" :class="{ active: editor.isActive('bulletList') }">• List</button>
      <button type="button" @click="toggleOrderedList" :class="{ active: editor.isActive('orderedList') }">1. List</button>
      <button type="button" @click="clearFormatting">Clear</button>
      <button type="button" @click="toggleHtmlMode" :class="{ active: showHtml }">HTML</button>
      <button type="button" @click="triggerImageUpload">📷 Image</button>
      <input type="file" ref="fileInput" accept="image/*" @change="uploadImage" class="hidden-input" />
    </div>

    <!-- Редактор или HTML -->
    <EditorContent v-if="editor && !showHtml" :editor="editor" class="editor" />
    <textarea v-if="showHtml" v-model="htmlContent" class="html-view"></textarea>
  </div>
</template>

<script setup>
import {onMounted, onBeforeUnmount, ref, computed} from 'vue';
import {Editor, EditorContent} from '@tiptap/vue-3';
import StarterKit from '@tiptap/starter-kit';
import Image from '@tiptap/extension-image';


const editor = ref(null);
const showHtml = ref(false);
const fileInput = ref(null);

const htmlContent = computed({
  get: () => editor.value?.getHTML() || '',
  set: (value) => editor.value?.commands.setContent(value),
});

// Методы для управления редактором
const toggleBold = () => editor.value?.chain().focus().toggleBold().run();
const toggleItalic = () => editor.value?.chain().focus().toggleItalic().run();
const toggleHeading = () => editor.value?.chain().focus().toggleHeading({level: 2}).run();
const toggleBulletList = () => editor.value?.chain().focus().toggleBulletList().run();
const toggleOrderedList = () => editor.value?.chain().focus().toggleOrderedList().run();
const clearFormatting = () => editor.value?.chain().focus().unsetAllMarks().clearNodes().run();
const toggleHtmlMode = () => showHtml.value = !showHtml.value;

// Открытие окна загрузки файлов
const triggerImageUpload = () => fileInput.value?.click();

// Обработка загрузки изображений
const uploadImage = async (event) => {
  const file = event.target.files[0];
  if (!file) return;

  // Создание формы для загрузки
  const formData = new FormData();
  //formData.append('images', file); // Изменяем на "images" вместо "image"
  formData.append('images[]', file);


  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  try {
    // Отправка на сервер
    const response = await fetch('/photo/upload', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,  // Добавляем CSRF токен в заголовки
      },
      body: formData,
    });

    const data = await response.json();

    console.log(data[0].src);
    let url = data[0].src;

    if (url) {
      // Вставляем изображение в редактор
      editor.value?.chain().focus().setImage({src: '/images/goods/' + url}).run();

    } else {
      console.error('Ошибка загрузки изображения');
    }
  } catch (error) {
    console.error('Ошибка при загрузке изображения:', error);
  }

  event.target.value = ''; // Очистка input, чтобы можно было загружать одно и то же изображение
};

onMounted(() => {
  editor.value = new Editor({
    content: '<p><strong>Test:</strong> I\'m running Tiptap with Vue.js. 🎉</p>',
    extensions: [StarterKit, Image],
  });
});

onBeforeUnmount(() => {
  editor.value?.destroy();
});
</script>

<style scoped>
.editor-container {
  border: 1px solid #ddd;
  border-radius: 8px;
  background: #fff;
  padding: 10px;
}

.toolbar {
  display: flex;
  gap: 5px;
  margin-bottom: 10px;
}

.toolbar button {
  padding: 5px 10px;
  border: none;
  cursor: pointer;
  background: #f3f3f3;
  border-radius: 5px;
}

.toolbar button.active {
  background: #333;
  color: white;
}

.editor {
  min-height: 150px;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.html-view {
  width: 100%;
  min-height: 150px;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 10px;
  font-family: monospace;
}

.hidden-input {
  display: none;
}
</style>
