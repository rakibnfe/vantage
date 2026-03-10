<template>
  <div class="space-y-6">
    <h1 class="text-4xl font-bold">Markdown Preview</h1>
    <div class="grid grid-cols-2 gap-6">
      <div>
        <label class="block text-sm font-medium mb-2">Markdown</label>
        <textarea 
          v-model="markdown" 
          placeholder="# Heading..."
          class="w-full h-96 p-4 border rounded font-mono text-sm"
        ></textarea>
      </div>
      <div>
        <label class="block text-sm font-medium mb-2">Preview</label>
        <div class="h-96 p-4 border rounded overflow-auto bg-white dark:bg-slate-900">
          <div v-html="preview" class="prose dark:prose-invert max-w-none"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const markdown = ref('# Hello World\n\nThis is a test.')

const preview = computed(() => {
  // Simple markdown preview (basic implementation)
  return markdown.value
    .replace(/^### (.*?)$/gm, '<h3 class="text-lg font-bold">$1</h3>')
    .replace(/^## (.*?)$/gm, '<h2 class="text-2xl font-bold">$1</h2>')
    .replace(/^# (.*?)$/gm, '<h1 class="text-3xl font-bold">$1</h1>')
    .replace(/\*\*(.*?)\*\*/gm, '<strong>$1</strong>')
    .replace(/\n/gm, '<br/>')
})
</script>
