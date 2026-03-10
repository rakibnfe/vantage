# Vantage Project Structure

Complete directory mapping and file purposes for the Laravel 12 + Vue 3 SPA portfolio platform.

---

## 📊 Visual Hierarchy

```
vantage/
├── app/                          # Laravel application code
│   ├── Models/                   # Database models (Eloquent ORM)
│   ├── Http/
│   │   ├── Controllers/          # Request handlers
│   │   ├── Requests/             # Form request validation
│   │   ├── Resources/            # API response transformers
│   │   └── Middleware/           # Route & request middleware
│   ├── Traits/                   # Reusable behavior classes
│   ├── Exceptions/               # Custom exception classes
│   └── Services/                 # Business logic services
├── bootstrap/                    # Framework bootstrapping
├── config/                       # Configuration files
├── database/
│   ├── migrations/               # Schema changes
│   ├── seeders/                  # Database seed data
│   └── factories/                # Model factories for testing
├── resources/
│   ├── js/                       # Vue 3 frontend application
│   │   ├── pages/                # Page components (route targets)
│   │   ├── components/           # Reusable Vue components
│   │   ├── layouts/              # Layout wrapper components
│   │   ├── stores/               # Pinia state management
│   │   ├── router/               # Vue Router configuration
│   │   ├── composables/          # Reusable Vue 3 logic
│   │   ├── bootstrap.js          # Initialization script
│   │   └── app.js                # Main Vue app entry
│   ├── css/
│   │   └── app.css               # Global styles & Tailwind directives
│   └── views/
│       └── app.blade.php         # Root SPA template
├── routes/
│   ├── web.php                   # Web routes (SPA catch-all)
│   ├── api.php                   # API routes (/api/...)
│   └── console.php               # Artisan commands
├── storage/                      # Logs, sessions, cache
├── tests/                        # Test suites
├── vite.config.js                # Vite build configuration
├── postcss.config.js             # PostCSS pipeline config
├── tailwind.config.js            # Tailwind CSS config
├── package.json                  # Node dependencies
├── composer.json                 # PHP dependencies
├── .env                          # Environment variables
├── artisan                       # Laravel CLI
├── README.md                     # Project documentation
└── PROJECT_STRUCTURE.md          # This file
```

---

## 🗂️ Detailed Directory Guide

### `/app/Models`
**Purpose:** Eloquent ORM models for database operations
- `User.js` - Users table model
- `Service.js` - Services (work/expertise) model
- `Project.js` - Portfolio projects model
- `Article.js` - Notes/blog articles model
- `Tool.js` - Tool definitions model
- `Visitor.js` - Analytics visitor tracking
- `Contact.js` - Contact form submissions

### `/app/Http/Controllers`
**Purpose:** Route handlers and business logic
- `PageController` - Render page content
- `ApiController` - API endpoint handlers
- `ContactController` - Form submission handling

### `/resources/js`
**Purpose:** Vue 3 (Composition API) frontend application

#### `/resources/js/Pages`
Route-bound page components (one per route):
- `HomePage.vue` - Home page (`/`)
- `ProjectsPage.vue` - Projects listing (`/work`)
- `ProjectDetailPage.vue` - Single project (`/work/:slug`)
- `ServicesPage.vue` - Services listing (`/services`)
- `ServiceDetailPage.vue` - Single service (`/services/:slug`)
- `ArticlesPage.vue` - Articles listing (`/notes`)
- `ArticleDetailPage.vue` - Single article (`/notes/:slug`)
- `BlogPage.vue` - Blog listing (`/blog`)
- `BlogPostPage.vue` - Single blog post (`/blog/:slug`)
- `ToolsPage.vue` - Tools overview (`/tools`)
- `ToolDetailPage.vue` - Tool information (`/tools/:slug`)
- **`/Tools/` - Interactive Tool Pages:**
  - `JsonFormatterPage.vue` - JSON formatter utility (`/tools/json-formatter`)
  - `ApiViewerPage.vue` - API response viewer (`/tools/api-viewer`)
  - `SlugGeneratorPage.vue` - URL slug generator (`/tools/slug-generator`)
  - `MarkdownPreviewPage.vue` - Markdown preview (`/tools/markdown-preview`)
  - `TextUtilitiesPage.vue` - Text utilities (counter, case converter) (`/tools/text-utilities`)
- `ContactPage.vue` - Contact form (`/contact`, `/contact/thank-you`)
- `AboutPage.vue` - About section (`/about`)
- `NowPage.vue` - Now page (`/now`)
- `UsesPage.vue` - Uses/stack page (`/uses`)
- **`/Legal/`:**
  - `PrivacyPage.vue` - Privacy policy (`/privacy`)
  - `TermsPage.vue` - Terms of service (`/terms`)

#### `/resources/js/Components`
Reusable Vue components used across pages:
- `Button.vue` - Styled button component
- `Card.vue` - Reusable card layout
- **`/tools/` - Tool-specific components:**
  - `JsonFormatter/JsonFormatterTool.vue` - JSON formatting logic
  - `ApiViewer/ApiViewerTool.vue` - API response parsing
  - `SlugGenerator/SlugGeneratorTool.vue` - Slug generation
  - `MarkdownPreview/MarkdownPreviewTool.vue` - Markdown rendering
  - `TextUtilities/TextUtilitiesTool.vue` - Text operations

