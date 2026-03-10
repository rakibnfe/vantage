import { defineStore } from 'pinia';

export const useThemeStore = defineStore('theme', {
  state: () => ({
    isDark: false,
    theme: 'light',
  }),

  getters: {
    currentTheme: (state) => state.theme,
  },

  actions: {
    toggleTheme() {
      this.isDark = !this.isDark;
      this.theme = this.isDark ? 'dark' : 'light';
    },

    setTheme(theme) {
      this.theme = theme;
      this.isDark = theme === 'dark';
    },
  },
});
