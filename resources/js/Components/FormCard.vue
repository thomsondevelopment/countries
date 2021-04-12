<template>
    <form class="w-full max-w-md p-4 mx-auto rounded shadow-xl bg-white" @submit.prevent="$emit('submitted')">
        <header class="mb-4">
            <h2 class="font-bold text-center">
                <slot name="heading"></slot>
            </h2>
        </header>
        <main class="mb-4">
            
            <slot></slot>

        </main>
        <footer class="flex justify-center flex-col text-center">
            <slot name="footer"></slot>
        </footer>
    </form>
</template>

<script>
export default {
    emits: ['submitted']
}
</script>