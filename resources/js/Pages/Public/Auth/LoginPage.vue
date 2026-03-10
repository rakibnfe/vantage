<template>
  <div class="login-page">
    <div class="login-container">
      <h1>Login</h1>
      <form @submit.prevent="handleLogin">
        <div class="form-group">
          <label for="email">Email</label>
          <input v-model="email" id="email" type="email" required />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input v-model="password" id="password" type="password" required />
        </div>

        <button type="submit" :disabled="loading">
          {{ loading ? 'Loading...' : 'Login' }}
        </button>
      </form>

      <p>
        Don't have an account?
        <router-link to="/register">Register</router-link>
      </p>

      <router-link to="/forgot-password">Forgot password?</router-link>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const email = ref('')
const password = ref('')
const loading = ref(false)

const handleLogin = async () => {
  loading.value = true
  try {
    // Submit login form
    // Redirect to dashboard on success
  } catch (error) {
    console.error('Login failed:', error)
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
/* Login page styles */
</style>
