
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
//change date 2019-01-11
//Vue.config.productionTip = false;

import HighchartsVue from 'highcharts-vue';
import Highcharts from 'highcharts';
Highcharts.setOptions({
    global: {
        useUTC: false
    }
});
Vue.use(HighchartsVue);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
// need to add .deault for krisna's pc
Vue.component('root-component', require('./components/RootComponent.vue'));
Vue.component('cpu-component', require('./components/dashboard/CpuComponent.vue'));
Vue.component('disk-component', require('./components/dashboard/DiskComponent.vue'));
Vue.component('memory-component', require('./components/dashboard/MemoryComponent.vue'));
Vue.component('server-form-component', require('./components/servers/ServerFormComponent.vue'));
Vue.component('user-form-component', require('./components/users/UsesrFormComponent.vue'));
Vue.component('customer-form-component', require('./components/customers/CustomersFormComponent.vue'));
Vue.component('servicetypes-form-component', require('./components/servicetypes/ServicetypesFormComponent.vue'));
Vue.component('test-component', require('./components/TestComponent.vue'));
Vue.component('memory-test', require('./components/MemoryTestComponent.vue'));
Vue.component('trend-chart', require('./components/TrendChart.vue'));

const app = new Vue({
    el: '#app'
});
