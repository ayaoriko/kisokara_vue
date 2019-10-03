<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
/* 以下はボックス要素のスタイル */
.list {
  width: 240px;
  padding: 0;
}
.item {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  margin: 4px;
  width: 40px;
  height: 40px;
  background: #f5f5f5;
}
/* トランジション用スタイル */
.v-enter-active, .v-leave-active, .v-move {
  transition: all 1s;
}
.v-leave-active {
  position: absolute;
}

.v-enter, .v-leave-to {
  opacity: 0;
  background: #f9a3b1;
  transform: translateY(-10px);
}
  </style>
</head>

<body>
<div id="app">
  <p>
    <button v-on:click="doShuffle">シャッフル</button>
    <button v-on:click="doAdd">追加</button>
    <button v-on:click="doRemove">　削除</button>
  </p>
  <transition-group tag="ul" class="list">
    <li v-for="(item, index) in list"
      v-bind:key="item"
      class="item"
      v-on:click="doRemove(index)">{{ item }}</li>
  </transition-group>
</div>



  <script src="node_modules/vue/dist/vue.min.js"></script>
  <script src="node_modules/axios/dist/axios.min.js"></script>
  <script src="node_modules/lodash/lodash.js"></script>
  <script>
    (function () {
      new Vue({
        el: '#app',
        data: {
          list: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        },
        methods: {
          doShuffle: function () {
            this.list = _.shuffle(this.list)
          },
          doAdd: function() {
            var newNumber = Math.max.apply(null, this.list) + 1
            var index = Math.floor(Math.random() * (this.list.length + 1))
            this.list.splice(index, 0, newNumber)
          },
          doRemove: function (index) {
            this.list.splice(index, 1)
          }
        }
      })
    })();
  </script>
</body>

</html>