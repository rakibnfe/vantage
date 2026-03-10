<!-- resources/js/Components/Public/Navigation/MobileBottomNav.vue -->
<template>
  <nav class="fixed bottom-0 left-0 right-0 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border-t border-gray-200 dark:border-gray-800 md:hidden z-50 safe-bottom">
    <div class="flex justify-around items-center h-16">
      <router-link v-for="item in navItems" 
                   :key="item.path"
                   :to="item.path"
                   class="flex flex-col items-center justify-center w-full h-full transition-all duration-200 relative group"
                   :class="[$route.path === item.path ? 'text-primary-600 dark:text-primary-400' : 'text-gray-600 dark:text-gray-400']">
        
        <!-- Active indicator dot -->
        <span v-if="$route.path === item.path" 
              class="absolute -top-1 w-1 h-1 bg-primary-600 dark:bg-primary-400 rounded-full"></span>
        
        <!-- Icon with hover effect -->
        <component :is="item.icon" 
                   class="w-6 h-6 group-hover:scale-110 group-hover:-translate-y-0.5 transition-transform" 
                   :class="{ 'animate-bounce-subtle': $route.path === item.path }" />
        
        <!-- Label -->
        <span class="text-xs mt-1 font-medium">{{ item.name }}</span>
        
        <!-- Hover background -->
        <span class="absolute inset-0 bg-primary-100 dark:bg-primary-900/20 opacity-0 group-hover:opacity-100 transition-opacity -z-10 rounded-t-2xl"></span>
      </router-link>
    </div>
  </nav>
</template>

<script setup>
import { HomeIcon, BriefcaseIcon, DocumentTextIcon, EnvelopeIcon } from '@heroicons/vue/24/outline'
import { useRoute } from 'vue-router'

const route = useRoute()

const navItems = [
  { name: 'Home', path: '/', icon: HomeIcon },
  { name: 'Work', path: '/work', icon: BriefcaseIcon },
  { name: 'Notes', path: '/notes', icon: DocumentTextIcon },
  { name: 'Contact', path: '/contact', icon: EnvelopeIcon }
]
</script>

<style scoped>
/* Safe area for notched phones */
.safe-bottom {
  padding-bottom: env(safe-area-inset-bottom, 0);
}

@keyframes bounce-subtle {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-2px); }
}

.animate-bounce-subtle {
  animation: bounce-subtle 1s ease-in-out infinite;
}
</style>