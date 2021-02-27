import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import login from './components/admin/pages/Login'
import dashboard from './components/admin/pages/Dashboard'
import user from './components/admin/pages/Adminuser'
import tag from './components/admin/pages/Tag'
import category from './components/admin/pages/Category'
import role from './components/admin/pages/Role'
import assign_role from './components/admin/pages/AssignRole'

const routes = [
    {
        path: '/login',
        component: login,
        name: 'login',
    },
    {
        path: '/dashboard',
        component: dashboard,
        name: 'dashboard'
    },
    {
        path: '/users',
        component: user,
        name: 'users'
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
    {
        path: '/role',
        component: role,
        name: 'role'
    },
    {
        path: '/assignRole',
        component: assign_role,
        name: 'assignRole'
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
