<template>
  <QuestionText
    v-if="type == 'text'" 
    :value="content.value"
    :min="content.min" 
    :max="content.max"
  />

  <QuestionNumber
    v-if="type == 'number'"
    :value="content.value"
    :min="content.min"
    :max="content.max"
  />
</template>

<script setup>
import QuestionText from './Text.vue'
import QuestionNumber from './Number'

defineProps({
  type: String,
  content: Object,
})
</script>
