<template>
    <input :type="type" :id="id" 
        class="bloc w-full bg-gray-100 p-3 rounded border-none" 
        :value="modelValue" 
        @input="changeValue($event.target.value)">
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            required: true
        },
        id: {
            type: String,
            required: true
        },
        modelValue: String
    },
    emits: ['update:modelValue'],
    methods: {
        changeValue(value) {
            this.$emit('update:modelValue', value)
        }
    }
}
</script>