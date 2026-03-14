<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Loading State -->
    <div v-if="loading" class="min-h-screen flex items-center justify-center">
      <div class="text-center">
        <div class="w-16 h-16 border-4 border-primary-600 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
        <p class="text-gray-600 dark:text-gray-400">Loading project...</p>
      </div>
    </div>

    <!-- Error State -->
    <div v-else-if="error" class="min-h-screen flex items-center justify-center">
      <div class="text-center max-w-lg mx-auto px-4">
        <div class="w-20 h-20 mx-auto bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mb-6">
          <ExclamationTriangleIcon class="w-10 h-10 text-red-600 dark:text-red-400" />
        </div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Project Not Found</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">{{ error }}</p>
        <div class="flex gap-4 justify-center">
          <router-link 
            to="/work" 
            class="px-6 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition"
          >
            Back to Work
          </router-link>
          <button 
            @click="fetchProject" 
            class="px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition"
          >
            Try Again
          </button>
        </div>
      </div>
    </div>

    <!-- Project Content -->
    <div v-else-if="project" class="pb-16">
      <!-- Hero Section with Image -->
      <div class="relative h-[70vh] min-h-[600px] bg-gray-900">
        <!-- Background Image -->
        <img 
          :src="project.featured_image" 
          :alt="project.title"
          class="absolute inset-0 w-full h-full object-cover opacity-60"
          @error="handleImageError"
        />
        
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>

        <!-- Back Button -->
        <div class="absolute top-8 left-8 z-10">
          <router-link 
            to="/work" 
            class="flex items-center gap-2 px-4 py-2 bg-black/50 backdrop-blur-sm text-white rounded-full hover:bg-black/70 transition"
          >
            <ChevronLeftIcon class="w-5 h-5" />
            <span>Back to Work</span>
          </router-link>
        </div>

        <!-- Hero Content -->
        <div class="absolute bottom-0 left-0 right-0 z-10">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
            <!-- Title and Description -->
            <div class="max-w-4xl">
              <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6">
                {{ project.title }}
              </h1>
              <p class="text-xl text-gray-200 mb-8">
                {{ project.description }}
              </p>

              <!-- Project Meta -->
              <div class="flex flex-wrap gap-4">
                <!-- Year -->
                <div class="flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white">
                  <CalendarIcon class="w-5 h-5" />
                  <span>{{ project.year }}</span>
                </div>

                <!-- Status -->
                <div class="flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white">
                  <span class="w-2 h-2 rounded-full" :class="statusColor"></span>
                  <span class="capitalize">{{ project.status?.replace('_', ' ') }}</span>
                </div>

                <!-- Featured Badge -->
                <div v-if="project.is_featured" class="flex items-center gap-2 px-4 py-2 bg-yellow-500/20 backdrop-blur-sm rounded-full text-yellow-300">
                  <StarIcon class="w-5 h-5" />
                  <span>Featured Project</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
          <!-- Left Column - Main Content -->
          <div class="lg:col-span-2 space-y-12">
            <!-- Overview -->
            <section>
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                <DocumentTextIcon class="w-6 h-6 text-primary-600" />
                Overview
              </h2>
              <div class="prose prose-lg dark:prose-invert max-w-none">
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                  {{ project.overview }}
                </p>
              </div>
            </section>

            <!-- Challenge -->
            <section v-if="project.challenge">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                <ExclamationTriangleIcon class="w-6 h-6 text-primary-600" />
                The Challenge
              </h2>
              <div class="prose prose-lg dark:prose-invert max-w-none">
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                  {{ project.challenge }}
                </p>
              </div>
            </section>

            <!-- Solution -->
            <section v-if="project.solution">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                <LightBulbIcon class="w-6 h-6 text-primary-600" />
                The Solution
              </h2>
              <div class="prose prose-lg dark:prose-invert max-w-none">
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                  {{ project.solution }}
                </p>
              </div>
            </section>

            <!-- Results -->
            <section v-if="project.results">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                <ChartBarIcon class="w-6 h-6 text-primary-600" />
                The Results
              </h2>
              <div class="prose prose-lg dark:prose-invert max-w-none">
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                  {{ project.results }}
                </p>
              </div>
            </section>

            <!-- Technologies Used -->
            <section v-if="project.technologies?.length">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                <CodeBracketIcon class="w-6 h-6 text-primary-600" />
                Technologies Used
              </h2>
              <div class="flex flex-wrap gap-3">
                <span 
                  v-for="tech in project.technologies" 
                  :key="tech"
                  class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-gray-700 dark:text-gray-300 shadow-sm"
                >
                  {{ tech }}
                </span>
              </div>
            </section>
          </div>

          <!-- Right Column - Sidebar -->
          <div class="space-y-8">
            <!-- Project Details Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
              <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Project Details</h3>
              
              <div class="space-y-4">
                <!-- Client/Year -->
                <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                  <span class="text-gray-500 dark:text-gray-400">Year</span>
                  <span class="font-medium text-gray-900 dark:text-white">{{ project.year }}</span>
                </div>

                <!-- Status -->
                <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                  <span class="text-gray-500 dark:text-gray-400">Status</span>
                  <span class="font-medium capitalize text-gray-900 dark:text-white">
                    {{ project.status?.replace('_', ' ') }}
                  </span>
                </div>

                <!-- Timeline (if start/end dates exist) -->
                <div v-if="project.start_date" class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                  <span class="text-gray-500 dark:text-gray-400">Timeline</span>
                  <span class="font-medium text-gray-900 dark:text-white">
                    {{ formatDate(project.start_date) }} - {{ project.end_date ? formatDate(project.end_date) : 'Present' }}
                  </span>
                </div>

                <!-- Duration (if calculated) -->
                <div v-if="project.duration_days" class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                  <span class="text-gray-500 dark:text-gray-400">Duration</span>
                  <span class="font-medium text-gray-900 dark:text-white">{{ project.duration_days }} days</span>
                </div>
              </div>
            </div>

            <!-- Live Links Card -->
            <div v-if="project.live_url || project.github_url || project.case_study_url" 
                 class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6">
              <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Project Links</h3>
              
              <div class="space-y-3">
                <!-- Live Demo -->
                <a 
                  v-if="project.live_url"
                  :href="project.live_url" 
                  target="_blank"
                  rel="noopener noreferrer"
                  class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 transition group"
                >
                  <div class="flex items-center gap-3">
                    <GlobeAltIcon class="w-5 h-5 text-gray-500 group-hover:text-primary-600" />
                    <span class="font-medium text-gray-700 dark:text-gray-300">Live Demo</span>
                  </div>
                  <ArrowTopRightOnSquareIcon class="w-5 h-5 text-gray-400 group-hover:text-primary-600" />
                </a>

                <!-- GitHub -->
                <a 
                  v-if="project.github_url"
                  :href="project.github_url" 
                  target="_blank"
                  rel="noopener noreferrer"
                  class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 transition group"
                >
                  <div class="flex items-center gap-3">
                    <CodeBracketIcon class="w-5 h-5 text-gray-500 group-hover:text-primary-600" />
                    <span class="font-medium text-gray-700 dark:text-gray-300">Source Code</span>
                  </div>
                  <ArrowTopRightOnSquareIcon class="w-5 h-5 text-gray-400 group-hover:text-primary-600" />
                </a>

                <!-- Case Study -->
                <a 
                  v-if="project.case_study_url"
                  :href="project.case_study_url" 
                  target="_blank"
                  rel="noopener noreferrer"
                  class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-xl hover:bg-primary-50 dark:hover:bg-primary-900/20 transition group"
                >
                  <div class="flex items-center gap-3">
                    <DocumentTextIcon class="w-5 h-5 text-gray-500 group-hover:text-primary-600" />
                    <span class="font-medium text-gray-700 dark:text-gray-300">Case Study</span>
                  </div>
                  <ArrowTopRightOnSquareIcon class="w-5 h-5 text-gray-400 group-hover:text-primary-600" />
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Related Projects Section -->
        <section v-if="relatedProjects.length" class="mt-16 pt-16 border-t border-gray-200 dark:border-gray-700">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-8">Related Projects</h2>
          
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <ProjectCard
              v-for="related in relatedProjects"
              :key="related.id"
              :project="related"
            />
          </div>
        </section>

        <!-- CTA Section -->
        <section class="mt-16 pt-16 border-t border-gray-200 dark:border-gray-700">
          <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl p-12 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Interested in working together?</h2>
            <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
              I'm always open to discussing new projects and opportunities.
            </p>
            <div class="flex gap-4 justify-center">
              <router-link 
                to="/contact" 
                class="px-8 py-4 bg-white text-primary-600 rounded-xl font-semibold hover:bg-gray-100 transition"
              >
                Get in Touch
              </router-link>
              <router-link 
                to="/offerings" 
                class="px-8 py-4 border border-white text-white rounded-xl font-semibold hover:bg-white/10 transition"
              >
                View Offerings
              </router-link>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue' // 👈 Added watch here
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'
import ProjectCard from '@/Components/Public/Common/ProjectCard.vue'
import {
  ChevronLeftIcon,
  CalendarIcon,
  StarIcon,
  DocumentTextIcon,
  ExclamationTriangleIcon,
  LightBulbIcon,
  ChartBarIcon,
  CodeBracketIcon,
  GlobeAltIcon,
  ArrowTopRightOnSquareIcon
} from '@heroicons/vue/24/outline'

