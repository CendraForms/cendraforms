<template>
    <div v-for="(value, index) in form" :key="index">
        <p>{{ value }}</p>
    </div>
</template>

<script setup>
    import { ref } from 'vue'

    const props = defineProps({
        form: Object,
        sections: Object,
        questions: Object
    })

    const form = ref(props.form)
    const sections = ref(props.sections)
    const questions = ref(props.questions)
</script>
