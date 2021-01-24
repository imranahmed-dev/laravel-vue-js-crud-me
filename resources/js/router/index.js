import Vue from 'vue';
import VueRouter from 'vue-router';


Vue.use(VueRouter);

import Home from '../components/Home.vue';

import Category from '../components/Category.vue';
import CreateCategory from '../components/CreateCategory.vue';
import EditCategory from '../components/EditCategory.vue';
import Product from '../components/Product.vue';
import CreateProduct from '../components/CreateProduct.vue';
import EditProduct from '../components/EditProduct.vue';

const routes = new VueRouter({
    mode: 'history',
    routes: [
        {
           path: '/',
           component: Home,
           name: 'home',
        },
        {
           path: '/category',
           component: Category,
           name: 'category',
        },
        {
            path: '/category/create',
            component: CreateCategory,
            name: 'create-category',
         },
         {
            path: '/category/edit/:id',
            component: EditCategory,
            name: 'edit-category',
         },
         {
            path: '/product',
            component: Product,
            name: 'product',
         },
         {
             path: '/product/create',
             component: CreateProduct,
             name: 'create-product',
          },
          {
             path: '/product/edit/:id',
             component: EditProduct,
             name: 'edit-product',
          },

        
    ]
});
export default routes;