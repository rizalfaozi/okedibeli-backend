require('./../bootstrap');

import VueRouter from 'vue-router';
import Vuex from 'vuex';

Vue.use(VueRouter);
Vue.use(Vuex);

import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.min.css'

Vue.component('datetime', Datetime);

const store = new Vuex.Store({
    state: {
      
    }
});

const router = new VueRouter({
    routes: [

        {
            name: '/',
            path: '/',
            component: require('./../components/slide/SlideList.vue').default,
            props: true
        },
        {
            name: '/add',
            path: '/add',
            component: require('./../components/slide/SlideForm.vue').default,
            props: true
        },
        {
            name: '/edit/:id',
            path: '/edit/:id',
            component: require('./../components/slide/SlideForm.vue').default
        },
    ],
});

// lazy load components
const Lists = (resolve) => require(['./../components/slide/SlideList.vue'], resolve);
new Vue({
    store,
    router,
    components : {
        Lists
    },
    mounted() {
    },
    methods: {
    }
}).$mount('#app-slide');
