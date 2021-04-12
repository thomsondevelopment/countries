import Countries from '@/Pages/Countries'
import Login from '@/Pages/Auth/Login'
import Register from '@/Pages/Auth/Register'
import ShowCountry from '@/Pages/ShowCountry'
import CreateCountry from '@/Pages/CreateCountry'
import NotFound from '@/Pages/NotFound'

export const routes = [
    {
        path: '',
        redirect: '/countries'
    },
    {
        path: '/countries',
        component: Countries,
        name: 'countries.index',
        meta: {
            auth: true
        }
    },
    {
        path: '/countries/:id',
        component: ShowCountry,
        name: 'countries.show'
    },
    {
        path: '/countries/create',
        component: CreateCountry,
        name: 'countries.create'
    },
    {
        path: '/login',
        component: Login,
        name: 'login'
    },
    {
        path: '/register',
        component: Register,
        name: 'register'
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound,
        name: '404'
    }
]