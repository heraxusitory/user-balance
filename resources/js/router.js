import Vue from 'vue'
import VueRouter from 'vue-router'
import ExampleComponent from "./components/ExampleComponent";

Vue.use(VueRouter);

export const routes = [
    {
        name: 'index',
        path: '/',
        component: ExampleComponent
    },
]
