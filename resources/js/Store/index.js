import axios from 'axios'
import { createStore } from 'vuex'

export const store = createStore({
    state: {
        currentUser: null,
        accessToken: null,
        continents: [],
        countries: []
    },

    getters: {
        getCountriesByContinentCode: (state) => code => {
            return code 
                ? state.countries.filter(country => {
                    return country.continent_code == code
                })
                : state.countries
        },

        getCountryById: (state) => id => {
            return state.countries.find(country => country.country_id == id)
        }
    },

    mutations: {
        setAccessToken(state, value){
            return state.accessToken = value
        },

        setCurrentUser(state, user) {
            return state.currentUser = user
        },

        setCountries(state, countries) {
            return state.countries = countries
        },

        setContinents(state, continents) {
            return state.continents = continents
        },

        pushNewCountry(state, country) {
            return state.countries.push(country)
        }
    },

    actions: {
        setAccessToken({ commit }, value){
            commit('setAccessToken', value)
        },

        setCurrentUser({commit}, user){
            commit('setCurrentUser', user)
        },

        getCountries({commit}) {
            axios.get('/api/countries')
                .then(res => commit('setCountries', res.data.countries))
        },

        getContinents({commit}) {
            axios.get('/api/continents')
                .then(res => commit('setContinents', res.data.continents))
        },

        addNewCountry({commit}, country) {
            commit('pushNewCountry', country)
        }
    }
})