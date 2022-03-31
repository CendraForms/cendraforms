<template>
  <label v-text="`Opció de l'esquerra`" for="left" />
  <input
    id="left"
    type="text"
    v-model="left.text"
  />

  <br>

  <label v-text="`Opció de la dreta`" for="right" />
  <input
    id="right"
    type="text"
    v-model="right.text"
  />

  <br>

  <label v-text="`Opció per defecte`" for="defaultVal" />
  <select id="defaultVal">
    <option
      value="left.text"
      v-text="left.text"
      :selected="left.defaultVal"
    />

    <option
      value="right.text"
      v-text="right.text"
      :selected="right.defaultVal"
    />
  </select>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  left: Object,
  right: Object,
})

const left = ref(props.left)
const right = ref(props.right)
</script>