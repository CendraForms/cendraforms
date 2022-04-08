<template>
  <div class="cf-section mt-10 mb-10">
    <!-- Form > Name -->
    <input
      v-model="form.name"
      class="cf-input mt-0 w-full text-4xl font-semibold"
      placeholder="Nom del formulari"
      type="text"
      required
    />

    <!-- Form > Description -->
    <textarea
      class="cf-input mt-4 w-full text-xl"
      v-model="form.description"
      rows="1"
      placeholder="Descripció del formulari"
      required
    />
  </div>

  <!-- Section -->
  <div
    v-for="(section, sindex) in getSections"
    :key="sindex"
    class="cf-section mt-5 first-child:mt-0"
    :class="{ 'opacity-50': section.locked }"
  >
    <div class="flex items-start gap-10">
      <!-- Collapse -->
      <button @click="toggleCollapse(section)">
        <Icon
          v-if="section.collapsed"
          class="h-8"
          name="chevron-down"
        />

        <Icon
          v-else
          class="h-8"
          name="chevron-up"
        />
      </button>

      <!-- Section -->
      <div class="w-full">
        <div class="flex items-center justify-between gap-10">
          <!-- Section > Name -->
          <input
            v-model="section.name"
            class="cf-input mt-0 w-full text-2xl font-medium"
            placeholder="Títol de la secció"
            type="text"
          />

          <div class="flex items-center gap-1">
            <!-- Section > Arrow up -->
            <Icon
              v-if="!section.locked"
              class="h-6 cursor-pointer"
              :class="{ 'cursor-not-allowed opacity-25': sindex <= 0 }"
              name="arrow-up"
              :disabled="sindex == 0 || section.locked"
              @click="sectionArrows('up', sindex)"
            />

            <!-- Section > Arrow down -->
            <Icon
              v-if="!section.locked"
              class="h-6 cursor-pointer"
              :class="{ 'cursor-not-allowed opacity-25': sindex >= getSections.length - 1 }"
              name="arrow-down"
              :disabled="sindex == getSections.length - 1 || section.locked"
              @click="sectionArrows('down', sindex)"
            />

            <!-- Section > Duplicate -->
            <Icon
              class="h-6 cursor-pointer"
              name="copy"
              @click="duplicateSection(sindex, section)"
            />

            <!-- Section > Deleted -->
            <Icon
              class="ml-2 h-10 text-red-400 hover:opacity-75 cursor-pointer"
              :disabled="section.locked"
              v-if="!section.locked"
              name="x"
              @click="deleteSection(section, sindex)"
            />
          </div>
        </div>

        <!-- (new Date()).getTime() -->
        <!-- <template
          v-if="!section.collapsed"
          v-for="(question, qindex) in getQuestions(section)"
          :key="qindex"
        > -->

        <!-- v-for="(question, qindex) in getQuestions(section)" -->
        <template
          v-if="!section.collapsed"
          v-for="(question, qindex) in getQuestions(section)"
          :key="new Date().getTime()"
        >
          <Question
            :index="qindex"
            v-model:question="section.questions[qindex]"
            v-model:section="form.sections[sindex]"
          />
        </template>

        <button
          v-if="!section.collapsed && !section.locked"
          class="cf-btn-add mt-5"
          @click="newQuestion(section)"
        >
          Nova pregunta
        </button>
      </div>
    </div>
  </div>

  <div class="mx-auto mt-5 w-2/3">
    <button class="cf-btn-add" @click="newSection">
      <!-- <Icon class="h-4" name="plus" />   -->
      Nova secció
    </button>
  </div>

  <div class="cf-section mt-10">
    <span class="block text-3xl font-bold">
      Rols edició
    </span>

    <span class="block mt-1 text-lg">
      Especifica quins rols vols autoritzar per crear seccions. El rol <i>Direcció</i> sempre podrá editar qualsevol secció d'aquest formulari.
    </span>

    <div class="flex items-center gap-10 mt-5 w-full">
      <div class="flex items-center gap-4 w-1/3">
        <Combobox v-model="roles.edit.selected">
          <div class="relative w-full z-10">
            <div class="flex items-center w-full border-b-2 border-stone-200  focus:border-white">
              <ComboboxInput
                class="w-full px-0 text-lg bg-transparent border-none focus:ring-0 placeholder:text-stone-200"
                placeholder="Cercar rols..."
                @change="roles.edit.query = $event.target.value"
              />
              <ComboboxButton>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <polyline points="8 9 12 5 16 9" />
                  <polyline points="16 15 12 19 8 15" />
                </svg>
              </ComboboxButton>
            </div>
            <ComboboxOptions class="absolute w-full bg-stone-700 rounded-b-md">
              <ComboboxOption
                v-for="(role, index) in availableRoles(roles.edit.query, form.roles.edit)"
                :key="index"
                as="template"
                :value="role"
                v-slot="{ selected, active }"
              >
                <li class="flex items-center justify-between px-4 py-2 select-none" :class="{ 'bg-stone-600': active }">
                  {{ role.name }}
                  <Icon
                    v-if="selected"
                    class="h-4"
                    name="plus"
                  />
                </li>
              </ComboboxOption>
            </ComboboxOptions>
          </div>
        </Combobox>

        <button
          class="p-1 bg-stone-600 rounded"
          v-if="roles.edit.selected"
          @click="addEditRole"
        >
          <Icon class="h-6" name="plus" />
        </button>
      </div>

      <ul class="flex flex-wrap gap-2 w-2/3 leading-none">
        <li v-for="(role, index) in form.roles.edit" class="flex items-center gap-1 p-2 border border-white/25 rounded">
          {{ role.name }}

          <Icon
            class="h-4 cursor-pointer hover:opacity-75"
            name="x"
            @click="removeEditRole(index)"
          />
        </li>
      </ul>
    </div>
  </div>

  <div class="cf-section mt-10">
    <span class="block text-3xl font-bold">
      Rols resposta
    </span>

    <span class="block mt-1 text-lg">
      Especifica quins rols vols autoritzar per contestar el formulari.
    </span>
    
    <div class="flex items-center gap-10 mt-5 w-full">
      <div class="flex items-center gap-4 w-1/3">
        <Combobox v-model="roles.answer.selected">
          <div class="relative w-full">
            <div class="flex items-center w-full border-b-2 border-stone-200  focus:border-white">
              <ComboboxInput
                class="w-full px-0 text-lg bg-transparent border-none focus:ring-0 placeholder:text-stone-200"
                placeholder="Cercar rols..."
                @change="roles.answer.query = $event.target.value"
              />
              <ComboboxButton>
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <polyline points="8 9 12 5 16 9" />
                  <polyline points="16 15 12 19 8 15" />
                </svg>
              </ComboboxButton>
            </div>
            <ComboboxOptions class="absolute w-full bg-stone-700 rounded-b-md">
              <ComboboxOption
                v-for="(role, index) in availableRoles(roles.answer.query, form.roles.answer)"
                :key="index"
                as="template"
                :value="role"
                v-slot="{ selected, active }"
              >
                <li class="flex items-center justify-between px-4 py-2 select-none" :class="{ 'bg-stone-600': active }">
                  {{ role.name }}

                  <svg v-if="selected" class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l5 5l10 -10" />
                  </svg>
                </li>
              </ComboboxOption>
            </ComboboxOptions>
          </div>
        </Combobox>

        <button
          class="p-1 bg-stone-600 rounded"
          v-if="roles.answer.selected"
          @click="addEditRole">
          <svg class="h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
          </svg>
        </button>
      </div>

      <ul class="flex flex-wrap gap-2 w-2/3 leading-none">
        <li v-for="(role, index) in form.roles.answer" class="flex items-center gap-1 p-2 border border-white/25 rounded">
          {{ role.name }}
          
          <svg class="h-4 cursor-pointer hover:opacity-75" @click="removeEditRole(index)" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
          </svg>
        </li>
      </ul>
    </div>
  </div>

  <div class="flex items-start justify-between mx-auto mt-5 mb-10 w-2/3 leading-none">
    <button class="px-2 py-1 text-lg font-medium text-[#2b2b36] bg-gray-300 rounded hover:opacity-90">
      Tornar
    </button>

    <button
      class="px-2 py-1 text-lg font-medium bg-[#039ff4] rounded hover:opacity-90"
      @click="Inertia.post(`/formulari/guardar`, { form })"
    >
      Crear formulari
    </button>
  </div>

  <div v-if="$page.props.flash.message" class="alert">
    {{ $page.props.flash.message }}
  </div>
  <div v-else>
    nepes
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import lodash from 'lodash'
import { Inertia } from "@inertiajs/inertia";

