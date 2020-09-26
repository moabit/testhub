require('./bootstrap');
import Vue from 'vue'
import Editor from './Editor'
import store from './store/editor';



new Vue({
    el: '#editor',
    template: '<Editor/>',
    components: { Editor},
    store
})
