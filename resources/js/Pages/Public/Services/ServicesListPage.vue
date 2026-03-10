<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Hero Section with Stats -->
    <section class="relative overflow-hidden bg-gradient-to-br from-primary-600 to-primary-800 dark:from-primary-800 dark:to-primary-900 text-white">
      <!-- Background Pattern -->
      <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:60px_60px]"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-primary-900/50 to-transparent"></div>
      
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center max-w-4xl mx-auto">
          <!-- Breadcrumb -->
          <nav class="flex items-center justify-center gap-2 text-sm text-primary-100 mb-6">
            <router-link to="/" class="hover:text-white transition">Home</router-link>
            <ChevronRightIcon class="w-4 h-4" />
            <span class="text-white font-medium">Services</span>
          </nav>

          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fade-in-down">
            Services & <span class="text-yellow-300">Expertise</span>
          </h1>
          <p class="text-xl md:text-2xl text-primary-100 max-w-3xl mx-auto mb-12 animate-fade-in-up">
            Transforming ideas into powerful digital solutions with modern technologies and best practices
          </p>

          <!-- Stats Grid -->
          <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto">
            <div v-for="stat in stats" :key="stat.label" class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-2xl">
              <div class="text-3xl font-bold text-white mb-1">{{ stat.value }}</div>
              <div class="text-sm text-primary-200">{{ stat.label }}</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Wave SVG -->
      <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
          <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" 
                class="fill-gray-50 dark:fill-gray-900"/>
        </svg>
      </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
      <!-- Search and Filter Bar -->
      <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center gap-4">
          <!-- Search -->
          <div class="flex-1 relative">
            <MagnifyingGlassIcon class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
            <input 
              v-model="searchQuery"
              type="text"
              placeholder="Search services by name, description or features..."
              class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 dark:text-white transition"
            />
            <button 
              v-if="searchQuery"
              @click="clearSearch"
              class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
            >
              <XMarkIcon class="w-5 h-5" />
            </button>
          </div>

          <!-- View Toggle -->
          <div class="flex items-center gap-2 bg-gray-100 dark:bg-gray-700 p-1 rounded-xl">
            <button 
              @click="viewMode = 'grid'"
              class="p-2 rounded-lg transition"
              :class="viewMode === 'grid' ? 'bg-white dark:bg-gray-600 shadow-sm text-primary-600' : 'text-gray-500 dark:text-gray-400'"
            >
              <Squares2X2Icon class="w-5 h-5" />
            </button>
            <button 
              @click="viewMode = 'list'"
              class="p-2 rounded-lg transition"
              :class="viewMode === 'list' ? 'bg-white dark:bg-gray-600 shadow-sm text-primary-600' : 'text-gray-500 dark:text-gray-400'"
            >
              <Bars3Icon class="w-5 h-5" />
            </button>
          </div>

          <!-- Sort Dropdown -->
          <div class="relative min-w-[180px]">
            <select 
              v-model="sortBy"
              class="appearance-none w-full pl-4 pr-10 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 dark:text-white cursor-pointer"
            >
              <option value="order">Default Order</option>
              <option value="name_asc">Name A-Z</option>
              <option value="name_desc">Name Z-A</option>
              <option value="newest">Newest First</option>
              <option value="oldest">Oldest First</option>
            </select>
            <ChevronDownIcon class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" />
          </div>
        </div>

        <!-- Category Pills -->
        <div class="mt-6">
          <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Browse by Category</span>
            <button 
              v-if="selectedCategory"
              @click="selectedCategory = ''"
              class="text-xs text-primary-600 dark:text-primary-400 hover:underline"
            >
              Clear filter
            </button>
          </div>
          <div class="flex flex-wrap gap-2">
            <button
              v-for="category in categories"
              :key="category"
              @click="selectedCategory = selectedCategory === category ? '' : category"
              class="px-4 py-2 text-sm rounded-full border transition-all"
              :class="selectedCategory === category 
                ? 'bg-primary-600 border-primary-600 text-white' 
                : 'bg-white dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:border-primary-400'"
            >
              {{ formatCategory(category) }}
            </button>
          </div>
        </div>

        <!-- Active Filters Summary -->
        <div v-if="activeFilterCount > 0" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
          <div class="flex items-center gap-3 flex-wrap">
            <span class="text-sm text-gray-500 dark:text-gray-400">Active filters:</span>
            
            <!-- Search Filter -->
            <span v-if="searchQuery" class="inline-flex items-center gap-1 px-3 py-1 bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300 rounded-full text-sm">
              <MagnifyingGlassIcon class="w-3 h-3" />
              "{{ searchQuery }}"
              <button @click="searchQuery = ''" class="hover:text-primary-900">
                <XMarkIcon class="w-4 h-4" />
              </button>
            </span>

            <!-- Category Filter -->
            <span v-if="selectedCategory" class="inline-flex items-center gap-1 px-3 py-1 bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300 rounded-full text-sm">
              {{ formatCategory(selectedCategory) }}
              <button @click="selectedCategory = ''" class="hover:text-primary-900">
                <XMarkIcon class="w-4 h-4" />
              </button>
            </span>

            <!-- Sort Filter -->
            <span v-if="sortBy !== 'order'" class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm">
              Sort: {{ getSortLabel(sortBy) }}
              <button @click="sortBy = 'order'" class="hover:text-gray-900">
                <XMarkIcon class="w-4 h-4" />
              </button>
            </span>

            <button @click="resetFilters" class="text-primary-600 dark:text-primary-400 hover:underline text-sm ml-auto">
              Reset all
            </button>
          </div>
        </div>
      </div>

      <!-- Results Count -->
      <div class="flex justify-between items-center mb-6">
        <p class="text-gray-600 dark:text-gray-400">
          Showing <span class="font-semibold text-primary-600 dark:text-primary-400">{{ paginatedServices.length }}</span> 
          of <span class="font-semibold">{{ filteredServices.length }}</span> services
        </p>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <div v-for="n in 8" :key="n" class="animate-pulse">
          <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 h-80 shadow-lg">
            <div class="h-12 w-12 bg-gray-200 dark:bg-gray-700 rounded-xl mb-4"></div>
            <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded w-3/4 mb-3"></div>
            <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-full mb-2"></div>
            <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-5/6 mb-4"></div>
            <div class="flex gap-2 mt-4">
              <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded-full w-16"></div>
              <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded-full w-16"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Error State -->
      <div v-else-if="error" class="text-center py-16">
        <div class="bg-red-50 dark:bg-red-900/20 rounded-2xl p-12 max-w-lg mx-auto">
          <ExclamationTriangleIcon class="h-16 w-16 text-red-500 mx-auto mb-4" />
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Oops! Something went wrong</h3>
          <p class="text-gray-600 dark:text-gray-400 mb-6">{{ error }}</p>
          <button
            @click="fetchServices"
            class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium transition-colors inline-flex items-center gap-2"
          >
            <ArrowPathIcon class="h-5 w-5" />
            Try Again
          </button>
        </div>
      </div>

      <!-- No Results State -->
      <div v-else-if="!filteredServices.length" class="text-center py-16">
        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-12 max-w-lg mx-auto">
          <MagnifyingGlassIcon class="h-16 w-16 text-gray-400 mx-auto mb-4" />
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No services found</h3>
          <p class="text-gray-600 dark:text-gray-400 mb-6">
            Try adjusting your search or filters to find what you're looking for.
          </p>
          <button
            @click="resetFilters"
            class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-medium transition-colors"
          >
            Clear All Filters
          </button>
        </div>
      </div>

      <!-- Services Grid/List -->
      <div v-else>
        <!-- Grid View -->
        <div v-if="viewMode === 'grid'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          <div
            v-for="service in paginatedServices"
            :key="service.id"
            @click="navigateToService(service.slug)"
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden group cursor-pointer transform hover:-translate-y-1 transition-all duration-300 hover:shadow-xl"
          >
            <!-- Icon -->
            <div class="bg-gradient-to-br from-primary-500 to-primary-600 p-6 flex items-center justify-center">
              <component 
                :is="getIcon(service.icon)" 
                class="h-12 w-12 text-white"
              />
            </div>

            <!-- Content -->
            <div class="p-6">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">
                {{ service.title }}
              </h3>
              
              <p v-if="service.tagline" class="text-sm text-primary-600 dark:text-primary-400 mb-3">
                {{ service.tagline }}
              </p>
              
              <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
                {{ service.description }}
              </p>

              <!-- Features Preview -->
              <div class="flex flex-wrap gap-2 mb-4">
                <span 
                  v-for="feature in service.features.slice(0, 3)" 
                  :key="feature"
                  class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded-full text-gray-700 dark:text-gray-300"
                >
                  {{ feature }}
                </span>
                <span 
                  v-if="service.features.length > 3"
                  class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded-full text-gray-700 dark:text-gray-300"
                >
                  +{{ service.features.length - 3 }} more
                </span>
              </div>

              <!-- Category Badge and Price -->
              <div class="flex items-center justify-between">
                <span class="inline-block px-3 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded-full text-gray-700 dark:text-gray-300">
                  {{ formatCategory(service.category) }}
                </span>
                <span class="text-sm font-semibold text-primary-600 dark:text-primary-400">
                  {{ service.price }}
                </span>
              </div>
            </div>
          </div>
        </div>

        <!-- List View -->
        <div v-else class="space-y-4">
          <div
            v-for="service in paginatedServices"
            :key="service.id"
            @click="navigateToService(service.slug)"
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden group cursor-pointer transform hover:-translate-y-1 transition-all duration-300 hover:shadow-xl"
          >
            <div class="flex flex-col md:flex-row">
              <!-- Icon -->
              <div class="md:w-24 bg-gradient-to-br from-primary-500 to-primary-600 p-6 flex items-center justify-center">
                <component 
                  :is="getIcon(service.icon)" 
                  class="h-12 w-12 text-white"
                />
              </div>

              <!-- Content -->
              <div class="flex-1 p-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">
                    {{ service.title }}
                  </h3>
                  <span class="text-sm font-semibold text-primary-600 dark:text-primary-400">
                    {{ service.price }}
                  </span>
                </div>
                
                <p v-if="service.tagline" class="text-sm text-primary-600 dark:text-primary-400 mb-2">
                  {{ service.tagline }}
                </p>
                
                <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
                  {{ service.description }}
                </p>

                <!-- Features and Category -->
                <div class="flex flex-wrap items-center gap-3">
                  <span class="inline-block px-3 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded-full text-gray-700 dark:text-gray-300">
                    {{ formatCategory(service.category) }}
                  </span>
                  <span 
                    v-for="feature in service.features.slice(0, 3)" 
                    :key="feature"
                    class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded-full text-gray-700 dark:text-gray-300"
                  >
                    {{ feature }}
                  </span>
                  <span 
                    v-if="service.features.length > 3"
                    class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded-full text-gray-700 dark:text-gray-300"
                  >
                    +{{ service.features.length - 3 }} more
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="totalPages > 1" class="mt-12">
          <nav class="flex justify-center items-center gap-2">
            <button
              @click="currentPage--"
              :disabled="currentPage === 1"
              class="p-2 rounded-lg border border-gray-200 dark:border-gray-700 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
            >
              <ChevronLeftIcon class="w-5 h-5" />
            </button>
            
            <template v-for="(page, index) in visiblePages" :key="index">
              <button
                v-if="page === '...'"
                disabled
                class="px-4 py-2 text-gray-400"
              >
                ...
              </button>
              <button
                v-else
                @click="currentPage = page"
                :class="[
                  'px-4 py-2 rounded-lg font-medium transition-colors',
                  currentPage === page
                    ? 'bg-primary-600 text-white'
                    : 'hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300'
                ]"
              >
                {{ page }}
              </button>
            </template>
            
            <button
              @click="currentPage++"
              :disabled="currentPage === totalPages"
              class="p-2 rounded-lg border border-gray-200 dark:border-gray-700 disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
            >
              <ChevronRightIcon class="w-5 h-5" />
            </button>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useDebounce } from '@vueuse/core'
