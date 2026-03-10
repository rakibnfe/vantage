<!-- resources/js/Components/Public/Home/ToolsGrid.vue -->
<template>
  <section class="py-24 bg-white dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Section Header -->
      <div class="text-center mb-16">
        <span class="text-sm font-semibold text-primary-600 dark:text-primary-400 uppercase tracking-widest">
          FREE TOOLS
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mt-4">
          Developer <span class="text-primary-600 dark:text-primary-400">Utilities</span>
        </h2>
      </div>

      <!-- Tools Grid -->
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        <div v-for="tool in tools" 
             :key="tool.id"
             class="group">
          
          <router-link :to="`/tools/${tool.slug}`" 
                       class="block bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-6 text-center hover:bg-white dark:hover:bg-gray-800 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
            
            <!-- Icon -->
            <div class="w-16 h-16 mx-auto bg-primary-100 dark:bg-primary-900/30 rounded-2xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
              <component :is="getIcon(tool.icon)" class="w-8 h-8 text-primary-600 dark:text-primary-400" />
            </div>

            <!-- Name -->
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
              {{ tool.name }}
            </h3>
            
            <!-- Description -->
            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
              {{ tool.description }}
            </p>
          </router-link>
        </div>
      </div>

      <!-- View All Button -->
      <div class="text-center mt-12">
        <router-link to="/tools" 
                     class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 dark:bg-gray-800 text-white rounded-xl hover:bg-gray-800 dark:hover:bg-gray-700 transition-all">
          Explore All Tools
          <ArrowRightIcon class="w-4 h-4" />
        </router-link>
      </div>
    </div>
  </section>
</template>

<script setup>
import { 
  CodeBracketIcon,
  CloudArrowUpIcon,
  LinkIcon,
  DocumentTextIcon,
  AdjustmentsHorizontalIcon,
  ArrowRightIcon 
} from '@heroicons/vue/24/outline'

const tools = [
  { id: 1, name: 'JSON Formatter', slug: 'json-formatter', description: 'Format & validate JSON', icon: 'code' },
  { id: 2, name: 'API Viewer', slug: 'api-viewer', description: 'Test & explore APIs', icon: 'api' },
  { id: 3, name: 'Slug Generator', slug: 'slug-generator', description: 'Create URL-friendly slugs', icon: 'link' },
  { id: 4, name: 'Markdown Preview', slug: 'markdown-preview', description: 'Live markdown editor', icon: 'markdown' },
  { id: 5, name: 'Text Utilities', slug: 'text-utilities', description: 'Count & transform text', icon: 'text' }
]

const getIcon = (icon) => {
  const icons = {
    'code': CodeBracketIcon,
    'api': CloudArrowUpIcon,
    'link': LinkIcon,
    'markdown': DocumentTextIcon,
    'text': AdjustmentsHorizontalIcon
  }
  return icons[icon] || CodeBracketIcon
}
</script>