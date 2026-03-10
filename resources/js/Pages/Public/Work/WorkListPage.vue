<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Page Header with Breadcrumb -->
    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-4">
          <router-link to="/" class="hover:text-primary-600 dark:hover:text-primary-400 transition">Home</router-link>
          <ChevronRightIcon class="w-4 h-4" />
          <span class="text-gray-900 dark:text-white font-medium">Work</span>
        </nav>

        <!-- Title and Description -->
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
          <div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-2">
              My <span class="text-primary-600 dark:text-primary-400">Work</span>
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl">
              A collection of projects I've built, from web applications to mobile apps and everything in between.
            </p>
          </div>
          
          <!-- Project Count -->
          <div class="flex items-center gap-2 text-sm bg-gray-100 dark:bg-gray-700 px-4 py-2 rounded-full">
            <BriefcaseIcon class="w-4 h-4 text-primary-600 dark:text-primary-400" />
            <span class="text-gray-700 dark:text-gray-300 font-medium">{{ totalProjects }} projects</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <!-- Filters Bar -->
      <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center gap-4">
          <!-- Search -->
          <div class="flex-1 relative">
            <MagnifyingGlassIcon class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
            <input 
              v-model="searchQuery"
              type="text"
              placeholder="Search projects..."
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
          <div class="relative">
            <select 
              v-model="sortBy"
              class="appearance-none pl-4 pr-10 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 dark:text-white cursor-pointer"
            >
              <option value="newest">Newest First</option>
              <option value="oldest">Oldest First</option>
              <option value="name_asc">Name A-Z</option>
              <option value="name_desc">Name Z-A</option>
            </select>
            <ChevronDownIcon class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" />
          </div>
        </div>

        <!-- Technology Filters -->
        <div class="mt-6">
          <div class="flex items-center justify-between mb-3">
            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Filter by Technology</span>
            <button 
              v-if="selectedTechs.length"
              @click="clearTechFilters"
              class="text-xs text-primary-600 dark:text-primary-400 hover:underline"
            >
              Clear all
            </button>
          </div>
          <div class="flex flex-wrap gap-2">
            <button
              v-for="tech in allTechnologies"
              :key="tech"
              @click="toggleTech(tech)"
              class="px-4 py-2 text-sm rounded-full border transition-all"
              :class="selectedTechs.includes(tech) 
                ? 'bg-primary-600 border-primary-600 text-white' 
                : 'bg-white dark:bg-gray-700 border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:border-primary-400'"
            >
              {{ tech }}
              <XMarkIcon v-if="selectedTechs.includes(tech)" class="inline w-3 h-3 ml-1" />
            </button>
          </div>
        </div>

        <!-- Active Filters Summary -->
        <div v-if="activeFilterCount > 0" class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
          <div class="flex items-center gap-2 text-sm">
            <span class="text-gray-500 dark:text-gray-400">Active filters:</span>
            <span class="px-2 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 rounded-full text-xs">
              {{ activeFilterCount }} applied
            </span>
            <button @click="resetAllFilters" class="text-primary-600 dark:text-primary-400 hover:underline text-xs ml-auto">
              Reset all
            </button>
          </div>
        </div>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div v-for="n in 6" :key="n" class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm animate-pulse">
          <div class="h-48 bg-gray-200 dark:bg-gray-700"></div>
          <div class="p-6 space-y-3">
            <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-3/4"></div>
            <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-full"></div>
            <div class="h-4 bg-gray-200 dark:bg-gray-700 rounded w-2/3"></div>
          </div>
        </div>
      </div>

      <!-- Error State -->
      <div v-else-if="error" class="text-center py-16">
        <div class="w-20 h-20 mx-auto bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mb-4">
          <ExclamationTriangleIcon class="w-10 h-10 text-red-600 dark:text-red-400" />
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Failed to load projects</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-6">{{ error }}</p>
        <button @click="fetchProjects" class="px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition">
          Try Again
        </button>
      </div>

      <!-- No Results State -->
      <div v-else-if="!filteredProjects.length" class="text-center py-16">
        <div class="w-20 h-20 mx-auto bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-4">
          <MagnifyingGlassIcon class="w-10 h-10 text-gray-400" />
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No projects found</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Try adjusting your filters or search query</p>
        <button @click="resetAllFilters" class="px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition">
          Clear Filters
        </button>
      </div>

      <!-- Projects Grid/List -->
      <div v-else>
        <!-- Results Count -->
        <div class="flex justify-between items-center mb-6">
          <p class="text-gray-600 dark:text-gray-300">
            Showing <span class="font-semibold text-primary-600 dark:text-primary-400">{{ paginatedProjects.length }}</span> 
            of <span class="font-semibold">{{ filteredProjects.length }}</span> projects
          </p>
        </div>

        <!-- Grid View -->
        <div v-if="viewMode === 'grid'" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <ProjectCard
            v-for="project in paginatedProjects"
            :key="project.id"
            :project="project"
            class="animate-fade-in-up"
            :style="{ animationDelay: `${(project.id % 5) * 100}ms` }"
          />
        </div>

        <!-- List View -->
        <div v-else class="space-y-4">
          <div v-for="project in paginatedProjects" :key="project.id" 
               class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all hover:-translate-y-1 animate-fade-in-up"
               :style="{ animationDelay: `${(project.id % 5) * 100}ms` }">
            <router-link :to="`/work/${project.slug}`" class="flex flex-col md:flex-row">
              <!-- Image -->
              <div class="md:w-64 h-48 md:h-auto overflow-hidden bg-gray-100 dark:bg-gray-700">
                <img 
                  :src="project.featured_image || 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'" 
                  :alt="project.title"
                  class="w-full h-full object-cover hover:scale-110 transition-transform duration-500"
                  loading="lazy"
                  @error="handleImageError"
                />
              </div>
              
              <!-- Content -->
              <div class="flex-1 p-6">
                <div class="flex items-start justify-between mb-2">
                  <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-primary-600 transition">
                    {{ project.title }}
                  </h3>
                  <span class="text-sm text-gray-500">{{ project.year || project.timeline }}</span>
                </div>
                
                <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                  {{ project.description }}
                </p>
                
                <!-- Technologies -->
                <div class="flex flex-wrap gap-2 mb-4">
                  <span v-for="tech in project.technologies?.slice(0, 4)" :key="tech"
                        class="px-3 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full">
                    {{ tech }}
                  </span>
                  <span v-if="project.technologies?.length > 4" 
                        class="px-3 py-1 text-xs bg-gray-100 dark:bg-gray-700 text-gray-500 rounded-full">
                    +{{ project.technologies.length - 4 }}
                  </span>
                </div>
                
                <!-- View Details -->
                <span class="inline-flex items-center text-primary-600 dark:text-primary-400 font-medium group">
                  View Project Details
                  <ArrowRightIcon class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" />
                </span>
              </div>
            </router-link>
          </div>
        </div>

        <!-- Pagination -->
        <div v-if="totalPages > 1" class="mt-12 flex justify-center">
          <div class="flex items-center gap-2">
            <button 
              @click="currentPage--"
              :disabled="currentPage === 1"
              class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <ChevronLeftIcon class="w-5 h-5" />
            </button>
            
            <button
              v-for="page in visiblePages"
              :key="page"
              @click="currentPage = page"
              class="min-w-10 h-10 px-3 rounded-lg font-medium transition"
              :class="currentPage === page 
                ? 'bg-primary-600 text-white' 
                : 'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300'"
            >
              {{ page }}
            </button>
            
            <button 
              @click="currentPage++"
              :disabled="currentPage === totalPages"
              class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition disabled:opacity-50 disabled:cursor-not-allowed"
            >
              <ChevronRightIcon class="w-5 h-5" />
            </button>
          </div>
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
import ProjectCard from '@/Components/Public/Common/ProjectCard.vue'
import {
  ChevronRightIcon,
  BriefcaseIcon,
  MagnifyingGlassIcon,
  XMarkIcon,
  Squares2X2Icon,
  Bars3Icon,
  ChevronDownIcon,
  ExclamationTriangleIcon,
  ArrowRightIcon,
  ChevronLeftIcon
} from '@heroicons/vue/24/outline'

