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
    <SelectOption
    v-if="type == 'select'"
    />

  

  <!--<option v-for="content.option in content.option" :value="content.option.value" >{{content.option.text}}</option>-->

</template>

<script setup>
import QuestionNumber from './Number'
import SelectOption from './Select'

defineProps({
  type: String,
  content: Object,
})
</script>