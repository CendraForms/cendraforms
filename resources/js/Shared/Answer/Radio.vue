<template>
  <div v-for="(option, index) in options">
    <label
      v-text="option.text"
      for="`radio-option-` + {{ option.index }}"
    />

    <input
      id="`radio-option-` + {{ option.index }}"
      type="radio"
      v-model="answer.selected"
      :value="option.text"
    />
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  options: Array,
  answer: Object,
})

const options = ref(props.options)
const answer = ref(props.answer)
</script>