import { useRouter } from 'vue-router'
import axios from 'axios'
import {
  ChevronRightIcon,
  MagnifyingGlassIcon,
  XMarkIcon,
  Squares2X2Icon,
  Bars3Icon,
  ChevronDownIcon,
  ExclamationTriangleIcon,
  ArrowPathIcon,
  ChevronLeftIcon,
  CodeBracketIcon,
  DevicePhoneMobileIcon,
  PaintBrushIcon,
  ChatBubbleBottomCenterTextIcon,
  CloudIcon,
  ShoppingCartIcon,
  ChartBarIcon,
  CogIcon,
  WrenchIcon,
  RocketLaunchIcon,
  ShieldCheckIcon,
  CpuChipIcon,
  DocumentTextIcon
} from '@heroicons/vue/24/outline'

const router = useRouter()

// ==================== STATE ====================
const services = ref([])
const loading = ref(true)
const error = ref(null)

// Filter states
const searchQuery = ref('')
const debouncedSearch = useDebounce(searchQuery, 300)
const selectedCategory = ref('')
const sortBy = ref('order')
const viewMode = ref('grid')
const currentPage = ref(1)
const itemsPerPage = 8

// Stats
const stats = ref([
  { label: 'Services', value: '0' },
  { label: 'Projects', value: '0' },
  { label: 'Clients', value: '0' },
  { label: 'Experience', value: '0' }
])

