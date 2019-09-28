<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>

#app ul {
  padding: 0;
  list-style: none;
}

#app li > span.done {
  text-decoration: line-through;
  color: #bbb;
}
  </style>
</head>
<body>
<div id="app">
  <button @click="purge">削除</button>
  <h1>my-titles
    <span class="info">({{ remaining.length }}/{{ todos.length }})</span>
  </h1>
  <ul>
    <li v-for="(todo, index) in todos">
      <input type="checkbox" v-model="todo.isDone">
      <span v-bind:class="{done: todo.isDone}">{{todo.title}}
      <span @click="deleteItem(index)" class="command">X</span>
    </li>
    <li v-show="!todos.length">Nothing to do, yay!</li>
  </ul>
  <form @submit.prevent="addItem">
    <input type="text" v-model="newItem">
    <input type="submit">
  </form>
</div>



<script src="node_modules//dist/.min.js"></script>
<script>
  (function() {
    'use strict';

    // two way data binding (to UI)

    var vm = new ({
      el: '#app',
      data: {
        newItem: '',
        todos: []
      },
      methods: {
        addItem: function() {
          var item = {
            title: this.newItem,
            isDone: false
          };
          this.todos.push(item);
          this.newItem = '';
        },
        deleteItem: function(index) {
          if(confirm('are you sure?')) {
            this.todos.splice(index, 1);
          }
        },
       purge: function(index) {
          if(!confirm('are you finished?')) {
            return;
          }
          // this.todos = this.todos.filter(function(todo) {
          //   return !todo.isDone;
          // });
          this.todos = this.remaining;
        }
      },
      computed: {
        remaining: function(){
         //  var items = this.todos.filter(function(todo) {
         //    return !todo.isDone;
         //  });
         // return items.length;
         return this.todos.filter(function(todo) {
            return !todo.isDone;
          });
        }
      }
    });
  })();


</script>

</body>
</html>
