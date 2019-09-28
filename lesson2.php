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
#app .active{
	color: #ccc;
}

.v-enter-active .v-leave-active{
	transition: opacity 1s;
}

.v-enter, .v-leave-to{
	opacity: 0;
}
  </style>
</head>
<body>
<div id="app">
	<template v-if="ok">
		<header>タイトル</header>
		<div>コンテンツ</div>
	</template>
  <h1>my-titles</h1>
  <p class="info">{{ message.value }}</p>
  <p class="info">{{ message.value.count }}</p>
  <p class="info">{{ message.value.length >= 10 ? '10文字以上' : '10文字未満' }}</p>
  <!-- value="{{}}"は使えない -->
  <input v-model="message.value"><br>
  <input v-bind:value="message.value"><br>
  <input :value="message.value"><br>
  <button v-on:click="show=!show">表示・非表示</button><br />
  <p v-if="show">{{ counter }}回クリックしたよ。</p>
  <button v-on:click="increment">カウントを増やす</button><br />
  <button v-on:click="isActive=!isActive">isActive</button>
  <!-- 値の指定の仕方 -->
  <p v-bind:class="{ child: isChild }">TEXT</p>
  <p v-bind:style="{ color: textColor, backgroundColor: bgColor }">TEXT</p>
  <p v-bind:style="styleObject">TEXT</p>
  <p v-bind:class="[ isActive ? 'active' : 'normal' ]">TEXT</p>
  <img v-bind="img[0]" v-bind:id="'thumb-'+ img[0].id">
  <!-- if文 -->
  <div v-if="type=== 'A'" key="content-visible">typeはA</div>
  <div v-else-if="type=== 'B'">typeはB</div>
  <div v-else>typeはC</div>
  <!-- for文 -->
  <ul>
	  <li v-for="imgCts in img">
	  	ID.{{ imgCts.id }} {{ imgCts.alt }}
	  </li>
  </ul>
    <ul>
	  <li v-for="(imgCts,key,index) in img">
	  	ID.{{ imgCts.id }} {{ imgCts.alt }} key.{{ key }} index.{{ index }}
	  </li>
  </ul>
  名前 <input v-model="name"><br />
  HP<input v-model="hp">
  <button v-on:click="doAdd">モンスターを追加</button>
  <ul>
	  <li v-for="(item in list" v-bind:key="item.id" v-bind:class="{ tuyoi: item.hp > 300 }">
	  	ID: {{ item.id }} {{ item.name }} HP.{{ item.hp }}
	  	<span v-if=" item.hp > 200 ">強い</span>
	  	<button v-on:click="doRemove">モンスターを削除</button>
	  </li>
  </ul>

  <ul>
	  <li v-for="(item, index) in list" v-bind:key="item.id" v-if="item.hp">
	  	ID: {{ item.id }} {{ item.name }} HP.{{ item.hp }}
	  	<button v-on:click="doAttack(index)">攻撃</button>
	  </li>
  </ul>
  <select name="" id="">
	  <option v-for="item in 15">{{ item }}</option>
  </select>
    <select name="" id="">
	  <option v-for="item in [1,3,5,16]">{{ item }}</option>
  </select>
  <p v-for="item in message.value">{{ item }}</p>
  <!-- json取得 -->
   <ul>
	  <li v-for="(jsonItem,index) in jsonList"  v-bind:key="jsonItem.id">
	  	ID: {{ jsonItem.id }} {{ jsonItem.name }} HP.{{ jsonItem.hp }}
	  		  	<button v-on:click="doJsonAttack(index)">攻撃</button>
	  </li>
  </ul>
  <!-- ref -->
  <p ref="hello"> HELLO</p>
  <button v-on:click="handleClick">カウントアップ</button><br />
  <button v-on:click="show=!show">表示・非表示</button><br />
  <span ref="count" v-if="show">0</span>
</div>

<script src="node_modules/vue/dist/vue.min.js"></script>
<script src="./axios/dist/axios.min.js"></script>
<script>

  (function() {
    'use strict';

    // two way data binding (to UI)
    var state = { count: 0 }
    var vm = new Vue({
      el: '#app',
      data: {
        message:  {
	        value: "Hello!vue.js",
        },
        ok: true,
        counter: 0,
        state: state,
        newTodoText: '',
        visitCount: 0,
        hideCompletedTodos: false,
        error: null,
        isChild: true,
        isActive: true,
        textColor: 'red',
        bgColor: 'lightgray',
        show: true,
        styleObject: {
	        color: 'red',
	        backgroundColor: 'lightgray'
        },
        img: [
	        {
		        id: 1,
		        src: 'item1.jpg',
		        alt: '商品1サムネイル',
		        width: 200,
		        height: 200,
	        },
	        {
		        id: 2,
		        src: 'item2.jpg',
		        alt: '商品2サムネイル',
		        width: 200,
		        height: 200,
	        },
			{
		        id: 3,
		        src: 'item3.jpg',
		        alt: '商品3サムネイル',
		        width: 300,
		        height: 300,
	        },
        ],
        type: 'A',
        name: '',
        hp: '',
        list: [
	        {
		        id: 1,
		        name: 'もんすたー1',
		        hp: 100,
	        },
	        {
		        id: 2,
		        name: 'もんすたー2',
		        hp: 200,
	        },
			{
		        id: 3,
		        name: 'もんすたー3',
		        hp: 300,
	        },
        ],
        jsonList: []
      },
      methods: {
	      increment: function(){
		      this.counter += 1
	      },
	      doAdd: function(){
		      var max = this.list.reduce(function(a,b){
			    	return a > b.id ? a: b.id
			  },0)
		      this.list.push({
			      id: max + 1,
			      name: this.name,
			      hp: this.hp,
		      })
	      },
	      doRemove: function(i){
		      this.list.splice(i,1)
	      },
	      doAttack: function(i){
		      this.list[i].hp -= 10;
		      if(!this.list[i].hp){
			      alert("敵は倒れた");
		      }
	      },
	      doJsonAttack: function(i){
		      this.jsonList[i].hp -= 10;
		      if(!this.jsonList[i].hp){
			      alert("敵は倒れた");
		      }
	      },
	      handleClick(){
		      var count = this.$refs.count
		      console.log(count)
		      if( count ){
			      count.innerText = parseInt(count.innerText,10)+1
		      }
	      }
      },
      mounted: function(){
	      console.log(this.$refs.hello)
      },
      created: function() {
		axios.get('json/Lesson2.json').then(function(res){
			this.jsonList = res.data
			}.bind(this)).catch(function(e){
				console.error(e)
			})
		}
    })
    state.count++;
  })();


</script>

</body>
</html>
