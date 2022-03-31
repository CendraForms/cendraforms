<template>
  <div class="cf-section mt-10">
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
    v-for="(section, index) in getSections"
    :key="index"
    class="cf-section mt-5"
    :class="{ 'opacity-50': section.locked }"
  >
    <div class="flex items-start gap-10">
      <!-- Collapse -->
      <button @click="toggleSectionCollapsed(section)">
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
          <!-- Section > Title -->
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
              :class="{ 'cursor-not-allowed opacity-25': index <= 0 }"
              name="arrow-up"
              :disabled="index == 0 || section.locked"
              @click="sectionArrows('up', index)"
            />

            <!-- Section > Arrow down -->
            <Icon
              v-if="!section.locked"
              class="h-6 cursor-pointer"
              :class="{ 'cursor-not-allowed opacity-25': index >= getSections.length - 1 }"
              name="arrow-down"
              :disabled="index == getSections.length - 1 || section.locked"
              @click="sectionArrows('down', index)"
            />

            <!-- Section > Duplicate -->
            <Icon
              class="h-6 cursor-pointer"
              name="copy"
              @click="duplicateSection(index, section)"
            />

            <!-- Section > Deleted -->
            <Icon
              class="ml-2 h-10 text-red-400 hover:opacity-75 cursor-pointer"
              :disabled="section.locked"
              v-if="!section.locked"
              name="x"
              @click="deleteSection(section, index)"
            />
          </div>
        </div>

        <!-- Question -->
        <div
          v-if="!section.collapsed"
          v-for="(question, index) in getQuestions(section)"
          :key="index"
          class="mt-5 p-4 bg-stone-800 rounded-md border border-white/25"
        >
          <div class="flex gap-10">
            <input
              v-model="question.title"
              class="cf-input mt-0 w-full text-lg"
              placeholder="Títol de la pregunta"
              type="text"
              :disabled="section.locked"
            />

            <select class="cf-input mt-0 w-1/4 text-lg" :disabled="section.locked">
              <option class="text-black" value="text" selected>Text</option>
              <option class="text-black" value="number">Número</option>
              <option class="text-black" value="select">Opcions</option>
            </select>

            <div v-if="!section.locked" class="flex items-center gap-1">
              <!-- Question > Arrow up -->
              <Icon
                v-if="!section.locked"
                class="h-5 cursor-pointer"
                :class="{ 'cursor-not-allowed opacity-25': index <= 0 }"
                name="arrow-up"
                :disabled="index <= 0 || section.locked"
                @click="questionArrows('up', section, index)"
              />

              <!-- Question > Arrow down -->
              <Icon
                v-if="!section.locked"
                class="h-6 cursor-pointer"
                :class="{ 'cursor-not-allowed opacity-25': index == getQuestions(section).length - 1 }"
                name="arrow-down"
                :disabled="index == getQuestions(section).length - 1 || section.locked"
                @click="questionArrows('down', section, index)"
              />

              <!-- Question > Duplicate -->
              <Icon
                class="h-5 cursor-pointer"
                name="copy"
                @click="duplicateQuestion(index, section, question)"
              />

              <!-- Deleted -->
              <Icon
                class="ml-2 h-8 text-red-400 hover:opacity-75 cursor-pointer"
                :disabled="section.locked"
                v-if="!section.locked"
                name="x"
                @click="deleteQuestion(index, question, section)"
              />
            </div>
          </div>
        </div>

        <button class="flex items-center gap-0.5 mt-5 px-2 py-1 text-sm uppercase bg-stone-600 rounded hover:opacity-90 leading-none" v-if="!section.collapsed" @click="newQuestion(section)">
          <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
          </svg>

          Pregunta
        </button>
      </div>
    </div>
  </div>

  <div class="mx-auto mt-5 p-8 w-2/3 bg-stone-800 rounded-md">
    <div class="flex items-center gap-10 w-full">
      <div class="flex items-center gap-4 w-1/3">
        <Combobox v-model="roles.edit.selected">
          <div class="relative w-full">
            <div class="flex items-center w-full border-b-2 border-stone-200  focus:border-white">
              <ComboboxInput
                class="w-full px-0 text-lg bg-transparent border-none focus:ring-0 placeholder:text-stone-200"
                placeholder="Cercar rols..."
                @change="query = $event.target.value"
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
                v-for="(role, index) in activeRoles"
                :key="index"
                as="template"
                :value="role"
                v-slot="{ selected, active }"
              >
                <li
                  class="flex items-center justify-between px-4 py-2 select-none"
                  :class="{ 'bg-stone-600': active }"
                >
                  {{ role }}

                  <svg v-if="selected" class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l5 5l10 -10" />
                  </svg>
                </li>
              </ComboboxOption>
            </ComboboxOptions>
          </div>
        </Combobox>

        <button class="p-1 bg-stone-600 rounded" @click="addEditRole">
          <svg class="h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
          </svg>
        </button>
      </div>

      <ul class="flex gap-2 w-full leading-none">
        <li v-for="role in form.roles.edit" class="flex items-center gap-1 p-2 border border-white/25 rounded">
          {{ role }}

          <svg class="h-4 hover:opacity-75" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <line x1="18" y1="6" x2="6" y2="18" />
            <line x1="6" y1="6" x2="18" y2="18" />
          </svg>
        </li>
      </ul>
    </div>
  </div>

  <div class="flex items-start justify-between mx-auto mt-5 mb-10 w-2/3 leading-none">
    <button class="flex items-center gap-0.5 px-2 py-1 text-sm uppercase bg-stone-600 rounded hover:opacity-90 leading-none" @click="newSection">
      <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <line x1="12" y1="5" x2="12" y2="19" />
        <line x1="5" y1="12" x2="19" y2="12" />
      </svg>

      Secció
    </button>

    <button class="px-2 py-1 text-lg font-medium bg-emerald-600 rounded hover:opacity-90">
      Crear formulari
    </button>
  </div>

</template>

<script setup>
import { ref, computed } from 'vue'
import lodash from 'lodash'
// import QuestionType from '../../Shared/Question/Index'

// Components
import Icon from '../../Shared/Icon.vue'
import { Combobox, ComboboxInput, ComboboxButton, ComboboxOptions, ComboboxOption } from '@headlessui/vue'

const form = ref({
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
    edit: [ 'Direcció', 'Professor' ],
    answer: [ 'Alumne' ],
  },
})

/*
 * Sections
 */

const getSections = computed(() => {
  return form.value.sections.filter(section => !section.deleted)
})

const toggleSectionCollapsed = (section) => {
  section.collapsed = !section.collapsed
}

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

const getQuestions = (section) => {
  return section.questions.filter(question => !question.deleted)
}

const questionArrows = (direction, section, index) => {
  if (direction != 'up' && direction != 'down') return
  if (direction == 'up' && index == 0) return
  if (direction == 'down' && index == getQuestions(section).length - 1) return

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

const activeRoles = [
  'Direcció',
  'Professor',
  'Alumne',
  'DAW',
  'SMX',
]

const roles = ref({
  edit: {
    query: '',
    selected: '',
  },
  answer: {
    query: '',
    selected: '',
  },
})

const addEditRole = () => {
  const selected = roles.value.edit.selected
  form.value.roles.edit.push(selected)

  roles.value.edit.selected = ''
}
</script>
