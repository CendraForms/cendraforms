<template>
  <div v-if="type !== 'text'" class="w-full mt-5">
    <!-- <QuestionText
      v-if="type == 'text'"
      v-model:content="content"
    /> -->

    <QuestionNumber
      v-if="type == 'number'"
      v-model:content="content"
    />

    <!-- <SelectOption
      v-if="type == 'select'"
      v-model:content="content"
    /> -->
  </div>

  <!-- <QuestionSwitch
    v-if="type == 'switch'"
    v-model:content="content"
    :left="content.left"
    :right="content.right"
  /> -->

  <!-- <QuestionRadio
    v-if="type == 'radio'"
    :options="content.options"
  /> -->

  <!-- <SelectOption
    v-if="type == 'select'"
  /> -->

  <!-- <CheckBox
    v-if="type == 'checkbox'"
  /> -->

  <!-- <Textarea
    v-if="type == 'textarea'"
  /> -->

  <!-- <Textarea /> -->
  
</template>

<script setup>
import { ref } from 'vue'

// Components
// import QuestionText from './Text.vue'
import QuestionNumber from './Number.vue'

// import QuestionSwitch from './Switch'
// import QuestionRadio from './Radio'
// import SelectOption from './Select'
// import CheckBox from './Checkbox'
// import Textarea from './Textarea'

const props = defineProps({
  type: String,
  content: Object,
})

const content = ref(props.content)
</script>
