<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Hero Section with Stats -->
    <section class="relative overflow-hidden bg-gradient-to-br from-primary-600 to-primary-800 dark:from-primary-800 dark:to-primary-900 text-white">
      <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:60px_60px]"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-primary-900/50 to-transparent"></div>
      
      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center max-w-4xl mx-auto">
          <nav class="flex items-center justify-center gap-2 text-sm text-primary-100 mb-6">
            <router-link to="/" class="hover:text-white transition">Home</router-link>
            <ChevronRightIcon class="w-4 h-4" />
            <span class="text-white font-medium">Articles</span>
          </nav>

          <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fade-in-down">
            Insights & <span class="text-yellow-300">Articles</span>
          </h1>
          <p class="text-xl md:text-2xl text-primary-100 max-w-3xl mx-auto mb-12 animate-fade-in-up">
            Latest thoughts, tutorials, and insights from our team
          </p>

          <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto">
            <div v-for="stat in stats" :key="stat.label" class="text-center p-4 bg-white/10 backdrop-blur-sm rounded-2xl">
              <div class="text-3xl font-bold text-white mb-1">{{ stat.value }}</div>
              <div class="text-sm text-primary-200">{{ stat.label }}</div>
            </div>
          </div>
        </div>
      </div>

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
          <div class="flex-1 relative">
            <MagnifyingGlassIcon class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
            <input 
              v-model="searchQuery"
              type="text"
              placeholder="Search articles by title, content or excerpt..."
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

          <div class="relative min-w-[180px]">
            <select 
              v-model="sortBy"
              class="appearance-none w-full pl-4 pr-10 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 dark:text-white cursor-pointer"
            >
              <option value="newest">Newest First</option>
              <option value="oldest">Oldest First</option>
              <option value="title_asc">Title A-Z</option>
              <option value="title_desc">Title Z-A</option>
            </select>
            <ChevronDownIcon class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" />
          </div>
        </div>

        <!-- Category and Tag Filters -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Categories</span>
              <button 
                v-if="selectedCategory"
                @click="selectedCategory = ''"
                class="text-xs text-primary-600 dark:text-primary-400 hover:underline"
              >
                Clear
              </button>
            </div>
            <div class="flex flex-wrap gap-2">
              <button
                v-for="category in categories"
                :key="category"
                @click="selectedCategory = selectedCategory === category.id ? '' : category.id"
                class="px-4 py-2 text-sm rounded-full border transition-all"
                :class="selectedCategory === category.id 
                  ? 'bg-primary-600 border-primary-600 text-white' 
                  : 'bg-white dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:border-primary-400'"
              >
                {{ category.name }}
              </button>
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between mb-3">
              <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Popular Tags</span>
              <button 
                v-if="selectedTag"
                @click="selectedTag = ''"
                class="text-xs text-primary-600 dark:text-primary-400 hover:underline"
              >
                Clear
              </button>
            </div>
            <div class="flex flex-wrap gap-2">
              <button
                v-for="tag in popularTags"
                :key="tag"
                @click="selectedTag = selectedTag === tag ? '' : tag"
                class="px-4 py-2 text-sm rounded-full border transition-all"
                :class="selectedTag === tag 
                  ? 'bg-primary-600 border-primary-600 text-white' 
                  : 'bg-white dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:border-primary-400'"
              >
                #{{ tag }}
              </button>
            </div>
          </div>
        </div>

        <!-- Active Filters Summary -->
        <div v-if="activeFilterCount > 0" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
          <div class="flex items-center gap-3 flex-wrap">
            <span class="text-sm text-gray-500 dark:text-gray-400">Active filters:</span>
            
            <span v-if="searchQuery" class="inline-flex items-center gap-1 px-3 py-1 bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300 rounded-full text-sm">
              <MagnifyingGlassIcon class="w-3 h-3" />
              "{{ searchQuery }}"
              <button @click="searchQuery = ''" class="hover:text-primary-900">
                <XMarkIcon class="w-4 h-4" />
              </button>
            </span>

            <span v-if="selectedCategory" class="inline-flex items-center gap-1 px-3 py-1 bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300 rounded-full text-sm">
              {{ getCategoryName(selectedCategory) }}
              <button @click="selectedCategory = ''" class="hover:text-primary-900">
                <XMarkIcon class="w-4 h-4" />
              </button>
            </span>

            <span v-if="selectedTag" class="inline-flex items-center gap-1 px-3 py-1 bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300 rounded-full text-sm">
              #{{ selectedTag }}
              <button @click="selectedTag = ''" class="hover:text-primary-900">
                <XMarkIcon class="w-4 h-4" />
              </button>
            </span>

            <span v-if="sortBy !== 'newest'" class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm">
              Sort: {{ getSortLabel(sortBy) }}
              <button @click="sortBy = 'newest'" class="hover:text-gray-900">
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
          Showing <span class="font-semibold text-primary-600 dark:text-primary-400">{{ paginatedArticles.length }}</span> 
          of <span class="font-semibold">{{ filteredArticles.length }}</span> articles
        </p>
        <p class="text-sm text-gray-500 dark:text-gray-400">
          Total reading time: {{ totalReadingTime }} min
        </p>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div v-for="n in 6" :key="n" class="animate-pulse">
          <div class="bg-white dark:bg-gray-800 rounded-2xl h-96 shadow-lg">
            <div class="h-48 bg-gray-200 dark:bg-gray-700 rounded-t-2xl"></div>
            <div class="p-6 space-y-4">
              <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-1/4"></div>
              <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded w-3/4"></div>
              <div class="space-y-2">
                <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-full"></div>
                <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-5/6"></div>
              </div>
              <div class="flex gap-2 pt-4">
                <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded-full w-16"></div>
                <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded-full w-16"></div>
              </div>
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
            @click="fetchArticles"
            class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl font-medium transition-colors inline-flex items-center gap-2"
          >
            <ArrowPathIcon class="h-5 w-5" />
            Try Again
          </button>
        </div>
      </div>

      <!-- No Results State -->
      <div v-else-if="!filteredArticles.length" class="text-center py-16">
        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-12 max-w-lg mx-auto">
          <DocumentTextIcon class="h-16 w-16 text-gray-400 mx-auto mb-4" />
          <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No articles found</h3>
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

      <!-- Articles Grid/List -->
      <div v-else>
        <!-- Grid View -->
        <div v-if="viewMode === 'grid'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div
            v-for="article in paginatedArticles"
            :key="article.id"
            @click="navigateToArticle(article.slug)"
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden group cursor-pointer transform hover:-translate-y-1 transition-all duration-300 hover:shadow-xl"
          >
            <!-- Featured Image -->
            <div class="relative h-48 overflow-hidden">
              <img 
                :src="article.featured_image || 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'"
                :alt="article.title"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                @error="handleImageError"
              />
              <div class="absolute top-4 right-4">
                <span class="px-3 py-1 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-xs font-medium rounded-full">
                  {{ article.reading_time }} min read
                </span>
              </div>
            </div>

            <div class="p-6">
              <!-- Category -->
              <div class="flex items-center gap-2 mb-3">
                <span class="text-xs font-medium text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 px-2 py-1 rounded-full">
                  {{ article.category?.name || 'Uncategorized' }}
                </span>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                  {{ formatDate(article.published_at) }}
                </span>
              </div>

              <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition line-clamp-2">
                {{ article.title }}
              </h3>
              
              <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">
                {{ article.excerpt }}
              </p>

              <!-- Author & Tags -->
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                  <img 
                    :src="article.user?.profile_picture || 'https://ui-avatars.com/api/?name=' + (article.user?.name || 'Author')"
                    :alt="article.user?.name"
                    class="w-8 h-8 rounded-full object-cover"
                  />
                  <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ article.user?.name || 'Anonymous' }}
                  </span>
                </div>
                
                <div class="flex gap-1">
                  <span 
                    v-for="tag in article.tags?.slice(0, 2)" 
                    :key="tag.id"
                    class="text-xs text-gray-500 dark:text-gray-400 hover:text-primary-600"
                  >
                    #{{ tag.name }}
                  </span>
                  <span v-if="article.tags?.length > 2" class="text-xs text-gray-500">
                    +{{ article.tags.length - 2 }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- List View -->
        <div v-else class="space-y-4">
          <div
            v-for="article in paginatedArticles"
            :key="article.id"
            @click="navigateToArticle(article.slug)"
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden group cursor-pointer transform hover:-translate-y-1 transition-all duration-300 hover:shadow-xl"
          >
            <div class="flex flex-col md:flex-row">
              <!-- Featured Image -->
              <div class="md:w-64 h-48 md:h-auto overflow-hidden">
                <img 
                  :src="article.featured_image || 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'"
                  :alt="article.title"
                  class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                  @error="handleImageError"
                />
              </div>

              <!-- Content -->
              <div class="flex-1 p-6">
                <div class="flex items-center gap-2 mb-3">
                  <span class="text-xs font-medium text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 px-2 py-1 rounded-full">
                    {{ article.category?.name || 'Uncategorized' }}
                  </span>
                  <span class="text-xs text-gray-500 dark:text-gray-400">
                    {{ formatDate(article.published_at) }}
                  </span>
                  <span class="text-xs text-gray-500 dark:text-gray-400">
                    • {{ article.reading_time }} min read
                  </span>
                </div>

                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition">
                  {{ article.title }}
                </h3>
                
                <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                  {{ article.excerpt }}
                </p>

                <!-- Author and Tags -->
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <img 
                      :src="article.user?.profile_picture || 'https://ui-avatars.com/api/?name=' + (article.user?.name || 'Author')"
                      :alt="article.user?.name"
                      class="w-8 h-8 rounded-full object-cover"
                    />
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                      {{ article.user?.name || 'Anonymous' }}
                    </span>
                  </div>
                  
                  <div class="flex gap-2">
                    <span 
                      v-for="tag in article.tags?.slice(0, 3)" 
                      :key="tag.id"
                      class="text-xs text-gray-500 dark:text-gray-400 hover:text-primary-600"
                    >
                      #{{ tag.name }}
                    </span>
                    <span v-if="article.tags?.length > 3" class="text-xs text-gray-500">
                      +{{ article.tags.length - 3 }}
                    </span>
                  </div>
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
  DocumentTextIcon
} from '@heroicons/vue/24/outline'

