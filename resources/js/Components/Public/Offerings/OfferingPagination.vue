<template>
  <div class="flex justify-center mt-12">
    <div class="flex items-center gap-2">
      <!-- Previous Button -->
      <button 
        @click="$emit('update:page', page - 1)"
        :disabled="page === 1"
        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
      >
        <ChevronLeftIcon class="w-5 h-5" />
      </button>
      
      <!-- Page Numbers -->
      <button
        v-for="p in visiblePages"
        :key="p"
        @click="$emit('update:page', p)"
        class="min-w-10 h-10 px-3 rounded-lg font-medium transition"
        :class="page === p 
          ? 'bg-primary-600 text-white' 
          : p === '...'
            ? 'cursor-default'
            : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300'"
        :disabled="p === '...'"
      >
        {{ p }}
      </button>
      
      <!-- Next Button -->
      <button 
        @click="$emit('update:page', page + 1)"
        :disabled="page === totalPages"
        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
      >
        <ChevronRightIcon class="w-5 h-5" />
      </button>
    </div>
  </div>
</template>

<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline'

defineProps({
  page: Number,
  totalPages: Number,
  visiblePages: Array
})

defineEmits(['update:page'])
</script>