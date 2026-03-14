<!-- resources/js/Components/Public/Home/OfferingsOverview.vue -->
<template>
  <section class="py-24 bg-white dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Header -->
      <div class="text-center mb-12">
        <span class="text-sm font-semibold text-primary-600 dark:text-primary-400 uppercase tracking-wider">Offerings</span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mt-2 mb-4">
          What I <span class="text-primary-600 dark:text-primary-400">Offer</span>
        </h2>
      </div>

      <!-- Loading -->
      <div v-if="loading" class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div v-for="n in 4" :key="n" class="bg-gray-100 dark:bg-gray-800 h-48 rounded-2xl animate-pulse"></div>
      </div>

      <!-- Offerings -->
      <div v-else-if="offerings.length" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div v-for="offering in offerings" :key="offering.id" 
             class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-6 hover:shadow-xl transition-all hover:-translate-y-1">
          <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mb-4">
            <component :is="getIcon(offering.icon)" class="w-6 h-6 text-primary-600 dark:text-primary-400" />
          </div>
          <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">{{ offering.title }}</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ offering.description }}</p>
          <router-link :to="`/offerings/${offering.slug}`" class="text-primary-600 dark:text-primary-400 text-sm font-medium">
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

const offerings = ref([])
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

const fetchOfferings = async () => {
  try {
    const response = await axios.get('/api/v1/offerings', {
      params: {
        published: true,
        per_page: 4,
        _: Date.now()
      }
    })

    if (response.data?.data) {
      offerings.value = response.data.data.map(offering => ({
        id: offering.id,
        title: offering.title,
        slug: offering.slug,
        description: offering.tagline || offering.overview || 'No description available',
        icon: offering.icon || 'default'
      }))
    }
  } catch (error) {
    console.error('Failed to fetch offerings:', error)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchOfferings()
})
</script>