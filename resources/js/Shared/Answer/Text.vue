<template>
    <div class="rounded-xl mb-5">
        <span class="block mb-5">
          Answers
        </span>

        <input type="text" :value="value" :placeholder="value" :minlength="min" :maxlength="max"  class="mb-5 w-full bg-transparent rounded-xl">
      </div>
</template>

<script setup>
    import { ref } from 'vue'

    const props = defineProps({
        value: Text,
        min: Number,
        max: Number,
    })

    const value = ref(props.value)
    const min = ref(props.min)
    const max = ref(props.max)
</script>