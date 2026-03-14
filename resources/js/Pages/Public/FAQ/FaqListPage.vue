<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-20">
    <div class="max-w-4xl mx-auto px-4">
      <h1 class="text-4xl font-bold text-center mb-4">Frequently Asked Questions</h1>
      <p class="text-xl text-center text-gray-600 dark:text-gray-400 mb-12">
        Find answers to common questions about our offerings
      </p>

      <!-- Search -->
      <div class="mb-8">
        <div class="relative max-w-md mx-auto">
          <MagnifyingGlassIcon class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
          <input 
            v-model="searchQuery"
            type="text"
            placeholder="Search FAQs..."
            class="w-full pl-12 pr-4 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500"
          />
        </div>
      </div>

      <!-- Filter by Offering -->
      <div class="mb-8 flex flex-wrap gap-2 justify-center">
        <button 
          @click="selectedOffering = null"
          class="px-4 py-2 rounded-full transition"
          :class="!selectedOffering ? 'bg-primary-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
        >
          All Offerings
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
      <div v-if="loading" class="space-y-4">
        <div v-for="n in 5" :key="n" class="bg-white dark:bg-gray-800 rounded-xl h-24 animate-pulse"></div>
      </div>

      <!-- FAQs -->
      <div v-else-if="faqs.length" class="space-y-4">
        <div 
          v-for="faq in faqs" 
          :key="faq.id"
          class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden"
        >
          <button 
            @click="toggleFaq(faq.id)" 
            class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 dark:hover:bg-gray-700 transition"
          >
            <span class="font-semibold text-gray-900 dark:text-white">{{ faq.question }}</span>
            <ChevronDownIcon 
              class="w-5 h-5 text-gray-500 transition-transform duration-300"
              :class="{ 'rotate-180': openFaqs.includes(faq.id) }"
            />
          </button>
          <div 
            v-show="openFaqs.includes(faq.id)" 
            class="px-6 pb-4"
          >
            <p class="text-gray-600 dark:text-gray-400 mb-3">{{ faq.answer }}</p>
            <p v-if="faq.offering" class="text-sm text-primary-600">
              Related Offering: {{ faq.offering.title }}
            </p>
          </div>
        </div>
      </div>

      <!-- No Results -->
      <div v-else class="text-center py-12">
        <DocumentTextIcon class="w-16 h-16 text-gray-400 mx-auto mb-4" />
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No FAQs found</h3>
        <p class="text-gray-600 dark:text-gray-400">Try adjusting your search or filter</p>
      </div>

      <!-- Pagination -->
      <div v-if="meta && meta.last_page > 1" class="mt-8 flex justify-center">
        <nav class="flex gap-2">
          <button 
            @click="currentPage--" 
            :disabled="currentPage === 1"
            class="px-4 py-2 rounded-lg border disabled:opacity-50"
          >
            Previous
          </button>
          <span class="px-4 py-2">{{ currentPage }} of {{ meta.last_page }}</span>
          <button 
            @click="currentPage++" 
            :disabled="currentPage === meta.last_page"
            class="px-4 py-2 rounded-lg border disabled:opacity-50"
          >
            Next
          </button>
        </nav>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import axios from 'axios'
import { MagnifyingGlassIcon, ChevronDownIcon, DocumentTextIcon } from '@heroicons/vue/24/outline'
import { useDebounce } from '@vueuse/core'

// State
const faqs = ref([])
const offerings = ref([])
const loading = ref(true)
const searchQuery = ref('')
const debouncedSearch = useDebounce(searchQuery, 300)
const selectedOffering = ref(null)
const openFaqs = ref([])
const currentPage = ref(1)
const perPage = ref(20)
const meta = ref({
  current_page: 1,
  last_page: 1,
  total: 0
})

// Methods
const toggleFaq = (id) => {
  if (openFaqs.value.includes(id)) {
    openFaqs.value = openFaqs.value.filter(i => i !== id)
  } else {
    openFaqs.value = [...openFaqs.value, id]
  }
}

const fetchFaqs = async () => {
  loading.value = true
  try {
    const params = {
      page: currentPage.value,
      per_page: perPage.value,
      _: Date.now()
    }
    
    if (selectedOffering.value) {
      params.offering_id = selectedOffering.value
    }
    
    if (searchQuery.value) {
      params.search = searchQuery.value
    }
    
    const response = await axios.get('/api/v1/faqs', { params })
    
    if (response.data?.data) {
      faqs.value = response.data.data
      meta.value = response.data.meta || {
        current_page: response.data.current_page || 1,
        last_page: response.data.last_page || 1,
        total: response.data.total || 0
      }
    } else {
      faqs.value = []
    }
  } catch (error) {
    console.error('Failed to fetch FAQs:', error)
    faqs.value = []
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

// Watchers
watch([debouncedSearch, selectedOffering, currentPage], () => {
  fetchFaqs()
})

// Lifecycle
onMounted(() => {
  fetchOfferings()
  fetchFaqs()
})
</script>