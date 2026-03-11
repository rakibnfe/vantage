<template>
  <section class="py-24 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Section Header -->
      <div class="text-center mb-12">
        <span class="text-sm font-semibold text-primary-600 dark:text-primary-400 uppercase tracking-wider">FEATURED</span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mt-2 mb-4">
          Editor's <span class="text-primary-600 dark:text-primary-400">Picks</span>
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-300">
          Hand-picked articles you shouldn't miss
        </p>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div v-for="n in 2" :key="n" class="bg-white dark:bg-gray-800 rounded-2xl h-96 animate-pulse"></div>
      </div>

      <!-- Featured Articles with Swiper -->
      <div v-else-if="featuredArticles.length" class="relative">
        <Swiper
          :modules="[Navigation, Pagination, Autoplay]"
          :slides-per-view="1"
          :space-between="20"
          :navigation="true"
          :pagination="{ clickable: true }"
          :autoplay="{ delay: 6000, disableOnInteraction: false }"
          :breakpoints="{
            768: { slidesPerView: 2, spaceBetween: 20 }
          }"
          class="featured-articles-swiper"
        >
          <SwiperSlide v-for="article in featuredArticles" :key="article.id">
            <div 
              @click="navigateToArticle(article.slug)"
              class="group bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 cursor-pointer"
            >
              <!-- Image -->
              <div class="relative h-56 overflow-hidden">
                <img 
                  :src="article.featured_image || 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'" 
                  :alt="article.title"
                  class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                  @error="handleImageError"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                
                <!-- Category Badge -->
                <div class="absolute top-4 left-4">
                  <span class="px-3 py-1 bg-primary-600 text-white text-xs font-medium rounded-full">
                    {{ article.category?.name || 'Featured' }}
                  </span>
                </div>

                <!-- Reading Time -->
                <div class="absolute bottom-4 right-4">
                  <span class="px-3 py-1 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-xs font-medium rounded-full">
                    {{ article.reading_time }} min read
                  </span>
                </div>
              </div>

              <!-- Content -->
              <div class="p-6">
                <!-- Title -->
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">
                  {{ article.title }}
                </h3>

                <!-- Excerpt -->
                <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                  {{ article.excerpt }}
                </p>

                <!-- Author and Date -->
                <div class="flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <img 
                      :src="article.user?.profile_picture || 'https://ui-avatars.com/api/?name=' + (article.user?.name || 'Author')"
                      :alt="article.user?.name"
                      class="w-8 h-8 rounded-full object-cover"
                    />
                    <div>
                      <p class="text-sm font-medium text-gray-900 dark:text-white">{{ article.user?.name }}</p>
                      <p class="text-xs text-gray-500 dark:text-gray-400">{{ formatDate(article.published_at) }}</p>
                    </div>
                  </div>

                  <ArrowRightIcon class="w-5 h-5 text-primary-600 dark:text-primary-400 opacity-0 group-hover:opacity-100 transition-opacity" />
                </div>
              </div>
            </div>
          </SwiperSlide>
        </Swiper>
      </div>

      <!-- No Featured Articles -->
      <div v-else class="text-center py-12">
        <p class="text-gray-600 dark:text-gray-400">No featured articles available</p>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Pagination, Autoplay } from 'swiper/modules'
import axios from 'axios'
import { ArrowRightIcon } from '@heroicons/vue/24/outline'

import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'

const router = useRouter()
const featuredArticles = ref([])
const loading = ref(true)

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric'
  })
}

const handleImageError = (e) => {
  e.target.src = 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'
}

const navigateToArticle = (slug) => {
  if (slug) {
    router.push(`/article/${slug}`)
  }
}

const fetchFeaturedArticles = async () => {
  try {
    const response = await axios.get('/api/v1/articles', {
      params: {
        featured: true,
        per_page: 6,
        _: Date.now()
      }
    })

    if (response.data?.data) {
      featuredArticles.value = response.data.data.map(article => ({
        id: article.id,
        title: article.title,
        slug: article.slug,
        excerpt: article.excerpt,
        featured_image: article.featured_image,
        reading_time: article.reading_time,
        published_at: article.published_at,
        category: article.category,
        user: article.user
      }))
    }
  } catch (error) {
    console.error('Failed to fetch featured articles:', error)
    
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchFeaturedArticles()
})
</script>

<style scoped>
.featured-articles-swiper {
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