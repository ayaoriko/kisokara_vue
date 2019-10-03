<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    /* 1秒かけて透明度を遷移 */
    .v-move {
      transition: transform 1s;
    }
  </style>
</head>

<body>
  <div id="app">
    <button v-on:click="order=!order">切り替え</button>
    <transition-group tag="ul" class="li">
      <li v-for="item in sortedList" v-bind:key="item.id">
        {{ item.name }} {{ item.price }}円
      </li>
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
          order: false,
          list: [
            {
              id: 1,
              name: 'もんすたー1',
              price: 100,
            },
            {
              id: 2,
              name: 'もんすたー2',
              price: 200,
            },
            {
              id: 3,
              name: 'もんすたー3',
              price: 300,
            },
          ],
          list: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        },
        computed: {
          sortedList: function(){
            return _.orderBy(this.list, 'price', this.order ? 'desc' : 'asc')
          }
        },
      })
    })();
  </script>
</body>

</html>