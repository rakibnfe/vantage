<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Loading State -->
    <div v-if="loading" class="min-h-screen flex items-center justify-center">
      <div class="text-center">
        <div class="w-16 h-16 border-4 border-primary-600 border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
        <p class="text-gray-600 dark:text-gray-400">Loading article...</p>
      </div>
    </div>

    <!-- Error State -->
    <div v-else-if="error" class="min-h-screen flex items-center justify-center">
      <div class="text-center max-w-lg mx-auto px-4">
        <div class="w-20 h-20 mx-auto bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mb-6">
          <ExclamationTriangleIcon class="w-10 h-10 text-red-600 dark:text-red-400" />
        </div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Article Not Found</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">{{ error }}</p>
        <div class="flex gap-4 justify-center">
          <router-link 
            to="/articles" 
            class="px-6 py-3 bg-gray-600 text-white rounded-xl hover:bg-gray-700 transition"
          >
            Back to Articles
          </router-link>
          <button 
            @click="fetchArticle" 
            class="px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition"
          >
            Try Again
          </button>
        </div>
      </div>
    </div>

    <!-- Article Content -->
    <div v-else-if="article" class="pb-16">
      <!-- Hero Section -->
      <section class="relative overflow-hidden bg-gradient-to-br from-primary-600 to-primary-800 dark:from-primary-800 dark:to-primary-900 text-white">
        <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:60px_60px]"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-primary-900/50 to-transparent"></div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
          <div class="mb-8">
            <router-link 
              to="/articles" 
              class="inline-flex items-center gap-2 text-primary-100 hover:text-white transition group"
            >
              <ChevronLeftIcon class="w-5 h-5 group-hover:-translate-x-1 transition-transform" />
              <span>Back to Articles</span>
            </router-link>
          </div>

          <!-- Category -->
          <div class="mb-4">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-sm font-medium">
              {{ article.category?.name || 'Uncategorized' }}
            </span>
          </div>

          <h1 class="text-4xl md:text-5xl font-bold mb-6">
            {{ article.title }}
          </h1>

          <!-- Meta Info -->
          <div class="flex items-center gap-6 text-primary-100">
            <div class="flex items-center gap-2">
              <img 
                :src="article.user?.profile_picture || 'https://ui-avatars.com/api/?name=' + (article.user?.name || 'Author')"
                :alt="article.user?.name"
                class="w-10 h-10 rounded-full border-2 border-white/20"
              />
              <div>
                <p class="font-medium text-white">{{ article.user?.name || 'Anonymous' }}</p>
                <p class="text-sm text-primary-200">{{ article.user?.role || 'Author' }}</p>
              </div>
            </div>
            <div class="flex items-center gap-2">
              <CalendarIcon class="w-5 h-5" />
              <span>{{ formatDate(article.published_at) }}</span>
            </div>
            <div class="flex items-center gap-2">
              <ClockIcon class="w-5 h-5" />
              <span>{{ article.reading_time }} min read</span>
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

      <!-- Featured Image -->
      <div v-if="article.featured_image" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 mb-12 relative z-10">
        <img 
          :src="article.featured_image"
          :alt="article.title"
          class="w-full h-[400px] object-cover rounded-2xl shadow-2xl"
          @error="handleImageError"
        />
      </div>

      <!-- Article Content -->
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Tags -->
        <div v-if="article.tags?.length" class="mb-8">
          <div class="flex flex-wrap gap-2">
            <span 
              v-for="tag in article.tags" 
              :key="tag.id"
              class="px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-full text-sm text-gray-700 dark:text-gray-300 hover:bg-primary-100 dark:hover:bg-primary-900/30 transition cursor-pointer"
              @click="navigateToTag(tag.name)"
            >
              #{{ tag.name }}
            </span>
          </div>
        </div>

        <!-- Content -->
        <article class="prose prose-lg dark:prose-invert max-w-none mb-12">
          <div v-html="article.content"></div>
        </article>

        <!-- Share Section -->
        <div class="border-t border-gray-200 dark:border-gray-700 pt-8 mb-12">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
              <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Share this article:</span>
              <div class="flex gap-2">
                <button @click="shareOnTwitter" class="p-2 bg-gray-100 dark:bg-gray-800 rounded-lg hover:bg-primary-100 dark:hover:bg-primary-900/30 transition">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </button>
                <button @click="shareOnLinkedIn" class="p-2 bg-gray-100 dark:bg-gray-800 rounded-lg hover:bg-primary-100 dark:hover:bg-primary-900/30 transition">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451c.979 0 1.771-.773 1.771-1.729V1.729C24 .774 23.204 0 22.225 0z"/></svg>
                </button>
                <button @click="shareOnFacebook" class="p-2 bg-gray-100 dark:bg-gray-800 rounded-lg hover:bg-primary-100 dark:hover:bg-primary-900/30 transition">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.879v-6.99h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.99C18.343 21.128 22 16.991 22 12z"/></svg>
                </button>
              </div>
            </div>
            <button @click="copyLink" class="flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-800 rounded-lg hover:bg-primary-100 dark:hover:bg-primary-900/30 transition text-sm">
              <LinkIcon class="w-4 h-4" />
              {{ copied ? 'Copied!' : 'Copy Link' }}
            </button>
          </div>
        </div>

        <!-- Author Bio -->
        <div v-if="article.user" class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-lg mb-12">
          <div class="flex items-start gap-6">
            <img 
              :src="article.user.profile_picture || 'https://ui-avatars.com/api/?name=' + article.user.name"
              :alt="article.user.name"
              class="w-20 h-20 rounded-full object-cover"
            />
            <div>
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-1">
                {{ article.user.name }}
              </h3>
              <p class="text-sm text-primary-600 dark:text-primary-400 mb-3">{{ article.user.role }}</p>
              <p class="text-gray-600 dark:text-gray-400">{{ article.user.bio || 'No bio available.' }}</p>
            </div>
          </div>
        </div>

        <!-- Related Articles -->
        <section v-if="relatedArticles.length" class="mb-12">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Related Articles</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div
              v-for="related in relatedArticles"
              :key="related.id"
              @click="navigateToArticle(related.slug)"
              class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg cursor-pointer transform hover:-translate-y-1 transition-all hover:shadow-xl"
            >
              <img 
                :src="related.featured_image || 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'"
                :alt="related.title"
                class="w-full h-48 object-cover"
                @error="handleImageError"
              />
              <div class="p-4">
                <div class="flex items-center gap-2 mb-2">
                  <span class="text-xs text-primary-600 dark:text-primary-400">{{ related.category?.name }}</span>
                  <span class="text-xs text-gray-500">•</span>
                  <span class="text-xs text-gray-500">{{ related.reading_time }} min read</span>
                </div>
                <h3 class="font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">{{ related.title }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ related.excerpt }}</p>
              </div>
            </div>
          </div>
        </section>

        <!-- Newsletter CTA -->
        <section class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl p-12 text-center text-white">
          <h2 class="text-3xl font-bold mb-4">Enjoyed this article?</h2>
          <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
            Subscribe to our newsletter for more insights and tutorials
          </p>
          <form @submit.prevent="subscribeNewsletter" class="max-w-md mx-auto flex gap-3">
            <input 
              v-model="email"
              type="email"
              placeholder="Enter your email"
              class="flex-1 px-4 py-3 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-white/40"
              required
            />
            <button 
              type="submit"
              class="px-6 py-3 bg-white text-primary-600 rounded-xl font-semibold hover:bg-gray-100 transition"
            >
              Subscribe
            </button>
          </form>
        </section>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'
