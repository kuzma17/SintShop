<template>
  <div>
    <!-- Кнопка звонка -->
    <button v-if="showBtn" class="callback-button" @click="openForm()">
      <i class="fa-solid fa-phone icon-btn-callback"></i>
    </button>

    <!-- Форма обратного звонка -->
    <div v-if="showForm" class="callback-form">
      <div class="callback-header" style="position: relative">
        <span>{{$t('callback')}}</span>
        <span class="close_callback" @click="closeForm()">
        <i class="fa-solid fa-circle-xmark icon-close-callback"></i>
      </span>
      </div>
      <input type="text"
             v-model="name"
             class="form-control"
             :class="{'is-invalid': errors.name}"
             :placeholder="$t('name')"
             @input="this.errors.name=''"
      />
      <span v-if="errors.name" class="error-message">{{ errors.name }}</span>
      <input-phone
          name="phone"
          v-model="phone"
          :class="{'is-invalid': errors.phone}"
          :placeholder="$t('phone')"
          required="required"
          @input="this.errors.phone=''"
      ></input-phone>
      <span v-if="errors.phone" class="error-message">{{ errors.phone }}</span>
      <button @click="submitForm" class="btn btn-blue">{{$t('send')}}</button>
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
      showBtn: true,
      name: '',
      phone: '',
      errors: {
        name: '',
        phone: '',
      },
      submit: true,
    }
  },
  methods:{
    // toggleForm() {
    //   this.showForm = !this.showForm;
    // },

    openForm(){
      this.showForm = true
      this.showBtn = false
    },

    closeForm(){
      this.phone = "";
      this.name = '';
      this.showForm = false
      this.showBtn = true
    },

    validateName() {
      this.errors.name = this.name ? '' : 'Введите ваше имя.';

      if (!this.name){
        this.submit = false;
      }

    },
    validatePhone() {
     // const phonePattern = /^[0-9]{10}$/; // Пример: 10 цифр
      this.errors.phone = this.phone ? '' : 'Введите номер телефона.';
          // ? ''
          // : 'Пожалуйста, введите корректный номер телефона.';
      if (!this.phone) {
        this.submit = false;
      }
    },

    submitForm() {
      this.submit = true;
      this.validateName();
      this.validatePhone();

      if (this.submit){
        let data = {
          name: this.name,
          phone: this.phone
        };
        axios.post('callback', data)
            .then(response => {
               console.log(response.data);

            })
            .catch(error => {
              console.log(error);
              // if (error.response.status === 422) {
              //   this.errors = error.response.data.errors;
              // }
            });

        this.closeForm();

      }
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
  background: #04B3F1;
  color: white;
  border: none;
  padding: 15px;
  border-radius: 50%;
  cursor: pointer;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  z-index: 100;
}
.callback-header{
  position: relative;
}
.close_callback{
  position: absolute;
  right: -5px;
  top: -7px;
}
.icon-close-callback{
  font-size: 26px;
  color: #04B3F1;
}

.icon-btn-callback {
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
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  display: flex;
  flex-direction: column;
  gap: 8px;
  z-index: 99;
}

.callback-form input {
  padding: 8px;
  //border: 1px solid #ccc;
  //border-radius: 5px;
}

.callback-form button {
  background: #0468C5;
  color: white;
  padding: 8px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
</style>