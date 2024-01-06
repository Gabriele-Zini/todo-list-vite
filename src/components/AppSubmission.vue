<script>
export default {
    data() {
        return {

        }
    },
    props: {
        isSubmitSuccess: Boolean,
        errorSubmit: Boolean,
    },
    methods: {
        backToLogin() {
            this.$emit('back-to-login');
        },
        backToSignUp() {
            this.$emit('back-to-signup');
        }
    }
}
</script>

<template>
    <div class="ms_submission d-flex justify-content-center align-items-center">
        <div class="card col-12 col-md-6">
            <div class="card-body d-flex flex-column gap-5">
                <p v-if="isSubmitSuccess" class="card-text text-center m-0">Submission send</p>
                <p v-if="!isSubmitSuccess && !errorSubmit" class="card-text text-center m-0">Username already exists</p>
                <p v-if="errorSubmit" class="card-text text-center m-0">Error: missing password or username</p>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <a href="#" class="btn ms_btn" @click="backToLogin">Back to login</a>
                    <p>or</p>
                    <a href="#" class="btn ms_btn" @click="backToSignUp">Back to sign up</a>

                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.ms_submission {
    padding-top: 200px;

    .card {
        border: 3px solid rgba(255, 217, 0, 0.34);
        background-color: #121420;

        p {
            font-size: 2rem;
            font-weight: bold;
            color: white;
        }
        .ms_btn {
        background-color: rgb(101, 89, 19);
        color: white;

        &:hover {
            background-color: rgb(238, 211, 61, 0.855);;
        }
    }
    }

}
</style>