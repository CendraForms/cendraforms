<template>
  <div class="flex gap-5 w-full">
    <input
      v-model="content.min"
      class="cf-input w-full text-lg"
      type="number"
      placeholder="Mínim"
      :max="content.max"
    />

    <input
      v-model="content.max"
      class="cf-input w-full text-lg"
      type="number"
      placeholder="Màxim"
      :min="content.min"
    />

    <input
      v-model="content.value"
      class="cf-input w-full text-lg"
      type="number"
      placeholder="Per defecte"
      :min="content.min"
      :max="content.max"
    />
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  content: Object,
})

const content = ref(props.content)
</script>