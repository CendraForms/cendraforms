<template>
    <h1 class="mt-5 mb-5 text-center w-full text-4xl font-semibold">Llistat de Rols</h1>
    <div class="cf-section mt-5">
        <button @click="back" class="flex justify-center items-center p-3 text-base bg-stone-600 rounded hover:opacity-90 leading-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-narrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <line x1="5" y1="12" x2="9" y2="16"></line>
                <line x1="5" y1="12" x2="9" y2="8"></line>
            </svg>
        </button>
        <div class="flex items-center justify-center mb-5 leading-none">
            <button @click="newRole" class="flex items-center p-3 text-base uppercase bg-stone-600 rounded hover:opacity-90 leading-none">
                <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>

                Crea Rol
            </button>
        </div>
        <div class="table w-full">
            <table class="table-auto w-full rounded">
                <thead>
                    <tr class="bg-stone-800 border-solid rounded text-center">
                        <th class="p-2 border border-black">#</th>
                        <th class="p-2 border border-black">Nom del Rol</th>
                        <th class="p-2 border border-black">Estat</th>
                        <th class="p-2 border border-black">Accions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="role in roles" :key="role.id" class="bg-stone-500 border-solid rounded text-center">
                        <td class="p-2 border text-black border-black">{{ role.id }}</td>
                        <td class="p-2 border text-black border-black">{{ role.name }}</td>
                        <td v-if="role.active" class="p-2 border text-black border-black">Activat</td>
                        <td v-else class="p-2 border text-black border-black">Desactivat</td>
                        <td class="p-2 border text-black border-black flex flex-row gap-1">
                            <button @click="editRole(role.id)" class="flex items-center p-2 text-base text-indigo-100 bg-indigo-700 hover:opacity-90 rounded leading-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path>
                                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path>
                                    <line x1="16" y1="5" x2="19" y2="8"></line>
                                </svg>
                            </button>
                            <button @click="deleteRole(role.id, role.name)" class="flex items-center p-2 text-base text-red-100 bg-red-700 hover:opacity-90 rounded leading-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { onMounted, ref } from "vue";
import Icon from '../../Shared/Icon.vue'

const props = defineProps({
    'roles': Object
})

const roles = ref(props.roles)

const newRole = () => {
    Inertia.get('/roles/crear')
}

const editRole = (id) => {
    Inertia.get('/roles/'+id+'/editar')
}

const deleteRole = (id, name) => {
    if (confirm('Estàs Segur que vols esborrar el rol '+name+'?')) {
        Inertia.delete('/roles/'+id)
    }
}

const back = () => {
    Inertia.get('/')
}

</script>