const router = useRouter()

// ==================== STATE ====================
const projects = ref([])
const filteredProjects = ref([])
const loading = ref(true)
const error = ref(null)

// Filter states
const searchQuery = ref('')
const debouncedSearch = useDebounce(searchQuery, 300)
const selectedTechs = ref([])
const sortBy = ref('newest')
const viewMode = ref('grid')
const currentPage = ref(1)
const itemsPerPage = 9

// All available technologies (extracted from projects)
const allTechnologies = ref([])

// ==================== COMPUTED ====================
const totalProjects = computed(() => filteredProjects.value.length)

const activeFilterCount = computed(() => {
  let count = 0
  if (searchQuery.value) count++
  if (selectedTechs.value.length) count++
  if (sortBy.value !== 'newest') count++
  return count
})

const paginatedProjects = computed(() => {
  const start = (currentPage.value - 1) * itemsPerPage
  const end = start + itemsPerPage
  return filteredProjects.value.slice(start, end)
})

const totalPages = computed(() => 
  Math.ceil(filteredProjects.value.length / itemsPerPage)
)

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
const fetchProjects = async () => {
  loading.value = true
  error.value = null
  
  try {
    // Try multiple possible endpoints
    const endpoints = ['/api/v1/projects', '/api/projects']
    let response = null
    
    for (const endpoint of endpoints) {
      try {
        response = await axios.get(endpoint, {
          params: {
            per_page: 100,
            published: true,
            _: Date.now()
          }
        })
        break
      } catch (e) {
        console.log(`Endpoint ${endpoint} failed`)
      }
    }

    if (!response) {
      throw new Error('Could not connect to API')
    }

    console.log('Projects API Response:', response.data)
    
    // Handle different response structures
    let projectData = []
    
    // Check if response.data is an object with a data property that contains the array
    if (response.data?.data && Array.isArray(response.data.data)) {
      projectData = response.data.data
    } 
    // Check if response.data itself is an array
    else if (Array.isArray(response.data)) {
      projectData = response.data
    }
    // Check if response.data has a projects property that's an array
    else if (response.data?.projects && Array.isArray(response.data.projects)) {
      projectData = response.data.projects
    }
    // Check if response.data has a data property that's an object (paginated response)
    else if (response.data?.data && typeof response.data.data === 'object') {
      // This might be a paginated response where data is an object with data property
      if (Array.isArray(response.data.data.data)) {
        projectData = response.data.data.data
      }
    }
    // If response.data is an object but not an array, try to convert it
    else if (response.data && typeof response.data === 'object') {
      // Maybe it's a single project object? Convert to array
      if (response.data.id) {
        projectData = [response.data]
      }
    }

    console.log('Processed project data:', projectData)

    // Transform and validate projects
    projects.value = projectData.map(p => ({
      id: p.id,
      title: p.title || 'Untitled Project',
      slug: p.slug || `project-${p.id}`,
      description: p.description || p.excerpt || p.overview || 'No description available',
      overview: p.overview || '',
      challenge: p.challenge || '',
      solution: p.solution || '',
      results: p.results || '',
      technologies: Array.isArray(p.technologies) ? p.technologies : 
                    (typeof p.technologies === 'string' ? JSON.parse(p.technologies) : []),
      featured_image: p.featured_image || p.image || 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format',
      images: p.images || [],
      live_url: p.live_url || null,
      github_url: p.github_url || null,
      case_study_url: p.case_study_url || null,
      year: p.year || p.timeline || new Date(p.created_at || Date.now()).getFullYear().toString(),
      start_date: p.start_date || null,
      end_date: p.end_date || null,
      status: p.status || 'completed',
      is_featured: p.is_featured || false,
      order: p.order || 0,
      created_at: p.created_at || new Date().toISOString(),
      updated_at: p.updated_at || new Date().toISOString()
    }))

    // Extract all unique technologies
    const techSet = new Set()
    projects.value.forEach(p => {
      if (Array.isArray(p.technologies)) {
        p.technologies.forEach(tech => techSet.add(tech))
      }
    })
    allTechnologies.value = Array.from(techSet).sort()

    // Apply initial filters
    applyFilters()

  } catch (err) {
    console.error('Error fetching projects:', err)
    error.value = err.response?.data?.message || err.message || 'Failed to load projects'
    
    // Set empty arrays to avoid undefined errors
    projects.value = []
    allTechnologies.value = []
    filteredProjects.value = []
  } finally {
    loading.value = false
  }
}

