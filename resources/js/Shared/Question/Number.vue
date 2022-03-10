<template>
<div class="flex gap-5">
  <div>
    <label class="block">Min</label>
    <input type="number" v-model="min" class="bg-transparent rounded-xl">
  </div>

  <div>
    <label class="block">Max</label>
    <input type="number" v-model="max" class="bg-transparent rounded-xl">
  </div>

  <div>
    <label class="block">Default</label>
    <input type="number" :value="value" :min="min" :max="max" class="bg-transparent rounded-xl">
  </div>
</div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  value: Number,
  min: Number,
  max: Number,
})

const value = ref(props.value)
const min = ref(props.min)
const max = ref(props.max)
</script>