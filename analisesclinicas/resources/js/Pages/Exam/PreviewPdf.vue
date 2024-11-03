<script setup>
import { ref } from 'vue'
import axios from 'axios'

const exam = ref({})
const components = ref([])
const info = ref({})
const conclusion = ref('')

const saveConclusion = async () => {
  await axios.post(`/exam/${exam.value.id}/save-conclusion`, {
    conclusion: conclusion.value,
  })
}
</script>

<template>
  <div>
    <h1>Laudo Médico</h1>
    <div v-html="exam.html"></div>
    <form @submit.prevent="saveConclusion">
      <textarea v-model="conclusion"></textarea>
      <button type="submit">Salvar Conclusão</button>
    </form>
  </div>
</template>