// ==================== COMPUTED ====================
const categories = computed(() => {
  const cats = new Set()
  services.value.forEach(s => {
    if (s.category) cats.add(s.category)
  })
  return Array.from(cats).sort()
})

const filteredServices = computed(() => {
  let result = [...services.value]

  // Search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    result = result.filter(s => 
      s.title?.toLowerCase().includes(query) ||
      s.tagline?.toLowerCase().includes(query) ||
      s.description?.toLowerCase().includes(query) ||
      s.features?.some(f => f.toLowerCase().includes(query))
    )
  }

  // Category filter
  if (selectedCategory.value) {
    result = result.filter(s => s.category === selectedCategory.value)
  }

  // Sorting
  result.sort((a, b) => {
    switch (sortBy.value) {
      case 'name_asc':
        return a.title.localeCompare(b.title)
      case 'name_desc':
        return b.title.localeCompare(a.title)
      case 'newest':
        return new Date(b.created_at || 0) - new Date(a.created_at || 0)
      case 'oldest':
        return new Date(a.created_at || 0) - new Date(b.created_at || 0)
      case 'order':
      default:
        return (a.order || 999) - (b.order || 999)
    }
  })

  return result
})

const paginatedServices = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filteredServices.value.slice(start, end)
})

const totalPages = computed(() => 
  Math.ceil(filteredServices.value.length / itemsPerPage)
)

