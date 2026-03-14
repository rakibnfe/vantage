<!-- resources/js/Pages/Process/Index.vue -->
<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-20">
    <div class="max-w-7xl mx-auto px-4">
      <h1 class="text-4xl font-bold text-center mb-4">Our Process</h1>
      <p class="text-xl text-center text-gray-600 dark:text-gray-400 mb-12">
        How we bring your ideas to life
      </p>

      <!-- Offering Filter -->
      <div class="mb-12 flex flex-wrap gap-2 justify-center">
        <button 
          @click="selectedOffering = null"
          class="px-4 py-2 rounded-full transition"
          :class="!selectedOffering ? 'bg-primary-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
        >
          All Processes
        </button>
        <button 
          v-for="offering in offerings" 
          :key="offering.id"
          @click="selectedOffering = offering.id"
          class="px-4 py-2 rounded-full transition"
          :class="selectedOffering === offering.id ? 'bg-primary-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
        >
          {{ offering.title }}
        </button>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="space-y-8">
        <div v-for="n in 5" :key="n" class="h-32 bg-white dark:bg-gray-800 rounded-xl animate-pulse"></div>
      </div>

      <!-- Process Steps -->
      <div v-else-if="processSteps.length" class="relative">
        <!-- Timeline Line -->
        <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-primary-200 dark:bg-gray-700"></div>

        <div v-for="(step, index) in processSteps" :key="step.id" 
             class="relative flex items-start mb-8 ml-8">
          
          <!-- Step Number -->
          <div class="absolute -left-8 w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center text-white font-bold z-10">
            {{ index + 1 }}
          </div>

          <!-- Step Content -->
          <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg flex-1">
            <h3 class="text-2xl font-bold mb-2">{{ step.title }}</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-3">{{ step.description }}</p>
            
            <div class="flex items-center justify-between">
              <p v-if="step.duration" class="text-sm text-primary-600 font-medium">
                Duration: {{ step.duration }}
              </p>
              <p class="text-sm text-gray-500">
                Offering: {{ step.offering?.title }}
              </p>
            </div>

            <div v-if="step.icon" class="mt-3">
              <component :is="getIcon(step.icon)" class="w-6 h-6 text-primary-400" />
            </div>
          </div>
        </div>
      </div>

      <!-- No Data -->
      <div v-else class="text-center py-12">
        <p class="text-gray-600 dark:text-gray-400">No process steps available</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
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

const processSteps = ref([])
const offerings = ref([])
const loading = ref(true)
const selectedOffering = ref(null)

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

const fetchProcessSteps = async () => {
  loading.value = true
  try {
    const params = {
      per_page: 50,
      _: Date.now()
    }
    
    if (selectedOffering.value) {
      params.offering_id = selectedOffering.value
    }
    
    const response = await axios.get('/api/v1/process-steps', { params })
    
    if (response.data?.data) {
      processSteps.value = response.data.data
    }
  } catch (error) {
    console.error('Failed to fetch process steps:', error)
    processSteps.value = []
  } finally {
    loading.value = false
  }
}

const fetchOfferings = async () => {
  try {
    const response = await axios.get('/api/v1/offerings', {
      params: { per_page: 100, published: true }
    })
    
    if (response.data?.data) {
      offerings.value = response.data.data.map(s => ({
        id: s.id,
        title: s.title
      }))
    }
  } catch (error) {
    console.error('Failed to fetch offerings:', error)
    offerings.value = []
  }
}

watch(selectedOffering, () => {
  fetchProcessSteps()
})

onMounted(() => {
  fetchOfferings()
  fetchProcessSteps()
})
</script>