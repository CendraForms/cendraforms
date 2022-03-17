<template>
  <div class="mt-5">
<<<<<<< HEAD
    <QuestionNumber
=======
    <AnswerNumber
>>>>>>> 4b5ea5d595f9282557ba4ccadc77953ec9ec9ebc
      v-if="type == 'number'"
      :value="content.value"
      :min="content.min"
      :max="content.max"
    />
  </div>
</template>

<script setup>
<<<<<<< HEAD
import QuestionNumber from './Number'
=======
import AnswerNumber from './Number'
>>>>>>> 4b5ea5d595f9282557ba4ccadc77953ec9ec9ebc

defineProps({
  type: String,
  content: Object,
})
</script>