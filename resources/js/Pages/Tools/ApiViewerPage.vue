<template>
  <div class="space-y-6">
    <h1 class="text-4xl font-bold">API Response Viewer</h1>
    <div class="bg-slate-50 dark:bg-slate-800 p-6 rounded-lg">
      <textarea 
        v-model="input" 
        placeholder="Paste API response..."
        class="w-full h-48 p-4 border rounded font-mono text-sm"
      ></textarea>
      <button @click="parse" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded">
        Parse Response
      </button>
      <div v-if="parsed" class="mt-4">
        <pre class="bg-white dark:bg-slate-900 p-4 rounded font-mono text-sm overflow-auto">{{ parsed }}</pre>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const input = ref('')
const parsed = ref('')

const parse = () => {
  try {
    const data = JSON.parse(input.value)
    parsed.value = JSON.stringify(data, null, 2)
  } catch (e) {
    parsed.value = 'Error: ' + e.message
  }
}
</script>
