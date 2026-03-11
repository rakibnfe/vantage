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
import axios from 'axios'
import {
  CodeBracketIcon,
  DevicePhoneMobileIcon,
  PaintBrushIcon,
  ChartBarIcon,
  CloudIcon,
  ShoppingCartIcon,
  CogIcon,
  WrenchIcon,
  RocketLaunchIcon,
  ShieldCheckIcon,
  CpuChipIcon,
  DocumentTextIcon
} from '@heroicons/vue/24/outline'

const services = ref([])
const loading = ref(true)

const iconMap = {
  'code': CodeBracketIcon,
  'code-bracket': CodeBracketIcon,
  'mobile': DevicePhoneMobileIcon,
  'design': PaintBrushIcon,
  'consulting': ChartBarIcon,
  'cloud': CloudIcon,
  'cart': ShoppingCartIcon,
  'cog': CogIcon,
  'wrench': WrenchIcon,
  'rocket': RocketLaunchIcon,
  'security': ShieldCheckIcon,
  'chip': CpuChipIcon,
  'document': DocumentTextIcon,
  'default': CodeBracketIcon
}

const getIcon = (icon) => {
  return iconMap[icon] || iconMap.default
}

const fetchServices = async () => {
  try {
    const response = await axios.get('/api/v1/services', {
      params: {
        published: true,
        per_page: 4,
        _: Date.now()
      }
    })

    if (response.data?.data) {
      services.value = response.data.data.map(service => ({
        id: service.id,
        title: service.title,
        slug: service.slug,
        description: service.tagline || service.overview || 'No description available',
        icon: service.icon || 'default'
      }))
    }
  } catch (error) {
    console.error('Failed to fetch services:', error)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchServices()
})
</script>