const activeFilterCount = computed(() => {
  let count = 0
  if (searchQuery.value) count++
  if (selectedCategory.value) count++
  if (sortBy.value !== 'order') count++
  return count
})

const visiblePages = computed(() => {
  const delta = 2
  const range = []
  const rangeWithDots = []
  let l

  for (let i = 1; i <= totalPages.value; i++) {
    if (i === 1 || i === totalPages.value || (i >= currentPage.value - delta && i <= currentPage.value + delta)) {
      range.push(i)
    }
  }

  range.forEach((i) => {
    if (l) {
      if (i - l === 2) {
        rangeWithDots.push(l + 1)
      } else if (i - l !== 1) {
        rangeWithDots.push('...')
      }
    }
    rangeWithDots.push(i)
    l = i
  })

  return rangeWithDots
})

// ==================== METHODS ====================
const getIcon = (iconName) => {
  const iconMap = {
    'code': CodeBracketIcon,
    'code-bracket': CodeBracketIcon,
    'mobile': DevicePhoneMobileIcon,
    'design': PaintBrushIcon,
    'consulting': ChatBubbleBottomCenterTextIcon,
    'cloud': CloudIcon,
    'cart': ShoppingCartIcon,
    'chart': ChartBarIcon,
    'cog': CogIcon,
    'wrench': WrenchIcon,
    'rocket': RocketLaunchIcon,
    'security': ShieldCheckIcon,
    'chip': CpuChipIcon,
    'document': DocumentTextIcon,
    'default': CodeBracketIcon
  }
  return iconMap[iconName] || iconMap.default
}

