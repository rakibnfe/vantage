# 📦 VANTAGE - Complete Project Structure Documentation

## Laravel 12 + Vue 3 SPA Portfolio Platform

---

## 📋 **TABLE OF CONTENTS**

1. [Project Overview](#project-overview)
2. [Technology Stack](#technology-stack)
3. [Complete Folder Structure](#complete-folder-structure)
4. [Public Pages (Vue)](#public-pages-vue)
5. [Admin Pages (Blade)](#admin-pages-blade)
6. [Authentication System](#authentication-system)
7. [Component Library](#component-library)
8. [Layouts & Routing](#layouts--routing)
9. [State Management](#state-management)
10. [Styling Guide (Tailwind v4)](#styling-guide-tailwind-v4)
11. [Icon System](#icon-system)
12. [Animation Patterns](#animation-patterns)
13. [Dark Mode Implementation](#dark-mode-implementation)
14. [Mobile Navigation](#mobile-navigation)
15. [Carousel Implementation](#carousel-implementation)

---

## 🎯 **PROJECT OVERVIEW**

**VANTAGE** is a full-stack portfolio and project management website with:

### 🏠 **Public Frontend (Vue SPA)**
- Home page with hero, featured projects, services, articles, tools, testimonials
- Work/Projects listing and details
- Dynamic Services pages with nested content
- Notes/Articles section
- Blog section
- Developer Tools (5 utilities)
- Contact form with thank you page
- Schedule/Booking page
- Info pages (About, Now, Uses, Privacy, Terms)

### 🔧 **Admin Dashboard (Blade)**
- Complete content management system
- Analytics dashboard
- Media library
- Settings configuration

### 🔐 **Authentication System**
- User registration and login
- Role-based access (user/admin)
- Password reset
- Email verification
- Separate admin login

---

## 🛠️ **TECHNOLOGY STACK**

### Backend
```
Laravel 12
MySQL / SQLite
Laravel Sanctum (API tokens)
Laravel Breeze (authentication scaffolding)
```

### Frontend
```
Vue 3 (Composition API)
Vue Router 4
Pinia (State Management)
Axios (HTTP client)
Tailwind CSS v4
Heroicons v2
Swiper.js (Carousels)
```

### Development
```
Vite
npm / yarn
Git
```

---

## 📂 **COMPLETE FOLDER STRUCTURE**

```
vantage/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── ProjectController.php
│   │   │   │   ├── ServiceController.php
│   │   │   │   ├── ArticleController.php
│   │   │   │   ├── BlogController.php
│   │   │   │   ├── ToolController.php
│   │   │   │   ├── InquiryController.php
│   │   │   │   ├── InsightController.php
│   │   │   │   ├── MediaController.php
│   │   │   │   └── SettingController.php
│   │   │   ├── Auth/
│   │   │   │   ├── RegisteredUserController.php
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   ├── PasswordResetLinkController.php
│   │   │   │   ├── NewPasswordController.php
│   │   │   │   ├── VerifyEmailController.php
│   │   │   │   └── EmailVerificationNotificationController.php
│   │   │   └── Public/
│   │   │       ├── HomeController.php
│   │   │       ├── ProjectController.php
│   │   │       ├── ServiceController.php
│   │   │       ├── ArticleController.php
│   │   │       ├── BlogController.php
│   │   │       ├── ToolController.php
│   │   │       └── ContactController.php
│   │   └── Middleware/
│   │       ├── AdminMiddleware.php
│   │       └── Authenticate.php
│   └── Models/
│       ├── User.php
│       ├── Project.php
│       ├── Service.php
│       ├── Article.php
│       ├── BlogPost.php
│       ├── Category.php
│       ├── Tag.php
│       ├── Tool.php
│       ├── Contact.php
│       └── Visitor.php
│
├── resources/
│   ├── js/
│   │   ├── app.js
│   │   ├── bootstrap.js
│   │   │
│   │   ├── Layouts/
│   │   │   ├── PublicLayout.vue
│   │   │   └── AdminLayout.vue
│   │   │
│   │   ├── Pages/
│   │   │   ├── Public/
│   │   │   │   ├── Home/
│   │   │   │   │   └── HomePage.vue
│   │   │   │   │
│   │   │   │   ├── Work/
│   │   │   │   │   ├── WorkListPage.vue
│   │   │   │   │   └── WorkDetailPage.vue
│   │   │   │   │
│   │   │   │   ├── Services/
│   │   │   │   │   ├── ServicesListPage.vue
│   │   │   │   │   └── ServiceDetailPage.vue
│   │   │   │   │
│   │   │   │   ├── Notes/
│   │   │   │   │   ├── NotesListPage.vue
│   │   │   │   │   └── ArticleDetailPage.vue
│   │   │   │   │
│   │   │   │   ├── Blog/
│   │   │   │   │   ├── BlogListPage.vue
│   │   │   │   │   └── PostDetailPage.vue
│   │   │   │   │
│   │   │   │   ├── Tools/
│   │   │   │   │   ├── ToolsListPage.vue
│   │   │   │   │   ├── JsonFormatterPage.vue
│   │   │   │   │   ├── ApiViewerPage.vue
│   │   │   │   │   ├── SlugGeneratorPage.vue
│   │   │   │   │   ├── MarkdownPreviewPage.vue
│   │   │   │   │   └── TextUtilitiesPage.vue
│   │   │   │   │
│   │   │   │   ├── Contact/
│   │   │   │   │   ├── ContactPage.vue
│   │   │   │   │   └── ThankYouPage.vue
│   │   │   │   │
│   │   │   │   ├── Schedule/
│   │   │   │   │   └── SchedulePage.vue
│   │   │   │   │
│   │   │   │   ├── Info/
│   │   │   │   │   ├── AboutPage.vue
│   │   │   │   │   ├── NowPage.vue
│   │   │   │   │   ├── UsesPage.vue
│   │   │   │   │   ├── PrivacyPage.vue
│   │   │   │   │   └── TermsPage.vue
│   │   │   │   │
│   │   │   │   └── Auth/
│   │   │   │       ├── LoginPage.vue
│   │   │   │       └── RegisterPage.vue
│   │   │   │
│   │   │   └── Admin/
│   │   │       ├── Dashboard/
│   │   │       │   └── DashboardPage.vue
│   │   │       ├── Work/
│   │   │       │   └── WorkManagement.vue
│   │   │       ├── Services/
│   │   │       │   └── ServicesManagement.vue
│   │   │       ├── Notes/
│   │   │       │   └── NotesManagement.vue
│   │   │       ├── Blog/
│   │   │       │   └── BlogManagement.vue
│   │   │       ├── Tools/
│   │   │       │   └── ToolsManagement.vue
│   │   │       ├── Inquiries/
│   │   │       │   └── InquiriesPage.vue
│   │   │       ├── Insights/
│   │   │       │   └── InsightsPage.vue
│   │   │       ├── Media/
│   │   │       │   └── MediaLibrary.vue
│   │   │       └── Settings/
│   │   │           └── SettingsPage.vue
│   │   │
│   │   ├── Components/
│   │   │   ├── Public/
│   │   │   │   ├── Common/
│   │   │   │   │   ├── ProjectCard.vue
│   │   │   │   │   ├── ServiceCard.vue
│   │   │   │   │   ├── ArticleCard.vue
│   │   │   │   │   ├── ToolCard.vue
│   │   │   │   │   └── TestimonialCard.vue
│   │   │   │   │
│   │   │   │   ├── Home/
│   │   │   │   │   ├── HeroSection.vue
│   │   │   │   │   ├── FeaturedProjects.vue
│   │   │   │   │   ├── ServicesOverview.vue
│   │   │   │   │   ├── RecentArticles.vue
│   │   │   │   │   ├── ToolsGrid.vue
│   │   │   │   │   ├── TestimonialsCarousel.vue
│   │   │   │   │   └── CtaSection.vue
│   │   │   │   │
│   │   │   │   ├── Navigation/
│   │   │   │   │   ├── Navbar.vue
│   │   │   │   │   ├── Footer.vue
│   │   │   │   │   └── MobileBottomNav.vue
│   │   │   │   │
│   │   │   │   └── UI/
│   │   │   │       ├── Button.vue
│   │   │   │       ├── Card.vue
│   │   │   │       ├── Badge.vue
│   │   │   │       ├── Skeleton.vue
│   │   │   │       ├── LoadingSpinner.vue
│   │   │   │       └── ErrorBoundary.vue
│   │   │   │
│   │   │   └── Admin/
│   │   │       ├── Sidebar.vue
│   │   │       ├── TopBar.vue
│   │   │       ├── DataTable.vue
│   │   │       ├── FormBuilder.vue
│   │   │       ├── StatsCard.vue
│   │   │       └── Charts/
│   │   │           ├── LineChart.vue
│   │   │           └── BarChart.vue
│   │   │
│   │   ├── Composables/
│   │   │   ├── useApi.js
│   │   │   ├── useAuth.js
│   │   │   ├── useProjects.js
│   │   │   ├── useServices.js
│   │   │   ├── useArticles.js
│   │   │   ├── useTools.js
│   │   │   ├── useContact.js
│   │   │   ├── usePagination.js
│   │   │   ├── useForm.js
│   │   │   └── useTheme.js
│   │   │
│   │   ├── Stores/
│   │   │   ├── theme.js
│   │   │   ├── auth.js
│   │   │   ├── ui.js
│   │   │   └── content.js
│   │   │
│   │   ├── router/
│   │   │   └── index.js
│   │   │
│   │   └── utils/
│   │       ├── formatters.js
│   │       ├── validators.js
│   │       └── helpers.js
│   │
│   └── css/
│       ├── app.css
│       └── animations.css
│
├── resources/views/
│   ├── app.blade.php (Vue SPA entry)
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   └── admin/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── dashboard/
│       │   └── index.blade.php
│       ├── work/
│       │   └── index.blade.php
│       ├── services/
│       │   └── index.blade.php
│       ├── notes/
│       │   └── index.blade.php
│       ├── blog/
│       │   └── index.blade.php
│       ├── tools/
│       │   └── index.blade.php
│       ├── inquiries/
│       │   └── index.blade.php
│       ├── insights/
│       │   └── index.blade.php
│       ├── media/
│       │   └── index.blade.php
│       └── settings/
│           └── index.blade.php
│
├── routes/
│   ├── web.php
│   ├── api.php
│   └── admin.php
│
├── package.json
├── tailwind.config.js
├── vite.config.js
├── .env
└── README.md
```

---

## 🏠 **PUBLIC PAGES (VUE)**

### Page Structure Overview

| Page | Route | Description |
|------|-------|-------------|
| **HomePage** | `/` | Hero, featured projects, services, articles, tools, testimonials, CTA |
| **WorkListPage** | `/work` | Projects grid with filters and search |
| **WorkDetailPage** | `/work/:slug` | Single project with full details |
| **ServicesListPage** | `/services` | Services overview grid |
| **ServiceDetailPage** | `/services/:slug` | Dynamic service with features, process, FAQs, pricing |
| **NotesListPage** | `/notes` | Articles grid with search and tags |
| **ArticleDetailPage** | `/notes/:slug` | Single article with TOC and related |
| **BlogListPage** | `/blog` | Blog posts with categories |
| **PostDetailPage** | `/blog/:slug` | Single post with comments |
| **ToolsListPage** | `/tools` | All developer tools overview |
| **JsonFormatterPage** | `/tools/json-formatter` | JSON formatting tool |
| **ApiViewerPage** | `/tools/api-viewer` | API response viewer |
| **SlugGeneratorPage** | `/tools/slug-generator` | URL slug generator |
| **MarkdownPreviewPage** | `/tools/markdown-preview` | Live markdown editor |
| **TextUtilitiesPage** | `/tools/text-utilities` | Text manipulation tools |
| **ContactPage** | `/contact` | Contact form |
| **ThankYouPage** | `/contact/thank-you` | Post-submission page |
| **SchedulePage** | `/schedule` | Calendar booking |
| **AboutPage** | `/about` | Personal bio |
| **NowPage** | `/now` | Current projects |
| **UsesPage** | `/uses` | Tools & setup |
| **PrivacyPage** | `/privacy` | Privacy policy |
| **TermsPage** | `/terms` | Terms of service |
| **LoginPage** | `/login` | User login |
| **RegisterPage** | `/register` | User registration |

---

## 🔧 **ADMIN PAGES (BLADE)**

| Page | Route | Description |
|------|-------|-------------|
| **Dashboard** | `/admin/dashboard` | Stats, recent activity, quick actions |
| **Work Management** | `/admin/work` | CRUD for projects |
| **Services Management** | `/admin/services` | Dynamic service management with drag-to-reorder |
| **Notes Management** | `/admin/notes` | Article management with rich editor |
| **Blog Management** | `/admin/blog` | Blog post management |
| **Tools Management** | `/admin/tools` | Tool configuration |
| **Inquiries** | `/admin/inquiries` | Contact form submissions |
| **Insights** | `/admin/insights` | Analytics dashboard |
| **Media Library** | `/admin/media` | File uploads and management |
| **Settings** | `/admin/settings` | Site configuration |

---

## 🔐 **AUTHENTICATION SYSTEM**

### User Roles
```
- User: Regular authenticated user
- Admin: Full system access
```

### Authentication Routes
```
GET    /login          → Login page
POST   /login          → Login submit
GET    /register       → Registration page
POST   /register       → Registration submit
POST   /logout         → Logout
GET    /forgot-password → Password reset request
POST   /forgot-password → Send reset link
GET    /reset-password/{token} → Reset password form
POST   /reset-password → Update password
GET    /email/verify   → Verification notice
GET    /email/verify/{id}/{hash} → Verify email
POST   /email/verification-send → Resend verification

Admin Login (Separate)
GET    /admin/login    → Admin login page
POST   /admin/login    → Admin login submit
POST   /admin/logout   → Admin logout
```

### Middleware
```
auth          → Check if authenticated
guest         → Check if not authenticated
admin         → Check if user is admin
verified      → Check if email verified
```

---

## 🧩 **COMPONENT LIBRARY**

### Common Components (`/Components/Public/Common/`)

#### ProjectCard.vue
```vue
<template>
  <router-link :to="`/work/${project.slug}`" class="group">
    <div class="relative h-48 overflow-hidden rounded-t-2xl">
      <img :src="project.image" :alt="project.title" class="w-full h-full object-cover group-hover:scale-110 transition">
      <div class="absolute bottom-2 left-2 flex gap-1">
        <span v-for="tech in project.technologies.slice(0,2)" class="px-2 py-1 text-xs bg-black/60 text-white rounded-full">
          {{ tech }}
        </span>
      </div>
    </div>
    <div class="p-4">
      <h3 class="text-lg font-bold">{{ project.title }}</h3>
      <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ project.description }}</p>
    </div>
  </router-link>
</template>
```

#### ServiceCard.vue
```vue
<template>
  <router-link :to="`/services/${service.slug}`" class="block p-6 bg-gray-50 dark:bg-gray-800/50 rounded-2xl hover:shadow-xl transition">
    <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-xl flex items-center justify-center mb-4">
      <component :is="service.icon" class="w-6 h-6 text-primary-600" />
    </div>
    <h3 class="text-lg font-bold mb-2">{{ service.title }}</h3>
    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ service.description }}</p>
    <span class="text-primary-600 text-sm">Learn more →</span>
  </router-link>
</template>
```

#### ArticleCard.vue
```vue
<template>
  <router-link :to="`/notes/${article.slug}`" class="block bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow">
    <img :src="article.image" :alt="article.title" class="w-full h-48 object-cover">
    <div class="p-4">
      <div class="flex gap-2 text-xs text-gray-500 mb-2">
        <span>{{ article.date }}</span>
        <span>•</span>
        <span>{{ article.readTime }} min read</span>
      </div>
      <h3 class="font-bold mb-2 line-clamp-2">{{ article.title }}</h3>
      <span class="text-primary-600 text-sm">Read more →</span>
    </div>
  </router-link>
</template>
```

#### ToolCard.vue
```vue
<template>
  <router-link :to="`/tools/${tool.slug}`" class="block p-4 bg-gray-50 dark:bg-gray-800/50 rounded-xl text-center hover:shadow transition">
    <div class="w-12 h-12 mx-auto bg-primary-100 rounded-xl flex items-center justify-center mb-2">
      <component :is="tool.icon" class="w-6 h-6 text-primary-600" />
    </div>
    <h3 class="font-semibold">{{ tool.name }}</h3>
    <p class="text-xs text-gray-500">{{ tool.description }}</p>
  </router-link>
</template>
```

### Home Page Components (`/Components/Public/Home/`)

#### HeroSection.vue
- Gradient background with floating elements
- Animated text entrance
- CTA buttons
- Availability badge
- Stats counters

#### FeaturedProjects.vue
- Swiper carousel with 3-6 projects
- Navigation arrows and pagination dots
- Autoplay on mobile
- Hover effects with scale

#### ServicesOverview.vue
- 4-column grid on desktop
- Icons with colored backgrounds
- Hover lift effects
- "Learn more" links

#### RecentArticles.vue
- 3-column grid
- Article cards with images
- Date and read time
- Category badges

#### ToolsGrid.vue
- 5-column grid on desktop
- Tool cards with icons
- Usage counts
- Hover animations

#### TestimonialsCarousel.vue
- Swiper carousel for testimonials
- Quote styling
- Author info with initials avatar
- Star ratings

#### CtaSection.vue
- Gradient background
- Animated floating elements
- Two CTA buttons
- Trust indicators

### Navigation Components

#### Navbar.vue
- Logo with gradient text
- Desktop menu items
- Theme toggle button
- Mobile menu button

#### Footer.vue
- Multi-column links
- Social media icons
- Copyright notice
- Responsive layout

#### MobileBottomNav.vue
- Fixed bottom navigation on mobile
- 4 main icons (Home, Work, Notes, Contact)
- Active state indicator
- Safe area handling

---

## 📐 **LAYOUTS & ROUTING**

### PublicLayout.vue
```vue
<template>
  <div class="min-h-screen bg-white dark:bg-gray-950">
    <Navbar />
    <main class="min-h-[calc(100vh-64px)]">
      <router-view />
    </main>
    <Footer />
    <MobileBottomNav v-if="isMobile" />
  </div>
</template>
```

### Router Configuration
```js
// router/index.js
import { createRouter, createWebHistory } from 'vue-router'
import PublicLayout from '@/Layouts/PublicLayout.vue'

const routes = [
  {
    path: '/',
    component: PublicLayout,
    children: [
      { path: '', name: 'home', component: HomePage },
      { path: 'work', name: 'work.list', component: WorkListPage },
      { path: 'work/:slug', name: 'work.detail', component: WorkDetailPage },
      // ... all other public routes
    ]
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) return savedPosition
    return { top: 0, behavior: 'smooth' }
  }
})
```

---

## 🎭 **STATE MANAGEMENT (PINIA)**

### Theme Store
```js
// Stores/theme.js
export const useThemeStore = defineStore('theme', {
  state: () => ({
    isDark: localStorage.getItem('theme') === 'dark' || 
            window.matchMedia('(prefers-color-scheme: dark)').matches
  }),
  
  actions: {
    toggleTheme() {
      this.isDark = !this.isDark
      this.applyTheme()
    },
    
    applyTheme() {
      localStorage.setItem('theme', this.isDark ? 'dark' : 'light')
      if (this.isDark) {
        document.documentElement.classList.add('dark')
      } else {
        document.documentElement.classList.remove('dark')
      }
    }
  }
})
```

### Auth Store
```js
// Stores/auth.js
export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: localStorage.getItem('auth_token'),
    isAuthenticated: !!localStorage.getItem('auth_token')
  }),
  
  getters: {
    isAdmin: (state) => state.user?.role === 'admin'
  },
  
  actions: {
    async login(credentials) {
      // Login logic
    },
    
    logout() {
      this.user = null
      this.token = null
      this.isAuthenticated = false
      localStorage.removeItem('auth_token')
    }
  }
})
```

---

## 🎨 **STYLING GUIDE (TAILWIND v4)**

### Tailwind Configuration
```js
// tailwind.config.js
export default {
  darkMode: 'class',
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#eef2ff',
          100: '#e0e7ff',
          200: '#c7d2fe',
          300: '#a5b4fc',
          400: '#818cf8',
          500: '#6366f1',
          600: '#4f46e5',
          700: '#4338ca',
          800: '#3730a3',
          900: '#312e81',
        },
      },
      animation: {
        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
        'float': 'float 6s ease-in-out infinite',
        'pulse-slow': 'pulse 3s ease-in-out infinite',
      },
      keyframes: {
        fadeInUp: {
          '0%': { opacity: '0', transform: 'translateY(30px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        float: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-20px)' },
        },
      },
    },
  },
  plugins: [],
}
```

### CSS Utilities
```css
/* app.css */
@import "tailwindcss";

@utility line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

@utility line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

@utility animation-delay-* {
  animation-delay: --value(integer)ms;
}

.animation-delay-200 { animation-delay: 200ms; }
.animation-delay-400 { animation-delay: 400ms; }
.animation-delay-600 { animation-delay: 600ms; }
.animation-delay-800 { animation-delay: 800ms; }
.animation-delay-1000 { animation-delay: 1000ms; }

/* Custom scrollbar */
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 4px;
}

.dark ::-webkit-scrollbar-track {
  background: #1f2937;
}

.dark ::-webkit-scrollbar-thumb {
  background: #4b5563;
}
```

---

## 🎯 **ICON SYSTEM (HEROICONS)**

### Installation
```bash
npm install @heroicons/vue
```

### Usage Pattern
```vue
<script setup>
import { 
  HomeIcon,
  BriefcaseIcon,
  DocumentTextIcon,
  EnvelopeIcon,
  SunIcon,
  MoonIcon,
  ArrowRightIcon,
  ChevronLeftIcon,
  ChevronRightIcon,
  CodeBracketIcon,
  DevicePhoneMobileIcon,
  PaintBrushIcon,
  ChartBarIcon,
  StarIcon,
  CalendarIcon,
  UserIcon,
  HeartIcon
} from '@heroicons/vue/24/outline'

// For solid icons
import { StarIcon as StarSolidIcon } from '@heroicons/vue/24/solid'
</script>

<template>
  <HomeIcon class="w-6 h-6" />
  <StarSolidIcon class="w-5 h-5 text-yellow-400" />
</template>
```

---

## ✨ **ANIMATION PATTERNS**

### Fade In Up Animation
```vue
<template>
  <div class="animate-fade-in-up" :class="`animation-delay-${index * 200}`">
    Content
  </div>
</template>
```

### Hover Lift Effect
```vue
<template>
  <div class="transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
    Card content
  </div>
</template>
```

### Scale on Hover
```vue
<template>
  <img class="transition-transform duration-500 hover:scale-110" src="image.jpg">
</template>
```

### Button Hover Effect
```vue
<template>
  <button class="relative overflow-hidden group">
    <span class="relative z-10">Button Text</span>
    <span class="absolute inset-0 bg-primary-600 opacity-0 group-hover:opacity-100 transition"></span>
  </button>
</template>
```

---

## 🌙 **DARK MODE IMPLEMENTATION**

### HTML Structure
```html
<html class="dark">
  <!-- Dark mode class on html element -->
</html>
```

### Tailwind Classes
```vue
<div class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
  <p class="text-gray-600 dark:text-gray-400">
    This text changes in dark mode
  </p>
</div>
```

### Theme Toggle Button
```vue
<template>
  <button @click="toggleTheme" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800">
    <SunIcon v-if="!isDark" class="w-5 h-5" />
    <MoonIcon v-else class="w-5 h-5" />
  </button>
</template>

<script setup>
import { useThemeStore } from '@/Stores/theme'
const theme = useThemeStore()
const { isDark, toggleTheme } = theme
</script>
```

---

## 📱 **MOBILE NAVIGATION**

### MobileBottomNav.vue
```vue
<template>
  <nav class="fixed bottom-0 left-0 right-0 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border-t border-gray-200 dark:border-gray-800 md:hidden z-50 pb-safe">
    <div class="flex justify-around items-center h-16">
      <router-link v-for="item in navItems" :key="item.path" :to="item.path" 
                   class="flex flex-col items-center" 
                   :class="{ 'text-primary-600': $route.path === item.path }">
        <component :is="item.icon" class="w-6 h-6" />
        <span class="text-xs">{{ item.name }}</span>
      </router-link>
    </div>
  </nav>
</template>

<script setup>
import { HomeIcon, BriefcaseIcon, DocumentTextIcon, EnvelopeIcon } from '@heroicons/vue/24/outline'

const navItems = [
  { name: 'Home', path: '/', icon: HomeIcon },
  { name: 'Work', path: '/work', icon: BriefcaseIcon },
  { name: 'Notes', path: '/notes', icon: DocumentTextIcon },
  { name: 'Contact', path: '/contact', icon: EnvelopeIcon }
]
</script>

<style scoped>
.pb-safe {
  padding-bottom: env(safe-area-inset-bottom, 0);
}
</style>
```

---

## 🎠 **CAROUSEL IMPLEMENTATION (SWIPER)**

### Installation
```bash
npm install swiper
```

### FeaturedProjects.vue with Carousel
```vue
<template>
  <section class="py-20">
    <div class="max-w-7xl mx-auto px-4">
      <h2 class="text-4xl font-bold text-center mb-12">Featured Projects</h2>
      
      <Swiper
        :modules="[Navigation, Pagination, Autoplay]"
        :slides-per-view="1"
        :space-between="20"
        :navigation="true"
        :pagination="{ clickable: true }"
        :autoplay="{ delay: 5000, disableOnInteraction: false }"
        :breakpoints="{
          640: { slidesPerView: 2 },
          1024: { slidesPerView: 3 }
        }"
        class="projects-swiper"
      >
        <SwiperSlide v-for="project in projects" :key="project.id">
          <ProjectCard :project="project" />
        </SwiperSlide>
      </Swiper>
    </div>
  </section>
</template>

<script setup>
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Pagination, Autoplay } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
</script>

<style scoped>
.projects-swiper {
  padding: 20px 10px 40px;
}

:deep(.swiper-button-next),
:deep(.swiper-button-prev) {
  color: #4f46e5;
  background: white;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
}

:deep(.swiper-button-next:after),
:deep(.swiper-button-prev:after) {
  font-size: 18px;
}

:deep(.swiper-pagination-bullet-active) {
  background: #4f46e5;
}

.dark :deep(.swiper-button-next),
.dark :deep(.swiper-button-prev) {
  background: #1f2937;
  color: #818cf8;
}
</style>
```

---

## 📦 **PACKAGE.JSON DEPENDENCIES**

```json
{
  "private": true,
  "type": "module",
  "scripts": {
    "dev": "vite",
    "build": "vite build",
    "preview": "vite preview"
  },
  "devDependencies": {
    "@vitejs/plugin-vue": "^5.0.0",
    "autoprefixer": "^10.4.16",
    "laravel-vite-plugin": "^1.0",
    "postcss": "^8.4.32",
    "tailwindcss": "^4.0.0",
    "vite": "^5.0"
  },
  "dependencies": {
    "@heroicons/vue": "^2.1.1",
    "@vueuse/core": "^10.7.0",
    "axios": "^1.6.2",
    "pinia": "^2.1.7",
    "swiper": "^11.0.5",
    "vue": "^3.4.0",
    "vue-router": "^4.2.5"
  }
}
```

---

## 🚀 **INSTALLATION COMMANDS**

```bash
# 1. Install PHP dependencies
composer install

# 2. Install NPM dependencies
npm install

# 3. Install additional frontend packages
npm install @heroicons/vue swiper pinia @vueuse/core axios

# 4. Setup environment
cp .env.example .env
php artisan key:generate

# 5. Run migrations
php artisan migrate

# 6. Start development servers
php artisan serve
npm run dev
```

---

## 📝 **FILE GENERATION CHECKLIST**

When generating any new file, ensure:

- [ ] Correct file path according to folder structure
- [ ] Vue 3 Composition API with `<script setup>`
- [ ] All required imports included
- [ ] Props defined with validation
- [ ] Loading states implemented
- [ ] Error handling with try/catch
- [ ] Responsive design (mobile first)
- [ ] Dark mode support with `dark:` classes
- [ ] Tailwind v4 classes used correctly
- [ ] Heroicons imported and used
- [ ] Animation classes where appropriate
- [ ] No console errors
- [ ] Proper image fallbacks

---

## 🎯 **PAGE GENERATION ORDER**

### Phase 1: Core Pages
1. HomePage.vue
2. WorkListPage.vue
3. WorkDetailPage.vue
4. ServicesListPage.vue
5. ServiceDetailPage.vue

### Phase 2: Content Pages
6. NotesListPage.vue
7. ArticleDetailPage.vue
8. BlogListPage.vue
9. PostDetailPage.vue

### Phase 3: Tools Pages
10. ToolsListPage.vue
11. JsonFormatterPage.vue
12. ApiViewerPage.vue
13. SlugGeneratorPage.vue
14. MarkdownPreviewPage.vue
15. TextUtilitiesPage.vue

### Phase 4: Contact & Info
16. ContactPage.vue
17. ThankYouPage.vue
18. SchedulePage.vue
19. AboutPage.vue
20. NowPage.vue
21. UsesPage.vue
22. PrivacyPage.vue
23. TermsPage.vue

### Phase 5: Auth Pages
24. LoginPage.vue
25. RegisterPage.vue

### Phase 6: Admin Pages
26. DashboardPage.vue
27. WorkManagement.vue
28. ServicesManagement.vue
29. NotesManagement.vue
30. BlogManagement.vue
31. ToolsManagement.vue
32. InquiriesPage.vue
33. InsightsPage.vue
34. MediaLibrary.vue
35. SettingsPage.vue

---

## ✅ **END OF DOCUMENTATION**

This document contains everything needed for an AI to understand and generate code for the VANTAGE project. Use this as a reference for all future page generations.