<!-- resources/js/Components/Public/Home/TestimonialsCarousel.vue -->
<template>
  <section class="py-24 bg-gradient-to-br from-primary-50 to-purple-50 dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Section Header -->
      <div class="text-center mb-16">
        <span class="text-sm font-semibold text-primary-600 dark:text-primary-400 uppercase tracking-wider">
          TESTIMONIALS
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mt-4">
          Client <span class="text-primary-600 dark:text-primary-400">Feedback</span>
        </h2>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div v-for="n in 3" :key="n" class="bg-white dark:bg-gray-800 rounded-3xl h-64 animate-pulse"></div>
      </div>

      <!-- Testimonials Grid -->
      <div v-else-if="testimonials.length" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div v-for="testimonial in testimonials" 
             :key="testimonial.id"
             class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300">
          
          <!-- Quote -->
          <div class="text-5xl text-primary-200 dark:text-primary-900 mb-4">"</div>
          
          <!-- Content -->
          <p class="text-gray-700 dark:text-gray-300 text-lg mb-6 italic">
            {{ testimonial.content }}
          </p>

          <!-- Author -->
          <div class="flex items-center">
            <img 
              :src="testimonial.client_avatar" 
              :alt="testimonial.client_name"
              class="w-12 h-12 rounded-full object-cover"
            />
            <div class="ml-4">
              <h4 class="font-bold text-gray-900 dark:text-white">{{ testimonial.client_name }}</h4>
              <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ testimonial.client_role }}, {{ testimonial.client_company }}
              </p>
            </div>
          </div>

          <!-- Project Link -->
          <div v-if="testimonial.project_link" class="mt-3">
            <a :href="testimonial.project_link" target="_blank" class="text-sm text-primary-600 dark:text-primary-400 hover:underline">
              {{ testimonial.project_name || 'View Project' }} →
            </a>
          </div>

          <!-- Rating -->
          <div class="flex mt-4 text-yellow-400">
            <StarIcon v-for="n in 5" :key="n" class="w-5 h-5" :class="{ 'fill-current': n <= testimonial.rating, 'text-gray-300 dark:text-gray-600': n > testimonial.rating }" />
          </div>
        </div>
      </div>

      <!-- No Testimonials -->
      <div v-else class="text-center py-12">
        <p class="text-gray-600 dark:text-gray-400">No testimonials available</p>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { StarIcon } from '@heroicons/vue/24/solid'

const testimonials = ref([])
const loading = ref(true)

const fetchTestimonials = async () => {
  try {
    const response = await axios.get('/api/v1/testimonials', {
      params: {
        featured: true,
        per_page: 3,
        _: Date.now()
      }
    })

    if (response.data?.data) {
      testimonials.value = response.data.data
    }
  } catch (error) {
    console.error('Failed to fetch testimonials:', error)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchTestimonials()
})
</script>