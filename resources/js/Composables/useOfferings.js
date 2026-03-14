import { ref, computed } from 'vue';
import { api } from '../Api/offerings.js';

export function useOfferings() {
  const offerings = ref([]);
  const loading = ref(false);
  const error = ref(null);

  const fetchOfferings  = async () => {
    loading.value = true;
    error.value = null;
    try {
      offerings.value = await api.get('/api/offerings');
    } catch (err) {
      error.value = err.message;
    } finally {
      loading.value = false;
    }
  };

  const getOfferingBySlug = async (slug) => {
    loading.value = true;
    error.value = null;
    try {
      return await api.get(`/api/offerings/${slug}`);
    } catch (err) {
      error.value = err.message;
      return null;
    } finally {
      loading.value = false;
    }
  };

  return {
    offerings: computed(() => offerings.value),
    loading: computed(() => loading.value),
    error: computed(() => error.value),
    fetchOfferings,
    getOfferingBySlug,
  };
}
