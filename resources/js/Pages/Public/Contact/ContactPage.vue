<!-- resources/js/Pages/Public/Contact/ContactPage.vue -->
<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-20">
    <div class="max-w-4xl mx-auto px-4">
      <!-- Header -->
      <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4">
          Get in <span class="text-primary-600 dark:text-primary-400">Touch</span>
        </h1>
        <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
          Have a project in mind? Let's discuss how we can help bring your ideas to life.
        </p>
      </div>

      <!-- Success Message -->
      <div v-if="success" class="mb-8 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-6 text-center">
        <CheckCircleIcon class="w-16 h-16 text-green-500 mx-auto mb-4" />
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Message Sent!</h2>
        <p class="text-gray-600 dark:text-gray-400">{{ success }}</p>
        <button @click="resetForm" class="mt-4 text-primary-600 hover:underline">
          Send another message
        </button>
      </div>

      <!-- Contact Form -->
      <div v-else class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
        <form @submit.prevent="submitForm" class="space-y-6">
          <!-- Name & Email Row -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Your Name <span class="text-red-500">*</span>
              </label>
              <input 
                v-model="form.name"
                type="text"
                required
                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 transition"
                :class="{ 'border-red-500': errors.name }"
                placeholder="John Doe"
              />
              <p v-if="errors.name" class="mt-1 text-sm text-red-500">{{ errors.name }}</p>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Email Address <span class="text-red-500">*</span>
              </label>
              <input 
                v-model="form.email"
                type="email"
                required
                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 transition"
                :class="{ 'border-red-500': errors.email }"
                placeholder="john@example.com"
              />
              <p v-if="errors.email" class="mt-1 text-sm text-red-500">{{ errors.email }}</p>
            </div>
          </div>

          <!-- Phone (Optional) -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Phone Number <span class="text-gray-400 text-xs">(Optional)</span>
            </label>
            <input 
              v-model="form.phone"
              type="tel"
              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 transition"
              placeholder="+1 (555) 123-4567"
            />
          </div>

          <!-- Subject -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Subject <span class="text-red-500">*</span>
            </label>
            <input 
              v-model="form.subject"
              type="text"
              required
              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 transition"
              :class="{ 'border-red-500': errors.subject }"
              placeholder="What would you like to discuss?"
            />
            <p v-if="errors.subject" class="mt-1 text-sm text-red-500">{{ errors.subject }}</p>
          </div>

          <!-- Message -->
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
              Message <span class="text-red-500">*</span>
            </label>
            <textarea 
              v-model="form.message"
              rows="5"
              required
              class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 transition"
              :class="{ 'border-red-500': errors.message }"
              placeholder="Tell us about your project..."
            ></textarea>
            <p v-if="errors.message" class="mt-1 text-sm text-red-500">{{ errors.message }}</p>
          </div>

          <!-- Budget & Timeline Row -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Budget Range <span class="text-gray-400 text-xs">(Optional)</span>
              </label>
              <select 
                v-model="form.budget"
                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 transition"
              >
                <option value="">Select a range</option>
                <option value="< $5,000">Less than $5,000</option>
                <option value="$5,000 - $10,000">$5,000 - $10,000</option>
                <option value="$10,000 - $25,000">$10,000 - $25,000</option>
                <option value="$25,000 - $50,000">$25,000 - $50,000</option>
                <option value="> $50,000">More than $50,000</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Timeline <span class="text-gray-400 text-xs">(Optional)</span>
              </label>
              <select 
                v-model="form.timeline"
                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 transition"
              >
                <option value="">Select timeline</option>
                <option value="ASAP">ASAP</option>
                <option value="1-2 weeks">1-2 weeks</option>
                <option value="1 month">1 month</option>
                <option value="2-3 months">2-3 months</option>
                <option value="3-6 months">3-6 months</option>
                <option value="6+ months">6+ months</option>
              </select>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="pt-4">
            <button 
              type="submit"
              :disabled="submitting"
              class="w-full md:w-auto px-8 py-4 bg-primary-600 text-white rounded-xl font-semibold hover:bg-primary-700 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
            >
              <PaperAirplaneIcon v-if="!submitting" class="w-5 h-5" />
              <svg v-else class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
              <span>{{ submitting ? 'Sending...' : 'Send Message' }}</span>
            </button>
          </div>
        </form>

        <!-- Contact Info -->
        <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div>
              <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mx-auto mb-3">
                <EnvelopeIcon class="w-6 h-6 text-primary-600 dark:text-primary-400" />
              </div>
              <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Email</h3>
              <a href="mailto:hello@vantage.com" class="text-gray-600 dark:text-gray-400 hover:text-primary-600">
                hello@vantage.com
              </a>
            </div>

            <div>
              <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mx-auto mb-3">
                <PhoneIcon class="w-6 h-6 text-primary-600 dark:text-primary-400" />
              </div>
              <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Phone</h3>
              <a href="tel:+1234567890" class="text-gray-600 dark:text-gray-400 hover:text-primary-600">
                +1 (234) 567-890
              </a>
            </div>

            <div>
              <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mx-auto mb-3">
                <MapPinIcon class="w-6 h-6 text-primary-600 dark:text-primary-400" />
              </div>
              <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Location</h3>
              <p class="text-gray-600 dark:text-gray-400">San Francisco, CA</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// Polyfill for crypto.randomUUID for older browsers
if (!crypto.randomUUID) {
  crypto.randomUUID = function() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
      var r = Math.random() * 16 | 0,
        v = c == 'x' ? r : (r & 0x3 | 0x8);
      return v.toString(16);
    });
  };
}

import { ref, reactive, onMounted } from 'vue'
import axios from 'axios'
import { 
  PaperAirplaneIcon, 
  EnvelopeIcon, 
  PhoneIcon, 
  MapPinIcon,
  CheckCircleIcon 
} from '@heroicons/vue/24/outline'

const form = reactive({
  name: '',
  email: '',
  phone: '',
  subject: '',
  message: '',
  budget: '',
  timeline: '',
})

const errors = ref({})
const submitting = ref(false)
const success = ref('')
const sessionId = ref('')

// Generate or get session ID on mount
onMounted(() => {
  let sid = localStorage.getItem('visitor_session_id')
  if (!sid) {
    sid = crypto.randomUUID()
    localStorage.setItem('visitor_session_id', sid)
  }
  sessionId.value = sid
})

const submitForm = async () => {
  submitting.value = true
  errors.value = {}
  success.value = ''

  try {
    const response = await axios.post('/api/v1/contacts', {
      ...form,
      source_page: window.location.pathname
    }, {
      headers: {
        'X-Session-ID': sessionId.value
      }
    })

    if (response.data.success) {
      success.value = response.data.message
      // Optionally redirect to thank you page
      // router.push('/contact/thank-you')
    }
  } catch (error) {
    if (error.response?.status === 422) {
      errors.value = error.response.data.errors || {}
    } else {
      console.error('Contact form error:', error)
      alert('Failed to send message. Please try again.')
    }
  } finally {
    submitting.value = false
  }
}

const resetForm = () => {
  form.name = ''
  form.email = ''
  form.phone = ''
  form.subject = ''
  form.message = ''
  form.budget = ''
  form.timeline = ''
  success.value = ''
}
</script>