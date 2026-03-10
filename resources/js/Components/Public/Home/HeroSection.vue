<!-- resources/js/Components/Public/Home/HeroSection.vue -->
<template>
  <section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-primary-600 via-purple-600 to-pink-600 dark:from-primary-950 dark:via-purple-950 dark:to-pink-950">
    <!-- Background Elements -->
    <div class="absolute inset-0 opacity-30">
      <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full mix-blend-overlay filter blur-3xl animate-float"></div>
      <div class="absolute bottom-20 right-10 w-96 h-96 bg-yellow-300 rounded-full mix-blend-overlay filter blur-3xl animate-float-delayed"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
      <!-- Badge -->
      <div class="inline-flex items-center px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 text-white text-sm mb-8">
        <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
        Available for freelance work
      </div>

      <!-- Main Heading - FIXED: now using flex wrap to prevent overflow -->
      <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white mb-6 leading-tight">
        <span class="inline-block">Building</span>
        <span class="inline-block text-yellow-300 mx-2">digital</span>
        <span class="inline-block">experiences</span>
        <br class="hidden sm:block" />
        <span class="inline-block mt-2">that matter</span>
      </h1>

      <!-- Description - FIXED: max width and proper padding -->
      <p class="max-w-2xl mx-auto text-lg sm:text-xl md:text-2xl text-white/90 mb-12 px-4">
        Full-stack developer crafting exceptional web applications 
        <span class="relative inline-block">
          with Laravel & Vue.js
        </span>
      </p>

      <!-- CTA Buttons - FIXED: stack on mobile, row on desktop -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center px-4">
        <router-link
          to="/work"
          class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-white text-gray-900 rounded-xl font-semibold hover:scale-105 transition-transform shadow-lg"
        >
          View My Work
        </router-link>
        
        <router-link
          to="/contact"
          class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-transparent border-2 border-white text-white rounded-xl font-semibold hover:bg-white/10 transition-all"
        >
          Let's Talk
        </router-link>
      </div>
    </div>
  </section>
</template>

<script setup>
// No script needed for this component
</script>

<style scoped>
@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}

@keyframes float-delayed {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-30px); }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes scroll {
  0% { transform: translateY(0); opacity: 1; }
  100% { transform: translateY(20px); opacity: 0; }
}

.animate-float {
  animation: float 6s ease-in-out infinite;
}

.animate-float-delayed {
  animation: float-delayed 8s ease-in-out infinite;
}

.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out forwards;
  opacity: 0;
}

.animate-scroll {
  animation: scroll 1.5s ease-in-out infinite;
}

.animation-delay-200 { animation-delay: 0.2s; }
.animation-delay-400 { animation-delay: 0.4s; }
.animation-delay-600 { animation-delay: 0.6s; }
.animation-delay-800 { animation-delay: 0.8s; }
.animation-delay-1000 { animation-delay: 1s; }
.animation-delay-1200 { animation-delay: 1.2s; }
.animation-delay-2000 { animation-delay: 2s; }
</style>