<template>
  <label v-text="`Opció de l'esquerra`" for="left" />
  <input
    id="left"
    type="text"
    v-model="left"
  >

  <br>

  <label v-text="`Opció de la dreta`" for="right" />
  <input
    id="right"
    type="text"
    v-model="right"
  >

  <br>

  <label v-text="`Opció per defecte`" for="defaultVal" />
  <select id="defaultVal" v-model="defaultVal">
    <option value="left" v-text="left" />
    <option value="right" v-text="right" />
  </select>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  left: String,
  right: String,
  defaultVal: String,
})

const left = ref(props.left)
const right = ref(props.right)
const defaultVal = ref(props.defaultVal)
</script>