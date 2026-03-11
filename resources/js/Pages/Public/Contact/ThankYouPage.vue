<!-- resources/js/Pages/Public/Contact/ThankYouPage.vue -->
<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-20">
    <div class="max-w-2xl mx-auto px-4 text-center">
      <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-12">
        <div class="w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
          <CheckCircleIcon class="w-10 h-10 text-green-600 dark:text-green-400" />
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
          Thank You!
        </h1>
        
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
          Your message has been sent successfully. We'll get back to you within 24-48 hours.
        </p>
        
        <div class="flex gap-4 justify-center">
          <router-link 
            to="/"
            class="px-6 py-3 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition"
          >
            Go to Homepage
          </router-link>
          
          <router-link 
            to="/work"
            class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition"
          >
            View Our Work
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { CheckCircleIcon } from '@heroicons/vue/24/outline'
</script>