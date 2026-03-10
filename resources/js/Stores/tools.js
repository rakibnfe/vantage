import { defineStore } from 'pinia';

export const useToolsStore = defineStore('tools', {
  state: () => ({
    recentlyUsed: [],
    toolHistory: [],
    favoriteTools: [],
  }),

  getters: {
    getRecentlyUsed: (state) => state.recentlyUsed,
    getFavorites: (state) => state.favoriteTools,
  },

  actions: {
    addToolUsage(toolSlug) {
      const tool = {
        slug: toolSlug,
        usedAt: new Date(),
      };

      this.recentlyUsed = [
        tool,
        ...this.recentlyUsed.filter((t) => t.slug !== toolSlug),
      ].slice(0, 5);

      this.toolHistory.push(tool);
    },

    toggleFavoriteTool(toolSlug) {
      const index = this.favoriteTools.indexOf(toolSlug);
      if (index > -1) {
        this.favoriteTools.splice(index, 1);
      } else {
        this.favoriteTools.push(toolSlug);
      }
    },
  },
});
