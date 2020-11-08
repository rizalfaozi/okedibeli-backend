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
            component: require('./../components/themes/ThemesList.vue').default,
            props: true
        },
        {
            name: '/add',
            path: '/add',
            component: require('./../components/themes/ThemesAddForm.vue').default
        },
        {
            name: '/edit/:id',
            path: '/edit/:id',
            component: require('./../components/themes/ThemesEditForm.vue').default
        },
    ],
});

// lazy load components
const Lists = (resolve) => require(['./../components/themes/ThemesList.vue'], resolve);

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
}).$mount('#app-themes');
