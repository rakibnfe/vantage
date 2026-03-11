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
          <!-- Add dropdown for Resources -->
          <li class="relative group">
            <button class="text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors flex items-center gap-1">
              Resources
              <ChevronDownIcon class="w-4 h-4" />
            </button>
            <!-- Dropdown Menu -->
            <div class="absolute top-full left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
              <div class="py-2">
                <router-link to="/faq" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary-600 dark:hover:text-primary-400">
                  FAQ
                </router-link>
                <router-link to="/pricing" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary-600 dark:hover:text-primary-400">
                  Pricing
                </router-link>
                <router-link to="/process" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-primary-600 dark:hover:text-primary-400">
                  Our Process
                </router-link>
              </div>
            </div>
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

    <!-- Main Content -->
    <main class="min-h-[calc(100vh-64px)]">
      <router-view />
    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <!-- Company Info -->
          <div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Vantage</h3>
            <p class="text-gray-600 dark:text-gray-400 text-sm">Building amazing digital experiences</p>
          </div>
          
          <!-- Quick Links -->
          <div>
            <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Quick Links</h4>
            <ul class="space-y-2">
              <li><router-link to="/work" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 text-sm">Work</router-link></li>
              <li><router-link to="/services" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 text-sm">Services</router-link></li>
              <li><router-link to="/articles" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 text-sm">Articles</router-link></li>
              <li><router-link to="/about" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 text-sm">About</router-link></li>
            </ul>
          </div>
          
          <!-- Resources -->
          <div>
            <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Resources</h4>
            <ul class="space-y-2">
              <li><router-link to="/faq" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 text-sm">FAQ</router-link></li>
              <li><router-link to="/pricing" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 text-sm">Pricing</router-link></li>
              <li><router-link to="/process" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 text-sm">Our Process</router-link></li>
              <li><router-link to="/tools" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 text-sm">Tools</router-link></li>
            </ul>
          </div>
          
          <!-- Contact -->
          <div>
            <h4 class="font-semibold text-gray-900 dark:text-white mb-4">Contact</h4>
            <ul class="space-y-2">
              <li><router-link to="/contact" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 text-sm">Get in Touch</router-link></li>
              <li><router-link to="/schedule" class="text-gray-600 dark:text-gray-400 hover:text-primary-600 text-sm">Schedule Call</router-link></li>
            </ul>
          </div>
        </div>
        
        <div class="text-center text-gray-600 dark:text-gray-400 mt-8 pt-8 border-t border-gray-200 dark:border-gray-800">
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
import { SunIcon, MoonIcon, ChevronDownIcon } from '@heroicons/vue/24/outline'

const route = useRoute()
const theme = useThemeStore()

const navItems = [
  { name: 'Work', path: '/work' },
  { name: 'Services', path: '/services' },
  { name: 'Articles', path: '/articles' },
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