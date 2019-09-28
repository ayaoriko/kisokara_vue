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

    #app li>span.done {
      text-decoration: line-through;
      color: #bbb;
    }

    .v-enter-active .v-leave-active {
      transition: opacity 1s;
    }

    .v-enter,
    .v-leave-to {
      opacity: 0;
    }
  </style>
</head>

<body>
  <div id="app">
    <h1>my-titles
      <span class="info">{{ message }}</span>
      <span class="info">{{ conputedMessage }}</span>
    </h1>
    <input v-model="message"><br>
    <input v-model.number="count"><br>
    <p v-if="flag">hello</p>
    <button v-on:click="handleClick">Click</button><br>
    <button v-on:click="show=!show">Change</button>
    <transition>
      <p v-if="show">Hello! Vue.js!</p>
    </transition>
  </div>



  <script src="node_modules/vue/dist/vue.min.js"></script>
  <script>
    (function () {
      'use strict';

      var vm = new Vue({
        el: '#app',
        data: {
          message: 'Hello!',
          flag: true,
          count: 0,
          show: true,
        },
        methods: {
          handleClick: function (e) {
            alert(e.target);
          }
        },
        computed: {
          conputedMessage: function (e) {
            return this.message + '!'
          }
        }
      });
    })();
  </script>

</body>

</html>