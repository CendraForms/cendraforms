<template>
  <input
    type="text"
    id="add-radio-option"
    v-text="`Afegir opció`"
    v-model="addOptionBtn"
    v-on:keyup.enter="addOption"
  />
  <label
    class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded cursor-pointer"
    v-text="`Afegir opció`"
    for="`add-radio-option`"
    @click="addOption"
  />

  <p v-if="options.length == 1" v-text="`Hi ha d'haver dues opcions com a mínim`" />

  <p v-if="options.length > 20" v-text="`Has arribat al límit d'opcions`" />

  <p v-if="addOptionBtn.length >= 32" v-text="`Longitud màxima de caràcters - 32`" />

  <div
    v-for="(option, index) in options"
    :key="index"
    class="flex gap-3"
  >
    <p v-text="option.text" />

    <button
      class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded cursor-pointer"
      @click="deleteOption(option)"
      v-text="`delete`"
    />
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  options: Array
})

const options = ref(props.options)
const addOptionBtn = ref('')

const addOption = () => {
  addOptionBtn.value = addOptionBtn.value.trim()

  if (options.value.length > 20 || addOptionBtn.value == "" || addOptionBtn.value.length >= 32) {
    addOptionBtn.value = ""
    return
  }

  for (const option of options.value) {
    if (option.text == addOptionBtn.value) {
      addOptionBtn.value = ""
      return
    }
  }

  options.value.push({ text: addOptionBtn.value, selected: false, defaultVal: false })
  addOptionBtn.value = ""
}

const deleteOption = (element) => {
  if (options.value.length > 2) {
    options.value.splice(element, 1)
  }
}
</script>