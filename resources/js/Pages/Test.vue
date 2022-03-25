<template>
  {{ llista }}<br>
  <Asd v-model:llista="llista" />
</template>

<script setup>
import { ref } from "vue";
import Asd from "../Shared/Asd.vue";

const llista = ref("Hola");
</script>