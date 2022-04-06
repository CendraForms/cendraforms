<template>
    <div v-if="avaiableForms.length > 0">
        <h1 class="mt-5 mr-10 ml-10 text-2xl text-center uppercase">Formularis a Respondre</h1>
        <button class="flex items-center p-2 text-lg leading-none">
            <svg class="h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
        Veure'n més
        </button>
        <div class="flex flex-row ml-10 mr-10 gap-5">
            <div v-for="form in avaiableForms" :key="form.id" class="cf-section mt-5">
                <h2 class="text-lg text-center">{{ form.name }}</h2>
            </div>
        </div>
    </div>
    <div v-else class="mt-5 mr-10 ml-10">
        <p class="text-center text-lg text-red-600">No tens cap Formulari a respodre</p>
    </div>
    <br>
    <div v-if="answeredForms.length > 0">
        <h1 class="mt-5 mr-10 ml-10 text-2xl text-center uppercase">Formularis Respostos</h1>
        <button class="flex items-center p-2 text-lg leading-none">
            <svg class="h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
        Veure'n més
        </button>
        <div class="flex flex-row ml-10 mr-10 gap-5">
            <div v-for="form in answeredForms" :key="form.id" class="cf-section mt-5">
                <h2 class="text-lg text-center">{{ form.name }}</h2>
            </div>
        </div>
    </div>
    <div v-else class="mt-5 mr-10 ml-10">
        <p class="text-center text-lg text-red-600">No has respos cap Formulari</p>
    </div>
    <br>
    <div class="cf-section mt-5">
        <p>Nom d'Usuari: {{ userLogin.name }}</p><br>
        <p>Email d'Usuari: {{ userLogin.email }}</p><br>
        <div class="table w-full p-1">
            <table class="w-full">
                <tbody>
                    <tr v-for="role in roleLogin" :key="role.id" class="border-none border-0 text-start">
                        <td class="p-3 border border-black rounded">{{ role.name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Icon from '../Shared/Icon.vue'

const props = defineProps({
    'avaiableForms': Object,
    'answeredForms': Object,
    'userLogin': String,
    'roleLogin': Object
})

const avaiableForms = ref(props.avaiableForms)
const answeredForms = ref(props.answeredForms)
const userLogin = ref(props.userLogin)
const roleLogin = ref(props.roleLogin)

</script>
