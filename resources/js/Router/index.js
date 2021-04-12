import {createRouter, createWebHistory} from 'vue-router'
import {routes} from './routes'
import {setAccessToken, setAuthUser} from '@/Middleware'
import {isAuthenticated} from '@/Helpers'

const guestRoutes = [
    'login',
    'register'
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    setAccessToken()
    setAuthUser()
    if(to.meta.auth && !isAuthenticated()) return next({name: 'login'})
    if(guestRoutes.includes(to.name) && isAuthenticated()) return next({name: 'countries.index'})
    next()
})

export default router
