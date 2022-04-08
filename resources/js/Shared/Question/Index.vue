<template>
  <div class="mt-5 p-4 bg-[#393947] rounded-md border border-white/25">
    <div class="flex gap-10">
      <!-- Name -->
      <input
        v-model="question.name"
        class="cf-input mt-0 w-full text-lg"
        type="text"
        placeholder="Títol de la pregunta"
        :disabled="section.locked"
      />

      <!-- Type -->
      <select
        v-model="question.type"
        class="cf-input mt-0 w-1/4 text-lg"
        :disabled="section.locked"
        @input="clearQuestionContent"
      >
        <option class="text-black" value="text" selected>Text</option>
        <option class="text-black" value="number">Número</option>
        <option class="text-black" value="select" disabled>Opcions</option>
        <option class="text-black" value="switch" disabled>Commutador</option>
      </select>

      <div v-if="!section.locked" class="flex items-center gap-1">
        <!-- Arrow up -->
        <Icon
          class="h-5 cursor-pointer"
          :class="{ 'cursor-not-allowed opacity-25': index <= 0 }"
          name="arrow-up"
          :disabled="true"
          @click="toggleArrows('up')"
        />
        <!-- :disabled="index <= 0" -->

        <!-- Arrow down -->
        <Icon
          class="h-6 cursor-pointer"
          :class="{ 'cursor-not-allowed opacity-25': index == lastQuestionIndex }"
          name="arrow-down"
          :disabled="true"
          @click="toggleArrows('down')"
        />
        <!-- :disabled="index == lastQuestionIndex" -->

        <!-- Duplicate -->
        <Icon
          class="h-5 cursor-pointer"
          name="copy"
          @click="duplicateQuestion"
        />

        <!-- Delete -->
        <Icon
          class="ml-2 h-8 text-red-400 hover:opacity-75 cursor-pointer"
          name="x"
          @click="deleteQuestion"
        />
      </div>
    </div>

    <QuestionType :type="question.type" v-model:content="question.content" />
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import lodash from 'lodash'

// Components
import Icon from '../Icon.vue'
import QuestionType from './Type/Index.vue'

const props = defineProps({
  index: Number,
  question: Object,
  section: Object,
})

const section = ref(props.section)
const question = ref(props.question)

const lastQuestionIndex = computed(() => {
  return section.value.questions.filter(q => !q.deleted).length - 1
})

const clearQuestionContent = () => {
  setTimeout(() => {
    question.value.content = {}
  }, 5000)
}

// const getLastQuestionIndex = () => {
//   return section.value.questions.filter(question => !question.deleted).length - 1
// }

// const toggleArrows = (direction) => {
//   if (direction != 'up' && direction != 'down') return
//   if (direction == 'up' && props.index == 0) return
//   if (direction == 'down' && props.index == getLastQuestionIndex) return

//   const questionObject = section.value.questions.splice(props.index, 1)[0]

//   const index = direction == 'down'
//     ? props.index + 1
//     : props.index - 1

//   section.value.questions.splice(index, 0, questionObject)
// }

const duplicateQuestion = () => {
  if (section.value.locked) return

  const position = props.index + 1
  const duplicated = lodash.cloneDeep(question.value)
  section.value.questions.push(duplicated)
}

const deleteQuestion = () => {
  if (confirm('Estàs segur que vols eliminar aquesta pregunta?')) {
    if (question.value.id == null) {
      section.value.questions.splice(props.index, 1)
      return
    }

    question.value.deleted = true
  }
}
</script>
