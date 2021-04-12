<template>
    <button :type="type" class="px-3 py-2 font-bold bg-gray-900 text-gray-200 rounded block w-full mb-3 border-none">
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            required: true
        }
    }
}
</script>