<template>
  <router-link :to="`/work/${project.slug}`" class="block group">
    <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
      <!-- Image -->
      <div class="relative h-48 overflow-hidden bg-gray-100 dark:bg-gray-700">
        <img 
          :src="project.featured_image" 
          :alt="project.title"
          class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
          loading="lazy"
          @error="handleImageError"
        />
        
        <!-- Featured Badge -->
        <div v-if="project.is_featured" 
             class="absolute top-4 right-4 px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full shadow-lg">
          Featured
        </div>
      </div>

      <!-- Content -->
      <div class="p-6">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">
          {{ project.title }}
        </h3>
        
        <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
          {{ project.description }}
        </p>

        <!-- Technologies -->
        <div class="flex flex-wrap gap-2 mb-4">
          <span v-for="tech in project.technologies?.slice(0, 3)" :key="tech"
                class="px-3 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full">
            {{ tech }}
          </span>
          <span v-if="project.technologies?.length > 3" 
                class="px-3 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-500 rounded-full">
            +{{ project.technologies.length - 3 }}
          </span>
        </div>

        <!-- Footer -->
        <div class="flex items-center justify-between">
          <span class="text-sm text-gray-500 dark:text-gray-400">
            {{ project.year }}
          </span>
          <span class="inline-flex items-center text-primary-600 dark:text-primary-400 font-medium text-sm">
            View Project
            <ArrowRightIcon class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" />
          </span>
        </div>
      </div>
    </div>
  </router-link>
</template>

<script setup>
import { ArrowRightIcon } from '@heroicons/vue/24/outline'

const props = defineProps({
  project: {
    type: Object,
    required: true
  }
})

const handleImageError = (e) => {
  e.target.src = 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'
}
</script>

<style scoped>
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>