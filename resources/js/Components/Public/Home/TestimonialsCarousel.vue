<!-- resources/js/Components/Public/Home/TestimonialsCarousel.vue -->
<template>
  <section class="py-24 bg-gradient-to-br from-primary-50 to-purple-50 dark:from-gray-900 dark:to-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <!-- Section Header -->
      <div class="text-center mb-16">
        <span class="text-sm font-semibold text-primary-600 dark:text-primary-400 uppercase tracking-wider">
          TESTIMONIALS
        </span>
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mt-4">
          Client <span class="text-primary-600 dark:text-primary-400">Feedback</span>
        </h2>
      </div>

      <!-- Testimonials Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div v-for="testimonial in testimonials" 
             :key="testimonial.id"
             class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-300">
          
          <!-- Quote -->
          <div class="text-5xl text-primary-200 dark:text-primary-900 mb-4">"</div>
          
          <!-- Content -->
          <p class="text-gray-700 dark:text-gray-300 text-lg mb-6 italic">
            {{ testimonial.content }}
          </p>

          <!-- Author -->
          <div class="flex items-center">
            <div class="w-12 h-12 rounded-full bg-gradient-to-r from-primary-500 to-purple-500 flex items-center justify-center text-white font-bold text-xl">
              {{ testimonial.initials }}
            </div>
            <div class="ml-4">
              <h4 class="font-bold text-gray-900 dark:text-white">{{ testimonial.name }}</h4>
              <p class="text-sm text-gray-500 dark:text-gray-400">{{ testimonial.role }}</p>
            </div>
          </div>

          <!-- Rating -->
          <div class="flex mt-4 text-yellow-400">
            <StarIcon v-for="n in 5" :key="n" class="w-5 h-5 fill-current" />
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { StarIcon } from '@heroicons/vue/24/solid'

const testimonials = [
  {
    id: 1,
    content: "An exceptional developer who delivered beyond expectations. The project was completed on time with perfect communication.",
    name: "John Doe",
    role: "CEO, TechCorp",
    initials: "JD"
  },
  {
    id: 2,
    content: "Working with them was a game-changer. They understood our vision and brought it to life with clean, maintainable code.",
    name: "Jane Smith",
    role: "Founder, StartupX",
    initials: "JS"
  },
  {
    id: 3,
    content: "Technical expertise combined with great communication. They always found solutions to complex problems.",
    name: "Mike Brown",
    role: "Product Manager, DevInc",
    initials: "MB"
  }
]
</script>