const route = useRoute()
const router = useRouter()

// ==================== STATE ====================
const project = ref(null)
const relatedProjects = ref([])
const loading = ref(true)
const error = ref(null)

// ==================== COMPUTED ====================
const statusColor = computed(() => {
  const colors = {
    planning: 'bg-yellow-500',
    in_progress: 'bg-blue-500',
    completed: 'bg-green-500'
  }
  return colors[project.value?.status] || 'bg-gray-500'
})

// ==================== METHODS ====================
const formatDate = (dateString) => {
  if (!dateString) return ''
  return new Date(dateString).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short'
  })
}

const handleImageError = (e) => {
  e.target.src = 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'
}

const fetchProject = async () => {
  loading.value = true
  error.value = null
  
  try {
    const slug = route.params.slug
    console.log('Fetching project with slug:', slug)
    
    // Try multiple possible endpoints
    const endpoints = [
      `/api/v1/projects/${slug}`,
      `/api/projects/${slug}`,
      `/api/projects/slug/${slug}`
    ]
    
    let response = null
    
    for (const endpoint of endpoints) {
      try {
        response = await axios.get(endpoint, {
          params: { _: Date.now() } // Cache bust
        })
        console.log(`Success with endpoint: ${endpoint}`)
        break
      } catch (e) {
        console.log(`Endpoint ${endpoint} failed`)
      }
    }

    if (!response) {
      throw new Error('Project not found')
    }

    console.log('Project API Response:', response.data)

    // Handle different response structures
    let projectData = null
    
    if (response.data?.data) {
      projectData = response.data.data
    } else if (response.data?.project) {
      projectData = response.data.project
    } else if (response.data && typeof response.data === 'object') {
      projectData = response.data
    }

    if (!projectData) {
      throw new Error('Invalid project data structure')
    }

    // Parse technologies if it's a JSON string
    let technologies = []
    if (Array.isArray(projectData.technologies)) {
      technologies = projectData.technologies
    } else if (typeof projectData.technologies === 'string') {
      try {
        technologies = JSON.parse(projectData.technologies)
      } catch (e) {
        technologies = projectData.technologies.split(',').map(t => t.trim())
      }
    }

    // Transform project data
    project.value = {
      id: projectData.id,
      title: projectData.title || 'Untitled Project',
      slug: projectData.slug,
      description: projectData.description || projectData.excerpt || 'No description available',
      overview: projectData.overview || projectData.description || '',
      challenge: projectData.challenge || '',
      solution: projectData.solution || '',
      results: projectData.results || '',
      technologies: technologies,
      featured_image: projectData.featured_image || projectData.image || 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format',
      images: projectData.images || [],
      live_url: projectData.live_url || null,
      github_url: projectData.github_url || null,
      case_study_url: projectData.case_study_url || null,
      year: projectData.year || projectData.timeline || new Date(projectData.created_at || Date.now()).getFullYear().toString(),
      start_date: projectData.start_date || null,
      end_date: projectData.end_date || null,
      status: projectData.status || 'completed',
      is_featured: projectData.is_featured || false,
      duration_days: projectData.duration_days || null,
      created_at: projectData.created_at,
      updated_at: projectData.updated_at
    }

    // Fetch related projects
    await fetchRelatedProjects()

  } catch (err) {
    console.error('Error fetching project:', err)
    error.value = err.response?.data?.message || err.message || 'Failed to load project'
  } finally {
    loading.value = false
  }
}

