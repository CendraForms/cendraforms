<template>
    <h1 class="mt-5 mb-5 text-center w-full text-4xl font-semibold">Llistat de Rols de l'Usuari {{ user.name }}</h1>
    <div class="cf-section mt-5">
        <div v-for="role in rolesLogin" :key="role.id" class="flex items-center justify-start gap-4">
            <div v-if="role.name == 'direccio'">
                <button @click="allUsers" class="flex justify-center items-center uppercase p-3 text-base bg-stone-600 rounded hover:opacity-90 leading-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                    </svg>

                    Tots els Usuaris
                </button>
                <button @click="allRoles" class="flex justify-center items-center uppercase p-3 text-base bg-stone-600 rounded hover:opacity-90 leading-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tags" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7.859 6h-2.834a2.025 2.025 0 0 0 -2.025 2.025v2.834c0 .537 .213 1.052 .593 1.432l6.116 6.116a2.025 2.025 0 0 0 2.864 0l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-6.117 -6.116a2.025 2.025 0 0 0 -1.431 -.593z"></path>
                        <path d="M17.573 18.407l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-7.117 -7.116"></path>
                        <path d="M6 9h-.01"></path>
                    </svg>

                    Tots els Rols
                </button>
            </div>
        </div>
        <div class="flex items-center justify-center mt-5 mb-5 leading-none">
            <button @click="addRole(user.id)" class="flex items-center p-3 text-base uppercase bg-stone-600 rounded hover:opacity-90 leading-none">
                <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>

                Afageix Rol
            </button>
        </div>
        <div class="table w-full">
            <table class="table-auto w-full rounded">
                <thead>
                    <tr class="bg-stone-800 border-solid rounded text-center">
                        <th class="p-2 border border-black">#</th>
                        <th class="p-2 border border-black">Nom</th>
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
                            <button @click="removeRole(user.id, role.id, role.name)" class="flex items-center p-2 text-base text-red-100 bg-red-700 hover:opacity-90 rounded leading-none">
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
    'user': Object,
    'roles': Object,
    'rolesLogin': Object,
})

const user = ref(props.user)
const roles = ref(props.roles)
const rolesLogin = ref(props.rolesLogin)

const allUsers = () => {
    Inertia.get('/users')
}

const allRoles = () => {
    Inertia.get('/roles')
}

const addRole = (id) => {
    Inertia.get('/users/'+id+'/roles/afegir')
}

const removeRole = (user_id, role_id, role_name) => {
    if (confirm('Estàs Segur que vols eliminar el rol '+role_name+'?')) {
        Inertia.delete('/users/'+user_id+'/roles/'+role_id)
    }
}

</script>
