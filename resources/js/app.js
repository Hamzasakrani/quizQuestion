import { createApp } from 'vue';

require('./bootstrap');
import VueApexCharts from "vue3-apexcharts";
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import vue3StarRatings from "vue3-star-ratings";
import App from './App.vue';
import axios from 'axios';
import router from './router';

const app = createApp(App);
app.component("vue3-star-ratings", vue3StarRatings);
app.config.globalProperties.$axios = axios;
app.use(router);
app.use(VueApexCharts);
app.mount('#app');