<script>
import { store } from '../store.js'
export default {
    data() {
        return {
            userInput: '',
            store,


        }
    },
    methods: {
        done(index) {
            this.store.toDoList[index].done = !this.store.toDoList[index].done

        },
        cancelToDo(index) {
            this.store.toDoList.splice(index, 1)
        },
        addNewToDo() {
            this.store.toDoList.push({ text: this.userInput, done: false });
            this.userInput = ''
        }
    },
}
</script>

<template>
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <label class="mb-3" for="text">inserisci un todo</label>
        <input type="text" @keyup.enter="addNewToDo()" v-model.trim="userInput">
    </div>
    <div class="container mt-5 w-50">
        <ul class="list-group" v-for="(toDo, index) in store.toDoList">
            <li class="list-group-item d-flex justify-content-between">
                <p :class="{ 'text-decoration-line-through': toDo.done }"> {{ toDo.text }}</p>
                <div><button @click="cancelToDo(index)" class="btn btn-danger">X</button> <button class="btn btn-success"
                        @click="done(index)">done</button>
                </div>
            </li>

        </ul>
    </div>
</template>

<style></style>