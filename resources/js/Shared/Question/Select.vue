<template>
<!-- -->
 <div class="flex gap-5 text-black" >
  <select name="test" class="text-black w-1/3">
     <option  class="text-black" v-for="option in arr" :value="option.value" :key="option.id">{{option.text}}</option>
</select>
</div>

  <div v-for="(option, index) in arr " :key="option.id" class="items-center">
    <label class="block">opció {{index+1}}</label>
    <input type="text" :value="option.value" @input="UpdateOptions($event,index)" :key="option.id" class="mb-3 bg-transparent rounded-xl">
  <button  @click="DeleteOptions(index)" class="ml-2 p-1 bg-stone-500 text-sm font-medium uppercase leading-none rounded hover:opacity-75">
     <svg  class="w-6 h-6" fill="none" stroke="red" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
  </button>
  <br>
  <button v-if="index == arr.length-1 || arr.length==0" @click="createOptions()" class="p-1 bg-stone-500 text-sm font-medium uppercase leading-none rounded hover:opacity-75">
     <svg  class="w-6 h-6" fill="none" stroke="green" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
  </button>
  </div>
  <br>
  <h1 v-if="arr.length==0">Crea aqui les opcions per la pregunta</h1>
  <button v-if="arr.length==0" @click="createOptions()" class="mt-6 p-1 bg-stone-500 text-sm font-medium uppercase leading-none rounded hover:opacity-75">
     <svg  class="w-6 h-6" fill="none" stroke="green" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
  </button>


</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  value: String,
  arr:  []
})


const createOptions = (valor) => {
  arr.value.push({
    id: arr.value.length,
    value:valor,
    text: valor,
  })
}

const UpdateOptions = (event,posicio) => {
  arr.value[posicio]['value']=event.target.value;
  arr.value[posicio]['text']=event.target.value;
}

const DeleteOptions = (posicio) => {
arr.value.splice(posicio,1)
}

const arr = ref([],props.arr);
</script>