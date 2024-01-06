<script>
import AppMain from './components/AppMain.vue';
import AppHeader from './components/AppHeader.vue';
import AppLogin from './components/AppLogin.vue';
import AppSignUp from './components/AppSignUp.vue';
import AppSubmission from './components/AppSubmission.vue';
import axios from 'axios';
export default {
  data() {
    return {
      notSignUp: false,
      isSubmit: false,
      isSubmitSuccess: false,
      errorSubmit: false,
      isLogged: false,
      usersList: [],
      apiUrl: "http://localhost/boolean/todo-list-vite/server/sign_up.php",
      apiUrlLogin: "http://localhost/boolean/todo-list-vite/server/login.php",
      userData: {
        password: '',
        email: '',
        username: '',

      },
      userDataLogin: {
        password: '',
        username: '',
      },
    }
  },
  components: { AppMain, AppHeader, AppLogin, AppSignUp, AppSubmission },
  methods: {
    toggleSignUp() {
      this.notSignUp = true;
    },
    toggleLogin() {
      this.notSignUp = false;
    },
    submit() {
      this.isSubmitSuccess = false;
      this.errorSubmit = false;
      this.userData.username = this.userData.username.trim();
      this.userData.password = this.userData.password.trim();
      if (this.userData.username === '' || this.userData.password === '') {
        this.errorSubmit = true;
        this.isSubmit = true;
      }
      else if (this.userData.username !== '' && this.userData.password !== '') {
        const data = {
          username: this.userData.username,
          email: this.userData.email,
          password: this.userData.password,
        };

        const options = {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        }

        axios.post(this.apiUrl, data, options).then((resp) => {
          this.usersList = resp.data;
          if (resp.data.success === false) {
            this.isSubmitSuccess = false
          } else {
            this.isSubmitSuccess = true
          }
        });
        this.isSubmit = true;
      }
    },
    backToLogin() {
      this.isSubmit = false;
      this.notSignUp = false;
    },
    backToSignUp() {
      this.isSubmit = false;
      this.notSignUp = true;
    },
    login() {
      const data = {
        username: this.userDataLogin.username,
        password: this.userDataLogin.password
      };

      const options = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      }

      axios.post(this.apiUrlLogin, data, options).then((resp) => {
        if (resp.data.success) {
          this.isLogged = true;
        }
      });
    },
    logout() {
      const data = {
        username: this.userDataLogin.username,
        password: this.userDataLogin.password
      };

      const options = {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      }

      axios.post(this.apiUrlLogin, data, options).then((resp) => {
        if (resp.data.success) {
          if (this.isLogged === true) {
            this.notSignUp = false;
          }
          this.isLogged = false;
        }
      })
    }

  }
}
</script>

<template>
  <AppHeader @logout="logout" />
  <AppSubmission v-if="isSubmit" @back-to-login="backToLogin" @back-to-signup="backToSignUp"
    :isSubmitSuccess="isSubmitSuccess" :errorSubmit="errorSubmit" />
  <div v-if="!isSubmit">
    <AppLogin @toggle-signup="toggleSignUp" v-if="!notSignUp" @login="login" :userDataLogin="userDataLogin" />
    <AppSignUp v-if="notSignUp && !isLogged" @toggle-login="toggleLogin" @submit="submit" :userData="userData" />
  </div>
  <AppMain v-if="isLogged" :userDataLogin="userDataLogin" />
</template>

<style lang="scss">
@use './style/general.scss';

body {
  /* background-color: #330033;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='400' viewBox='0 0 800 800'%3E%3Cg fill='none' stroke='%23404' stroke-width='1'%3E%3Cpath d='M769 229L1037 260.9M927 880L731 737 520 660 309 538 40 599 295 764 126.5 879.5 40 599-197 493 102 382-31 229 126.5 79.5-69-63'/%3E%3Cpath d='M-31 229L237 261 390 382 603 493 308.5 537.5 101.5 381.5M370 905L295 764'/%3E%3Cpath d='M520 660L578 842 731 737 840 599 603 493 520 660 295 764 309 538 390 382 539 269 769 229 577.5 41.5 370 105 295 -36 126.5 79.5 237 261 102 382 40 599 -69 737 127 880'/%3E%3Cpath d='M520-140L578.5 42.5 731-63M603 493L539 269 237 261 370 105M902 382L539 269M390 382L102 382'/%3E%3Cpath d='M-222 42L126.5 79.5 370 105 539 269 577.5 41.5 927 80 769 229 902 382 603 493 731 737M295-36L577.5 41.5M578 842L295 764M40-201L127 80M102 382L-261 269'/%3E%3C/g%3E%3Cg fill='%23505'%3E%3Ccircle cx='769' cy='229' r='5'/%3E%3Ccircle cx='539' cy='269' r='5'/%3E%3Ccircle cx='603' cy='493' r='5'/%3E%3Ccircle cx='731' cy='737' r='5'/%3E%3Ccircle cx='520' cy='660' r='5'/%3E%3Ccircle cx='309' cy='538' r='5'/%3E%3Ccircle cx='295' cy='764' r='5'/%3E%3Ccircle cx='40' cy='599' r='5'/%3E%3Ccircle cx='102' cy='382' r='5'/%3E%3Ccircle cx='127' cy='80' r='5'/%3E%3Ccircle cx='370' cy='105' r='5'/%3E%3Ccircle cx='578' cy='42' r='5'/%3E%3Ccircle cx='237' cy='261' r='5'/%3E%3Ccircle cx='390' cy='382' r='5'/%3E%3C/g%3E%3C/svg%3E"); */
  background-image: url(https://img.freepik.com/free-vector/dark-hexagonal-background-with-gradient-color_79603-1410.jpg?size=626&ext=jpg&ga=GA1.1.1546980028.1704240000&semt=ais);
}
</style>
