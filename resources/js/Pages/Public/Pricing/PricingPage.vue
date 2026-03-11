<!-- resources/js/Pages/Pricing/Index.vue -->
<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-20">
    <div class="max-w-7xl mx-auto px-4">
      <h1 class="text-4xl font-bold text-center mb-4">Pricing</h1>
      <p class="text-xl text-center text-gray-600 dark:text-gray-400 mb-12">
        Flexible pricing options for every need
      </p>

      <!-- Loading State -->
      <div v-if="loading" class="space-y-16">
        <div v-for="n in 3" :key="n" class="h-64 bg-white dark:bg-gray-800 rounded-xl animate-pulse"></div>
      </div>

      <!-- Pricing by Service -->
      <div v-else-if="pricingData.length" class="space-y-16">
        <div v-for="service in pricingData" :key="service.service.id" class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
          <h2 class="text-3xl font-bold mb-6">{{ service.service.title }}</h2>
          
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div 
              v-for="model in service.pricing_models" 
              :key="model.id"
              class="border-2 rounded-xl p-6 transition-all hover:border-primary-600 hover:shadow-xl"
              :class="getPopularClass(model)"
            >
              <h3 class="text-2xl font-bold mb-2">{{ model.name }}</h3>
              <p class="text-gray-600 dark:text-gray-400 mb-4">{{ model.description }}</p>
              <p class="text-3xl font-bold text-primary-600 mb-4">
                ${{ formatPrice(model.starting_price) }}+
              </p>
              <p v-if="model.notes" class="text-sm text-gray-500 mb-4">{{ model.notes }}</p>
              <button class="w-full py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                Get Started
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- No Data -->
      <div v-else class="text-center py-12">
        <p class="text-gray-600 dark:text-gray-400">No pricing information available</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const pricingData = ref([])
const loading = ref(true)

const formatPrice = (price) => {
  return price?.toLocaleString() || '0'
}

const getPopularClass = (model) => {
  return model.name?.toLowerCase().includes('popular') || model.name?.toLowerCase().includes('pro')
    ? 'border-primary-600 shadow-lg'
    : 'border-gray-200 dark:border-gray-700'
}

const fetchPricing = async () => {
  loading.value = true
  try {
    const response = await axios.get('/api/v1/pricing/comparison', {
      params: { _: Date.now() }
    })
    
    if (response.data?.data) {
      pricingData.value = response.data.data
    }
  } catch (error) {
    console.error('Failed to fetch pricing:', error)
    pricingData.value = []
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchPricing()
})
</script>