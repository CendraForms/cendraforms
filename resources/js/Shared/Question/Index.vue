<template>
  <div v-if="type == 'text'">
    <input type="text" name="" id="">
  </div>

  <QuestionNumber
    v-if="type == 'number'"
    :value="content.value"
    :min="content.min"
    :max="content.max"
  />
</template>

<script setup>
import QuestionNumber from './Number'

defineProps({
  type: String,
  content: Object,
})
</script>