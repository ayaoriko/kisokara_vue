<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
  </style>
</head>

<body>
  <div id="app">
    <button v-on:click="current='comp-board'">メッセージ一覧</button>
    <button v-on:click="current='comp-form'">投稿フォーム</button>
    <div v-bind:is="current"></div>

    <button v-on:click="current='comp-board'">メッセージ一覧</button>
    <button v-on:click="current='comp-form'">投稿フォーム</button>
    <keep-alive>
      <div v-bind:is="current"></div>
    </keep-alive>
  </div>


  <script src="node_modules/vue/dist/vue.min.js"></script>
  <script src="node_modules/axios/dist/axios.min.js"></script>
  <script>
    (function () {
      // メッセージ一覧用コンポーネント
      Vue.component('comp-board', {
        template: '<div>Message Board</div>',
      })
      // 入力フォーム用コンポーネント
      Vue.component('comp-form', {
        template: '<div>Form<textarea v-model="message"></textarea></div>',
        data: function () {
          return {
            message: ''
          }
        }
      })
      new Vue({
        el: '#app',
        data: {
          current: 'comp-board' // 動的に切り替える
        }
      })
    })();
  </script>
</body>

</html>