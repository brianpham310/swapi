require('./bootstrap');
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import Vue from 'vue';
// Install BootstrapVue
Vue.use(BootstrapVue);
import Main from "./Main";
import router from './router';

new Vue({
    router,
    components: { Main },
    template: '<Main/>',
}).$mount('#main');
