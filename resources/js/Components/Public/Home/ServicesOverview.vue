<!-- resources/js/Components/Public/Home/ServicesOverview.vue -->
<template>
  <section class="py-24 bg-white dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="text-center mb-12">
        <span class="text-sm font-semibold text-primary-600 dark:text-primary-400 uppercase tracking-wider">SERVICES</span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mt-2 mb-4">
          What I <span class="text-primary-600 dark:text-primary-400">Offer</span>
        </h2>
      </div>

      <!-- Loading -->
      <div v-if="loading" class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div v-for="n in 4" :key="n" class="bg-gray-100 dark:bg-gray-800 h-48 rounded-2xl animate-pulse"></div>
      </div>

      <!-- Services -->
      <div v-else-if="services.length" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div v-for="service in services" :key="service.id" 
             class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-6 hover:shadow-xl transition-all hover:-translate-y-1">
          <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mb-4">
            <component :is="getIcon(service.icon)" class="w-6 h-6 text-primary-600 dark:text-primary-400" />
          </div>
          <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ service.title }}</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ service.description }}</p>
          <router-link :to="`/services/${service.slug}`" class="text-primary-600 dark:text-primary-400 text-sm font-medium">
            Learn more →
          </router-link>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { CodeBracketIcon, DevicePhoneMobileIcon, PaintBrushIcon, ChartBarIcon } from '@heroicons/vue/24/outline'

const services = ref([])
const loading = ref(true)

const sampleServices = [
  { id: 1, title: 'Web Development', slug: 'web-development', description: 'Custom web applications with Laravel & Vue.js', icon: 'code' },
  { id: 2, title: 'Mobile Apps', slug: 'mobile-apps', description: 'Cross-platform iOS & Android apps', icon: 'mobile' },
  { id: 3, title: 'UI/UX Design', slug: 'ui-ux-design', description: 'Beautiful user-centered design', icon: 'design' },
  { id: 4, title: 'Consulting', slug: 'consulting', description: 'Technical guidance & architecture', icon: 'consulting' }
]

const getIcon = (icon) => {
  const icons = {
    'code': CodeBracketIcon,
    'mobile': DevicePhoneMobileIcon,
    'design': PaintBrushIcon,
    'consulting': ChartBarIcon
  }
  return icons[icon] || CodeBracketIcon
}

onMounted(() => {
  // Use sample data immediately
  services.value = sampleServices
  loading.value = false
})
</script>