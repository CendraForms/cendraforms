<template>
 <div class="gap-5 text-black" >
  <div v-for="(item, index) in Respostes" :key="index">
      <input type="checkbox" :value="item.resposta" v-model="resultat" class="m-3">
    <label class="w-full">{{item.resposta}}</label>
  </div>
 <!--Resultat: {{resultat}}-->
</div>
</template>

<script setup>
import { ref } from 'vue'
const Respostes = ref([{
  resposta:"Resposta 1"},{
  resposta:"Resposta 2"},{
  resposta:"Resposta 3"},{
  resposta:"Resposta 4"
  }]);
//const resultat = ref([]);
</script> 