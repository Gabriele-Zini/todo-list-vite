<script>
export default {
    data() {
        return {
        }
    },
    props: {
        userData: Object
    },
    methods: {
        login() {
            this.$emit('toggle-login');

        },
        submit() {
            this.$emit('submit');
        },
        preventDefault() {
            this.submit();
            this.login();
        }

    }
}
</script>

<template>
    <div class="container">
        <form action="App.vue" methods="POST" class="d-flex flex-column justify-content-center align-items-center" id="sign-up"
            @submit.prevent="preventDefault">
            <div class="col-12 col-md-6 mb-3">
                <label class="form-label text-white" for="new-username">Username:</label>
                <input v-model="userData.username" type="text" id="new-username" class="form-control" />
            </div>

            <div class="col-12 col-md-6 mb-4">
                <label class="form-label text-white" for="new-email">Email:</label>
                <input v-model="userData.email" type="email" id="new-email" class="form-control" />
            </div>

            <div class="col-12 col-md-6 mb-4">
                <label class="form-label text-white" for="new-password">Password:</label>
                <input v-model="userData.password" type="password" id="new-password" class="form-control" />
            </div>

            <div class="d-flex gap-4 align-items-center">
                <button @click="submit" class="btn ms_btn">Submit</button>
                <button href="" @click="login" class="text-white ms_button">Login</button>
            </div>
        </form>
    </div>
</template>

<style lang="scss" scoped>
.container {
    padding-top: 200px;

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