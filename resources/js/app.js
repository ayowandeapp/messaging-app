/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.VueRouter = require('vue-router').default;

window.Axios = require('axios').default;

import {store} from './store';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const Dashboard = Vue.component('chat-page', require('./components/pages/Dashboard.vue').default);

const ChatPage = Vue.component('chat-page', require('./components/pages/ChatPage.vue').default);
const PrivateMessage = Vue.component('private-message', require('./components/private-message/PrivateMessageInbox.vue').default);
const PrivateMessageCompose = Vue.component('message-compose', require('./components/private-message/PrivateMessageCompose.vue').default);
const PrivateMessageSent = Vue.component('message-sent', require('./components/private-message/PrivateMessageSent.vue').default);
const ViewPrivateMessage = Vue.component('message-view', require('./components/private-message/ViewPrivateMessage.vue').default);
const routes =[
    {path:'/', component:Dashboard, name:'Dashboard'},
    {path:'/page/chat', component:ChatPage, name:'ChatPage'},
    {path:'/private-message/inbox', component:PrivateMessage, name:'PrivateMessage'},
    {path:'/private-message/compose', component:PrivateMessageCompose, name:'PrivateMessageCompose'},
    {path:'/private-message/sent', component:PrivateMessageSent, name:'PrivateMessageSent'},
    {path:'/private-message/view/:id', component:ViewPrivateMessage, name:'ViewPrivateMessage'},


    ];
const router = new VueRouter({
    routes:routes,
});

//register modules
Vue.use(VueRouter,axios);
new Vue(
    Vue.util.extend(
        { mode:'history', router, store }
        )
    ).$mount('#app')

    
// new Vue({
//     el: '#app',
//     mode:'history', 
//     router, 
//     store,
//     created(){
//         axios.get('/authUser').then(response=>{
//             console.log(response);
//             if(response.status === 200){
//                 commit('setUserList',response.data);
//                 return response.data;
//             }
//         })
//     }

//     });