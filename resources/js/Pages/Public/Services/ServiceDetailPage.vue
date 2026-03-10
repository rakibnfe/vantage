<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Loading State -->
    <div v-if="loading" class="min-h-screen flex items-center justify-center">
      <div class="text-center">
        <div class="w-16 h-16 border-4 border-primary-600 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
        <p class="text-gray-600 dark:text-gray-400">Loading service details...</p>
      </div>
    </div>

    <!-- Error State -->
    <div v-else-if="error" class="min-h-screen flex items-center justify-center">
      <div class="text-center max-w-lg mx-auto px-4">
        <div class="w-20 h-20 mx-auto bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mb-6">
          <ExclamationTriangleIcon class="w-10 h-10 text-red-600 dark:text-red-400" />
        </div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Service Not Found</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">{{ error }}</p>
        <div class="flex gap-4 justify-center">
          <router-link 
            to="/services" 
            class="px-6 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition"
          >
            Back to Services
          </router-link>
          <button 
            @click="fetchService" 
            class="px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition"
          >
            Try Again
          </button>
        </div>
      </div>
    </div>

    <!-- Service Content -->
    <div v-else-if="service" class="pb-16">
      <!-- Hero Section -->
      <section class="relative overflow-hidden bg-gradient-to-br from-primary-600 to-primary-800 dark:from-primary-800 dark:to-primary-900 text-white">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:60px_60px]"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary-900/50 to-transparent"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
          <!-- Back Button -->
          <div class="mb-8">
            <router-link 
              to="/services" 
              class="inline-flex items-center gap-2 text-primary-100 hover:text-white transition group"
            >
              <ChevronLeftIcon class="w-5 h-5 group-hover:-translate-x-1 transition-transform" />
              <span>Back to Services</span>
            </router-link>
          </div>

          <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
            <!-- Left Content -->
            <div class="flex-1 max-w-3xl">
              <!-- Icon -->
              <div class="w-20 h-20 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center mb-6">
                <component 
                  :is="getIcon(service.icon)" 
                  class="w-10 h-10 text-white"
                />
              </div>

              <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">
                {{ service.title }}
              </h1>
              
              <p class="text-xl text-primary-100 mb-6">
                {{ service.tagline }}
              </p>

              <!-- Quick Stats -->
              <div class="flex flex-wrap gap-4">
                <div v-if="service.delivery_timeframe" class="flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full">
                  <ClockIcon class="w-5 h-5" />
                  <span>{{ service.delivery_timeframe }}</span>
                </div>
                <div v-if="service.team_size" class="flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full">
                  <UserGroupIcon class="w-5 h-5" />
                  <span>{{ service.team_size }}</span>
                </div>
                <div v-if="service.is_featured" class="flex items-center gap-2 px-4 py-2 bg-yellow-500/20 backdrop-blur-sm rounded-full text-yellow-300">
                  <StarIcon class="w-5 h-5" />
                  <span>Featured Service</span>
                </div>
              </div>
            </div>

            <!-- CTA Button -->
            <div class="lg:text-right">
              <router-link
                to="/contact"
                class="inline-flex items-center gap-2 px-8 py-4 bg-white text-primary-600 rounded-xl font-semibold hover:bg-gray-100 transition group"
              >
                <span>Start a Project</span>
                <ArrowRightIcon class="w-5 h-5 group-hover:translate-x-1 transition-transform" />
              </router-link>
              <p class="text-sm text-primary-200 mt-3">Free consultation • No commitment</p>
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
        <!-- Overview Section -->
        <section class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">Overview</h2>
          <div class="prose prose-lg dark:prose-invert max-w-none">
            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
              {{ service.overview }}
            </p>
          </div>
        </section>

        <!-- Key Features -->
        <section v-if="service.features?.length" class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Key Features</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div 
              v-for="(feature, index) in service.features" 
              :key="index"
              class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1"
            >
              <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mb-4">
                <component 
                  :is="getIcon(feature.icon || 'code')" 
                  class="w-6 h-6 text-primary-600 dark:text-primary-400"
                />
              </div>
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ feature.title }}</h3>
              <p class="text-gray-600 dark:text-gray-400">{{ feature.description }}</p>
            </div>
          </div>
        </section>

        <!-- Process Steps -->
        <section v-if="service.process_steps?.length" class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Our Process</h2>
          <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-8 top-0 bottom-0 w-0.5 bg-gray-200 dark:bg-gray-700 hidden md:block"></div>
            
            <div class="space-y-8">
              <div 
                v-for="(step, index) in service.process_steps" 
                :key="index"
                class="relative flex flex-col md:flex-row md:items-start gap-6"
              >
                <!-- Step Number -->
                <div class="flex-shrink-0 w-16 h-16 bg-primary-600 text-white rounded-2xl flex items-center justify-center text-2xl font-bold z-10">
                  {{ index + 1 }}
                </div>
                
                <!-- Content -->
                <div class="flex-1 bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ step.title }}</h3>
                  <p class="text-gray-600 dark:text-gray-400 mb-3">{{ step.description }}</p>
                  <p v-if="step.duration" class="text-sm text-primary-600 dark:text-primary-400 font-medium">
                    Duration: {{ step.duration }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- Technologies -->
        <section v-if="service.technologies?.length" class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Technologies We Use</h2>
          
          <!-- Group by category -->
          <div v-if="groupedTechnologies.length" class="space-y-8">
            <div v-for="group in groupedTechnologies" :key="group.category" class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ group.category }}</h3>
              <div class="flex flex-wrap gap-3">
                <span 
                  v-for="tech in group.items" 
                  :key="tech.name"
                  class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg text-gray-700 dark:text-gray-300 flex items-center gap-2"
                >
                  <component v-if="tech.icon" :is="getIcon(tech.icon)" class="w-4 h-4" />
                  {{ tech.name }}
                </span>
              </div>
            </div>
          </div>

          <!-- Simple list if not grouped -->
          <div v-else class="flex flex-wrap gap-3">
            <span 
              v-for="tech in service.technologies" 
              :key="tech.name || tech"
              class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-gray-700 dark:text-gray-300 shadow-sm"
            >
              {{ tech.name || tech }}
            </span>
          </div>
        </section>

        <!-- Pricing Models -->
        <section v-if="service.pricing_models?.length" class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Pricing Options</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div 
              v-for="model in service.pricing_models" 
              :key="model.id"
              class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-lg border-2 border-transparent hover:border-primary-600 transition-all hover:-translate-y-1"
            >
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">{{ model.name }}</h3>
              <p class="text-gray-600 dark:text-gray-400 mb-4">{{ model.description }}</p>
              <p v-if="model.starting_price" class="text-2xl font-bold text-primary-600 dark:text-primary-400 mb-2">
                ${{ model.starting_price.toLocaleString() }}+
              </p>
              <p v-if="model.notes" class="text-sm text-gray-500 dark:text-gray-400">{{ model.notes }}</p>
            </div>
          </div>
        </section>

        <!-- FAQs -->
        <section v-if="service.faqs?.length" class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Frequently Asked Questions</h2>
          <div class="space-y-4">
            <div 
              v-for="(faq, index) in service.faqs" 
              :key="index"
              class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden"
            >
              <button
                @click="toggleFaq(index)"
                class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition"
              >
                <span class="font-medium text-gray-900 dark:text-white">{{ faq.question }}</span>
                <ChevronDownIcon 
                  class="w-5 h-5 text-gray-500 transition-transform duration-300"
                  :class="{ 'rotate-180': openFaqs.includes(index) }"
                />
              </button>
              <div 
                v-show="openFaqs.includes(index)"
                class="px-6 pb-4 text-gray-600 dark:text-gray-400"
              >
                {{ faq.answer }}
              </div>
            </div>
          </div>
        </section>

        <!-- Related Projects -->
        <section v-if="relatedProjects.length" class="mb-16">
          <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">Related Projects</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
              v-for="project in relatedProjects"
              :key="project.id"
              @click="navigateToProject(project.slug)"
              class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg cursor-pointer transform hover:-translate-y-1 transition-all hover:shadow-xl"
            >
              <img 
                :src="project.featured_image" 
                :alt="project.title"
                class="w-full h-48 object-cover"
                @error="handleImageError"
              />
              <div class="p-4">
                <h3 class="font-semibold text-gray-900 dark:text-white mb-1">{{ project.title }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ project.description }}</p>
              </div>
            </div>
          </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl p-12 text-center text-white">
          <h2 class="text-3xl font-bold mb-4">Ready to get started?</h2>
          <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
            Let's discuss how we can help bring your idea to life
          </p>
          <div class="flex gap-4 justify-center">
            <router-link 
              to="/contact" 
              class="px-8 py-4 bg-white text-primary-600 rounded-xl font-semibold hover:bg-gray-100 transition"
            >
              Get in Touch
            </router-link>
            <router-link 
              to="/work" 
              class="px-8 py-4 border border-white text-white rounded-xl font-semibold hover:bg-white/10 transition"
            >
              View Portfolio
            </router-link>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'
