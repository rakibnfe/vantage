<template>
  <div class="space-y-8">
    <h1 class="text-4xl font-bold">Text Utilities</h1>
    
    <div class="bg-slate-50 dark:bg-slate-800 p-6 rounded-lg">
      <h2 class="text-2xl font-bold mb-4">Character/Word Counter</h2>
      <textarea 
        v-model="text" 
        placeholder="Enter text..."
        class="w-full h-32 p-4 border rounded"
      ></textarea>
      <div class="mt-4 grid grid-cols-2 gap-4">
        <div class="bg-white dark:bg-slate-900 p-4 rounded">
          <p class="text-sm text-slate-600">Characters</p>
          <p class="text-2xl font-bold">{{ text.length }}</p>
        </div>
        <div class="bg-white dark:bg-slate-900 p-4 rounded">
          <p class="text-sm text-slate-600">Words</p>
          <p class="text-2xl font-bold">{{ text.trim().split(/\s+/).filter(w => w).length }}</p>
        </div>
      </div>
    </div>

    <div class="bg-slate-50 dark:bg-slate-800 p-6 rounded-lg">
      <h2 class="text-2xl font-bold mb-4">Case Converter</h2>
      <div class="space-y-2">
        <button @click="() => converted = text.toUpperCase()" class="w-full p-2 bg-blue-600 text-white rounded">UPPERCASE</button>
        <button @click="() => converted = text.toLowerCase()" class="w-full p-2 bg-blue-600 text-white rounded">lowercase</button>
        <button @click="toTitleCase" class="w-full p-2 bg-blue-600 text-white rounded">Title Case</button>
      </div>
      <div v-if="converted" class="mt-4">
        <textarea :value="converted" readonly class="w-full h-24 p-4 border rounded font-mono text-sm"></textarea>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const text = ref('')
const converted = ref('')

const toTitleCase = () => {
  converted.value = text.value
    .split(' ')
    .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
    .join(' ')
}
</script>
