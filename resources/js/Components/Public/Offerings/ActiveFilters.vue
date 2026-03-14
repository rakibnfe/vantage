<template>
  <div class="mb-6 p-4 bg-primary-50 dark:bg-primary-900/20 rounded-xl">
    <div class="flex items-center flex-wrap gap-3">
      <span class="text-sm font-medium text-primary-700 dark:text-primary-300">
        Active Filters:
      </span>
      
      <!-- Search Filter -->
      <span v-if="search" 
            class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-gray-800 rounded-full text-sm">
        <span class="text-gray-600 dark:text-gray-400">Search:</span>
        <span class="font-medium text-gray-900 dark:text-white">"{{ search }}"</span>
        <button @click="$emit('clear-search')" class="text-gray-400 hover:text-gray-600">
          <XMarkIcon class="w-4 h-4" />
        </button>
      </span>

      <!-- Category Filter -->
      <span v-if="category" 
            class="inline-flex items-center gap-2 px-3 py-1 bg-white dark:bg-gray-800 rounded-full text-sm">
        <span class="text-gray-600 dark:text-gray-400">Category:</span>
        <span class="font-medium text-gray-900 dark:text-white">{{ category }}</span>
        <button @click="$emit('clear-category')" class="text-gray-400 hover:text-gray-600">
          <XMarkIcon class="w-4 h-4" />
        </button>
      </span>

      <!-- Filter Count -->
      <span class="text-sm text-gray-500 dark:text-gray-400">
        {{ filterCount }} filter{{ filterCount > 1 ? 's' : '' }} applied
      </span>

      <!-- Clear All -->
      <button @click="$emit('clear-all')" 
              class="ml-auto text-sm text-primary-600 dark:text-primary-400 hover:underline">
        Clear all
      </button>
    </div>
  </div>
</template>

<script setup>
import { XMarkIcon } from '@heroicons/vue/24/outline'

defineProps({
  search: String,
  category: String,
  filterCount: Number
})

defineEmits(['clear-search', 'clear-category', 'clear-all'])
</script>