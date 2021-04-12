<template>
    <form-card @submitted="handleSubmit">
        <template #heading>
            Register
        </template>
        
        <div class="mb-3">
            <label for="name">
                Full name
            </label>
            <FormInput 
                type="text" 
                id="name" 
                v-model="name" />
            <ErrorListing 
                v-if="formErrors?.name" 
                :errors="formErrors?.name" />
        </div>

        <div class="mb-3">
            <label for="email">
                Email address
            </label>
            <FormInput 
                type="email" 
                id="email" 
                v-model="email" />
            <ErrorListing 
                v-if="formErrors?.email" 
                :errors="formErrors?.email" />
        </div>

        <div class="mb-3">
            <label for="password">
                Password
            </label>
            <FormInput 
                type="password" 
                id="password" 
                v-model="password" />
            <ErrorListing 
                v-if="formErrors?.password" 
                :errors="formErrors?.password" />
        </div>

        <div class="mb-3">
            <label for="c_password">
                Confirm password
            </label>
            <FormInput 
                type="password" 
                id="c_password" 
                v-model="password_confirmation" />
            <ErrorListing 
                v-if="formErrors?.password" 
                :errors="formErrors?.password" />
        </div>

        <template #footer>
            <form-button type="submit">
                Create account
            </form-button>
            Do you already have an account?
            <router-link to="/login" class="text-indigo-700">
                Login
            </router-link>
        </template>
    </form-card>
</template>

<script>
import { reactive, ref, toRefs } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'
import Cookies from 'js-cookie'

//components
import FormCard from '@/Components/FormCard'
import FormInput from '@/Components/FormInput'
import ErrorListing from '@/Components/ErrorListing'
import FormButton from '@/Components/FormButton'

export default {
    components: {
        FormCard,
        FormInput,
        ErrorListing,
        FormButton
    },

    setup () {
        const store = useStore()
        const router = useRouter()

        //form data
        const form = reactive({
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        })

        const formErrors = ref(null)

        //set access token in store and cookies
        const setToken = (token) => {
            store.dispatch('setAccessToken', token)
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
            Cookies.set('x-access-token', token)
        }

        //set Auth user in sore and cookies
        const setCurrentUser = (user) => {
            store.dispatch('setCurrentUser', user)
            Cookies.set('auth-user', JSON.stringify(user))
        }

        //submit form 
        const handleSubmit = () => {
            axios.post('/api/register', form)
                .then(res => res.data)
                .then(data => {
                    setToken(data.token)
                    setCurrentUser(data.user)
                    router.push({name: 'countries.index'})
                })
                .catch(err => formErrors.value = err.response.data.errors)
        }
    
        return {
            formErrors,
            handleSubmit,
            ...toRefs(form),
        }
    }
}
</script>