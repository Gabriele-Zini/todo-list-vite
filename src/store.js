import { reactive } from "vue";

export const store = reactive({
  toDoList: [
    {
      text: 'fare la spesa',
      done: false,
    },
    {
      text: 'pulire casa',
      done: false,
    },
    {
      text: 'pulire lettiera del gatto',
      done: false,
    },
    {
      text: 'fare sport',
      done: false,
    },
  ],
});
