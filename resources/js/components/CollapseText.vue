<script>
export default {
    name: "CollapseText",
    props: {
      text: {
        type: String,
        required: true
      },
      maxLines: {
        type: Number,
        default: 3
      }
    },
    data() {
      return {
        isExpanded: false
      };
    },
    computed: {
      textClass() {
        return this.isExpanded ? '' : 'collapsed';
      }
    },
    methods: {
      toggleText() {
        this.isExpanded = !this.isExpanded;
      }
    }
  };
</script>

<template>
  <div class="collapse-container">
    <div class="collapse-text" :class="textClass"
       :style="{ '-webkit-line-clamp': isExpanded ? 'unset' : maxLines }">
<!--      {{ text }}-->
      <div v-html="text"></div>
      <div v-if="!isExpanded" class="fade-overlay"></div>
    </div>

    <a href="#" @click="toggleText">{{ isExpanded ? $t('collapse') : $t('all_show') }}</a>
  </div>
</template>

<style scoped>
/* Контейнер */
.collapse-container {
  width: 100%;
}

/* Текст */
.collapse-text {
  position: relative;
  overflow: hidden;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  font-size: 16px;
  line-height: 1.5;
  color: #333;
  transition: all 0.3s ease;
}

/* Затемнение внизу текста */
.fade-overlay {
  position: absolute;
  z-index: 100;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 30px;
  background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 100%);
}

</style>