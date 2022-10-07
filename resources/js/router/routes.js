import ExampleComponent from '../components/ExampleComponent.vue'
import DashBoard from '../pages/DashBoard.vue';
import User from '../pages/User.vue';
import ListProduct from '../pages/product/list.vue';
import CreateProduct from '../pages/product/create.vue';
import Category from '../pages/Category.vue';
import Producer from '../pages/Producer.vue';
import TypeProduct from '../pages/TypeProduct.vue';
import Coupon from '../pages/Coupon.vue';
import Customer from '../pages/Customer.vue';

export default [
    {
        path: '/admin/dashboard',
        component: DashBoard,
        name: 'DashBoard'
    },
    {
        path: '/admin/user',
        component: User,
        name: 'user'
    },
    {
        path: '/admin/product',
        component: ListProduct,
        name: 'product'
    },
    {
        path: '/admin/product/add',
        component: CreateProduct,
        name: 'createproduct',
    },
    {
        path: '/admin/product/:idProduct',
        component: CreateProduct,
        name: 'getproduct',
    },
    {
        path: '/admin/category',
        component: Category,
        name: 'category',
    },
    {
        path: '/admin/producer',
        component: Producer,
        name: 'producer',
    },
    {
        path: '/admin/type-product',
        component: TypeProduct,
        name: 'typeProduct',
    },
    {
        path: '/admin/coupon',
        component: Coupon,
        name: 'coupon',
    },
    {
        path: '/admin/customer',
        component: Customer,
        name: 'customer',
    }
]