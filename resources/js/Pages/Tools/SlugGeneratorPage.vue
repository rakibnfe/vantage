<template>
  <div class="space-y-6">
    <h1 class="text-4xl font-bold">Slug Generator</h1>
    <div class="bg-slate-50 dark:bg-slate-800 p-6 rounded-lg">
      <input 
        v-model="text" 
        type="text"
        placeholder="Enter text..."
        class="w-full p-4 border rounded"
        @input="generateSlug"
      />
      <div v-if="slug" class="mt-4">
        <p class="text-sm text-slate-600 dark:text-slate-400">Generated Slug:</p>
        <div class="flex gap-2 items-center">
          <code class="bg-white dark:bg-slate-900 p-3 rounded flex-1">{{ slug }}</code>
          <button @click="copy" class="px-4 py-2 bg-blue-600 text-white rounded">Copy</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const text = ref('')
const slug = ref('')

const generateSlug = () => {
  slug.value = text.value
    .toLowerCase()
    .trim()
    .replace(/[^\w\s-]/g, '')
    .replace(/\s+/g, '-')
    .replace(/-+/g, '-')
}

const copy = () => {
  navigator.clipboard.writeText(slug.value)
}
</script>
