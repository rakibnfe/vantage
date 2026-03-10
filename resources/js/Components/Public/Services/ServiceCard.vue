<template>
  <div :class="[
    'bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden group cursor-pointer',
    viewMode === 'list' ? 'flex' : ''
  ]" @click="navigateToService">
    <!-- Icon/Image -->
    <div :class="[
      'bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center',
      viewMode === 'list' ? 'w-24 h-24 m-4 rounded-xl' : 'p-6'
    ]">
      <component 
        :is="iconMap[service.icon] || Squares2X2Icon" 
        :class="viewMode === 'list' ? 'h-10 w-10' : 'h-12 w-12'"
        class="text-white"
      />
    </div>

    <!-- Content -->
    <div :class="['flex-1 p-6', viewMode === 'list' ? 'pl-0' : '']">
      <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
        {{ service.title }}
      </h3>
      
      <p v-if="service.tagline" class="text-sm text-primary-600 dark:text-primary-400 mb-3">
        {{ service.tagline }}
      </p>
      
      <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-2">
        {{ service.description }}
      </p>

      <!-- Features -->
      <div v-if="service.features?.length" class="flex flex-wrap gap-2 mb-4">
        <span 
          v-for="feature in service.features.slice(0, 3)" 
          :key="feature"
          class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded-full text-gray-700 dark:text-gray-300"
        >
          {{ feature }}
        </span>
        <span 
          v-if="service.features.length > 3"
          class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-xs rounded-full text-gray-700 dark:text-gray-300"
        >
          +{{ service.features.length - 3 }} more
        </span>
      </div>

      <!-- Footer -->
      <div class="flex items-center justify-between">
        <span class="text-sm font-medium text-primary-600 dark:text-primary-400">
          {{ service.price }}
        </span>
        <span class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 group-hover:text-primary-600 transition-colors">
          Learn more
          <ArrowRightIcon class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" />
        </span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import {
  Squares2X2Icon,
  CodeBracketIcon,
  DevicePhoneMobileIcon,
  PaintBrushIcon,
  ChatBubbleBottomCenterTextIcon,
  CloudIcon,
  ShoppingCartIcon,
  ChartBarIcon,
  ArrowRightIcon
} from '@heroicons/vue/24/outline'

const props = defineProps({
  service: {
    type: Object,
    required: true
  },
  viewMode: {
    type: String,
    default: 'grid'
  }
})

const router = useRouter()

const iconMap = {
  'code': CodeBracketIcon,
  'mobile': DevicePhoneMobileIcon,
  'design': PaintBrushIcon,
  'consulting': ChatBubbleBottomCenterTextIcon,
  'cloud': CloudIcon,
  'cart': ShoppingCartIcon,
  'chart': ChartBarIcon,
  'code-bracket': CodeBracketIcon
}

const navigateToService = () => {
  router.push(`/services/${props.service.slug}`)
}
</script>