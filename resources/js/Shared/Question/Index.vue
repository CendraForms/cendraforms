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
  />

  <QuestionRadio
    v-if="type == 'radio'"
    :options="content.options"
  />
</template>

<script setup>
import QuestionNumber from './Number'
import QuestionSwitch from './Switch'
import QuestionRadio from './Radio'

defineProps({
  type: String,
  content: Object,
})
</script>