import {
  ChevronLeftIcon,
  ChevronDownIcon,
  ClockIcon,
  UserGroupIcon,
  StarIcon,
  ArrowRightIcon,
  ExclamationTriangleIcon,
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

const route = useRoute()
const router = useRouter()

// ==================== STATE ====================
const service = ref(null)
const relatedProjects = ref([])
const loading = ref(true)
const error = ref(null)
const openFaqs = ref([])

// ==================== COMPUTED ====================
const groupedTechnologies = computed(() => {
  if (!service.value?.technologies) return []
  
  const groups = {}
  service.value.technologies.forEach(tech => {
    const category = tech.category || 'Other'
    if (!groups[category]) {
      groups[category] = []
    }
    groups[category].push(tech)
  })
  
  return Object.entries(groups).map(([category, items]) => ({
    category,
    items
  }))
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

const toggleFaq = (index) => {
  if (openFaqs.value.includes(index)) {
    openFaqs.value = openFaqs.value.filter(i => i !== index)
  } else {
    openFaqs.value = [...openFaqs.value, index]
  }
}

const handleImageError = (e) => {
  e.target.src = 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'
}

const navigateToProject = (slug) => {
  if (slug) {
    router.push(`/work/${slug}`)
  }
}

const fetchService = async () => {
  loading.value = true
  error.value = null
  
  try {
    const slug = route.params.slug
    console.log('Fetching service with slug:', slug)
    
    const response = await axios.get(`/api/v1/services/${slug}`, {
      params: { _: Date.now() }
    })

    console.log('Service API Response:', response.data)

    let serviceData = null
    if (response.data?.data) {
      serviceData = response.data.data
    } else if (response.data && typeof response.data === 'object') {
      serviceData = response.data
    }

    if (!serviceData) {
      throw new Error('Service not found')
    }

    // Transform service data
    service.value = {
      id: serviceData.id,
      title: serviceData.title,
      slug: serviceData.slug,
      tagline: serviceData.tagline || '',
      icon: serviceData.icon || 'code-bracket',
      overview: serviceData.overview || serviceData.description || '',
      description: serviceData.description || '',
      delivery_timeframe: serviceData.delivery_timeframe,
      team_size: serviceData.team_size,
      is_featured: serviceData.is_featured || false,
      features: serviceData.features?.map(f => ({
        title: f.title || f,
        description: f.description || '',
        icon: f.icon || 'code'
      })) || [],
      process_steps: serviceData.process_steps?.map(step => ({
        title: step.title,
        description: step.description,
        duration: step.duration
      })) || [],
      technologies: serviceData.technologies?.map(tech => ({
        name: tech.name || tech,
        icon: tech.icon,
        category: tech.category || 'Other'
      })) || [],
      pricing_models: serviceData.pricing_models?.map(model => ({
        id: model.id,
        name: model.name,
        description: model.description,
        starting_price: model.starting_price,
        notes: model.notes
      })) || [],
      faqs: serviceData.faqs?.map(faq => ({
        question: faq.question,
        answer: faq.answer
      })) || []
    }

    // Fetch related projects
    await fetchRelatedProjects()

  } catch (err) {
    console.error('Error fetching service:', err)
    error.value = err.response?.data?.message || err.message || 'Failed to load service'
  } finally {
    loading.value = false
  }
}

const fetchRelatedProjects = async () => {
  try {
    const response = await axios.get(`/api/v1/projects`, {
      params: {
        per_page: 3,
        _: Date.now()
      }
    })

    let projectsData = []
    if (response.data?.data) {
      projectsData = response.data.data
    } else if (Array.isArray(response.data)) {
      projectsData = response.data
    }

    relatedProjects.value = projectsData.map(p => ({
      id: p.id,
      title: p.title,
      slug: p.slug,
      description: p.description || p.excerpt || '',
      featured_image: p.featured_image || p.image
    }))

  } catch (err) {
    console.log('Could not fetch related projects:', err)
    relatedProjects.value = []
  }
}

// ==================== WATCHERS ====================
watch(() => route.params.slug, (newSlug, oldSlug) => {
  if (newSlug && newSlug !== oldSlug) {
    openFaqs.value = [] // Reset open FAQs
    fetchService()
  }
})

// ==================== LIFECYCLE ====================
onMounted(() => {
  fetchService()
})
</script>

<style scoped>
.bg-grid-white {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32' fill='none' stroke='rgb(255 255 255 / 0.05)'%3e%3cpath d='M0 .5H31.5V32'/%3e%3c/svg%3e");
}

.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
</style>