import {
  ChevronLeftIcon,
  CalendarIcon,
  ClockIcon,
  ExclamationTriangleIcon,
  LinkIcon
} from '@heroicons/vue/24/outline'

const route = useRoute()
const router = useRouter()

const article = ref(null)
const relatedArticles = ref([])
const loading = ref(true)
const error = ref(null)
const email = ref('')
const copied = ref(false)

const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('en-US', {
    month: 'long',
    day: 'numeric',
    year: 'numeric'
  })
}

const handleImageError = (e) => {
  e.target.src = 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&auto=format'
}

const navigateToArticle = (slug) => {
  if (slug) {
    router.push(`/articles/${slug}`)
  }
}

const navigateToTag = (tag) => {
  router.push(`/articles?tag=${tag}`)
}

const shareOnTwitter = () => {
  const text = encodeURIComponent(`Check out this article: ${article.value.title}`)
  const url = encodeURIComponent(window.location.href)
  window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank')
}

const shareOnLinkedIn = () => {
  const url = encodeURIComponent(window.location.href)
  window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank')
}

const shareOnFacebook = () => {
  const url = encodeURIComponent(window.location.href)
  window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank')
}

const copyLink = async () => {
  try {
    await navigator.clipboard.writeText(window.location.href)
    copied.value = true
    setTimeout(() => copied.value = false, 2000)
  } catch (err) {
    console.error('Failed to copy:', err)
  }
}

const subscribeNewsletter = () => {
  console.log('Subscribe:', email.value)
  email.value = ''
  alert('Thank you for subscribing!')
}

const fetchArticle = async () => {
  loading.value = true
  error.value = null
  
  try {
    const slug = route.params.slug
    const response = await axios.get(`/api/v1/articles/${slug}`, {
      params: { _: Date.now() }
    })

    let articleData = null
    if (response.data?.data) {
      articleData = response.data.data
    }

    if (!articleData) {
      throw new Error('Article not found')
    }

    article.value = {
      id: articleData.id,
      title: articleData.title,
      slug: articleData.slug,
      excerpt: articleData.excerpt,
      content: articleData.content,
      featured_image: articleData.featured_image,
      reading_time: articleData.reading_time,
      published_at: articleData.published_at,
      meta_title: articleData.meta_title,
      meta_description: articleData.meta_description,
      category: articleData.category,
      user: articleData.user,
      tags: articleData.tags || []
    }

    document.title = articleData.meta_title || articleData.title
    const metaDescription = document.querySelector('meta[name="description"]')
    if (metaDescription) {
      metaDescription.setAttribute('content', articleData.meta_description || articleData.excerpt)
    }

    await fetchRelatedArticles()

  } catch (err) {
    console.error('Error fetching article:', err)
    error.value = err.response?.data?.message || err.message || 'Failed to load article'
  } finally {
    loading.value = false
  }
}

const fetchRelatedArticles = async () => {
  try {
    const response = await axios.get(`/api/v1/articles/${article.value.id}/related`, {
      params: { limit: 2, _: Date.now() }
    })

    let articlesData = []
    if (response.data?.data) {
      articlesData = response.data.data
    }

    relatedArticles.value = articlesData.map(a => ({
      id: a.id,
      title: a.title,
      slug: a.slug,
      excerpt: a.excerpt,
      featured_image: a.featured_image,
      reading_time: a.reading_time,
      category: a.category
    }))

  } catch (err) {
    console.log('Could not fetch related articles:', err)
    relatedArticles.value = []
  }
}

watch(() => route.params.slug, (newSlug, oldSlug) => {
  if (newSlug && newSlug !== oldSlug) {
    fetchArticle()
  }
})

onMounted(() => {
  fetchArticle()
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