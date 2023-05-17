import VueRouter from "vue-router";
import routes from './routes';

const router = new VueRouter({
    base: '/',
    routes,
    mode: 'history'
})

export default router