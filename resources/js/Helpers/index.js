import {store} from '@/Store'

export const isAuthenticated = () => {
    return store.state.currentUser && 
        store.state.accessToken 
        ? true 
        : false
}