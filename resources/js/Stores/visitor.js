import { defineStore } from 'pinia';

export const useVisitorStore = defineStore('visitor', {
  state: () => ({
    visitorId: null,
    sessionDuration: 0,
    pagesVisited: [],
    referrer: null,
  }),

  getters: {
    getTotalPages: (state) => state.pagesVisited.length,
    getSessionDuration: (state) => state.sessionDuration,
  },

  actions: {
    setVisitorId(id) {
      this.visitorId = id;
    },

    addPageVisit(page) {
      this.pagesVisited.push({
        page,
        timestamp: new Date(),
      });
    },

    updateSessionDuration(duration) {
      this.sessionDuration = duration;
    },

    setReferrer(referrer) {
      this.referrer = referrer;
    },
  },
});
