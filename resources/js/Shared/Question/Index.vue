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

  <CheckBox
    v-if="type == 'checkbox'"
  />
</template>

<script setup>
import QuestionNumber from './Number'
import CheckBox from './Checkbox'

defineProps({
  type: String,
  content: Object,
})
</script>