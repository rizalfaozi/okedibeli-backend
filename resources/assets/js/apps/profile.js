require('./../bootstrap');

import VueRouter from 'vue-router';
import Vuex from 'vuex';

Vue.use(VueRouter);
Vue.use(Vuex);

import Editor from '@tinymce/tinymce-vue'

Vue.component('Editor',Editor);

const store = new Vuex.Store({
    state: {
      
    }
});

const router = new VueRouter({
    routes: [

        {
            name: '/',
            path: '/',
            component: require('./../components/profile/ProfileList.vue').default,
            props: true
        },
        {
            name: '/add',
            path: '/add',
            component: require('./../components/profile/ProfileAddForm.vue').default,
            props: true
        },
        {
            name: '/edit/:id',
            path: '/edit/:id',
            component: require('./../components/profile/ProfileEditForm.vue').default
        },
    ],
});

// lazy load components
const Lists = (resolve) => require(['./../components/profile/ProfileList.vue'], resolve);
new Vue({
    store,
    router,
    components : {
        Lists,Editor
    },
    mounted() {
    },
    methods: {
    }
}).$mount('#app-profile');
