<template>
  <div class="space-y-12">
    <!-- Hero Section -->
    <section class="text-center space-y-4 py-12">
      <h1 class="text-5xl md:text-6xl font-bold text-slate-900 dark:text-white">
        Welcome to Vantage
      </h1>
      <p class="text-xl text-slate-600 dark:text-slate-300 max-w-2xl mx-auto">
        Building digital experiences that matter. Software development, design consulting, and custom tools.
      </p>
      <div class="flex gap-4 justify-center pt-4">
        <router-link to="/work" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
          View My Work
        </router-link>
        <router-link to="/contact" class="inline-block px-6 py-3 border-2 border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 dark:hover:bg-slate-800">
          Get in Touch
        </router-link>
      </div>
    </section>

    <!-- Featured Work -->
    <section class="py-8">
      <h2 class="text-3xl font-bold mb-8">Featured Work</h2>
      <p class="text-slate-600 dark:text-slate-400">Featured projects coming soon...</p>
    </section>

    <!-- Services Overview -->
    <section class="py-8">
      <h2 class="text-3xl font-bold mb-8">Services</h2>
      <p class="text-slate-600 dark:text-slate-400">Services coming soon...</p>
    </section>

    <!-- Recent Writings -->
    <section class="py-8">
      <h2 class="text-3xl font-bold mb-8">Recent Writings</h2>
      <p class="text-slate-600 dark:text-slate-400">Articles coming soon...</p>
    </section>

    <!-- Featured Tools -->
    <section class="py-8">
      <h2 class="text-3xl font-bold mb-8">Featured Tools</h2>
      <p class="text-slate-600 dark:text-slate-400">Tools coming soon...</p>
    </section>

    <!-- Newsletter -->
    <section class="bg-blue-50 dark:bg-slate-800 rounded-lg p-12 text-center">
      <h2 class="text-3xl font-bold mb-4">Stay Updated</h2>
      <p class="text-slate-600 dark:text-slate-300 mb-6">Subscribe to get the latest thoughts and tools</p>
      <form @submit.prevent="subscribeNewsletter" class="max-w-md mx-auto flex gap-2">
        <input
          v-model="email"
          type="email"
          placeholder="Enter your email"
          class="flex-1 px-4 py-2 rounded border dark:bg-slate-700 dark:border-slate-600"
          required
        />
        <button
          type="submit"
          class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
        >
          Subscribe
        </button>
      </form>
    </section>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const email = ref('');

const subscribeNewsletter = () => {
  console.log('Subscribing:', email.value);
  email.value = '';
};
</script>
