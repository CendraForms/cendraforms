<template>
  <div class="cf-section mt-10 mb-10 flex flex-col">
    <div class="flex flex-row justify-between items-center">
      <div class="flex items-center gap-7">
        <img
          src="/img/stockUser.png"
          alt="User stock image"
          class="inline object-cover w-16 h-16 mr-2 rounded-full"
        />

        <h1 v-text="username" />

        <h2 v-text="email" class="hidden md:block"/>
      </div>

      <div class="flex items-center gap-2">
        <a
          href="/roles"
          title="Gestionar usuaris"
          class="bg-stone-700 p-1 rounded"
        >
          <Icon name="addressBook" class="w-7 h-7 cursor-pointer" />
        </a>
        
        <a
          href="/roles"
          title="Gestionar rols"
          class="bg-stone-700 p-1 rounded"
        >
          <Icon name="tag" class="w-7 h-7 cursor-pointer" />
        </a>
      </div>
    </div>

    <div class="mt-5 flex items-center gap-3 p-2 border border-white/25 rounded">
      <p
        v-for="role in roles"
        v-text="role"
        class="p-2 bg-stone-700 rounded"
      />
    </div>
  </div>

  <div class="cf-section mt-10 mb-10 flex flex-col">
    <p class="mb-5 text-2xl font-bold">Formularis per respondre</p>

    <div class="grid grid-cols-1 md:grid-cols-2 w-full gap-5">
      <div
        v-for="(form, i) in formsToBeAnswered"
        :key="form.id"
        class="w-full bg-stone-700 rounded-xl"
      >
        <div class="w-full h-4 bg-gradient-to-r from-sky-500 to-indigo-500 rounded-t-xl"></div>

        <div class="p-8 md:flex justify-between gap-8">
          <div class="flex items-center flex-col">
            <span class="text-2xl font-semibold">
              {{ form.name }}
            </span>

            <ul class="flex flex-wrap gap-2 mt-2 text-xs leading-none">
              <li v-for="(role) in formsToBeAnsweredRoles[i]" class="p-1.5 border border-white/25 rounded">
                {{ role.name }}
              </li>
            </ul>
          </div>

          <div class="flex items-center flex-col justify-center mt-5 md:mt-0 gap-y-4">
            <span>
              {{ formsToBeAnsweredCounts[i] }}
              {{ formsToBeAnsweredCounts[i] == 1 ? 'pregunta' : 'preguntes' }}
            </span>

            <a
              :href="`/formulari/${formsToBeAnswered[i].id}`"
              class="p-2 font-medium bg-gradient-to-r from-sky-500 to-indigo-500 leading-none rounded shadow hover:opacity-90"
            >
              Respondre
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="cf-section mt-10 mb-10 flex flex-col">
    <p class="mb-5 text-2xl font-bold">Formularis respostos</p>

    <div class="grid grid-cols-1 md:grid-cols-2 w-full gap-5">
      <div
        v-for="(form, i) in answeredForms"
        :key="form.id"
        class="w-full bg-stone-700 rounded-xl"
      >
        <div class="w-full h-4 bg-gradient-to-r from-purple-500 to-pink-500 rounded-t-xl"></div>

        <div class="p-8 md:flex justify-between gap-8">
          <div class="flex items-center flex-col">
            <span class="text-2xl font-semibold">
              {{ form.name }}
            </span>

            <ul class="flex flex-wrap gap-2 mt-2 text-xs leading-none">
              <li v-for="(role) in answeredFormsRoles[i]" class="p-1.5 border border-white/25 rounded">
                {{ role.name }}
              </li>
            </ul>
          </div>

          <div class="flex items-center flex-col justify-center mt-5 md:mt-0 gap-y-4">
            <span>
              {{ formsToBeAnsweredCounts[i] }}
              {{ formsToBeAnsweredCounts[i] == 1 ? 'pregunta' : 'preguntes' }}
            </span>

            <a
              :href="`/formulari/${answeredForms[i].id}`"
              class="p-2 font-medium bg-gradient-to-r from-purple-500 to-pink-500 leading-none rounded shadow hover:opacity-90"
            >
              Veure
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import Icon from '../Shared/Icon.vue'

const props = defineProps({
  'username': String,
  'email': String,
  'roles': Array,
  'formsToBeAnswered': Array,
  'answeredForms': Array,
  'formsToBeAnsweredCounts': Array,
  'answeredFormsCounts': Array,
  'formsToBeAnsweredRoles': Array,
  'answeredFormsRoles': Array
})

const username = ref(props.username)
const email = ref(props.email)
const roles = ref(props.roles)
const formsToBeAnswered = ref(props.formsToBeAnswered)
const answeredForms = ref(props.answeredForms)
const formsToBeAnsweredCounts = ref(props.formsToBeAnsweredCounts)
const answeredFormsCounts = ref(props.answeredFormsCounts)
const formsToBeAnsweredRoles = ref(props.formsToBeAnsweredRoles)
const answeredFormsRoles = ref(props.answeredFormsRoles)
</script>