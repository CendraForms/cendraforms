<template>
  <div class="mx-auto my-10 p-10 w-4/5 bg-stone-800 rounded-xl">
    <span class="mb-5 block text-4xl font-bold uppercase">
      Form #{{ form.id }}
    </span>

    <input type="text" :value="form.title" class="w-full bg-transparent rounded-xl">

    <div v-for="section in form.sections" :key="section.id" class="my-5 p-10 bg-stone-700 rounded-xl" :class="{ 'opacity-50': section.locked }">
      <div class="mb-5 flex justify-between">
        <span class="text-2xl font-bold uppercase">
          Section #{{ section.id }}
        </span>

        <div>
          <input class="appearance-none w-9 -ml-10 rounded-full h-5 align-top bg-white bg-no-repeat bg-contain focus:outline-none cursor-pointer shadow-sm" type="checkbox" role="switch" :value="section.visible" :disabled="section.locked">
          <span class="ml-2">
            Visible
          </span>
        </div>
      </div>

      <input type="text" :value="section.title" :disabled="section.locked" class="mb-5 block w-full bg-transparent rounded-xl">

      <div class="p-5 bg-stone-600 rounded-xl">
        <span class="block mb-5">
          Questions
        </span>

        <div v-for="question in section.questions" :key="question.id">
          <input type="text" :value="question.title" :disabled="section.locked" class="mb-5 w-full bg-transparent rounded-xl">

          <QuestionType :type="question.type" :content="question.content" />
        </div>

        <button v-if="!section.locked" @click="createQuestion(section)" class="p-1 bg-stone-500 text-sm font-medium uppercase leading-none rounded hover:opacity-75">
          New question
        </button>
      </div>
    </div>

    <button @click="createSection" class="p-1 bg-stone-500 text-sm font-medium uppercase leading-none rounded hover:opacity-75">
      New section
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import QuestionType from '../../Shared/Question/Index'

const form = ref({
  id: 1,
  title: 'Avaluació DAW2 curs 2021-22',
  sections: [
    {
      id: 1,
      title: 'DAW2_MP_02 - Bases de dades',
      questions: [
        {
          id: null,
          title: 'Què és el que més t\'ha agradat?',
          type: 'text',
        },

        {
          id: 2,
          title: 'Què és el que menys t\'ha agradat?',
          content: {
            min: 0,
            max: 10,
          },
          type: 'number',
        },
      ],
      locked: false,
      visible: false,
    },

    {
      id: 2,
      title: 'DAW2_MP_03 - Programació',
      questions: [
        {
          id: null,
          title: 'Què és el que més t\'ha agradat?',
        },

        {
          id: 2,
          title: 'Què és el que menys t\'ha agradat?',
        },
      ],
      locked: true,
      visible: false,
    },

    {
      id: 3,
      title: 'DAW2_MP_06 - Desenvolupament web en entorn de client',
      questions: [
        {
          id: null,
          title: 'Què és el que més t\'ha agradat?',
        },

        {
          id: 2,
          title: 'Què és el que menys t\'ha agradat?',
        },

        {
          id: 3,
          title: 'Quin àmbit prefereixes?',
          type: 'switch',
          content: {
            left: {
              text: 'frontend',
              selected: false,
              defaultVal: false
            },
            right: {
              text: 'backend',
              selected: false,
              defaultVal: true
            },
          },
        },

        {
          id: 4,
          title: 'Fruita, verdura o xocolata?',
          type: 'radio',
          content: {
            options: [
              {
                text: 'fruita',
                selected: false,
              },

              {
                text: 'verdura',
                selected: false,
              },

              {
                text: 'xocolata',
                selected: false,
              }
            ],
          }
        }
      ],
      locked: false,
      visible: true,
    },
  ]

})

const createSection = () => {
  form.sections.value.push({
    id: sections.value.length,
    title: '',
    questions: [
      {
        id: null,
        title: '',
      }
    ],
  })
}

const createQuestion = (section) => {
  section.questions.push({
    id: null,
    title: '',
  });
}
</script>
