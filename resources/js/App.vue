<template>
    <header class="bg-white w-full shadow px-5 py-3 flex items-center justify-between">
        <router-link to="/">
            <EarthIcon />
        </router-link>
        <div class="flex items-center space-x-6" v-if="user">
            <span>
                <strong>Logged in user:</strong>
                {{user.name}}
            </span>
            <LogoutButton />
        </div>
    </header>
    <main class="p-10">
        <router-view />
    </main>
</template>

<script>
import { computed } from 'vue'
import { useStore } from 'vuex'
import EarthIcon from '@/Icons/Earth'
import LogoutButton from '@/Components/LogoutButton'

export default {
    components: {
        EarthIcon,
        LogoutButton
    },
    setup () {
        const store = useStore()
    
        return {
            flash: computed(() => store.state.flashMessage),
            user: computed(() => store.state.currentUser ?? null)
        }
    }
}
</script>