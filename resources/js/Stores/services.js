import { defineStore } from 'pinia';

export const useServicesStore = defineStore('services', {
  state: () => ({
    services: [],
    loading: false,
    error: null,
    selectedService: null,
  }),

  getters: {
    getAllServices: (state) => state.services,
    getServiceBySlug: (state) => (slug) =>
      state.services.find((service) => service.slug === slug),
    isLoading: (state) => state.loading,
    hasError: (state) => !!state.error,
  },

  actions: {
    async fetchServices() {
      this.loading = true;
      try {
        const response = await fetch('/api/services');
        const data = await response.json();
        this.services = data;
        this.error = null;
      } catch (err) {
        this.error = err.message;
      } finally {
        this.loading = false;
      }
    },

    setServices(services) {
      this.services = services;
    },

    selectService(service) {
      this.selectedService = service;
    },

    setError(error) {
      this.error = error;
    },
  },
});
