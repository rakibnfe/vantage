import { ref, computed } from 'vue';
import { api } from '../Api/services.js';

export function useServices() {
  const services = ref([]);
  const loading = ref(false);
  const error = ref(null);

  const fetchServices = async () => {
    loading.value = true;
    error.value = null;
    try {
      services.value = await api.get('/api/services');
    } catch (err) {
      error.value = err.message;
    } finally {
      loading.value = false;
    }
  };

  const getServiceBySlug = async (slug) => {
    loading.value = true;
    error.value = null;
    try {
      return await api.get(`/api/services/${slug}`);
    } catch (err) {
      error.value = err.message;
      return null;
    } finally {
      loading.value = false;
    }
  };

  return {
    services: computed(() => services.value),
    loading: computed(() => loading.value),
    error: computed(() => error.value),
    fetchServices,
    getServiceBySlug,
  };
}
