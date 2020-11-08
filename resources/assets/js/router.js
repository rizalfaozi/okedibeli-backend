import Vue from 'vue'
import Router from 'vue-router'
import Memberlist from './components/Memberlist.vue'

Vue.use(Router)

const router = new Router({
    mode: 'Home',
    routes: [
        {
            path: '/',
            name: 'memberlist',
            component: Memberlist,
        }
    ]
});

export default router
