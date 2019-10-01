<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    /* 1秒かけて透明度を遷移 */
    .demo1-enter-active,
    .demo1-leave-active,
    .demo3-enter-active,
    .demo3-leave-active {
      transition: opacity 1s;
    }
    .demo3-leave-active{
      position: absolute;
    }

    /* 見えなくなるときの透明度 */
    .demo1-enter,
    .demo1-leave-to,
    .demo3-enter,
    .demo3-leave-to{
      opacity: 0;
    }

    /* 1秒かけて透明度を遷移 */
    .demo2-enter-active,
    .demo2-leave-active{
      transition: opacity 1s, transform 1s;
    }
    .demo2-enter{
      opacity: 0;
      transform: translateX(-10px);
    }

    .demo2-leave-to{
      opacity: 0;
      transform: translateY(10px)
    }
  </style>
</head>

<body>
  <div id="app">
    <p><button v-on:click="show=!show">切り替え</button></p>
    <transition name="demo1">
      <div v-show="show">
        トランジションさせたい要素
      </div>
    </transition>
    <transition name="demo2">
      <div v-show="show">
        トランジションさせたい要素
      </div>
    </transition>
    <transition name="demo3">
      <div v-if="show" key="a">
        Yes
      </div>
      <div v-else key="b">
        No
      </div>
    </transition>
    <transition name="demo3" mode="out-in">
      <div v-if="show" key="a">
        Yes
      </div>
      <div v-else key="b">
        No
      </div>
    </transition>
    　<button v-on:click="count++">切り替え</button>
    <transition name="demo3">
      <div v-bind:key="count">{{ count }}</div>
    </transition>
  </div>


  <script src="node_modules/vue/dist/vue.min.js"></script>
  <script src="node_modules/axios/dist/axios.min.js"></script>
  <script>
    (function () {
      new Vue({
        el: '#app',
        data: {
          show: true,
          count: 0
        }
      })
    })();
  </script>
</body>

</html>