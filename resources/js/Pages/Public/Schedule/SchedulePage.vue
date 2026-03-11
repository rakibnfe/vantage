<!-- resources/js/Pages/Public/Schedule/SchedulePage.vue -->
<template>
  <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-20">
    <div class="max-w-7xl mx-auto px-4">
      <h1 class="text-4xl font-bold text-center mb-4">Schedule & Appointments</h1>
      <p class="text-xl text-center text-gray-600 dark:text-gray-400 mb-12">
        View and manage your schedule
      </p>

      <!-- Calendar Controls -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
          <div class="flex items-center gap-2">
            <button @click="prevMonth" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
              <ChevronLeftIcon class="w-5 h-5" />
            </button>
            <h2 class="text-2xl font-bold">{{ currentMonthName }} {{ currentYear }}</h2>
            <button @click="nextMonth" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
              <ChevronRightIcon class="w-5 h-5" />
            </button>
            <button @click="today" class="ml-4 px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg text-sm">
              Today
            </button>
          </div>

          <div class="flex items-center gap-4">
            <!-- View Toggle -->
            <div class="flex bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
              <button @click="viewMode = 'month'" 
                      class="px-4 py-2 rounded-lg text-sm transition"
                      :class="viewMode === 'month' ? 'bg-white dark:bg-gray-600 shadow-sm' : ''">
                Month
              </button>
              <button @click="viewMode = 'week'" 
                      class="px-4 py-2 rounded-lg text-sm transition"
                      :class="viewMode === 'week' ? 'bg-white dark:bg-gray-600 shadow-sm' : ''">
                Week
              </button>
              <button @click="viewMode = 'day'" 
                      class="px-4 py-2 rounded-lg text-sm transition"
                      :class="viewMode === 'day' ? 'bg-white dark:bg-gray-600 shadow-sm' : ''">
                Day
              </button>
            </div>

            <!-- Filter -->
            <select v-model="filterType" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg text-sm border-0">
              <option value="all">All Events</option>
              <option value="appointment">Appointments</option>
              <option value="availability">Availability</option>
              <option value="blocked">Blocked</option>
            </select>

            <!-- Add Event Button -->
            <button @click="showAddModal = true" 
                    class="px-4 py-2 bg-primary-600 text-white rounded-lg text-sm hover:bg-primary-700">
              + New Event
            </button>
          </div>
        </div>
      </div>

      <!-- Loading State -->
      <div v-if="loading" class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
        <div class="h-96 animate-pulse bg-gray-200 dark:bg-gray-700 rounded"></div>
      </div>

      <!-- Calendar -->
      <div v-else class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
        <!-- Calendar Header (Days of Week) -->
        <div class="grid grid-cols-7 border-b border-gray-200 dark:border-gray-700">
          <div v-for="day in weekDays" :key="day" 
               class="p-4 text-center font-medium text-gray-600 dark:text-gray-400">
            {{ day }}
          </div>
        </div>

        <!-- Calendar Grid -->
        <div class="grid grid-cols-7 divide-x divide-gray-200 dark:divide-gray-700">
          <div v-for="(day, index) in calendarDays" :key="index"
               @click="selectDate(day.date)"
               class="min-h-32 p-2 border-b border-gray-200 dark:border-gray-700 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800/50 transition"
               :class="{
                 'bg-gray-50 dark:bg-gray-800/50': !day.isCurrentMonth,
                 'bg-primary-50 dark:bg-primary-900/20': isToday(day.date),
               }">
            
            <!-- Date Number -->
            <div class="flex justify-between items-start mb-2">
              <span class="text-sm font-medium"
                    :class="{
                      'text-gray-400': !day.isCurrentMonth,
                      'text-gray-900 dark:text-white': day.isCurrentMonth,
                      'bg-primary-600 text-white w-6 h-6 flex items-center justify-center rounded-full': isToday(day.date)
                    }">
                {{ day.date.getDate() }}
              </span>
              
              <!-- Event Count Badge -->
              <span v-if="getEventsForDate(day.date).length" 
                    class="text-xs bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 px-2 py-1 rounded-full">
                {{ getEventsForDate(day.date).length }}
              </span>
            </div>

            <!-- Events Preview (max 2) -->
            <div class="space-y-1">
              <div v-for="(event, idx) in getEventsForDate(day.date).slice(0, 2)" :key="event.id"
                   @click.stop="viewEvent(event)"
                   class="text-xs p-1 rounded truncate cursor-pointer"
                   :style="{ backgroundColor: event.color + '20', borderLeft: `3px solid ${event.color}` }">
                <span class="font-medium">{{ event.title }}</span>
                <span class="text-gray-500 dark:text-gray-400 ml-1">{{ formatEventTime(event) }}</span>
              </div>
              
              <!-- More events indicator -->
              <div v-if="getEventsForDate(day.date).length > 2" 
                   class="text-xs text-gray-500 dark:text-gray-400 pl-1">
                +{{ getEventsForDate(day.date).length - 2 }} more
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Legend -->
      <div class="mt-8 flex flex-wrap gap-4 justify-center">
        <div class="flex items-center gap-2">
          <div class="w-4 h-4 rounded-full" style="background-color: #4f46e5"></div>
          <span class="text-sm text-gray-600 dark:text-gray-400">Appointments</span>
        </div>
        <div class="flex items-center gap-2">
          <div class="w-4 h-4 rounded-full" style="background-color: #10b981"></div>
          <span class="text-sm text-gray-600 dark:text-gray-400">Availability</span>
        </div>
        <div class="flex items-center gap-2">
          <div class="w-4 h-4 rounded-full" style="background-color: #ef4444"></div>
          <span class="text-sm text-gray-600 dark:text-gray-400">Blocked</span>
        </div>
      </div>
    </div>

    <!-- Add/Edit Event Modal -->
    <TransitionRoot appear :show="showAddModal" as="template">
      <Dialog as="div" @close="closeModal" class="relative z-50">
        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-black/25" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
              <DialogPanel class="w-full max-w-2xl transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-xl transition-all">
                <DialogTitle as="h3" class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                  {{ editingEvent ? 'Edit Event' : 'Add New Event' }}
                </DialogTitle>

                <form @submit.prevent="saveEvent" class="space-y-4">
                  <!-- Title -->
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                    <input v-model="eventForm.title" type="text" required
                           class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                  </div>

                  <!-- Type -->
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Event Type</label>
                    <select v-model="eventForm.type" required
                            class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                      <option value="appointment">Appointment</option>
                      <option value="availability">Availability</option>
                      <option value="blocked">Blocked Time</option>
                    </select>
                  </div>

                  <!-- Date & Time -->
                  <div class="grid grid-cols-2 gap-4">
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date/Time</label>
                      <input v-model="eventForm.start_time" type="datetime-local" required
                             class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Date/Time</label>
                      <input v-model="eventForm.end_time" type="datetime-local" required
                             class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                  </div>

                  <!-- Customer Info (for appointments) -->
                  <template v-if="eventForm.type === 'appointment'">
                    <div class="grid grid-cols-2 gap-4">
                      <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Customer Name</label>
                        <input v-model="eventForm.customer_name" type="text"
                               class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                      </div>
                      <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Customer Email</label>
                        <input v-model="eventForm.customer_email" type="email"
                               class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                      </div>
                    </div>
                    <div>
                      <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Customer Phone</label>
                      <input v-model="eventForm.customer_phone" type="tel"
                             class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                    </div>
                  </template>

                  <!-- Description -->
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                    <textarea v-model="eventForm.description" rows="3"
                              class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500"></textarea>
                  </div>

                  <!-- Color -->
                  <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Color</label>
                    <input v-model="eventForm.color" type="color"
                           class="w-full h-10 px-1 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg">
                  </div>

                  <!-- Actions -->
                  <div class="flex justify-end gap-3 mt-6">
                    <button type="button" @click="closeModal"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                      Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                      {{ editingEvent ? 'Update' : 'Save' }}
                    </button>
                  </div>
                </form>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>

    <!-- Event Details Modal -->
    <TransitionRoot appear :show="showDetailModal" as="template">
      <Dialog as="div" @close="closeDetailModal" class="relative z-50">
        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0" enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
          <div class="fixed inset-0 bg-black/25" />
        </TransitionChild>

        <div class="fixed inset-0 overflow-y-auto">
          <div class="flex min-h-full items-center justify-center p-4">
            <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="duration-200 ease-in" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
              <DialogPanel class="w-full max-w-lg transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-xl transition-all">
                <DialogTitle as="h3" class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                  Event Details
                </DialogTitle>

                <div v-if="selectedEvent" class="space-y-4">
                  <!-- Title -->
                  <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Title</h4>
                    <p class="text-lg font-semibold">{{ selectedEvent.title }}</p>
                  </div>

                  <!-- Type -->
                  <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Type</h4>
                    <span class="inline-block px-3 py-1 rounded-full text-sm mt-1"
                          :style="{ backgroundColor: selectedEvent.color + '20', color: selectedEvent.color }">
                      {{ selectedEvent.type }}
                    </span>
                  </div>

                  <!-- Date/Time -->
                  <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Date & Time</h4>
                    <p class="text-gray-900 dark:text-white">{{ selectedEvent.formatted_date }}</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ selectedEvent.formatted_time }}</p>
                    <p class="text-sm text-gray-500">Duration: {{ selectedEvent.formatted_duration }}</p>
                  </div>

                  <!-- Customer Info -->
                  <div v-if="selectedEvent.customer">
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Customer</h4>
                    <p class="text-gray-900 dark:text-white">{{ selectedEvent.customer.name }}</p>
                    <p class="text-gray-600 dark:text-gray-400">{{ selectedEvent.customer.email }}</p>
                    <p v-if="selectedEvent.customer.phone" class="text-gray-600 dark:text-gray-400">{{ selectedEvent.customer.phone }}</p>
                    <p v-if="selectedEvent.customer.notes" class="text-sm text-gray-500 mt-2">{{ selectedEvent.customer.notes }}</p>
                  </div>

                  <!-- Description -->
                  <div v-if="selectedEvent.description">
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</h4>
                    <p class="text-gray-600 dark:text-gray-400">{{ selectedEvent.description }}</p>
                  </div>

                  <!-- Actions -->
                  <div class="flex justify-end gap-3 mt-6">
                    <button @click="editEvent(selectedEvent)"
                            class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                      Edit
                    </button>
                    <button @click="deleteEvent(selectedEvent)"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                      Delete
                    </button>
                    <button @click="closeDetailModal"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                      Close
                    </button>
                  </div>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import axios from 'axios'
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline'

