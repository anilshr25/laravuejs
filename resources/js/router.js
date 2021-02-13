import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import dashboard from './components/admin/pages/Dashboard'
import adminuser from './components/admin/pages/Adminuser'
import tag from './components/admin/pages/Tag'
import category from './components/admin/pages/Category'
import mainvuex from './components/vuex/VuexApp'

const routes = [
    {
        path: '/testvuex',
        component: mainvuex,
        name: 'mainvuex'
    },
    {
        path: '/',
        component: dashboard,
        name: 'dashboard'
    },
    {
        path: '/adminuser',
        component: adminuser,
        name: 'adminuser'
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
