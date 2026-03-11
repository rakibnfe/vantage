<!-- resources/js/Components/Public/Home/FeaturedProjects.vue -->
<template>
  <section class="py-24 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Section Header -->
      <div class="text-center mb-12">
        <span class="text-sm font-semibold text-primary-600 dark:text-primary-400 uppercase tracking-wider">PORTFOLIO</span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mt-2 mb-4">
          Featured <span class="text-primary-600 dark:text-primary-400">Projects</span>
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-300">
          Real-world solutions that deliver exceptional results
        </p>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div v-for="n in 3" :key="n" class="bg-white dark:bg-gray-800 rounded-2xl h-80 animate-pulse"></div>
      </div>

      <!-- Projects with Swiper Carousel -->
      <div v-else-if="featuredProjects.length" class="relative">
        <Swiper
          :modules="[Navigation, Pagination, Autoplay]"
          :slides-per-view="1"
          :space-between="20"
          :navigation="true"
          :pagination="{ clickable: true }"
          :autoplay="{ delay: 5000, disableOnInteraction: false }"
          :breakpoints="{
            640: { slidesPerView: 2, spaceBetween: 20 },
            1024: { slidesPerView: 3, spaceBetween: 30 }
          }"
          class="projects-swiper"
        >
          <SwiperSlide v-for="project in featuredProjects" :key="project.id">
            <ProjectCard :project="project" />
          </SwiperSlide>
        </Swiper>
      </div>

      <!-- No Projects -->
      <div v-else class="text-center py-12">
        <p class="text-gray-600 dark:text-gray-400">No featured projects available</p>
      </div>

      <!-- View All Link -->
      <div class="text-center mt-12">
        <router-link to="/work" class="text-primary-600 dark:text-primary-400 font-semibold hover:underline">
          View All Projects →
        </router-link>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Pagination, Autoplay } from 'swiper/modules'
import ProjectCard from '@/Components/Public/Common/ProjectCard.vue'
import axios from 'axios'

import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'

const featuredProjects = ref([])
const loading = ref(true)

const fetchProjects = async () => {
  try {
    const response = await axios.get('/api/v1/projects', {
      params: {
        featured: true,
        per_page: 6,
        _: Date.now()
      }
    })
    
    if (response.data?.data) {
      featuredProjects.value = response.data.data
    }
  } catch (error) {
    console.error('Failed to fetch featured projects:', error)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchProjects()
})
</script>

<style scoped>
.projects-swiper {
  padding: 20px 10px 40px 10px;
}

:deep(.swiper-button-next),
:deep(.swiper-button-prev) {
  color: #4f46e5;
  background: white;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
}

:deep(.swiper-button-next:after),
:deep(.swiper-button-prev:after) {
  font-size: 18px;
}

:deep(.swiper-pagination-bullet) {
  background: #4f46e5;
}

.dark :deep(.swiper-button-next),
.dark :deep(.swiper-button-prev) {
  background: #1f2937;
  color: #818cf8;
}

.dark :deep(.swiper-pagination-bullet) {
  background: #818cf8;
}
</style>