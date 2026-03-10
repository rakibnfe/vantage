<!-- resources/js/Components/Public/Home/RecentArticles.vue -->
<template>
  <section class="py-24 bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Section Header -->
      <div class="text-center mb-16">
        <span class="text-sm font-semibold text-primary-600 dark:text-primary-400 uppercase tracking-widest">
          Blog & Insights
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mt-4">
          Latest <span class="text-primary-600 dark:text-primary-400">Writings</span>
        </h2>
      </div>

      <!-- Articles Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <article v-for="article in articles" 
                 :key="article.id"
                 class="group bg-white dark:bg-gray-800 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
          
          <!-- Image -->
          <div class="relative h-48 overflow-hidden">
            <img :src="article.featured_image" 
                 :alt="article.title"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                 loading="lazy" />
          </div>

          <!-- Content -->
          <div class="p-6">
            <!-- Meta Info -->
            <div class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-3">
              <span>{{ article.date }}</span>
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

            <!-- Read More -->
            <router-link :to="`/notes/${article.slug}`" 
                         class="inline-flex items-center text-primary-600 dark:text-primary-400 font-medium group/link">
              Read Article
              <ArrowRightIcon class="w-4 h-4 ml-2 group-hover/link:translate-x-2 transition-transform" />
            </router-link>
          </div>
        </article>
      </div>

      <!-- View All Link -->
      <div class="text-center mt-12">
        <router-link to="/notes" 
                     class="inline-flex items-center gap-2 text-primary-600 dark:text-primary-400 font-semibold hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
          Read All Articles
          <ArrowRightIcon class="w-5 h-5" />
        </router-link>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ArrowRightIcon } from '@heroicons/vue/24/outline'  // ✅ Import ArrowRightIcon

const articles = [
  {
    id: 1,
    title: 'Getting Started with Laravel 12',
    slug: 'laravel-12-guide',
    excerpt: 'Everything you need to know about Laravel 12 and its new features',
    featured_image: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800&auto=format',
    date: 'Mar 10, 2026',
    reading_time: 8
  },
  {
    id: 2,
    title: 'Vue 3 Composition API Deep Dive',
    slug: 'vue3-composition-api',
    excerpt: 'Master the Composition API with practical examples',
    featured_image: 'https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?w=800&auto=format',
    date: 'Mar 8, 2026',
    reading_time: 12
  },
  {
    id: 3,
    title: 'Database Optimization Tips',
    slug: 'database-optimization',
    excerpt: 'Improve your database performance with these techniques',
    featured_image: 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=800&auto=format',
    date: 'Mar 5, 2026',
    reading_time: 6
  }
]
</script>