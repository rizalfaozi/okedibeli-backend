require('./../bootstrap');

import VueRouter from 'vue-router';
import Vuex from 'vuex';


Vue.use(VueRouter);
Vue.use(Vuex);



const store = new Vuex.Store({
    state: {
      
    }
});

const router = new VueRouter({
    routes: [

        {
            name: '/',
            path: '/',
            component: require('./../components/fiture/FitureList.vue').default,
            props: true
        },
        {
            name: '/add',
            path: '/add',
            component: require('./../components/fiture/FitureAddForm.vue').default,
            props: true
        },
        {
            name: '/edit/:id',
            path: '/edit/:id',
            component: require('./../components/fiture/FitureEditForm.vue').default
        },
    ],
});

// lazy load components
const Lists = (resolve) => require(['./../components/fiture/FitureList.vue'], resolve);
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
}).$mount('#app-fiture');
