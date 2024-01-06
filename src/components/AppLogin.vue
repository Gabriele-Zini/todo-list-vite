<script>
import axios from 'axios';
export default {
    data() {
        return {
        }
    },
    props: {
        userDataLogin:Object
    },
    methods: {
        login() {
            this.$emit('login');
        },
        signUp() {
            this.$emit('toggle-signup');
        },
        preventDefault() {
            this.signUp();
            this.login();
        }
    }
}
</script>


<template>
    <form action="index.html" method="POST" id="login" @submit.prevent="preventDefault">
        <div class="ms_login-form container">
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label text-white" for="username">Username:</label>
                <input v-model="userDataLogin.username" type="text" id="username" class="form-control" />
            </div>

            <div class="col-12 col-md-6 mb-4">
                <label class="form-label text-white" for="password">Password:</label>
                <input v-model="userDataLogin.password" type="password" id="password" class="form-control" />
            </div>

            <div class="d-flex gap-4 align-items-center">
                <button @click="login" class="btn ms_btn">Login</button>
                <button href="" @click="signUp" class="text-white ms_button">Sign up</button>
            </div>
        </div>
    </form>
</template>

<style lang="scss" scoped>
.ms_login-form {
    padding-top: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;

    .ms_button {
        border: 1px solid transparent;
        background-color: transparent;
        text-decoration: underline;
    }
    .ms_btn {
        background-color: rgb(101, 89, 19);
        color: white;

        &:hover {
            background-color: rgb(238, 211, 61, 0.855);;
        }
    }


}
</style>