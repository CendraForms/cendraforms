<template>
  <div class="mt-5">
    <AnswerNumber
      v-if="type == 'number'"
      :value="content.value"
      :min="content.min"
      :max="content.max"
    />

    <AnswerSwitch
      v-if="type == 'switch'"
      :left="content.left"
      :right="content.right"
      :answer="answer"
    />
  </div>
</template>

<script setup>
import AnswerNumber from './Number'
import AnswerSwitch from './Switch'

defineProps({
  type: String,
  content: Object,
  answer: Object
})
</script>