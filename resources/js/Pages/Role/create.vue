<template>
    <h1 class="mt-5 mb-5 text-center w-full text-4xl font-semibold">Crear Rol</h1>
    <div class="cf-section mt-5">
        <button @click="back" class="flex justify-center items-center p-3 text-base bg-stone-600 rounded hover:opacity-90 leading-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <line x1="5" y1="12" x2="9" y2="16"></line>
                <line x1="5" y1="12" x2="9" y2="8"></line>
            </svg>
        </button>
        <div class="flex items-center justify-center mx-auto w-2/3 leading-none">
            <form @submit.prevent="submit">
                <label for="roleName" class="mt-5 text-base">Nom del Rol</label>
                <div class="mt-2 p-3 bg-stone-800 rounded-md border border-white/25">
                    <input
                        type="text"
                        name="name"
                        id="roleName"
                        v-model="form.name"
                        class="cf-input text-lg"
                        minlength="3"
                        maxlength="30"
                    >
                </div>
                <br>
                <label for="roleActive" class="mt-5 text-base">Estat</label>
                <div class="flex justify-center mt-2 p-3 bg-stone-800 rounded-md border border-white/25">
                    <input
                        type="checkbox"
                        name="active"
                        id="roleActive"
                        v-model="form.active"
                        class="w-16 text-lg rounded bg-white"
                    >
                </div>
                <br>
                <div class="flex justify-center mt-5">
                    <button type="submit" class="w-full flex justify-center items-center ml-5 mr-5 p-3 text-base uppercase bg-stone-600 rounded hover:opacity-90 leading-none">
                        <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>

                        Crea Rol
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import Icon from '../../Shared/Icon.vue'

const form = ref({
    name: '',
    active: false,
})

const submit = () => {
    Inertia.post('/roles', form.value)
}

const back = () => {
    Inertia.get('/roles')
}

</script>
