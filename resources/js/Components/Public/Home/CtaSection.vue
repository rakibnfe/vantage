<!-- resources/js/Components/Public/Home/CtaSection.vue -->
<template>
  <section class="relative py-32 overflow-hidden">
    <!-- Animated gradient background -->
    <div class="absolute inset-0 bg-gradient-to-r from-primary-600 to-purple-600 dark:from-primary-900 dark:to-purple-900">
      <div class="absolute inset-0 opacity-30">
        <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-yellow-300 rounded-full blur-3xl animate-float-delayed"></div>
      </div>
    </div>

    <!-- Grid overlay -->
    <div class="absolute inset-0 opacity-10" 
         style="background-image: linear-gradient(to right, white 1px, transparent 1px), linear-gradient(to bottom, white 1px, transparent 1px); background-size: 50px 50px;">
    </div>

    <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
      <!-- Badge -->
      <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md rounded-full text-white border border-white/20 mb-8 animate-fade-in-up">
        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
        <span class="text-sm">Limited slots available for Q2 2026</span>
      </div>

      <!-- Main heading -->
      <h2 class="text-4xl md:text-6xl font-bold text-white mb-6">
        <span class="inline-block animate-fade-in-up">Ready to</span>
        <span class="inline-block animate-fade-in-up animation-delay-200 text-yellow-300"> build </span>
        <span class="inline-block animate-fade-in-up animation-delay-400">something</span>
        <br />
        <span class="inline-block animate-fade-in-up animation-delay-600 text-yellow-300">amazing?</span>
      </h2>

      <!-- Description -->
      <p class="text-xl md:text-2xl text-white/90 mb-12 max-w-2xl mx-auto animate-fade-in-up animation-delay-800">
        Let's collaborate and turn your ideas into powerful, scalable web applications that users will love.
      </p>

      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up animation-delay-1000">
        <router-link to="/contact" 
                     class="group relative px-10 py-5 bg-white text-primary-700 rounded-2xl font-bold text-lg overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-black/20">
          <span class="relative z-10">Start Your Project</span>
        </router-link>
        
        <router-link to="/schedule" 
                     class="group relative px-10 py-5 bg-transparent border-2 border-white text-white rounded-2xl font-bold text-lg overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-black/20">
          <span class="relative z-10 flex items-center gap-2">
            Schedule a Call
            <CalendarIcon class="w-5 h-5 group-hover:rotate-12 transition-transform" />
          </span>
        </router-link>
      </div>
    </div>
  </section>
</template>

<script setup>
import { CalendarIcon } from '@heroicons/vue/24/outline'  // ✅ Import CalendarIcon
</script>