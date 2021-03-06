<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
.v-enter-active, .v-leave-active {
  transition: all 1s;
}
.v-leave-active {
  position: absolute;
}
.v-enter, .v-leave-to {
  opacity: 0;
  transform: translateX(-20px);
}
  </style>
</head>

<body>
<div id="app">
  <button v-on:click="toggle=!toggle">切り替え</button>
  <svg xmlns="http://www.w3.org/2000/svg" version="1.1">
    <!-- SVGのパーツにトランジションを適用 -->
    <transition>
      <my-circle v-bind:fill="fill" v-bind:key="fill"></my-circle>
    </transition>
  </svg>
</div>



  <script src="node_modules/vue/dist/vue.min.js"></script>
  <script src="node_modules/axios/dist/axios.min.js"></script>
  <script src="node_modules/lodash/lodash.js"></script>
  <script>
    (function () {
// SVGパーツのコンポーネントを定義
      Vue.component('my-circle', {
        template: '<circle cx="80" cy="75" r="50" v-bind:fill="fill"/>',
        props: {
          fill: String
        }
      })
      new Vue({
        el: '#app',
        data: {
          toggle: false
        },
        computed: {
          fill: function () {
            return this.toggle ? 'lightpink' : 'skyblue'
          }
        }
      })
    })();
  </script>
</body>

</html>