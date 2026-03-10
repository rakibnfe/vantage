import { createRouter, createWebHistory } from 'vue-router';

// Public Pages
import HomePage from '../Pages/HomePage.vue';
import ProjectsPage from '../Pages/ProjectsPage.vue';
import ProjectDetailPage from '../Pages/ProjectDetailPage.vue';
import ServicesPage from '../Pages/ServicesPage.vue';
import ServiceDetailPage from '../Pages/ServiceDetailPage.vue';
import ArticlesPage from '../Pages/ArticlesPage.vue';
import ArticleDetailPage from '../Pages/ArticleDetailPage.vue';
import ToolsPage from '../Pages/ToolsPage.vue';
import ToolDetailPage from '../Pages/ToolDetailPage.vue';
import ContactPage from '../Pages/ContactPage.vue';
import AboutPage from '../Pages/AboutPage.vue';
import NowPage from '../Pages/NowPage.vue';
import UsesPage from '../Pages/UsesPage.vue';
import BlogPage from '../Pages/BlogPage.vue';
import BlogPostPage from '../Pages/BlogPostPage.vue';
import PrivacyPage from '../Pages/Legal/PrivacyPage.vue';
import TermsPage from '../Pages/Legal/TermsPage.vue';
import JsonFormatterPage from '../Pages/Tools/JsonFormatterPage.vue';
import ApiViewerPage from '../Pages/Tools/ApiViewerPage.vue';
import SlugGeneratorPage from '../Pages/Tools/SlugGeneratorPage.vue';
import MarkdownPreviewPage from '../Pages/Tools/MarkdownPreviewPage.vue';
import TextUtilitiesPage from '../Pages/Tools/TextUtilitiesPage.vue';

const routes = [
  // Public Routes
  { path: '/', name: 'home', component: HomePage },
  { path: '/work', name: 'projects', component: ProjectsPage },
  { path: '/work/:slug', name: 'project-detail', component: ProjectDetailPage },
  { path: '/services', name: 'services', component: ServicesPage },
  { path: '/services/:slug', name: 'service-detail', component: ServiceDetailPage },
  { path: '/notes', name: 'articles', component: ArticlesPage },
  { path: '/notes/:slug', name: 'article-detail', component: ArticleDetailPage },
  { path: '/notes/topics/:topic', name: 'topic', component: ArticlesPage },
  { path: '/tools', name: 'tools', component: ToolsPage },
  { path: '/tools/json-formatter', name: 'tool-json-formatter', component: JsonFormatterPage },
  { path: '/tools/api-viewer', name: 'tool-api-viewer', component: ApiViewerPage },
  { path: '/tools/slug-generator', name: 'tool-slug-generator', component: SlugGeneratorPage },
  { path: '/tools/markdown-preview', name: 'tool-markdown-preview', component: MarkdownPreviewPage },
  { path: '/tools/text-utilities', name: 'tool-text-utilities', component: TextUtilitiesPage },
  { path: '/tools/:slug', name: 'tool-detail', component: ToolDetailPage },
  { path: '/contact', name: 'contact', component: ContactPage },
  { path: '/contact/thank-you', name: 'contact-thank-you', component: ContactPage },
  { path: '/about', name: 'about', component: AboutPage },
  { path: '/now', name: 'now', component: NowPage },
  { path: '/uses', name: 'uses', component: UsesPage },
  { path: '/blog', name: 'blog', component: BlogPage },
  { path: '/blog/:slug', name: 'blog-post', component: BlogPostPage },
  { path: '/blog/categories/:category', name: 'blog-category', component: BlogPage },
  { path: '/privacy', name: 'privacy', component: PrivacyPage },
  { path: '/terms', name: 'terms', component: TermsPage },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
