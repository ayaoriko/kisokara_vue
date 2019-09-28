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
        <select v-model="current">
            <option v-for="topic in topics" v-bind:value="topic.value">
                {{ topic.name }}
            </option>
        </select>
        <div v-for="item in gitList">{{ item.full_name }}</div>
    </div>


    <script src="node_modules/vue/dist/vue.min.js"></script>
    <script src="node_modules/axios/dist/axios.min.js"></script>
    <script src="node_modules/lodash/lodash.js"></script>
    <script>
        (function () {
            'use strict';

            var vm = new Vue({
                el: '#app',
                data: {
                    gitList: [],
                    current: '',
                    topics: [{
                            value: 'vue',
                            name: 'Vue.js'
                        },
                        {
                            value: 'jQuery',
                            name: 'jQuery'
                        },
                    ]
                },
                watch: {
                    current: function (val) {
                        axios.get('https://api.github.com/search/repositories', {
                            params: {
                                q: 'topic:' + val
                            }
                        }).then(function (res) {
                            this.gitList = res.data.items
                        }.bind(this)).catch(function (e) {
                            console.error(e)
                            alert(e)
                        })
                    }
                }
            });
        })();
    </script>

</body>

</html>