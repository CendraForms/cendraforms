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

    <AnswerCheckbox
      v-if="type == 'checkbox'"
    />

    <AnswerSwitch
      v-if="type == 'switch'"
      :left="content.left"
      :right="content.right"
      :answer="answer"
    />

    <AnswerRadio
      v-if="type == 'radio'"
      :options="content.options"
      :answer="answer"
    />
  </div>

  <Textarea/>
</template>

<script setup>
import AnswerText from './Text'
import AnswerNumber from './Number'
import AnswerCheckbox from './Checkbox'
import AnswerSwitch from './Switch'
import AnswerRadio from './Radio'
import Textarea from './Textarea'

defineProps({
  type: String,
  content: Object,
  answer: Object
})
</script>