#### `/resources/js/Layouts`
**Purpose:** Layout wrapper components
- `PublicLayout.vue` - Main SPA layout (header, nav, footer, router-view)

#### `/resources/js/Router`
**Purpose:** Vue Router configuration and route definitions
- `index.js` - Route definitions:
  ```
  / → HomePage
  /work → ProjectsPage
  /work/:slug → ProjectDetailPage
  /services → ServicesPage
  /services/:slug → ServiceDetailPage
  /notes → ArticlesPage
  /notes/:slug → ArticleDetailPage
  /blog → BlogPage
  /blog/:slug → BlogPostPage
  /tools → ToolsPage
  /tools/:slug → ToolDetailPage
  /tools/json-formatter → JsonFormatterPage
  /tools/api-viewer → ApiViewerPage
  /tools/slug-generator → SlugGeneratorPage
  /tools/markdown-preview → MarkdownPreviewPage
  /tools/text-utilities → TextUtilitiesPage
  /contact → ContactPage
  /about → AboutPage
  /now → NowPage
  /uses → UsesPage
  /privacy → PrivacyPage
  /terms → TermsPage
  ```

#### `/resources/js/Stores`
**Purpose:** Pinia state management stores
- `theme.js` - Dark/light mode, UI preferences
- `visitor.js` - Current visitor session data
- `services.js` - Cached services data
- `tools.js` - Tool history and favorites

#### `/resources/js`
**Purpose:** Main Vue application files
- `app.js` - Vue app initialization, Pinia/Router setup, mounts to #app
- `bootstrap.js` - Axios configuration, utility helpers

### `/resources/css`
**Purpose:** Global styles and Tailwind imports
- `app.css` - Contains:
  - `@import "tailwindcss"` - Tailwind CSS v4 (via PostCSS plugin)
  - Global component styles
  - Custom utility classes

### `/resources/views`
**Purpose:** Blade templates (Laravel templating)
- `app.blade.php` - Root HTML template:
  - DOCTYPE, meta tags, charset
  - `<div id="app"></div>` - Vue mount point
  - Vite script tag for dev/production

### `/database/migrations`
Database schema history:
- `create_users_table` - User accounts
- `create_services_table` - Services/expertise
- `create_projects_table` - Portfolio projects
- `create_articles_table` - Blog articles
- `create_tools_table` - Tool definitions
- `create_visitors_table` - Analytics tracking
- `create_contacts_table` - Contact form submissions
- Asset management (Spatie):
  - `create_media_table` - File attachments
- Activity logging (Spatie):
  - `create_activity_log_table` - Audit trail
- Permissions (Spatie):
  - `create_permissions_table` - Role/permission definitions
  - `create_roles_table`
  - `create_role_permission_table`
  - `create_user_role_table`

### `/routes`
**Purpose:** HTTP route definitions

- `web.php` - SPA catch-all route:
  ```php
  Route::get('/{any}', [PageController::class, 'index'])->where('any', '.*');
  ```
  All URLs route to Vue Router on frontend

- `api.php` - REST API endpoints:
  ```
  GET /api/services - List all services
  GET /api/services/{slug} - Get service by slug
  ```

### `/config`
**Purpose:** Laravel configuration files
- `database.php` - Database connection settings
- `app.php` - App name, timezone, locale
- `auth.php` - Authentication providers
- `filesystem.php` - File storage
- `view.php` - Blade view paths
- `queue.php` - Job queue configuration

### Root Configuration Files

- **`vite.config.js`** - Vite bundler:
  - Vue 3 plugin (@vitejs/plugin-vue)
  - Laravel Vite plugin for manifest
  - PostCSS processing

- **`postcss.config.js`** - PostCSS pipeline:
  - @tailwindcss/postcss plugin (Tailwind v4)
  - autoprefixer for vendor prefixes

- **`tailwind.config.js`** - Tailwind CSS:
  - Content paths (resources/js/**/*.vue)
  - Theme extensions
  - Plugin configurations

- **`package.json`** - Node dependencies:
  ```json
  {
    "dependencies": {
      "vue": "^3.4",
      "pinia": "^2.1",
      "vue-router": "^4.3",
      "axios": "^1.6"
    },
    "devDependencies": {
      "vite": "^5.0",
      "@vitejs/plugin-vue": "^5.0",
      "tailwindcss": "^4.0",
      "@tailwindcss/postcss": "^4.0",
      "postcss": "^8.4",
      "autoprefixer": "^10.4",
      "laravel-vite-plugin": "^1.0"
    }
  }
  ```

- **`composer.json`** - PHP dependencies:
  - Laravel framework
  - 12 packages (Sanctum, Horizon, Pulse, Spatie\Permission, etc.)

- **`.env`** - Environment variables:
  - APP_NAME, APP_ENV, APP_KEY
  - DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
  - CACHE_DRIVER, SESSION_DRIVER, QUEUE_CONNECTION

---

## 🔄 Data Flow Architecture

