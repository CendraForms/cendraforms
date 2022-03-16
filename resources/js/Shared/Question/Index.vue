<template>
  <div class="mt-5">
    <QuestionNumber
      v-if="type == 'number'"
      :value="content.value"
      :min="content.min"
      :max="content.max"
    />
  </div>

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