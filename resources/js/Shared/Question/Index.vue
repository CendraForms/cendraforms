<template>
  <div class="mt-5">
    <QuestionNumber
      v-if="type == 'number'"
      :value="content.value"
      :min="content.min"
      :max="content.max"
    />
  </div>

  <QuestionSwitch
    v-if="type == 'switch'"
    :left="content.left"
    :right="content.right"
    :defaultVal="content.defaultVal"
  />
</template>

<script setup>
import QuestionNumber from './Number'
import QuestionSwitch from './Switch'

defineProps({
  type: String,
  content: Object,
})
</script>