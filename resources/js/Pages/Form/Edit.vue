<template>
    {{ form }}
</template>

<script setup>
    import { ref } from 'vue'

    const props = defineProps({
        form: Object
    })

    const form = ref(props.form)
</script>
