<template>
  <div>
    <!-- Кнопка звонка -->
    <button class="callback-button" @click="toggleForm">
      <i class="fa-solid fa-phone icon"></i>
    </button>

    <!-- Форма обратного звонка -->
    <div v-if="showForm" class="callback-form">
      <input type="text" v-model="name" placeholder="Ваше имя" />
      <input type="tel" v-model="phone" placeholder="Ваш телефон" />
      <button @click="submitForm">Отправить</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "CallbackButton",
  props:[
  ],
  mounted() {
  },
  data(){
    return{
      showForm : false,
      name: '',
      phone: ''
    }
  },
  methods:{
    toggleForm() {
      this.showForm = !this.showForm;
    },

    submitForm() {
      if (!this.phone.trim()) {
        alert("Введите номер!");
        return;
      }

      this.$emit("submit", this.phone);
      this.phone = "";
      this.showForm = false;
    },

  }
}
</script>

<style scoped>
/* Стили кнопки */
.callback-button {
  position: fixed;
  bottom: 100px;
  right: 20px;
  background: #007bff;
  color: white;
  border: none;
  padding: 15px;
  border-radius: 50%;
  cursor: pointer;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  z-index: 100;
}

.icon {
  //width: 24px;
  //height: 24px;
  font-size: 32px;
}

/* Всплывающая форма */
.callback-form {
  position: fixed;
  bottom: 100px;
  right: 20px;
  background: white;
  padding: 10px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  display: flex;
  flex-direction: column;
  gap: 8px;
  z-index: 99;
}

.callback-form input {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.callback-form button {
  background: #007bff;
  color: white;
  padding: 8px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
</style>