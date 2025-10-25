<template>
  <div>
    <button v-if="showBtn" class="callback-button" @click="openForm()">
      <svg class="icon icon-btn-callback">
        <use xlink:href="#fa-phone-flip"></use>
      </svg>
    </button>

    <div v-if="showForm" class="callback-container">
      <div class="callback-header" style="position: relative">
        <span>{{$t('callback')}}</span>
        <span class="close_callback" @click="closeForm()">
        <i class="fa-solid fa-circle-xmark icon-close-callback"></i>
      </span>
      </div>
      <div v-if="message" class="callback-message">{{message}}</div>
      <div v-if="!message" class="callback-form">
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
  </div>
</template>

<script>
export default {
  name: "CallbackButton",
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
      message: false
    }
  },
  methods:{
    openForm(){
      this.showForm = true
      this.showBtn = false
    },

    closeForm(){
      this.phone = "";
      this.name = '';
      this.showForm = false
      this.showBtn = true
      this.message = false
      this.errors.name = ''
      this.errors.phone = ''
    },

    validateName() {
      this.errors.name = this.name ? '' : this.$t('error_name');
      if (!this.name){
        this.submit = false;
      }

    },
    validatePhone() {
      this.errors.phone = this.phone ? '' : this.$t('error_phone');
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
               //console.log(response.data);
               if (response.data.success === true){
                 this.message =  response.data.message
               }
            })
            .catch(error => {
              console.log(error);
              if (error.response.status === 422) {
                this.errors = error.response.data.errors;
              }
            });
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
  padding: 7px;
  color: #04B4F2;
  font-size: 16px;
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
  color: white;
}

/* Всплывающая форма */
.callback-container {
  position: fixed;
  max-width: 250px;
  bottom: 100px;
  right: 20px;
  background: white;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  display: flex;
  flex-direction: column;
  z-index: 99;
}
.callback-form{
  padding: 10px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.callback-form input {
  padding: 8px;
}

.callback-form button {
  background: #0468C5;
  color: white;
  padding: 8px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.error-message{
  font-size: 11px;
  color: darkred;
}
.callback-message{
  padding: 10px 7px 20px 7px;
  font-size: 14px;
}

</style>