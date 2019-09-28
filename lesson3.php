<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>

p{
	opacity: 1;
	transition: opacity 1s;
}
p.hide{
	opacity: 0;
}
  </style>
</head>
<body>
<div id="app">
  <h1>my-titles
    <span class="info">{{ message }}</span>
  </h1>
  <input v-model="message"><br>
  <input v-model.number="count"><br>
  <p v-if="flag">hello</p>
  <button v-on:click="handleClick">Click</button><br>
    <button @click="handleClick">Click</button><br>

    <input type="text" v-bind:value="message" v-on:input="handleInput">

    <div v-on:click="handler('stop1')">stop1
	    <div v-on:click.stop="handler('stop2')">stop2</div>
    </div>

    <div v-on:click="handler('prevent1')">prevent1
	    <div v-on:click.prevent="handler('prevent2')">prevent2</div>
    </div>

    <div v-on:click.capture="handler('prevent1')">capture1
	    <div v-on:click="handler('prevent2')">capture2</div>
    </div>

    <div v-on:click="handler('prevent1')">capture1
	    <div v-on:click.self="handler('prevent2')">capture2</div>
    </div>

    <input type="text" v-on:keydown.up="handleClick">

    <input type="file" v-model="fileVal" v-on:change="handleChange">
    <div v-if="preview"><img v-bind:src="preview"></div>


</div>



<script src="node_modules/vue/dist/vue.min.js"></script>
<script>
  (function() {
    'use strict';

    // two way data binding (to UI)

    var vm = new Vue({
      el: '#app',
      data: {
        message: 'Hello!',
        flag: true,
        count: 0,
        show: true,
        preview: '',
        fileVal: '',
        price: 100
      },
      methods: {
	      handleClick: function(e){
		      alert(e.target);
	      },
	      handleInput: function(e){
		      this.message = event.target.value,
		      console.log(this.message)
	      },
	     handler: function(txt){
		     console.log(txt)
	     },
	     handleChange: function(e){
		     var file = event.target.files[0]
		     if(file && file.type.match(/^image\/(png|jpeg|jpg)$/)){
			     this.preview = window.URL.createObjectURL(file)
		     }else{
			     alert('きちんとしたファイル形式でお願いします')
			     this.fileVal = ''
		     }
	     }
      },
    });
  })();


</script>

</body>
</html>
