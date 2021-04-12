<template>
    <router-link :to="{name: 'countries.create'}" class="text-white fixed top-50 right-0 px-4 py-1 bg-indigo-700 font-bold rounded-l-full">
        Add country
    </router-link>

    <div class="bg-white max-w-7xl mx-auto rounded overflow-hidden">

        <header class="bg-gray-900 text-white p-3 flex items-center space-x-2">
            <strong class="block mr-4">Countries</strong>
            <small>
                Filter by continent:
            </small>
            <select v-model="selectedContinentCode" class="form-select border-none p-1 pr-6 text-gray-900 rounded">
                <option :value="null" selected>All continents</option>
                <option v-for="continent in continents" :value="continent.code" :key="`continent-${continent.code}`">
                    {{continent.name}}
                </option>
            </select>
        </header>

        <main>
            <table class="table-auto w-full" v-if="sortedCountries.length > 0">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="px-4 py-3 text-left">Code</th>
                        <th class="px-4 py-3 text-left cursor-pointer flex items-center space-x-6" 
                            @click="changeSortMethod">
                            <span>Name</span>
                            <SortArrows />
                        </th>
                        <th class="px-4 py-3 text-left">Continent</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="country in sortedCountries" :key="country.id" class="border-b border-gray-200">
                        <td class="px-4 py-3">{{country.code}}</td>
                        <td class="px-4 py-3">
                            <router-link :to="{name: 'countries.show', params: {id: country.country_id}}">
                                {{country.name}}
                            </router-link>
                        </td>
                        <td class="px-4 py-3">{{continentName(country.continent_code)}}</td>
                    </tr>
                </tbody>
            </table>
            <div v-else class="p-4 text-center">
                No countries found.
            </div>
        </main>
        
    </div>
</template>

<script>
import { computed, ref } from 'vue'
import { useStore } from 'vuex'
import SortArrows from '@/Icons/SortArrows'

export default {
    components: {
        SortArrows
    },

    setup () {
        const store = useStore()

        const selectedContinentCode = ref(null)

        const sortMethod = ref('asc')

        const changeSortMethod = () => {
            return sortMethod.value = sortMethod.value == 'asc' ? 'desc' : 'asc'
        }

        //get countries from DB and save data in strore
        store.dispatch('getCountries')

         //get continents from DB and save data in strore
        store.dispatch('getContinents')

        //get countries from store
        const countries = computed(() => store.getters.getCountriesByContinentCode(selectedContinentCode.value))

        //sort countries by name
        const sortedCountries = computed(() => countries.value.sort((a, b) => {
            if (sortMethod.value == 'asc') {
                return a.name > b.name
            }
            return a.name < b.name
        }))

        //get continents from store
        const continents = computed(() => store.state.continents)
    
        //get continent name by continent_code attribute of country
        const continentName = (code) => {
            return continents.value.find( continent => continent.code == code)?.name
        }

        return {
            selectedContinentCode,
            changeSortMethod,
            sortedCountries,
            continents,
            continentName,
        }
    }
}
</script>