// Components
import Icon from '../../Shared/Icon.vue'
import Question from '../../Shared/Question/Index.vue'

import { Combobox, ComboboxInput, ComboboxButton, ComboboxOptions, ComboboxOption } from '@headlessui/vue'
// import QuestionType from '../../Shared/Question/Type/Index.vue'

/*
 * Props
 */

const props = defineProps({
  form: Object,
  roles: Array,
})

/*
 * Data
 */

const keys = ref({
  sections: 1,
  questions: 1,
})

const form = ref(props.form || {
  id: null,
  name: '',
  description: '',
  published: false,
  anonymized: false,
  sections: [
    {
      id: null,
      name: '',
      collapsed: false,
      locked: false,
      deleted: false,
      questions: [
        {
          id: null,
          name: '',
          type: 'text',
          visible: true,
          deleted: false,
          content: {},
        },
      ],
    },
  ],
  roles: {
    edit: [
      {
        id: 0,
        name: 'Professor',
      },
    ],
    answer: [
      {
        id: 1,
        name: 'DAW',
      },

      {
        id: 2,
        name: 'SMX',
      }
    ],
  },
})

/*
 * Computed
 */


/*
 * Method
 */

const newSectionKey = () => {
  let key = keys.value.sections
  keys.value.sections++
  return key
}

