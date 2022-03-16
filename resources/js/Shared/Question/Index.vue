<template>
  <div class="mt-5">
    <QuestionNumber
      v-if="type == 'number'"
      :value="content.value"
      :min="content.min"
      :max="content.max"
    />
  </div>
</template>

<script setup>
import QuestionNumber from './Number'

defineProps({
  type: String,
  content: Object,
})
</script>