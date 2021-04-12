<template>
    <div class="bg-white max-w-3xl mx-auto rounded shadow-xl p-5">
        <router-link :to="{name: 'countries.index'}" class="font-bold mb-4 flex items-center space-x-2 text-gray-600 hover:text-indigo-700">
            <ArrowLeft />
            <span>Back to the list</span>
        </router-link>
        <ul>
            <li v-for="(attribute, index) in countryAttributes" :key="`attr-${index}`">
                <strong>{{formatAttributeName(attribute)}}:</strong>
                {{country[attribute]}}
            </li>
        </ul>
    </div>
</template>

<script>
import { ref } from '@vue/reactivity'
import { useRoute } from 'vue-router'
import { computed } from '@vue/runtime-core'
import ArrowLeft from '@/Icons/ArrowLeft'

export default {
    components: {
        ArrowLeft
    },

    setup () {
        const route = useRoute()
        const country = ref(null)

        axios.get(`/api/countries/${route.params.id}`)
            .then(res => res.data)
            .then(data => country.value = data)
    

        const countryAttributes = computed(() => {
            return Object.keys(country.value ?? {})
        })

        const formatAttributeName = attr => _.capitalize(_.replace(attr, '_', ' ')) 

        return {
            country,
            countryAttributes,
            formatAttributeName
        }
    }
}
</script>