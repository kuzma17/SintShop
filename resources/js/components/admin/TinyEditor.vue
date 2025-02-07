<template>
  <div class="text_editor">
    <Editor
        :api-key="this.apikey"
        :init="editorInit"
        :name="this.name"
        :initial-value="this.value"
    />
  </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'
export default {
  name: "TinyEditor",
  components: {
    Editor
  },
  props: {
    name: {
      type: String,
      default: ''
    },
    value: {
      type: String,
      default: ''
    },
    apikey: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      editorInit: {
        toolbar_mode: 'sliding',
        plugins: [
          'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'code'
        ],
        toolbar: 'undo redo code | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
          { value: 'First.Name', title: 'First Name' },
          { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
      },

    }
  }
};
</script>

<style scoped>

</style>