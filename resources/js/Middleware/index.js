import Cookies from 'js-cookie'
import {store} from '@/Store'

export const setAccessToken = () => {
    const token = Cookies.get('x-access-token') ?? null
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
    return store.dispatch('setAccessToken', token)
}

export const setAuthUser = () => {
    const user = Cookies.get('auth-user') ?? null
    return store.dispatch('setCurrentUser', JSON.parse(user))
}