<template>
  <div class="mt-5">
    
















    <AnswerNumber
      v-if="type == 'number'"
      :value="content.value"
      :min="content.min"
      :max="content.max"
    />
    <AnswerCheckbox
      v-if="type == 'checkbox'"
    />
  </div>
</template>

<script setup>
import AnswerNumber from './Number'
import AnswerCheckbox from './Checkbox'
defineProps({
  type: String,
  content: Object,
})
</script>