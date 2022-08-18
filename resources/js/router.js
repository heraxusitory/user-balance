import Vue from 'vue'
import VueRouter from 'vue-router'
import ExampleComponent from "./components/ExampleComponent";
import MainLayout from "./layouts/MainLayout";
import Profile from "./views/Profile";
import SignUp from "./views/SignIn";
import Operation from "./views/Operation";

Vue.use(VueRouter);

export const routes = [
    {
        // name: 'index',
        path: '',
        component: MainLayout,
        children: [
            {
                // name: 'profile',
                path: '/profile',
               component: Profile,
            },
            {
                // name: 'sign-in',
                path: '/sign-in',
                component: SignUp,
            },
            {
                // name: 'operations',
                path: '/operations',
              component: Operation
            },
        ],
    },
    // {
    //     // name: 'profile',
    //     path: '/profile',
    //     component: Profile,
    // },
]
