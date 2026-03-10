<template>
  <div class="min-h-screen bg-white dark:bg-slate-900 transition-colors">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white dark:bg-slate-800 shadow-sm">
      <nav class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
        <router-link to="/" class="text-2xl font-bold text-slate-900 dark:text-white">
          Vantage
        </router-link>
        <ul class="hidden md:flex items-center space-x-8">
          <li><router-link to="/work" class="hover:text-blue-600 dark:hover:text-blue-400">Work</router-link></li>
          <li><router-link to="/services" class="hover:text-blue-600 dark:hover:text-blue-400">Services</router-link></li>
          <li><router-link to="/notes" class="hover:text-blue-600 dark:hover:text-blue-400">Notes</router-link></li>
          <li><router-link to="/tools" class="hover:text-blue-600 dark:hover:text-blue-400">Tools</router-link></li>
          <li><router-link to="/about" class="hover:text-blue-600 dark:hover:text-blue-400">About</router-link></li>
        </ul>
        <button @click="toggleTheme" class="p-2 rounded-lg bg-slate-100 dark:bg-slate-700">
          <span v-if="theme.isDark">☀️</span>
          <span v-else>🌙</span>
        </button>
      </nav>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <router-view />
    </main>

    <!-- Footer -->
    <footer class="bg-slate-50 dark:bg-slate-800 border-t dark:border-slate-700 mt-20">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-8">
          <div>
            <h4 class="font-semibold mb-4">Work</h4>
            <ul class="space-y-2">
              <li><router-link to="/work" class="text-slate-600 dark:text-slate-400 hover:text-blue-600">Projects</router-link></li>
              <li><router-link to="/services" class="text-slate-600 dark:text-slate-400 hover:text-blue-600">Services</router-link></li>
            </ul>
          </div>
          <div>
            <h4 class="font-semibold mb-4">Learn</h4>
            <ul class="space-y-2">
              <li><router-link to="/notes" class="text-slate-600 dark:text-slate-400 hover:text-blue-600">Articles</router-link></li>
              <li><router-link to="/tools" class="text-slate-600 dark:text-slate-400 hover:text-blue-600">Tools</router-link></li>
            </ul>
          </div>
          <div>
            <h4 class="font-semibold mb-4">About</h4>
            <ul class="space-y-2">
              <li><router-link to="/about" class="text-slate-600 dark:text-slate-400 hover:text-blue-600">About</router-link></li>
              <li><router-link to="/now" class="text-slate-600 dark:text-slate-400 hover:text-blue-600">Now</router-link></li>
              <li><router-link to="/uses" class="text-slate-600 dark:text-slate-400 hover:text-blue-600">Uses</router-link></li>
            </ul>
          </div>
          <div>
            <h4 class="font-semibold mb-4">Legal</h4>
            <ul class="space-y-2">
              <li><router-link to="/privacy" class="text-slate-600 dark:text-slate-400 hover:text-blue-600">Privacy</router-link></li>
              <li><router-link to="/terms" class="text-slate-600 dark:text-slate-400 hover:text-blue-600">Terms</router-link></li>
            </ul>
          </div>
        </div>
        <div class="border-t dark:border-slate-700 pt-8 text-center text-slate-600 dark:text-slate-400">
          <p>&copy; 2024 Vantage. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { useThemeStore } from '../Stores/theme.js';

const theme = useThemeStore();

const toggleTheme = () => {
  theme.toggleTheme();
};
</script>

<style scoped>
/* Add any layout-specific styles here */
</style>