// State
const events = ref([])
const loading = ref(true)
const viewMode = ref('month')
const currentDate = ref(new Date())
const filterType = ref('all')
const showAddModal = ref(false)
const showDetailModal = ref(false)
const editingEvent = ref(null)
const selectedEvent = ref(null)
const selectedDate = ref(null)

// Form state
const eventForm = ref({
  title: '',
  type: 'appointment',
  start_time: '',
  end_time: '',
  description: '',
  customer_name: '',
  customer_email: '',
  customer_phone: '',
  color: '#4f46e5',
})

// Computed
const currentYear = computed(() => currentDate.value.getFullYear())
const currentMonth = computed(() => currentDate.value.getMonth())
const currentMonthName = computed(() => {
  return currentDate.value.toLocaleString('default', { month: 'long' })
})

const weekDays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']

const calendarDays = computed(() => {
  const year = currentYear.value
  const month = currentMonth.value
  
  const firstDay = new Date(year, month, 1)
  const lastDay = new Date(year, month + 1, 0)
  
  const days = []
  const startDate = new Date(firstDay)
  startDate.setDate(firstDay.getDate() - firstDay.getDay())
  
  for (let i = 0; i < 42; i++) {
    const date = new Date(startDate)
    date.setDate(startDate.getDate() + i)
    
    days.push({
      date,
      isCurrentMonth: date.getMonth() === month,
    })
  }
  
  return days
})

