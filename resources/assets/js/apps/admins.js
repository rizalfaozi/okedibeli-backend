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
            component: require('./../components/admins/AdminsList.vue').default,
            props: true
        },
        {
            name: '/add',
            path: '/add',
            component: require('./../components/admins/AdminsAddForm.vue').default
        },
        {
            name: '/edit/:id',
            path: '/edit/:id',
            component: require('./../components/admins/AdminsEditForm.vue').default
        },
    ],
});

// lazy load components
const Lists = (resolve) => require(['./../components/admins/AdminsList.vue'], resolve);

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
}).$mount('#app-admins');
