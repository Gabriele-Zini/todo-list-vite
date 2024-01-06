<script>
export default { 
    methods: {
        logout() {
            this.$emit('logout');
        }
    }
}

</script>

<template>
    <header class="d-flex justify-content-center align-items-center">
    <h1>Todo List</h1>
    <button @click="logout" class="btn ms_btn ms-5">Logout</button>
    </header>
 
</template>

<style lang="scss" scoped>

header {
    background-color: #121420;
    border-bottom: 2px solid rgba(255, 217, 0, 0.34);
    min-height: 100px;
    color: white;
    z-index: 999;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    box-shadow: 2px 2px 25px 25px rgba(0, 0, 0, 0.411);

    .ms_btn {
        background-color: rgb(101, 89, 19);
        color: white;

        &:hover {
            background-color: rgb(238, 211, 61, 0.855);;
        }
    }


    h1 {
        font-size: 2.5rem;
    }
}

</style>