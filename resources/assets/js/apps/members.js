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
            component: require('./../components/members/MembersList.vue').default
        },
        {
            name: '/add',
            path: '/add',
            component: require('./../components/members/MembersAddForm.vue').default
        },
        {
            name: '/edit/:id',
            path: '/edit/:id',
            component: require('./../components/members/MembersEditForm.vue').default
        },
    ],
});

// lazy load components
const Lists = (resolve) => require(['./../components/members/MembersList.vue'], resolve);

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
}).$mount('#app-members');
