<template>
  <div class="flex gap-5">
    <div>
      <label class="block mb-1">Min Number</label>
      <input type="number" v-model="min" :max="max" class="bg-transparent border-white rounded-xl">
    </div>

    <div>
      <label class="block mb-1">Max Number</label>
      <input type="number" v-model="max" :min="min" class="bg-transparent border-white rounded-xl">
    </div>

    <div>
      <label class="block mb-1">Default Number</label>
      <input type="number" :value="value" :min="min" :max="max" class="bg-transparent border-white rounded-xl">
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