import Vue, { createApp } from '@vue/compat';
import BootstrapVue from 'bootstrap-vue';
import router from './router'
import axios from 'axios'
import App from './App.vue'

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.use(BootstrapVue);
const app = createApp(App);
axios.defaults.headers.common["Authorization"];
app.use(router,axios)
app.mount('#app');
