<template>
  <PublicLayout>
    <!-- Page Header -->
    <!-- Service Cards (Dynamic from DB) -->
    <!-- Consultation CTA -->
  </PublicLayout>
</template>

<script setup>
import PublicLayout from '@/Layouts/PublicLayout.vue';
import { ref, onMounted } from 'vue';

const services = ref([]);
const loading = ref(true);

onMounted(async () => {
  try {
    const response = await fetch('/api/services');
    services.value = await response.json();
  } catch (error) {
    console.error('Error fetching services:', error);
  } finally {
    loading.value = false;
  }
});
</script>

<style scoped>
/* ServicesListPage styles */
</style>
