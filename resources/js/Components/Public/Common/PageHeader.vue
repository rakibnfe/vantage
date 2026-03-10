<!-- resources/js/Components/Public/Common/PageHeader.vue -->
<template>
  <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <!-- Breadcrumb -->
      <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-4">
        <router-link to="/" class="hover:text-primary-600 dark:hover:text-primary-400 transition">
          Home
        </router-link>
        <ChevronRightIcon class="w-4 h-4" />
        <span class="text-gray-900 dark:text-white font-medium">{{ title }}</span>
      </nav>

      <!-- Title and Count -->
      <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
        <div>
          <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-2">
            {{ title }}
            <span v-if="highlight" class="text-primary-600 dark:text-primary-400"> {{ highlight }}</span>
          </h1>
          <p v-if="subtitle" class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl">
            {{ subtitle }}
          </p>
        </div>
        
        <!-- Count Badge -->
        <div v-if="count !== undefined" 
             class="flex items-center gap-2 text-sm bg-gray-100 dark:bg-gray-700 px-4 py-2 rounded-full">
          <component :is="icon" class="w-4 h-4 text-primary-600 dark:text-primary-400" />
          <span class="text-gray-700 dark:text-gray-300 font-medium">
            {{ count }} {{ countLabel }}
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ChevronRightIcon } from '@heroicons/vue/24/outline'
import { BriefcaseIcon } from '@heroicons/vue/24/outline'

defineProps({
  title: String,
  highlight: String,
  subtitle: String,
  count: [Number, String],
  countLabel: String,
  icon: {
    type: Object,
    default: BriefcaseIcon
  }
})
</script>