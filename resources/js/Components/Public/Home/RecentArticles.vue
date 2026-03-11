<template>
  <section class="py-24 bg-white dark:bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Section Header -->
      <div class="text-center mb-16">
        <span class="text-sm font-semibold text-primary-600 dark:text-primary-400 uppercase tracking-widest">
          Blog & Insights
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mt-4">
          Latest <span class="text-primary-600 dark:text-primary-400">Articles</span>
        </h2>
        <p class="text-xl text-gray-600 dark:text-gray-400 mt-4 max-w-2xl mx-auto">
          Thoughts, tutorials, and insights from our team
        </p>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div v-for="n in 3" :key="n" class="bg-gray-100 dark:bg-gray-800 rounded-3xl h-96 animate-pulse"></div>
      </div>

      <!-- Articles Grid -->
      <div v-else-if="articles.length" class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <article v-for="article in articles" 
                 :key="article.id"
                 @click="navigateToArticle(article.slug)"
                 class="group bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 cursor-pointer">
          
          <!-- Image -->
          <div class="relative h-48 overflow-hidden">
            <img :src="article.featured_image || 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'" 
                 :alt="article.title"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                 loading="lazy"
                 @error="handleImageError" />
            
            <!-- Category Badge -->
            <div class="absolute top-4 left-4">
              <span class="px-3 py-1 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-xs font-medium rounded-full">
                {{ article.category?.name || 'Uncategorized' }}
              </span>
            </div>
          </div>

          <!-- Content -->
          <div class="p-6">
            <!-- Meta Info -->
            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-3">
              <span>{{ formatDate(article.published_at) }}</span>
              <span>•</span>
              <span>{{ article.reading_time }} min read</span>
            </div>

            <!-- Title -->
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2">
              {{ article.title }}
            </h3>

            <!-- Excerpt -->
            <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
              {{ article.excerpt }}
            </p>

            <!-- Author -->
            <div class="flex items-center gap-2 mb-4">
              <img 
                :src="article.user?.profile_picture || 'https://ui-avatars.com/api/?name=' + (article.user?.name || 'Author')"
                :alt="article.user?.name"
                class="w-6 h-6 rounded-full object-cover"
              />
              <span class="text-sm text-gray-700 dark:text-gray-300">{{ article.user?.name || 'Anonymous' }}</span>
            </div>

            <!-- Tags -->
            <div class="flex flex-wrap gap-2 mb-4">
              <span 
                v-for="tag in article.tags?.slice(0, 2)" 
                :key="tag.id"
                class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded-full text-gray-600 dark:text-gray-300"
              >
                #{{ tag.name }}
              </span>
              <span v-if="article.tags?.length > 2" class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded-full text-gray-600 dark:text-gray-300">
                +{{ article.tags.length - 2 }}
              </span>
            </div>

            <!-- Read More -->
            <div class="inline-flex items-center text-primary-600 dark:text-primary-400 font-medium group/link">
              Read Article
              <ArrowRightIcon class="w-4 h-4 ml-2 group-hover/link:translate-x-2 transition-transform" />
            </div>
          </div>
        </article>
      </div>

      <!-- No Articles -->
      <div v-else class="text-center py-12">
        <DocumentTextIcon class="w-16 h-16 text-gray-400 mx-auto mb-4" />
        <p class="text-gray-600 dark:text-gray-400">No articles available</p>
      </div>

      <!-- View All Link -->
      <div class="text-center mt-12">
        <router-link to="/articles" 
                     class="inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 font-semibold hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
          Read All Articles
          <ArrowRightIcon class="w-5 h-5" />
        </router-link>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
import { ArrowRightIcon, DocumentTextIcon } from '@heroicons/vue/24/outline'

const router = useRouter()
const articles = ref([])
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

const fetchArticles = async () => {
  try {
    const response = await axios.get('/api/v1/articles', {
      params: {
        per_page: 3,
        _: Date.now()
      }
    })

    if (response.data?.data) {
      articles.value = response.data.data.map(article => ({
        id: article.id,
        title: article.title,
        slug: article.slug,
        excerpt: article.excerpt,
        featured_image: article.featured_image,
        reading_time: article.reading_time,
        published_at: article.published_at,
        category: article.category,
        user: article.user,
        tags: article.tags || []
      }))
    }
  } catch (error) {
    console.error('Failed to fetch articles:', error)
    // Fallback to sample data
   
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  fetchArticles()
})
</script>

<style scoped>
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