const router = useRouter()

const articles = ref([])
const categories = ref([])
const popularTags = ref([])
const loading = ref(true)
const error = ref(null)

const searchQuery = ref('')
const debouncedSearch = useDebounce(searchQuery, 300)
const selectedCategory = ref('')
const selectedTag = ref('')
const sortBy = ref('newest')
const viewMode = ref('grid')
const currentPage = ref(1)
const itemsPerPage = 6

const stats = ref([
  { label: 'Articles', value: '0' },
  { label: 'Categories', value: '0' },
  { label: 'Tags', value: '0' },
  { label: 'Authors', value: '0' }
])

const filteredArticles = computed(() => {
  let result = [...articles.value]

  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    result = result.filter(a => 
      a.title?.toLowerCase().includes(query) ||
      a.excerpt?.toLowerCase().includes(query) ||
      a.content?.toLowerCase().includes(query)
    )
  }

  if (selectedCategory.value) {
    result = result.filter(a => a.category?.id === selectedCategory.value)
  }

  if (selectedTag.value) {
    result = result.filter(a => 
      a.tags?.some(t => t.name.toLowerCase() === selectedTag.value.toLowerCase())
    )
  }

  result.sort((a, b) => {
    switch (sortBy.value) {
      case 'title_asc':
        return a.title.localeCompare(b.title)
      case 'title_desc':
        return b.title.localeCompare(a.title)
      case 'oldest':
        return new Date(a.published_at || 0) - new Date(b.published_at || 0)
      case 'newest':
      default:
        return new Date(b.published_at || 0) - new Date(a.published_at || 0)
    }
  })

  return result
})

