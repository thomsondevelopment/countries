<template>
    <form-card @submitted="handleSubmit">
        <template #heading>
            Create country
        </template>
        <div class="mb-3">
            <label for="code">
                Code
            </label>
            <FormInput 
                type="text" 
                id="code" 
                v-model="code" />
            <ErrorListing
                v-if="errors?.code" 
                :errors="errors.code" />
        </div>

        <div class="mb-3">
            <label for="name">
                Name
            </label>
            <FormInput 
                type="text" 
                id="name" 
                v-model="name" />
            <ErrorListing
                v-if="errors?.name" 
                :errors="errors.name" />
        </div>

        <div class="mb-3">
            <label for="full_name">
                Full name
            </label>
            <FormInput 
                type="text" 
                id="full_name" 
                v-model="full_name" />
            <ErrorListing
                v-if="errors?.full_name" 
                :errors="errors.full_name" />
        </div>

        <div class="mb-3">
            <label for="iso3">
                iso3
            </label>
            <FormInput 
                type="text" 
                id="iso3" 
                v-model="iso3" />
            <ErrorListing
                v-if="errors?.iso3" 
                :errors="errors.iso3" />
        </div>

        <div class="mb-3">
            <label for="number">
                Number
            </label>
            <FormInput 
                type="text" 
                id="number" 
                v-model="number" />
            <ErrorListing
                v-if="errors?.number" 
                :errors="errors.number" />
        </div>

        <div class="mb-3">
            <label for="continent_code">
                Continent
            </label>
            <select id="continent_code" class="w-full bg-gray-100 p-3 rounded border-none" v-model="continent_code">
                <option v-for="continent in continents" :value="continent.code" :key="`continent-${continent.code}`">
                    {{continent.name}}
                </option>
            </select>
            <ErrorListing
                v-if="errors?.continent_code" 
                :errors="errors.continent_code" />
        </div>

        <div class="mb-3">
            <label for="display_order">
                Display order
            </label>
            <FormInput 
                type="text" 
                id="display_order" 
                v-model="display_order" />
            <ErrorListing
                v-if="errors?.display_order" 
                :errors="errors.display_order" />
        </div>
        <template #footer>
            <form-button type="submit">
                Save
            </form-button>
        </template>
    </form-card>
</template>

<script>
import { reactive, ref, toRefs } from 'vue'
import { useStore } from 'vuex'
import { useRouter } from 'vue-router'

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
            code: '',
            name: '',
            full_name: '',
            iso3: '',
            number: '',
            continent_code: '',
            display_order: ''
        })

        const errors = ref(null)

        //submit form and add new country to array in store or handle errors
        const handleSubmit = () => {
            axios.post('/api/countries', form)
                .then(res => store.dispatch('addNewCountry', res.data.country))
                .then(() => router.push({name: 'countries.index'}))
                .catch(err => errors.value = err.response.data.errors)
        }

        const continents = ref([])

        //get available continents from DB and set to "continents" variable
        axios.get('/api/continents')
            .then(res => continents.value = res.data.continents)
    
        return {
            continents,
            handleSubmit,
            errors,
            ...toRefs(form),
        }
    }
}
</script>