<script>
import axios from 'axios';
export default {
    data() {
        return {
            userInput: '',
            todoList: [],
            apiUrl: "http://localhost/boolean/todo-list-vite/server/server.php",


        }
    },
    props: {
        userDataLogin: Object,
    },
    created() {
        axios.get(this.apiUrl).then((resp) => {
            this.todoList = resp.data;
        })
    },
    methods: {
        done(id) {
            const data = {
                toggleId: id,
            };

            const options = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            axios.post(this.apiUrl, data, options).then((resp) => {
                this.todoList = resp.data;
            });
        },
        cancelToDo(id) {
            const data = {
                deleteId: id,
            };

            const options = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };

            axios.post(this.apiUrl, data, options).then((resp) => {
                this.todoList = resp.data;
            });
        },
        addNewToDo() {
            if (this.userInput !== "") {
                const data = {
                    newTodo: this.userInput,
                };
                axios
                    .post(this.apiUrl, data, {
                        headers: {
                            "Content-Type": "multipart/form-data",
                        },
                    })
                    .then((resp) => {
                        this.todoList = resp.data;
                    });

                this.userInput = ''
            }
        },
    },
}

</script>

<template>
    <div class="container mt-5 ms_todo-container">
        <div class="mx-auto d-flex flex-column align-items-center justify-content-center  col-12 col-md-4">
            <label class="mb-3" for="text">Ciao {{ userDataLogin.username }}, Inserisci un todo</label>
            <input type="text" class="form-control" @keyup.enter="addNewToDo()" v-model.trim="userInput">
        </div>
        <ul class="list-group mt-5 align-items-center">
            <li class="list-group-item d-flex justify-content-between col-12 col-md-10 col-lg-6 align-items-start"
                v-for="(toDo, id) in todoList" :key="id">
                <p :class="{ 'text-decoration-line-through': toDo.done === '1' }"> {{ toDo.text }}</p>
                <div class="d-flex align-items-center ms-3"><button @click="cancelToDo(toDo.id)"
                        class="btn ms_btn-cancel me-3">X</button> <button class="btn ms_btn-done"
                        @click="done(toDo.id)">done</button>
                </div>
            </li>

        </ul>
    </div>
</template>

<style lang="scss">
.ms_todo-container {
    padding-top: 120px;
    padding-bottom: 70px;

    label {
        font-size: 1.5rem;
        font-weight: bold;
        color: white;
    }

    .ms_btn-done {
        background-color: rgb(144, 125, 23);
        color: white;

        &:hover {
            background-color: rgb(189, 162, 7);
        }
    }

    .ms_btn-cancel {
        background-color: rgb(144, 22, 48);
        color: white;

        &:hover {
            background-color: rgb(200, 27, 65);
        }
    }
}

.list-group-item:nth-child(even) {
    background-color: #f0f0f05a;
    color: white;
}

.list-group-item:nth-child(odd) {
    background-color: rgba(0, 0, 0, 0.133);
    color: white;
}
</style>