const paginatedArticles = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filteredArticles.value.slice(start, end)
})

const totalPages = computed(() => 
  Math.ceil(filteredArticles.value.length / itemsPerPage)
)

const activeFilterCount = computed(() => {
  let count = 0
  if (searchQuery.value) count++
  if (selectedCategory.value) count++
  if (selectedTag.value) count++
  if (sortBy.value !== 'newest') count++
  return count
})

const totalReadingTime = computed(() => {
  return filteredArticles.value.reduce((sum, a) => sum + (a.reading_time || 0), 0)
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

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric'
  })
}

const getCategoryName = (id) => {
  const cat = categories.value.find(c => c.id === id)
  return cat?.name || ''
}

const getSortLabel = (sortValue) => {
  const labels = {
    'newest': 'Newest',
    'oldest': 'Oldest',
    'title_asc': 'A-Z',
    'title_desc': 'Z-A'
  }
  return labels[sortValue] || sortValue
}

const handleImageError = (e) => {
  e.target.src = 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'
}

const navigateToArticle = (slug) => {
  if (slug) {
    router.push(`/article/${slug}`)
  }
}

const fetchArticles = async () => {
  loading.value = true
  error.value = null
  
  try {
    const response = await axios.get('/api/v1/articles', {
      params: {
        per_page: 100,
        _: Date.now()
      }
    })

    let articlesData = []
    if (response.data?.data) {
      articlesData = response.data.data
    } else if (Array.isArray(response.data)) {
      articlesData = response.data
    }

    articles.value = articlesData.map(article => ({
      id: article.id,
      title: article.title,
      slug: article.slug,
      excerpt: article.excerpt,
      content: article.content,
      featured_image: article.featured_image,
      reading_time: article.reading_time,
      published_at: article.published_at,
      category: article.category,
      user: article.user,
      tags: article.tags || []
    }))

    // Extract unique categories
    const catMap = new Map()
    articles.value.forEach(a => {
      if (a.category && !catMap.has(a.category.id)) {
        catMap.set(a.category.id, a.category)
      }
    })
    categories.value = Array.from(catMap.values())

    // Extract popular tags
    const tagCount = {}
    articles.value.forEach(a => {
      a.tags?.forEach(t => {
        tagCount[t.name] = (tagCount[t.name] || 0) + 1
      })
    })
    popularTags.value = Object.entries(tagCount)
      .sort((a, b) => b[1] - a[1])
      .slice(0, 10)
      .map(([tag]) => tag)

    stats.value = [
      { label: 'Articles', value: articles.value.length.toString() },
      { label: 'Categories', value: categories.value.length.toString() },
      { label: 'Tags', value: popularTags.value.length.toString() },
      { label: 'Authors', value: new Set(articles.value.map(a => a.user?.id)).size.toString() }
    ]

  } catch (err) {
    console.error('Failed to fetch articles:', err)
    error.value = err.response?.data?.message || 'Failed to load articles'
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
  selectedTag.value = ''
  sortBy.value = 'newest'
  currentPage.value = 1
}

watch([debouncedSearch, selectedCategory, selectedTag, sortBy], () => {
  currentPage.value = 1
})

onMounted(() => {
  fetchArticles()
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

.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>