const filteredEvents = computed(() => {
  if (filterType.value === 'all') return events.value
  return events.value.filter(e => e.type === filterType.value)
})

// Methods
const fetchEvents = async () => {
  loading.value = true
  try {
    const start = new Date(currentYear.value, currentMonth.value, 1)
    const end = new Date(currentYear.value, currentMonth.value + 1, 0)
    
    const response = await axios.get('/api/v1/schedules', {
      params: {
        start: start.toISOString().split('T')[0],
        end: end.toISOString().split('T')[0],
        _: Date.now()
      }
    })
    
    if (response.data?.data) {
      events.value = response.data.data
    }
  } catch (error) {
    console.error('Failed to fetch events:', error)
  } finally {
    loading.value = false
  }
}

const getEventsForDate = (date) => {
  const dateStr = date.toISOString().split('T')[0]
  return filteredEvents.value.filter(event => {
    const eventDate = new Date(event.start_time).toISOString().split('T')[0]
    return eventDate === dateStr
  })
}

const formatEventTime = (event) => {
  const start = new Date(event.start_time)
  return start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })
}

const isToday = (date) => {
  const today = new Date()
  return date.toDateString() === today.toDateString()
}

const prevMonth = () => {
  currentDate.value = new Date(currentYear.value, currentMonth.value - 1, 1)
}

