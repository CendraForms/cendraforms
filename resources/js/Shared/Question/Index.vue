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

  <SelectOption
    v-if="type == 'select'"
  />
  

  <!--<option v-for="content.option in content.option" :value="content.option.value" >{{content.option.text}}</option>-->

  <CheckBox
    v-if="type == 'checkbox'"
  />

</template>

<script setup>
import QuestionNumber from './Number'
import QuestionSwitch from './Switch'
import QuestionRadio from './Radio'
import SelectOption from './Select'
import CheckBox from './Checkbox'

defineProps({
  type: String,
  content: Object,
})
</script>
