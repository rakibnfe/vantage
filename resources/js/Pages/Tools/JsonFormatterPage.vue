<template>
  <div class="space-y-6">
    <h1 class="text-4xl font-bold">JSON Formatter</h1>
    <div class="bg-slate-50 dark:bg-slate-800 p-6 rounded-lg">
      <textarea 
        v-model="input" 
        placeholder="Paste JSON here..."
        class="w-full h-48 p-4 border rounded font-mono text-sm"
      ></textarea>
      <button @click="format" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">
        Format
      </button>
      <div v-if="output" class="mt-4">
        <pre class="bg-white dark:bg-slate-900 p-4 rounded font-mono text-sm overflow-auto">{{ output }}</pre>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const input = ref('')
const output = ref('')

const format = () => {
  try {
    const parsed = JSON.parse(input.value)
    output.value = JSON.stringify(parsed, null, 2)
  } catch (e) {
    output.value = 'Invalid JSON: ' + e.message
  }
}
</script>
