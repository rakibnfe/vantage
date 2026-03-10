<!-- resources/js/Layouts/PublicLayout.vue -->
<template>
  <div class="min-h-screen bg-white dark:bg-gray-950 transition-colors duration-300">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border-b border-gray-200 dark:border-gray-800">
      <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
        <!-- Logo -->
        <router-link to="/" class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-purple-600 bg-clip-text text-transparent">
          Vantage
        </router-link>

        <!-- Desktop Navigation -->
        <ul class="hidden md:flex items-center gap-8">
          <li v-for="item in navItems" :key="item.path">
            <router-link 
              :to="item.path"
              class="text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors"
              :class="{ 'text-primary-600 dark:text-primary-400 font-medium': $route.path.startsWith(item.path) }"
            >
              {{ item.name }}
            </router-link>
          </li>
        </ul>

        <!-- Theme Toggle -->
        <button 
          @click="toggleTheme" 
          class="w-10 h-10 rounded-xl bg-gray-100 dark:bg-gray-800 flex items-center justify-center hover:scale-110 transition-transform"
        >
          <SunIcon v-if="!theme.isDark" class="w-5 h-5 text-yellow-500" />
          <MoonIcon v-else class="w-5 h-5 text-blue-400" />
        </button>
      </nav>
    </header>

    <!-- Main Content - THIS IS THE KEY FIX: only one router-view -->
    <main class="min-h-[calc(100vh-64px)]">
      <router-view />
    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center text-gray-600 dark:text-gray-400">
          <p>&copy; {{ currentYear }} Vantage. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { useThemeStore } from '@/Stores/theme'
import { SunIcon, MoonIcon } from '@heroicons/vue/24/outline'

const route = useRoute()
const theme = useThemeStore()

const navItems = [
  { name: 'Work', path: '/work' },
  { name: 'Services', path: '/services' },
  { name: 'Notes', path: '/notes' },
  { name: 'Tools', path: '/tools' },
  { name: 'About', path: '/about' }
]

const currentYear = computed(() => new Date().getFullYear())

const toggleTheme = () => {
  theme.toggleTheme()
  if (theme.isDark) {
    document.documentElement.classList.add('dark')
  } else {
    document.documentElement.classList.remove('dark')
  }
}
</script>