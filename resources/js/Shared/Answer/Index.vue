<template>
  <div class="mt-5">
    <AnswerText
      v-if="type == 'text'"
      :value="content.value"
      :min="content.min"
      :max="content.max"
    />

    <AnswerNumber
      v-if="type == 'number'"
      :value="content.value"
      :min="content.min"
      :max="content.max"
    />
  </div>
</template>

<script setup>
import AnswerText from './Text'
import AnswerNumber from './Number'

defineProps({
  type: String,
  content: Object,
})
</script>