require('./bootstrap');
import Vue from 'vue'
import Timer from './Timer'




new Vue({
    el: '#timer',
    template: '<Timer/>',
    components: {Timer},

})