```
User Request
    ↓
routes/web.php (catch-all)
    ↓
PageController (Laravel)
    ↓
resources/views/app.blade.php (Vue mount)
    ↓
resources/js/app.js (Vue init)
    ↓
resources/js/Router/index.js (match route)
    ↓
resources/js/Pages/*.vue (render page)
    ↓
resources/js/Components/*.vue (nested components)
    ↓
resources/js/Stores/*.js (state if needed)
    ↓
axios/API calls → routes/api.php → ApiController → Models → Database
```

---

## 📦 Build & Runtime Process

### Development
```bash
npm run dev
# Vite dev server: http://localhost:5173 or 5174
# Hot Module Replacement enabled
# Vue DevTools available
```

### Production
```bash
npm run build
# Generates: public/build/
#   - app-[hash].js
#   - app-[hash].css
#   - manifest.json
php artisan serve
# Serves built app
```

### Environment Switching
- **Local:** SQLite (resources/db/database.sqlite)
- **Production:** MySQL (configured in .env)

---

## 🎯 Key Routes Summary

| Path | Handler | Component | Purpose |
|------|---------|-----------|---------|
| `/` | web.php → Vue | HomePage.vue | Landing page |
| `/work` | web.php → Vue | ProjectsPage.vue | Portfolio projects listing |
| `/work/:slug` | web.php → Vue | ProjectDetailPage.vue | Single project details |
| `/services` | web.php → Vue | ServicesPage.vue | Services/expertise listing |
| `/services/:slug` | web.php → Vue | ServiceDetailPage.vue | Service details |
| `/notes` | web.php → Vue | ArticlesPage.vue | Articles/notes listing |
| `/notes/:slug` | web.php → Vue | ArticleDetailPage.vue | Single article |
| `/blog` | web.php → Vue | BlogPage.vue | Blog posts listing |
| `/blog/:slug` | web.php → Vue | BlogPostPage.vue | Single blog post |
| `/tools` | web.php → Vue | ToolsPage.vue | Tools overview |
| `/tools/json-formatter` | web.php → Vue | JsonFormatterPage.vue | JSON formatter tool |
| `/tools/api-viewer` | web.php → Vue | ApiViewerPage.vue | API response viewer |
| `/tools/slug-generator` | web.php → Vue | SlugGeneratorPage.vue | URL slug generator |
| `/tools/markdown-preview` | web.php → Vue | MarkdownPreviewPage.vue | Markdown previewer |
| `/tools/text-utilities` | web.php → Vue | TextUtilitiesPage.vue | Text utilities (word count, case) |
| `/tools/:slug` | web.php → Vue | ToolDetailPage.vue | Individual tool info |
| `/contact` | web.php → Vue | ContactPage.vue | Contact form |
| `/about` | web.php → Vue | AboutPage.vue | About page |
| `/now` | web.php → Vue | NowPage.vue | Now page (/now updates) |
| `/uses` | web.php → Vue | UsesPage.vue | Stack/uses page |
| `/privacy` | web.php → Vue | PrivacyPage.vue | Privacy policy |
| `/terms` | web.php → Vue | TermsPage.vue | Terms of service |
| `/api/services` | api.php → ApiController | JSON | All services JSON |
| `/api/services/{slug}` | api.php → ApiController | JSON | Single service JSON |

---

## 🛠️ Technology Stack

| Layer | Technology | Version |
|-------|-----------|---------|
| Backend Framework | Laravel | 12 |
| Language (PHP) | PHP | 8.4 |
| Frontend Framework | Vue | 3.4 (Composition API) |
| Routing (Frontend) | Vue Router | 4.3 |
| State Management | Pinia | 2.1 |
| CSS Framework | Tailwind CSS | 4.0 (@tailwindcss/postcss) |
| Build Tool | Vite | 5.0 |
| CSS Processing | PostCSS + Autoprefixer | 8.4 + 10.4 |
| HTTP Client | Axios | 1.6 |
| Database (Local) | SQLite | Latest |
| Database (Prod) | MySQL | 8.0+ |
| ORM | Eloquent | Laravel 12 |
| Authentication | Laravel Sanctum | Latest |

---

## 📝 Next Steps for Development

1. **Replace placeholder content** in page components with actual data
2. **Connect API endpoints** - Update components to fetch from `/api/*` routes
3. **Add form validation** - ContactPage form submission handling
4. **Implement auth** - User login/registration (optional)
5. **Add SEO metadata** - Meta tags for each route
6. **Deploy to production** - Configure .env for MySQL, run migrations
7. **Set up CI/CD** - GitHub Actions or similar for automated deployment
8. **Monitor with Horizon/Pulse** - Queue monitoring and performance metrics

---

## 🔑 Important Files to Understand

- `routes/web.php` - How all routes reach Vue Router
- `resources/js/app.js` - How Vue boots
- `resources/js/Router/index.js` - All available routes
- `resources/js/Pages/HomePage.vue` - Example page structure
- `vite.config.js` - Build pipeline
- `.env` - Environment configuration
- `composer.json` / `package.json` - Dependencies

---

Maintained by: Project Team
Last Updated: 2025-03-10
