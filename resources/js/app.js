import { createApp } from 'vue';

require('./bootstrap');
import VueApexCharts from "vue3-apexcharts";

import App from './App.vue';
import axios from 'axios';
import router from './router';

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.use(router);
app.use(VueApexCharts);
app.mount('#app');