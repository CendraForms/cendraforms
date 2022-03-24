<template>
  <label v-text="left.text" for="left" />
  <input
    id="left"
    type="checkbox"
    v-model="left.selected"
    @click="toggleChecked(left)"
    :disabled="left.selected"
  />

  <label v-text="right.text" for="right" />
  <input
    id="right"
    type="checkbox"
    v-model="right.selected"
    @click="toggleChecked(right)"
    :disabled="right.selected"
  />
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  left: Object,
  right: Object,
  answer: Object,
})

const left = ref(props.left)
const right = ref(props.right)
const answer = ref(props.answer)

const toggleChecked = (clickedBtn) => {
  left.value.selected = false
  right.value.selected = false

  clickedBtn.selected = true
  answer.value.selected = clickedBtn.text
}
</script>