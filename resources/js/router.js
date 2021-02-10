import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import dashboard from './components/admin/pages/Dashboard'
import tag from './components/admin/pages/Tag'
import category from './components/admin/pages/Category'

const routes = [
    {
        path: '/',
        component: dashboard,
        name: 'dashboard'
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