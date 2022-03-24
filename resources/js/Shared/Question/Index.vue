<template>
<Textarea
  
  />
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

  <SelectOption
    v-if="type == 'select'"
  />

  <CheckBox
    v-if="type == 'checkbox'"
  />

  <Textarea
    v-if="type == 'textarea'"
  />
  
</template>

<script setup>
import QuestionNumber from './Number'
import QuestionSwitch from './Switch'
import QuestionRadio from './Radio'
import SelectOption from './Select'
import CheckBox from './Checkbox'
import Textarea from './Textarea'

defineProps({
  type: String,
  content: Object,
})
</script>
