<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    /* 1秒かけて透明度を遷移 */
    .v-enter-active,
    .v-leave-active {
      transition: opacity 1s;
    }

    /* 見えなくなるときの透明度 */
    .v-enter,
    .v-leave-to {
      opacity: 0;
    }
  </style>
</head>

<body>
  <div id="app">
    <p><button v-on:click="show=!show">切り替え</button></p>
    <transition>
      <div v-show="show">
        トランジションさせたい要素
      </div>
    </transition>
  </div>


  <script src="node_modules/vue/dist/vue.min.js"></script>
  <script src="node_modules/axios/dist/axios.min.js"></script>
  <script>
    (function () {
      new Vue({
        el: '#app',
        data: {
          show: true
        }
      })
    })();
  </script>
</body>

</html>