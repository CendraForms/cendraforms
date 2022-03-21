<template>
  <div class="mt-5">
    <AnswerNumber
      v-if="type == 'number'"
      :value="content.value"
      :min="content.min"
      :max="content.max"
    />
  </div>

  <Textarea/>
</template>

<script setup>
import AnswerNumber from './Number'
import Textarea from './Textarea'
defineProps({
  type: String,
  content: Object,
})
</script>