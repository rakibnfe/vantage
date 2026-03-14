<template>
  <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 mb-8">
    <div class="flex flex-col lg:flex-row lg:items-center gap-4">
      <!-- Search -->
      <div class="flex-1 relative">
        <MagnifyingGlassIcon class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
        <input 
          :value="search"
          @input="$emit('update:search', $event.target.value)"
          type="text"
          placeholder="Search offerings..."
          class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 dark:text-white transition"
        />
      </div>

      <!-- Category Filter -->
      <div class="relative min-w-[200px]">
        <select 
          :value="category"
          @change="$emit('update:category', $event.target.value)"
          class="appearance-none w-full pl-4 pr-10 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 dark:text-white cursor-pointer"
        >
          <option value="">All Categories</option>
          <option v-for="cat in categories" :key="cat.value" :value="cat.value">
            {{ cat.label }}
          </option>
        </select>
        <ChevronDownIcon class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" />
      </div>

      <!-- Sort Dropdown -->
      <div class="relative min-w-[180px]">
        <select 
          :value="sort"
          @change="$emit('update:sort', $event.target.value)"
          class="appearance-none w-full pl-4 pr-10 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 dark:text-white cursor-pointer"
        >
          <option value="featured">Featured First</option>
          <option value="name_asc">Name A-Z</option>
          <option value="name_desc">Name Z-A</option>
          <option value="price_asc">Price: Low to High</option>
        </select>
        <ChevronDownIcon class="absolute right-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" />
      </div>

      <!-- Results Count -->
      <div class="text-sm text-gray-500 dark:text-gray-400 whitespace-nowrap">
        {{ totalResults }} results
      </div>
    </div>
  </div>
</template>

<script setup>
import { MagnifyingGlassIcon, ChevronDownIcon } from '@heroicons/vue/24/outline'

defineProps({
  search: String,
  category: String,
  sort: String,
  categories: Array,
  totalResults: Number
})

defineEmits(['update:search', 'update:category', 'update:sort', 'clear'])
</script>