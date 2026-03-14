import { defineStore } from 'pinia';

export const useOfferingsStore = defineStore('offerings', {
  state: () => ({
    offerings: [],
    loading: false,
    error: null,
    selectedOffering: null,
  }),

  getters: {
    getAllOfferings: (state) => state.offerings,
    getOfferingBySlug: (state) => (slug) =>
      state.offerings.find((offering) => offering.slug === slug),
    isLoading: (state) => state.loading,
    hasError: (state) => !!state.error,
  },

  actions: {
    async fetchOfferings() {
      this.loading = true;
      try {
        const response = await fetch('/api/offerings');
        const data = await response.json();
        this.offerings = data;
        this.error = null;
      } catch (err) {
        this.error = err.message;
      } finally {
        this.loading = false;
      }
    },

    setOfferings(offerings) {
      this.offerings = offerings;
    },

    selectOffering(offering) {
      this.selectedOffering = offering;
    },

    setError(error) {
      this.error = error;
    },
  },
});
