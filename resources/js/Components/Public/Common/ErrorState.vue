<!-- resources/js/Components/Public/Common/ErrorState.vue -->
<template>
  <div class="text-center py-16">
    <div class="w-20 h-20 mx-auto bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mb-4">
      <ExclamationTriangleIcon class="w-10 h-10 text-red-600 dark:text-red-400" />
    </div>
    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Oops! Something went wrong</h3>
    <p class="text-gray-600 dark:text-gray-400 mb-6">{{ message }}</p>
    <button 
      @click="$emit('retry')"
      class="px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition"
    >
      Try Again
    </button>
  </div>
</template>

<script setup>
import { ExclamationTriangleIcon } from '@heroicons/vue/24/outline'

defineProps({
  message: {
    type: String,
    default: 'Failed to load data. Please try again.'
  }
})

defineEmits(['retry'])
</script>