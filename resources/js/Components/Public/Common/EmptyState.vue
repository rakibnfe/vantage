<!-- resources/js/Components/Public/Common/EmptyState.vue -->
<template>
  <div class="text-center py-16">
    <div class="w-20 h-20 mx-auto bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4">
      <MagnifyingGlassIcon class="w-10 h-10 text-gray-400" />
    </div>
    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">{{ title }}</h3>
    <p class="text-gray-600 dark:text-gray-400 mb-6">{{ message }}</p>
    <button 
      @click="$emit('clear')"
      class="px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition"
    >
      Clear Filters
    </button>
  </div>
</template>

<script setup>
import { MagnifyingGlassIcon } from '@heroicons/vue/24/outline'

defineProps({
  title: {
    type: String,
    default: 'No results found'
  },
  message: {
    type: String,
    default: 'Try adjusting your search or filters'
  }
})

defineEmits(['clear'])
</script>