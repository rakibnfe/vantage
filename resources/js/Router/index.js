// resources/js/router/index.js
import { createRouter, createWebHistory } from 'vue-router'

// ==================== Layouts ====================
import PublicLayout from '@/Layouts/PublicLayout.vue'

// ==================== Public Pages ====================
// Home
import HomePage from '@/Pages/Public/Home/HomePage.vue'

// Work/Projects
import WorkListPage from '@/Pages/Public/Work/WorkListPage.vue'
import WorkDetailPage from '@/Pages/Public/Work/WorkDetailPage.vue'

// Services
import ServicesListPage from '@/Pages/Public/Services/ServicesListPage.vue'
import ServiceDetailPage from '@/Pages/Public/Services/ServiceDetailPage.vue'

// Notes/Articles
import NotesListPage from '@/Pages/Public/Notes/NotesListPage.vue'
import NoteDetailPage from '@/Pages/Public/Notes/NoteDetailPage.vue'

// Article
import ArticleListPage from '@/Pages/Public/Article/ArticleListPage.vue'
import ArticleDetailPage from '@/Pages/Public/Article/ArticleDetailPage.vue'

// Tools
import ToolsListPage from '@/Pages/Public/Tools/ToolsListPage.vue'
import JsonFormatterPage from '@/Pages/Public/Tools/JsonFormatterPage.vue'
import ApiViewerPage from '@/Pages/Public/Tools/ApiViewerPage.vue'
import SlugGeneratorPage from '@/Pages/Public/Tools/SlugGeneratorPage.vue'
import MarkdownPreviewPage from '@/Pages/Public/Tools/MarkdownPreviewPage.vue'
import TextUtilitiesPage from '@/Pages/Public/Tools/TextUtilitiesPage.vue'

// Contact
import ContactPage from '@/Pages/Public/Contact/ContactPage.vue'
import ThankYouPage from '@/Pages/Public/Contact/ThankYouPage.vue'

// Schedule
import SchedulePage from '@/Pages/Public/Schedule/SchedulePage.vue'

// Info Pages
import AboutPage from '@/Pages/Public/Info/AboutPage.vue'
import NowPage from '@/Pages/Public/Info/NowPage.vue'
import UsesPage from '@/Pages/Public/Info/UsesPage.vue'
import PrivacyPage from '@/Pages/Public/Info/PrivacyPage.vue'
import TermsPage from '@/Pages/Public/Info/TermsPage.vue'

// Auth Pages
import LoginPage from '@/Pages/Public/Auth/LoginPage.vue'
import RegisterPage from '@/Pages/Public/Auth/RegisterPage.vue'

// ==================== NEW PAGES ====================
// FAQ Pages
import FaqListPage from '@/Pages/Public/FAQ/FaqListPage.vue'

// Pricing Pages
import PricingPage from '@/Pages/Public/Pricing/PricingPage.vue'

// Process Pages
import ProcessPage from '@/Pages/Public/Process/ProcessPage.vue'

// ==================== Route Configuration ====================
const routes = [
  {
    path: '/',
    component: PublicLayout,
    children: [
      // Home
      { path: '', name: 'home', component: HomePage },

      // Work Routes
      { path: 'work', name: 'work.list', component: WorkListPage },
      { path: 'work/:slug', name: 'work.detail', component: WorkDetailPage },

      // Services Routes
      { path: 'services', name: 'services.list', component: ServicesListPage },
      { path: 'services/:slug', name: 'services.detail', component: ServiceDetailPage },

      // Notes Routes
      { path: 'notes', name: 'notes.list', component: NotesListPage },
      { path: 'notes/:slug', name: 'notes.detail', component: NoteDetailPage },
      { path: 'notes/topics/:topic', name: 'notes.topic', component: NotesListPage },

      // Article Routes
      { path: 'articles', name: 'article.list', component: ArticleListPage },
      { path: 'article/:slug', name: 'article.detail', component: ArticleDetailPage },
      { path: 'article/categories/:category', name: 'article.category', component: ArticleListPage },

      // Tools Routes
      { path: 'tools', name: 'tools.list', component: ToolsListPage },
      { path: 'tools/json-formatter', name: 'tools.json-formatter', component: JsonFormatterPage },
      { path: 'tools/api-viewer', name: 'tools.api-viewer', component: ApiViewerPage },
      { path: 'tools/slug-generator', name: 'tools.slug-generator', component: SlugGeneratorPage },
      { path: 'tools/markdown-preview', name: 'tools.markdown-preview', component: MarkdownPreviewPage },
      { path: 'tools/text-utilities', name: 'tools.text-utilities', component: TextUtilitiesPage },

      // Contact Routes
      { path: 'contact', name: 'contact', component: ContactPage },
      { path: 'contact/thank-you', name: 'contact.thank-you', component: ThankYouPage },

      // Schedule
      { path: 'schedule', name: 'schedule', component: SchedulePage },

      // Info Routes
      { path: 'about', name: 'about', component: AboutPage },
      { path: 'now', name: 'now', component: NowPage },
      { path: 'uses', name: 'uses', component: UsesPage },
      { path: 'privacy', name: 'privacy', component: PrivacyPage },
      { path: 'terms', name: 'terms', component: TermsPage },

      // Auth Routes
      { path: 'login', name: 'login', component: LoginPage },
      { path: 'register', name: 'register', component: RegisterPage },

      // ==================== NEW ROUTES ====================
      // FAQ Routes
      { path: 'faq', name: 'faq.list', component: FaqListPage },
      
      // Pricing Routes
      { path: 'pricing', name: 'pricing', component: PricingPage },
      
      // Process Routes
      { path: 'process', name: 'process', component: ProcessPage },
    ]
  }
]

// Create router instance
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { top: 0, behavior: 'smooth' }
    }
  }
})

// Navigation guard for auth routes (to be implemented later)
router.beforeEach((to, from, next) => {
  // Add auth logic here when ready
  next()
})

export default router