const nextMonth = () => {
  currentDate.value = new Date(currentYear.value, currentMonth.value + 1, 1)
}

const today = () => {
  currentDate.value = new Date()
}

const selectDate = (date) => {
  selectedDate.value = date
  eventForm.value.start_time = new Date(date.setHours(9, 0)).toISOString().slice(0, 16)
  eventForm.value.end_time = new Date(date.setHours(10, 0)).toISOString().slice(0, 16)
  showAddModal.value = true
}

const viewEvent = (event) => {
  selectedEvent.value = event
  showDetailModal.value = true
}

const editEvent = (event) => {
  editingEvent.value = event
  eventForm.value = {
    title: event.title,
    type: event.type,
    start_time: event.start_time.slice(0, 16),
    end_time: event.end_time.slice(0, 16),
    description: event.description || '',
    customer_name: event.customer?.name || '',
    customer_email: event.customer?.email || '',
    customer_phone: event.customer?.phone || '',
    color: event.color || '#4f46e5',
  }
  showDetailModal.value = false
  showAddModal.value = true
}

const saveEvent = async () => {
  try {
    // Format dates properly
    const formData = {
      title: eventForm.value.title,
      type: eventForm.value.type,
      start_time: new Date(eventForm.value.start_time).toISOString(),
      end_time: new Date(eventForm.value.end_time).toISOString(),
      description: eventForm.value.description || null,
      color: eventForm.value.color || null,
    };

    // Add customer data if appointment
    if (eventForm.value.type === 'appointment') {
      formData.customer_name = eventForm.value.customer_name || null;
      formData.customer_email = eventForm.value.customer_email || null;
      formData.customer_phone = eventForm.value.customer_phone || null;
    }

    if (editingEvent.value) {
      await axios.put(`/api/v1/schedules/${editingEvent.value.id}`, formData);
    } else {
      await axios.post('/api/v1/schedules', formData);
    }
    
    await fetchEvents();
    closeModal();
  } catch (error) {
    console.error('Failed to save event:', error);
    if (error.response) {
      // The request was made and the server responded with a status code
      console.error('Response data:', error.response.data);
      console.error('Response status:', error.response.status);
      
      // Show error message to user
      alert(error.response.data.message || 'Failed to save event');
    } else if (error.request) {
      // The request was made but no response was received
      console.error('No response received:', error.request);
      alert('Network error - no response from server');
    } else {
      // Something happened in setting up the request that triggered an Error
      console.error('Error:', error.message);
      alert('Error: ' + error.message);
    }
  }
}
const deleteEvent = async (event) => {
  if (!confirm('Are you sure you want to delete this event?')) return
  
  try {
    await axios.delete(`/api/v1/schedules/${event.id}`)
    await fetchEvents()
    closeDetailModal()
  } catch (error) {
    console.error('Failed to delete event:', error)
  }
}

const closeModal = () => {
  showAddModal.value = false
  editingEvent.value = null
  eventForm.value = {
    title: '',
    type: 'appointment',
    start_time: '',
    end_time: '',
    description: '',
    customer_name: '',
    customer_email: '',
    customer_phone: '',
    color: '#4f46e5',
  }
}

const closeDetailModal = () => {
  showDetailModal.value = false
  selectedEvent.value = null
}

// Watchers
watch([currentDate, filterType], () => {
  fetchEvents()
})

// Lifecycle
onMounted(() => {
  fetchEvents()
})
</script>

<style scoped>
.calendar-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
}
</style>