const newQuestionKey = () => {
  let key = keys.value.questions
  keys.value.questions++
  return key
}

const calculateKeys = () => {
  for (let section of form.value.sections) {
    section.key = newSectionKey()

    for (let question of section.questions) {
      question.key = newQuestionKey()
    }
  }

  console.log(form.value)
}

/*
 * Sequence
 */

calculateKeys()

/*
 * Sections
 */

const getSections = computed(() => {
  return form.value.sections.filter(section => !section.deleted)
})

const toggleCollapse = (section) => {
  section.collapsed = !section.collapsed
}

// const toggleSectionCollapsed = (section) => {
//   section.collapsed = !section.collapsed
// }

const sectionArrows = (direction, index) => {
  if (direction != 'up' && direction != 'down') return
  if (direction == 'up' && index == 0) return
  if (direction == 'down' && index == getSections.length - 1) return

  const section = form.value.sections.splice(index, 1)[0]

  index = direction == 'down' ? index + 1 : index - 1

  form.value.sections.splice(index, 0, section)
}

const duplicateSection = (index, section) => {
  section = lodash.cloneDeep(section)
  section.locked = false

  form.value.sections.splice(index++, 0, section)
}

const newSection = () => {
  form.value.sections.push({
    id: null,
    name: '',
    collapsed: false,
    locked: false,
    deleted: false,
    questions: [{
      id: null,
      name: '',
      type: 'text',
      deleted: false,
      content: {}, 
    }],
  })
}

const deleteSection = (section, index) => {
  if (section.locked) return

  if (confirm('Estàs segur que vols eliminar la secció i totes les seves qüestions?')) {
    if (section.id == null) {
      form.value.sections.splice(index, 1)
      return
    }

    section.deleted = true
  }
}

/*
 * Questions
 */

const getQuestions = computed(() => {
  return (section) => section.questions.filter(question => !question.deleted)
})





const questionArrows = (direction, section, index) => {
  if (direction != 'up' && direction != 'down') return
  if (direction == 'up' && index == 0) return
  // if (direction == 'down' && index == getQuestions(section).length - 1) return

  const question = section.questions.splice(index, 1)[0]

  index = direction == 'down' ? index + 1 : index - 1

  section.questions.splice(index, 0, question)
}

const duplicateQuestion = (index, section, question) => {
  if (section.locked) return

  section.questions.splice(index++, 0, { ...question });
}

const deleteQuestion = (index, question, section) => {
  if (confirm('Estàs segur que vols eliminar aquesta qüestió?')) {
    if (question.id == null) {
      section.questions.splice(index, 1)
      return
    }

    question.deleted = true
  }
}

const newQuestion = (section) => {
  section.questions.push({
    name: '',
    type: 'text',
    deleted: false,
    content: {},
  })
}

/*
 * Roles
 */

const roles = ref({
  all: props.roles || [
    { id: 0, name: 'Direcció' },
    { id: 1, name: 'Professor' },
    { id: 2, name: 'Tutor' },
    { id: 3, name: 'Alumne' },
    { id: 4, name: 'Delegat' },
    { id: 5, name: 'DAW' },
    { id: 6, name: 'DAW - 1r' },
    { id: 7, name: 'DAW - 2n' },
    { id: 8, name: 'SMX' },
    { id: 9, name: 'SMX - 1r' },
    { id: 10, name: 'SMX - 2n' },
    { id: 11, name: 'FCT' },
  ],
  edit: {
    query: '',
    selected: '',
  },
  answer: {
    query: '',
    selected: '',
  },
})

const availableRoles = (query, mode) => {
  let allowedRoles = []

  for (const role of roles.value.all) {
    if (!mode.includes(role)) {
      allowedRoles.push(role)
    }
  }

  return query == ''
    ? allowedRoles
    : allowedRoles.filter(role => role.toLowerCase().includes(query.toLowerCase()))
}

const addEditRole = () => {
  const selected = roles.value.edit.selected

  console.log(selected)

  if (selected == '') return

  form.value.roles.edit.push(selected)

  roles.value.edit.selected = ''
  roles.value.edit.query = ''
}

const removeEditRole = (index) => {
  form.value.roles.edit.splice(index, 1)
}
</script>
