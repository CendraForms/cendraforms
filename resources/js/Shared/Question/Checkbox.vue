<template>
 <div class="gap-5 text-black" >
  <div v-for="(Answer, index) in arr" :key="index">
    <div class="flex mb-3 w-full">
    <input type="checkbox" :value="Answer.value" v-model="CheckBoxResultat" class="m-3">
    <label class="w-full"><input type="text" placeholder="Resposta d'exemple" :value="Answer.value" @input="UpdateAnswers($event,index)" :key="Answer.id"   class="mb-5 block w-full bg-transparent rounded-xl"></label>
  
  <button  @click="DeleteAnswers(index)" class="mb-3 ml-2 p-1 text-sm font-medium uppercase leading-none rounded hover:opacity-75">
<svg class="w-6 h-6" fill="white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>  </button>
    </div>

  <button v-if="index == arr.length-1 || arr.length==0" @click="createAnswers()" class="ml-4 mb-2 p-1 bg-stone-500 text-sm font-medium uppercase leading-none rounded hover:opacity-75">
     <svg  class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
  </button>
  </div>


  <div v-if="arr.length==0" class="pb-2">
  <h1  class="text-white">Crea aquí les opcions per la pregunta:</h1>
  <button  @click="createAnswers()" class="ml-4 mt-6 p-1 bg-stone-500 text-sm font-medium uppercase leading-none rounded hover:opacity-75">
     <svg  class="w-6 h-6" fill="none" stroke="white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
  </button>
  </div>
</div>
</template>

<script setup>
import { ref } from 'vue'

const CheckBoxResultat = defineProps([]);

const createAnswers = (valor) => {
  arr.value.push({
    id: arr.value.length,
    value:valor,
    text: valor,
  })
}

const UpdateAnswers = (event,posicio) => {
  arr.value[posicio]['value']=event.target.value;
  arr.value[posicio]['text']=event.target.value;
}

const DeleteAnswers = (posicio) => {
arr.value.splice(posicio,1)
}

const arr = ref([]);

</script> 