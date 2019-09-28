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
        <my-component></my-component>
        <my-component2></my-component2>
        <my-component3></my-component3>
        <comp-val val="これはA"></comp-val>
        <comp-val val="これはB"></comp-val>
        <ul>
            <comp-child v-for="item in list" v-bind:key="item.id" v-bind="item" v-on:attack="handleAttack"></comp-child>
        </ul>
        <example v-bind:value="value"></example>

        <!-- <comp-child v-bind:val="message"></comp-child> -->
        <comp-child2 v-on:childs-event="parentsMethod"></comp-child2>
    </div>


    <script src="node_modules/vue/dist/vue.min.js"></script>
    <script src="node_modules/axios/dist/axios.min.js"></script>
    <script>
        (function () {
            'use strict';

            var myComponent = {
                template: '<p>MyComponent!!!</p>'
            }

            Vue.component('my-component2', {
                template: '<p>{{ message }}</p>',
                data: function () {
                    return {
                        message: 'hello Vue.js'
                    }
                }
            })

            var myComponent3 = {
                template: '<p><my-component2></my-component2></p>'
            }

            var compParents = {
                template: '<p><comp-child></<comp-child></p>'
            }

            Vue.component('comp-val', {
                template: '<p>{{ val }}</p>',
                props: ['val'],
            })

            function Cat(name) {
                this.name = name
            }

            Vue.component('example', {
                props: {
                    value: Cat // 猫データのみ許可！
                }
            })
            Vue.component('comp-child', {
                template: '<li v-if="hp">{{ name }} HP. {{ hp }} <button v-on:click="doAttack">こうげきする</button> </li>',
                props: {
                    id: Number,
                    name: String,
                    hp: Number
                },
                methods: {
                    doAttack: function () {
                        this.$emit('attack', this.id)
                    }
                }
            })

            Vue.component('comp-child2', {
                template: '<button v-on:click="handleClick">イベント発火</button>',
                methods: {
                    // ボタンのクリックイベントのハンドラでchilds-eventを発火する
                    handleClick: function () {
                        this.$emit('childs-event')
                    }
                }
            })

            var vm = new Vue({
                el: '#app',
                components: {
                    'my-component': myComponent,
                    'my-component3': myComponent3,
                    'comp-parents': compParents,
                },
                data: {
                    jsonList: '',
                    value: new Cat('たま'), // valueは猫データ
                    list: [{
                            id: 1,
                            name: 'スライム',
                            hp: 100
                        },
                        {
                            id: 2,
                            name: 'ゴブリン',
                            hp: 200
                        },
                        {
                            id: 3,
                            name: 'ドラゴン',
                            hp: 500
                        }
                    ]
                },
                created: function () {
                    axios.get('json/Lesson2.json').then(function (res) {
                        this.jsonList = res.data
                    }.bind(this)).catch(function (e) {
                        console.error(e)
                    })
                },
                methods: {
                    // childs-eventが発生した！
                    parentsMethod: function () {
                        alert('イベントをキャッチ！ ')
                    },
                    // attackが発生した！
                    handleAttack: function (id) {
                        // 引数のIDから要素を検索
                        var item = this.list.find(function (el) {
                            return el.id === id
                        })
                        // HPが0より多ければ10減らす
                        if (item !== undefined && item.hp > 0) item.hp -= 10
                    }
                }
            });

        })();
    </script>
</body>
</html>