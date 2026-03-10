<template>
  <div class="register-page">
    <div class="register-container">
      <h1>Register</h1>
      <form @submit.prevent="handleRegister">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input v-model="name" id="name" type="text" required />
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input v-model="email" id="email" type="email" required />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input v-model="password" id="password" type="password" required />
        </div>

        <div class="form-group">
          <label for="password-confirm">Confirm Password</label>
          <input v-model="passwordConfirm" id="password-confirm" type="password" required />
        </div>

        <button type="submit" :disabled="loading">
          {{ loading ? 'Creating...' : 'Create Account' }}
        </button>
      </form>

      <p>
        Already have an account?
        <router-link to="/login">Login</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const router = useRouter()
const name = ref('')
const email = ref('')
const password = ref('')
const passwordConfirm = ref('')
const loading = ref(false)

const handleRegister = async () => {
  loading.value = true
  try {
    // Submit registration form
    // Redirect to email verification or login on success
  } catch (error) {
    console.error('Registration failed:', error)
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
/* Register page styles */
</style>