const applyFilters = () => {
  let result = [...projects.value]

  // Search filter
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    result = result.filter(p => 
      p.title.toLowerCase().includes(query) ||
      p.description.toLowerCase().includes(query) ||
      (Array.isArray(p.technologies) && p.technologies.some(t => t.toLowerCase().includes(query)))
    )
  }

  // Technology filter
  if (selectedTechs.value.length) {
    result = result.filter(p =>
      selectedTechs.value.every(tech => 
        Array.isArray(p.technologies) && p.technologies.includes(tech)
      )
    )
  }

  // Sorting
  result.sort((a, b) => {
    switch (sortBy.value) {
      case 'newest':
        return new Date(b.created_at || 0) - new Date(a.created_at || 0)
      case 'oldest':
        return new Date(a.created_at || 0) - new Date(b.created_at || 0)
      case 'name_asc':
        return a.title.localeCompare(b.title)
      case 'name_desc':
        return b.title.localeCompare(a.title)
      default:
        return 0
    }
  })

  filteredProjects.value = result
  currentPage.value = 1 // Reset to first page when filters change
}

const toggleTech = (tech) => {
  if (selectedTechs.value.includes(tech)) {
    selectedTechs.value = selectedTechs.value.filter(t => t !== tech)
  } else {
    selectedTechs.value = [...selectedTechs.value, tech]
  }
  applyFilters()
}

const clearTechFilters = () => {
  selectedTechs.value = []
  applyFilters()
}

const clearSearch = () => {
  searchQuery.value = ''
  applyFilters()
}

const resetAllFilters = () => {
  searchQuery.value = ''
  selectedTechs.value = []
  sortBy.value = 'newest'
  applyFilters()
}

const handleImageError = (e) => {
  e.target.src = 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'
}

const navigateToProject = (slug) => {
  if (slug) {
    router.push(`/work/${slug}`)
  }
}

// ==================== WATCHERS ====================
watch([debouncedSearch, selectedTechs, sortBy], () => {
  applyFilters()
})

// ==================== LIFECYCLE ====================
onMounted(() => {
  fetchProjects()
})
</script>

<style scoped>
/* Animation for cards */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-up {
  animation: fadeInUp 0.5s ease-out forwards;
  opacity: 0;
}
</style>