const fetchRelatedProjects = async () => {
  try {
    // Try to fetch related projects based on technologies or tags
    const response = await axios.get(`/api/v1/projects`, {
      params: {
        per_page: 3,
        exclude: project.value.id,
        technologies: project.value.technologies.slice(0, 3).join(','),
        _: Date.now()
      }
    })

    let relatedData = []
    if (response.data?.data) {
      relatedData = response.data.data
    } else if (Array.isArray(response.data)) {
      relatedData = response.data
    }

    relatedProjects.value = relatedData.map(p => ({
      id: p.id,
      title: p.title,
      slug: p.slug,
      description: p.description || p.excerpt || '',
      technologies: Array.isArray(p.technologies) ? p.technologies : [],
      featured_image: p.featured_image || p.image,
      year: p.year || p.timeline,
      is_featured: p.is_featured || false
    }))

  } catch (err) {
    console.log('Could not fetch related projects:', err)
    relatedProjects.value = []
  }
}

// ==================== WATCHERS ====================
watch(() => route.params.slug, (newSlug, oldSlug) => {
  if (newSlug && newSlug !== oldSlug) {
    fetchProject()
  }
})

// ==================== LIFECYCLE ====================
onMounted(() => {
  fetchProject()
})
</script>

<style scoped>
.prose {
  max-width: none;
}
</style>