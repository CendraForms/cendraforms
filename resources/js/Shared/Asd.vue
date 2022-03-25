<template>
  {{ llista }}<br>
  
  <button @click="afegir">
    Afegir
  </button>
</template>

<script setup>
import { ref, defineEmits } from "vue";

const props = defineProps({
  llista: Array,
});

const emit = defineEmits([
  "update:llista",
]);

const llista = ref(props.llista);

const afegir = () => {
  llista.value = "Adeu";
  emit("update:llista", llista.value);
}
</script>
