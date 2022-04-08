<template>
  <div class="cf-section mt-10 mb-10">
    <!-- Form > Name -->
    <span
      v-text="form.name"
      class="mt-0 text-4xl font-semibold"
    />

    <!-- <input
      v-model="form.name"
      class="cf-input mt-0 w-full text-4xl font-semibold"
      placeholder="Nom del formulari"
      type="text"
      required
    /> -->

    <p
      v-text="form.description"
      class="mt-4 w-full text-xl"
    />

    <!-- Form > Description -->
    <!-- <textarea
      class="cf-input mt-4 w-full text-xl"
      v-model="form.description"
      rows="1"
      placeholder="Descripció del formulari"
      required
    /> -->
  </div>

  <!-- Section -->
  <div
    v-for="(section, sindex) in getSections"
    :key="sindex"
    class="cf-section mt-5 first-child:mt-0"
  >
    <div class="flex items-start gap-10">
      <!-- Section -->
      <div class="w-full">
        <div class="flex items-center justify-between gap-10">
          <!-- Section > Name -->
          <span
            v-text="section.name"
            class="mt-0 text-2xl font-medium"
          />
          
          <!-- <input
            v-model="section.name"
            class="cf-input mt-0 w-full text-2xl font-medium"
            placeholder="Títol de la secció"
            type="text"
          /> -->
        </div>

        <div
          v-for="(question, qindex) in section.questions"
          :key="qindex"
          class="mt-5 p-4 bg-[#393947] rounded-md border border-white/25"
        >
          <div>
            <!-- Name -->
            <span
              v-text="question.name"
              class="mt-0 w-full text-xl"
            />

            <input
              class="cf-input mt-2 w-full text-lg"
              type="text"
              placeholder="Resposta..."
            />
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="flex items-start justify-between mx-auto mt-5 mb-10 w-2/3 leading-none">
    <button class="px-2 py-1 text-lg font-medium text-[#2b2b36] bg-gray-300 rounded hover:opacity-90" @click="Inertia.get('/')">
      Cancel·lar
    </button>

    <button class="px-2 py-1 text-lg font-medium bg-[#039ff4] rounded hover:opacity-90">
      Contestar
    </button>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Inertia } from '@inertiajs/inertia'
// import lodash from 'lodash'

// Components
import Icon from '../../Shared/Icon.vue'
import Question from '../../Shared/Question/Index.vue'

// import { Combobox, ComboboxInput, ComboboxButton, ComboboxOptions, ComboboxOption } from '@headlessui/vue'
// // import QuestionType from '../../Shared/Question/Type/Index.vue'

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


// /*
//  * Method
//  */

// const newSectionKey = () => {
//   let key = keys.value.sections
//   keys.value.sections++
//   return key
// }

// const newQuestionKey = () => {
//   let key = keys.value.questions
//   keys.value.questions++
//   return key
// }

// const calculateKeys = () => {
//   for (let section of form.value.sections) {
//     section.key = newSectionKey()

//     for (let question of section.questions) {
//       question.key = newQuestionKey()
//     }
//   }

//   console.log(form.value)
// }

// /*
//  * Sequence
//  */

// calculateKeys()

// /*
//  * Sections
//  */

const getSections = computed(() => {
  return form.value.sections.filter(section => !section.deleted)
})

// const toggleCollapse = (section) => {
//   section.collapsed = !section.collapsed
// }

// // const toggleSectionCollapsed = (section) => {
// //   section.collapsed = !section.collapsed
// // }

// const sectionArrows = (direction, index) => {
//   if (direction != 'up' && direction != 'down') return
//   if (direction == 'up' && index == 0) return
//   if (direction == 'down' && index == getSections.length - 1) return

//   const section = form.value.sections.splice(index, 1)[0]

//   index = direction == 'down' ? index + 1 : index - 1

//   form.value.sections.splice(index, 0, section)
// }

// const duplicateSection = (index, section) => {
//   section = lodash.cloneDeep(section)
//   section.locked = false

//   form.value.sections.splice(index++, 0, section)
// }

// const newSection = () => {
//   form.value.sections.push({
//     id: null,
//     name: '',
//     collapsed: false,
//     locked: false,
//     deleted: false,
//     questions: [{
//       id: null,
//       name: '',
//       type: 'text',
//       deleted: false,
//       content: {}, 
//     }],
//   })
// }

// const deleteSection = (section, index) => {
//   if (section.locked) return

//   if (confirm('Estàs segur que vols eliminar la secció i totes les seves qüestions?')) {
//     if (section.id == null) {
//       form.value.sections.splice(index, 1)
//       return
//     }

//     section.deleted = true
//   }
// }

// /*
//  * Questions
//  */

// const getQuestions = computed(() => {
//   return (section) => section.questions.filter(question => !question.deleted)
// })





// const questionArrows = (direction, section, index) => {
//   if (direction != 'up' && direction != 'down') return
//   if (direction == 'up' && index == 0) return
//   // if (direction == 'down' && index == getQuestions(section).length - 1) return

//   const question = section.questions.splice(index, 1)[0]

//   index = direction == 'down' ? index + 1 : index - 1

//   section.questions.splice(index, 0, question)
// }

// const duplicateQuestion = (index, section, question) => {
//   if (section.locked) return

//   section.questions.splice(index++, 0, { ...question });
// }

// const deleteQuestion = (index, question, section) => {
//   if (confirm('Estàs segur que vols eliminar aquesta qüestió?')) {
//     if (question.id == null) {
//       section.questions.splice(index, 1)
//       return
//     }

//     question.deleted = true
//   }
// }

// const newQuestion = (section) => {
//   section.questions.push({
//     name: '',
//     type: 'text',
//     deleted: false,
//     content: {},
//   })
// }

// /*
//  * Roles
//  */

// const roles = ref({
//   all: props.roles || [
//     { id: 0, name: 'Direcció' },
//     { id: 1, name: 'Professor' },
//     { id: 2, name: 'Tutor' },
//     { id: 3, name: 'Alumne' },
//     { id: 4, name: 'Delegat' },
//     { id: 5, name: 'DAW' },
//     { id: 6, name: 'DAW - 1r' },
//     { id: 7, name: 'DAW - 2n' },
//     { id: 8, name: 'SMX' },
//     { id: 9, name: 'SMX - 1r' },
//     { id: 10, name: 'SMX - 2n' },
//     { id: 11, name: 'FCT' },
//   ],
//   edit: {
//     query: '',
//     selected: '',
//   },
//   answer: {
//     query: '',
//     selected: '',
//   },
// })

// const availableRoles = (query, mode) => {
//   let allowedRoles = []

//   for (const role of roles.value.all) {
//     if (!mode.includes(role)) {
//       allowedRoles.push(role)
//     }
//   }

//   return query == ''
//     ? allowedRoles
//     : allowedRoles.filter(role => role.toLowerCase().includes(query.toLowerCase()))
// }

// const addEditRole = () => {
//   const selected = roles.value.edit.selected

//   console.log(selected)

//   if (selected == '') return

//   form.value.roles.edit.push(selected)

//   roles.value.edit.selected = ''
//   roles.value.edit.query = ''
// }

// const removeEditRole = (index) => {
//   form.value.roles.edit.splice(index, 1)
// }
</script>
