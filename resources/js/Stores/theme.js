// resources/js/Stores/theme.js
import { defineStore } from 'pinia'

export const useThemeStore = defineStore('theme', {
  state: () => ({
    isDark: localStorage.getItem('theme') === 'dark' || 
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
  }),

  getters: {
    theme: (state) => state.isDark ? 'dark' : 'light',
  },

  actions: {
    toggleTheme() {
      this.isDark = !this.isDark
      this.applyTheme()
    },

    setTheme(theme) {
      this.isDark = theme === 'dark'
      this.applyTheme()
    },

    applyTheme() {
      // Save to localStorage
      localStorage.setItem('theme', this.theme)
      
      // Apply to document
      if (this.isDark) {
        document.documentElement.classList.add('dark')
      } else {
        document.documentElement.classList.remove('dark')
      }
    },

    initTheme() {
      // Check for saved theme or system preference
      const savedTheme = localStorage.getItem('theme')
      if (savedTheme) {
        this.isDark = savedTheme === 'dark'
      }
      this.applyTheme()
    }
  }
})