const formatCategory = (cat) => {
  if (!cat) return 'General'
  return cat.split('_').map(word => 
    word.charAt(0).toUpperCase() + word.slice(1)
  ).join(' ')
}

const getSortLabel = (sortValue) => {
  const labels = {
    'order': 'Default',
    'name_asc': 'A-Z',
    'name_desc': 'Z-A',
    'newest': 'Newest',
    'oldest': 'Oldest'
  }
  return labels[sortValue] || sortValue
}

const navigateToService = (slug) => {
  if (slug) {
    router.push(`/services/${slug}`)
  }
}

const fetchServices = async () => {
  loading.value = true
  error.value = null
  
  try {
    const response = await axios.get('/api/v1/services', {
      params: {
        per_page: 100,
        published: true,
        _: Date.now()
      }
    })

    console.log('Services API Response:', response.data)

    // Handle response structure
    let servicesData = []
    if (response.data?.data) {
      servicesData = response.data.data
    } else if (Array.isArray(response.data)) {
      servicesData = response.data
    }

    // Map the data
    services.value = servicesData.map(service => ({
      id: service.id,
      title: service.title || 'Untitled Service',
      slug: service.slug || '',
      tagline: service.tagline || service.excerpt || '',
      description: service.description || service.overview || 'No description available',
      icon: service.icon || 'code-bracket',
      category: service.category || 'general',
      price: service.pricing_models?.[0]?.starting_price 
        ? `$${service.pricing_models[0].starting_price.toLocaleString()}+` 
        : 'Custom Pricing',
      order: service.order || 0,
      featured: service.is_featured || false,
      features: service.features?.map(f => f.title || f) || [],
      created_at: service.created_at
    }))

    // Update stats
    stats.value = [
      { label: 'Services', value: services.value.length.toString() },
      { label: 'Projects', value: '50+' },
      { label: 'Clients', value: '30+' },
      { label: 'Experience', value: '8+' }
    ]

  } catch (err) {
    console.error('Failed to fetch services:', err)
    error.value = err.response?.data?.message || 'Failed to load services'
  } finally {
    loading.value = false
  }
}

const clearSearch = () => {
  searchQuery.value = ''
}

const resetFilters = () => {
  searchQuery.value = ''
  selectedCategory.value = ''
  sortBy.value = 'order'
  currentPage.value = 1
}

// ==================== WATCHERS ====================
watch([debouncedSearch, selectedCategory, sortBy], () => {
  currentPage.value = 1
})

// ==================== LIFECYCLE ====================
onMounted(() => {
  fetchServices()
})
</script>

<style scoped>
.bg-grid-white {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32' fill='none' stroke='rgb(255 255 255 / 0.05)'%3e%3cpath d='M0 .5H31.5V32'/%3e%3c/svg%3e");
}

@keyframes fade-in-down {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fade-in-up {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-down {
  animation: fade-in-down 0.6s ease-out;
}

.animate-fade-in-up {
  animation: fade-in-up 0.6s ease-out;
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>