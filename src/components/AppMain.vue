<script>
import { store } from '../store.js'
import axios from 'axios';
export default {
    data() {
        return {
            userInput: '',
            todoList: [],
            apiUrl: "http://localhost/boolean/todo-list-vite/server/server.php",


        }
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
    <div class="container">
        <div class="mx-auto d-flex flex-column align-items-center justify-content-center  col-12 col-md-3">
            <label class="mb-3" for="text">inserisci un todo</label>
            <input type="text" @keyup.enter="addNewToDo()" v-model.trim="userInput">
        </div>
        <ul class="list-group mt-5 align-items-center">
            <li class="list-group-item d-flex justify-content-between col-12 col-md-5 align-items-start"  v-for="(toDo, id) in todoList" :key="id">
                <p :class="{ 'text-decoration-line-through': toDo.done === '1' }"> {{ toDo.text }}</p>
                <div class="d-flex align-items-center ms-3"><button @click="cancelToDo(toDo.id)" class="btn btn-danger me-3">X</button> <button class="btn btn-success"
                        @click="done(toDo.id)">done</button>
                </div>
            </li>

        </ul>
    </div>
</template>

<style></style>