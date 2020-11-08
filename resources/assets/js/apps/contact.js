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
            component: require('./../components/contact/ContactList.vue').default,
            props: true
        },
        {
            name: '/add',
            path: '/add',
            component: require('./../components/contact/ContactAddForm.vue').default
        },
        {
            name: '/edit/:id',
            path: '/edit/:id',
            component: require('./../components/contact/ContactEditForm.vue').default
        },
    ],
});

// lazy load components
const Lists = (resolve) => require(['./../components/contact/ContactList.vue'], resolve);

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
}).$mount('#app-contact');
