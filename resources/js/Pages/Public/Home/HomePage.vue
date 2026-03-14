<!-- resources/js/Pages/Public/Home/HomePage.vue -->
<template>
  <div>
    <!-- Hero Section -->
    <HeroSection />
    
    <!-- Featured Projects with Carousel -->
    <FeaturedProjects />
    
    <!-- Offerings -->
    <OfferingsOverview />
    
    <!-- Recent Articles -->
    <RecentArticles />

    <!-- Featured Articles -->
    <FeaturedArticles />
    
    <!-- Tools -->
    <ToolsGrid />
    
    <!-- Testimonials -->
    <TestimonialsCarousel />
    
    <!-- CTA -->
    <CtaSection />
  </div>
</template>

<script setup>
import HeroSection from '@/Components/Public/Home/HeroSection.vue'
import FeaturedProjects from '@/Components/Public/Home/FeaturedProjects.vue'
import OfferingsOverview from '@/Components/Public/Home/OfferingsOverview.vue'
import RecentArticles from '@/Components/Public/Home/RecentArticles.vue'
import FeaturedArticles from '@/Components/Public/Home/FeaturedArticles.vue'

import ToolsGrid from '@/Components/Public/Home/ToolsGrid.vue'
import TestimonialsCarousel from '@/Components/Public/Home/TestimonialsCarousel.vue'
import CtaSection from '@/Components/Public/Home/CtaSection.vue'
</script>