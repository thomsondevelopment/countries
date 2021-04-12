<template>
    <div class="mt-1 text-red-600">
        <small class="block" v-for="(err, index) in errors" :key="index">
            {{err}}
        </small>
    </div>
</template>

<script>
export default {
    props: {
        errors: {
            type: Array,
            default: []
        }
    }
}
</script>