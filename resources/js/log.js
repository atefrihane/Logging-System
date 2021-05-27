

//Progressbar
// import VueProgressBar from 'vue-progressbar'

// Vue.use(VueProgressBar, {
//         color: 'rgb(143, 255, 199)',
//         failedColor: 'red',
//         height: '2px',
//         thickness: '2.5px',
//     })
//     //Toast

// import VueElementLoading from 'vue-element-loading'

// Vue.component('VueElementLoading', VueElementLoading)



// Logs
Vue.component('start-log', require('./components/StartLog.vue').default);
Vue.component('show-logs', require('./components/ShowLogs.vue').default);

Vue.component('pagination', require('laravel-vue-pagination'));




const app = new Vue({
    el: '#app',

 
});