import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import login from './components/admin/pages/Login'
import dashboard from './components/admin/pages/Dashboard'
import user from './components/admin/pages/Adminuser'
import tag from './components/admin/pages/Tag'
import category from './components/admin/pages/Category'

const routes = [
    {
        path: '/login',
        component: login,
        name: 'login',
    },
    {
        path: '/',
        component: dashboard,
        name: 'dashboard'
    },
    {
        path: '/user',
        component: user,
        name: 'user'
    },
    {
        path: '/tag',
        component: tag,
        name: 'tag'
    },
    {
        path: '/category',
        component: category,
        name: 'category'
    },
    // {
    //     path: '/testvuex',
    //     component: mainvuex,
    //     name: 'mainvuex'
    // },
    // {
    //     path: '/test-page',
    //     component: TestPage
    // },
    // {
    //     path: '/new-page',
    //     component: NewPage
    // }
]

export default new Router({
    mode: 'history',
    routes
})
