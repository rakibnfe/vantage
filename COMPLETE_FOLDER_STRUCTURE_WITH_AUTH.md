# VANTAGE - Complete Folder Structure with Authentication & Pages

**Last Updated:** March 10, 2026  
**Framework:** Laravel 12 + Vue 3 SPA  
**Database:** MySQL  
**Authentication:** Standard Laravel Auth (Breeze-style)

---

## 📑 TABLE OF CONTENTS

1. [Authentication System](#authentication-system)
2. [Public Pages (Vue)](#public-pages-vue)
3. [Admin Pages (Blade)](#admin-pages-blade)
4. [Backend Controllers & Models](#backend-controllers--models)
5. [Database Schema](#database-schema)
6. [API Routes](#api-routes)
7. [Web Routes](#web-routes)
8. [Folder Structure Tree](#folder-structure-tree)

---

## 🔐 AUTHENTICATION SYSTEM

### Overview
- **Type:** Standard Laravel Authentication
- **Package:** Laravel Breeze (devDependency)
- **Guard:** `web` (default)
- **Middleware:** `auth`, `guest`, `admin` (custom)
- **Users Table:** Has `role` column for role-based access

### Authentication Features
```php
// Registration & Login
- GET  /register              → RegisteredUserController@create
- POST /register              → RegisteredUserController@store
- GET  /login                 → AuthenticatedSessionController@create
- POST /login                 → AuthenticatedSessionController@store
- POST /logout                → AuthenticatedSessionController@destroy

// Password Reset
- GET  /forgot-password       → PasswordResetLinkController@create
- POST /forgot-password       → PasswordResetLinkController@store
- GET  /reset-password/{token}→ NewPasswordController@create
- POST /reset-password        → NewPasswordController@store

// Email Verification
- GET  /email/verification-prompt → VerificationPrompt
- GET  /email/verify/{id}/{hash}  → VerifyEmail
- POST /email/verification-send   → SendVerificationEmail

// Admin Login (Separate)
- GET  /admin/login           → Admin/LoginController@showLoginForm
- POST /admin/login           → Admin/LoginController@login
- POST /admin/logout          → Admin/LoginController@logout
```

### User Model
```php
// app/Models/User.php
- id
- name
- email (unique)
- password (hashed)
- role (string: 'user' | 'admin') [DEFAULT: 'user']
- is_active (boolean) [DEFAULT: true]
- profile_picture (nullable)
- bio (nullable)
- email_verified_at (nullable)
- remember_token (nullable)
- created_at
- updated_at

// Relationships
- hasMany('projects')
- hasMany('articles')
- hasMany('tools')

// Traits
- HasFactory
- Notifiable (Notifications)
- HasApiTokens (Sanctum)
- HasRoles (Spatie Permission)
```

### Middleware
```php
// app/Http/Middleware/AdminAuth.php
- Checks if user is authenticated
- Checks if user->role === 'admin'
- Redirects to /admin/login if not authorized
- Registered as 'admin' in Kernel.php
```

---

## 🏠 PUBLIC PAGES (VUE)

### Folder Structure
```
resources/js/Pages/Public/
├── Home/
│   └── HomePage.vue                    (/)
├── Work/
│   ├── WorkListPage.vue               (/work)
│   └── WorkDetailPage.vue             (/work/{slug})
├── Services/
│   ├── ServicesListPage.vue           (/services)
│   └── ServiceDetailPage.vue          (/services/{slug})
├── Notes/
│   ├── NotesListPage.vue              (/notes)
│   └── ArticleDetailPage.vue          (/notes/{slug})
├── Blog/
│   ├── BlogListPage.vue               (/blog)
│   └── PostDetailPage.vue             (/blog/{slug})
├── Tools/
│   ├── ToolsListPage.vue              (/tools)
│   ├── JsonFormatterPage.vue          (/tools/json-formatter)
│   ├── ApiViewerPage.vue              (/tools/api-viewer)
│   ├── SlugGeneratorPage.vue          (/tools/slug-generator)
│   ├── MarkdownPreviewPage.vue        (/tools/markdown-preview)
│   └── TextUtilitiesPage.vue          (/tools/text-utilities)
├── Contact/
│   ├── ContactPage.vue                (/contact)
│   └── ThankYouPage.vue               (/contact/thank-you)
├── Schedule/
│   └── SchedulePage.vue               (/schedule)
└── Info/
    ├── AboutPage.vue                  (/about)
    ├── NowPage.vue                    (/now)
    ├── UsesPage.vue                   (/uses)
    ├── PrivacyPage.vue                (/privacy)
    └── TermsPage.vue                  (/terms)
```

### Page Descriptions

#### **HomePage.vue** (/)
- Hero section with introduction
- Featured work showcase
- Services overview (fetched from API)
- Recent writings/articles
- Featured tools preview
- Let's connect CTA section

#### **Work Pages**
- **WorkListPage.vue** (/work): Projects grid with filters, search
- **WorkDetailPage.vue** (/work/{slug}): Individual project with full details, metrics, related services

#### **Services Pages** (Dynamic from DB)
- **ServicesListPage.vue** (/services): List of all services with dynamic content from DB
- **ServiceDetailPage.vue** (/services/{slug}): 
  - Fetches from `/api/services/{slug}`
  - Full service details (overview, features, process, tech stack, pricing, FAQs)
  - Related projects, case studies
  - Dynamic CTA buttons

#### **Notes Pages**
- **NotesListPage.vue** (/notes): Article grid with search, tags, filters
- **ArticleDetailPage.vue** (/notes/{slug}): Individual article with Table of Contents, related articles

#### **Blog Pages**
- **BlogListPage.vue** (/blog): Featured posts, categories, pagination
- **PostDetailPage.vue** (/blog/{slug}): Individual blog post with comments, shares, related posts

#### **Tools Pages**
- **ToolsListPage.vue** (/tools): Grid of available tools
- **JsonFormatterPage.vue** (/tools/json-formatter): JSON input/output formatting
- **ApiViewerPage.vue** (/tools/api-viewer): API response tree visualization
- **SlugGeneratorPage.vue** (/tools/slug-generator): URL slug generation
- **MarkdownPreviewPage.vue** (/tools/markdown-preview): Live markdown preview
- **TextUtilitiesPage.vue** (/tools/text-utilities): Character/word count, case conversion

#### **Contact Pages**
- **ContactPage.vue** (/contact): Contact form, response time expectations
- **ThankYouPage.vue** (/contact/thank-you): Success confirmation

#### **Schedule Page** (/schedule)
- Calendar booking interface

#### **Info Pages**
- **AboutPage.vue** (/about): Personal bio, journey, philosophy
- **NowPage.vue** (/now): Current projects, learning, reading
- **UsesPage.vue** (/uses): Hardware, software, tools
- **PrivacyPage.vue** (/privacy): Privacy policy
- **TermsPage.vue** (/terms): Terms of service

---

## 🔐 ADMIN PAGES (BLADE)

### Folder Structure
```
resources/views/admin/
├── layouts/
│   └── app.blade.php                  (Main admin layout)
├── dashboard/
│   └── index.blade.php                (/admin/dashboard)
├── work/
│   └── index.blade.php                (/admin/work)
├── services/
│   └── index.blade.php                (/admin/services)
├── notes/
│   └── index.blade.php                (/admin/notes)
├── blog/
│   └── index.blade.php                (/admin/blog)
├── tools/
│   └── index.blade.php                (/admin/tools)
├── inquiries/
│   └── index.blade.php                (/admin/inquiries)
├── insights/
│   └── index.blade.php                (/admin/insights)
├── media/
│   └── index.blade.php                (/admin/media)
└── settings/
    └── index.blade.php                (/admin/settings)
```

### Admin Pages Overview

#### Dashboard (/admin/dashboard)
- Quick stats (visitors, inquiries, projects, articles)
- Recent inquiries/messages
- Recent content updates
- Quick action buttons

#### Work Management (/admin/work)
- List all projects with table (title, status, featured, actions)
- Add new project form
- Edit project form
- Delete with confirmation
- Search/filter by title, status

#### Services Management (/admin/services) - FULLY DYNAMIC
- **List View:**
  - Table with: title, slug, order, status (published/draft), featured, actions
  - Search/filter functionality
  - Drag-to-reorder interface
  - Bulk actions (publish, draft, delete)
  - Preview button

- **Add/Edit Service Form:**
  - Title, Slug (auto-generated)
  - Tagline, Icon selector
  - Featured image upload
  - Overview (rich text editor)
  - Key Features (repeater: title + description)
  - Process Steps (repeater: step title + description)
  - Technologies (tag input)
  - Pricing Models (repeater: name + description)
  - FAQs (repeater: question + answer)
  - Related Projects (multi-select)
  - Meta Title, Meta Description (SEO)
  - Order position, Publish status

#### Notes Management (/admin/notes)
- List articles (title, status, published date, actions)
- Write/edit article with rich editor
- Tags manager (add, edit, merge, delete)
- Schedule future publishing

#### Blog Management (/admin/blog)
- List posts (title, category, status, actions)
- Write/edit post with rich editor
- Categories manager (add, edit, delete)
- Comments manager (approve, edit, delete)
- Tags management

#### Tools Management (/admin/tools)
- List configured tools
- Enable/disable tools
- Configure tool settings
- Usage statistics

#### Inquiries Management (/admin/inquiries)
- Inbox with list of messages
- Read/unread status
- Message detail view
- Reply form
- Status tags (new, replied, closed)
- Inquiry reports/trends

#### Insights Dashboard (/admin/insights)
- Traffic overview (visitors chart, page views, time on site)
- Popular content (top projects, articles, services, tools)
- Referral sources
- Device breakdown (desktop/mobile, browsers, OS)
- Tool usage stats
- Conversion metrics

#### Media Library (/admin/media)
- Folder management (create, rename, delete)
- File grid with thumbnails
- Drag & drop upload
- Image editing (crop, resize, optimize)
- Usage tracking

#### Settings (/admin/settings)
- Site settings (name, description, logo, favicon)
- SEO defaults (meta title format, description, social images)
- Email configuration (SMTP, templates, test)
- User management (list, add, permissions, delete)
- Activity logs
- Cookie consent settings

---

## 🏗️ BACKEND CONTROLLERS & MODELS

### Controllers

```
app/Http/Controllers/
├── Auth/
│   ├── RegisteredUserController.php
│   ├── AuthenticatedSessionController.php
│   ├── PasswordResetLinkController.php
│   ├── NewPasswordController.php
│   ├── EmailVerificationPromptController.php
│   ├── VerifyEmailController.php
│   └── EmailVerificationNotificationController.php
├── Admin/
│   ├── LoginController.php           (Admin login)
│   ├── DashboardController.php
│   ├── WorkController.php
│   ├── ServiceController.php
│   ├── NoteController.php
│   ├── BlogController.php
│   ├── ToolController.php
│   ├── InquiryController.php
│   ├── InsightController.php
│   ├── MediaController.php
│   └── SettingController.php
├── HomeController.php                (Public dashboard)
└── ProfileController.php             (Auth user profile)
```

### Models

```
app/Models/
├── User.php                          (name, email, role, is_active, etc.)
├── Project.php
├── Service.php
├── Article.php
├── Blog.php
├── Category.php
├── Tag.php
├── Tool.php
├── Contact.php                       (Inquiry messages)
├── Visitor.php                       (Analytics)
├── ToolUsage.php                     (Tool statistics)
├── ServiceFeature.php
├── ServicePricingModel.php
├── ServiceProcessStep.php
├── ServiceTechnology.php
├── ServiceFAQ.php
└── PageView.php
```

---

## 📊 DATABASE SCHEMA

### Core Tables

#### users
```sql
id
name
email (unique)
password (hashed)
role (string: 'user' | 'admin')
is_active (boolean)
profile_picture (JSON|nullable)
bio (text|nullable)
email_verified_at (timestamp|nullable)
remember_token (string|nullable)
created_at
updated_at
```

#### services (DYNAMIC)
```sql
id
title
slug (unique)
tagline
icon
featured_image
overview (longText)
process (json|nullable)
features (json)
technologies (json)
pricing_models (json)
faqs (json)
meta_title
meta_description
order (integer)
is_published (boolean)
published_at (timestamp|nullable)
created_at
updated_at
```

#### projects
```sql
id
title
slug
description
overview
technologies (json)
problem_statement
my_role
timeline
results (json)
featured_image
url_demo (nullable)
url_github (nullable)
is_featured (boolean)
created_at
updated_at
```

#### articles
```sql
id
title
slug
description
content (longText)
reading_time
is_featured (boolean)
published_at (timestamp)
created_at
updated_at
```

#### blog_posts
```sql
id
title
slug
content (longText)
category_id
user_id
is_published (boolean)
published_at (timestamp|nullable)
created_at
updated_at
```

#### contacts (Inquiries)
```sql
id
name
email
subject
message
budget_range (nullable)
timeline (nullable)
status (string: 'new' | 'replied' | 'closed')
page_url (nullable)
replied_at (timestamp|nullable)
created_at
updated_at
```

#### tools
```sql
id
name
slug
description
icon (nullable)
is_enabled (boolean)
config (json|nullable)
created_at
updated_at
```

#### visitors (Analytics)
```sql
id
ip_address
user_agent
visiting_page
referer (nullable)
created_at
```

#### page_views (Analytics)
```sql
id
visitor_id (foreign)
page_url
created_at
```

#### tags
```sql
id
name
slug
visibility (string: 'public' | 'private')
created_at
updated_at
```

#### categories
```sql
id
name
slug
description (nullable)
created_at
updated_at
```

---

## 📡 API ROUTES

### Prefix: `/api`

```php
// Public API (no auth required)
GET    /services                       → Get all services (paginated)
GET    /services/{slug}                → Get single service by slug
GET    /articles                       → Get all articles (paginated)
GET    /blog                           → Get all blog posts (paginated)
GET    /projects                       → Get all projects (paginated)
POST   /contact                        → Submit contact inquiry

// Authenticated API (auth:sanctum middleware)
POST   /profile/update                 → Update user profile
POST   /profile/avatar                 → Update user avatar
GET    /dashboard                      → Get user dashboard data

// Admin API (auth:sanctum + admin role)
GET    /admin/stats                    → Dashboard statistics
GET    /admin/services                 → List all services (full details)
POST   /admin/services                 → Create new service
PUT    /admin/services/{id}            → Update service
DELETE /admin/services/{id}            → Delete service
POST   /admin/services/reorder         → Reorder services
[Similar endpoints for projects, articles, blog, tools, contacts, etc.]
```

---

## 🛣️ WEB ROUTES

### Public Routes (No Auth)

```php
// Authentication
GET    /register                       → auth.register
POST   /register
GET    /login                          → auth.login
POST   /login
GET    /forgot-password                → password.request
POST   /forgot-password                → password.email
GET    /reset-password/{token}         → password.reset
POST   /reset-password                 → password.update
GET    /email/verify                   → verification.notice
GET    /email/verify/{id}/{hash}       → verification.verify
POST   /email/resend                   → verification.resend

// Public Pages (SPA routes in Vue Router)
GET    /                               → HomePage
GET    /work                           → WorkListPage
GET    /work/{slug}                    → WorkDetailPage
GET    /services                       → ServicesListPage
GET    /services/{slug}                → ServiceDetailPage
GET    /notes                          → NotesListPage
GET    /notes/{slug}                   → ArticleDetailPage
GET    /blog                           → BlogListPage
GET    /blog/{slug}                    → PostDetailPage
GET    /tools                          → ToolsListPage
GET    /tools/{tool-name}              → Individual tool pages
GET    /contact                        → ContactPage
GET    /contact/thank-you              → ThankYouPage
GET    /schedule                       → SchedulePage
GET    /about                          → AboutPage
GET    /now                            → NowPage
GET    /uses                           → UsesPage
GET    /privacy                        → PrivacyPage
GET    /terms                          → TermsPage

// Dashboard (Auth required)
POST   /logout                         → auth.logout
GET    /dashboard                      → auth.dashboard (Blade)
```

### Admin Routes (Auth + Admin Role)

```php
Route::prefix('admin')->name('admin.')->group(function () {
    // Login (guest only)
    Route::middleware('guest')->group(function () {
        GET  /login                    → AdminLoginController@showLoginForm
        POST /login                    → AdminLoginController@login
    });

    // Protected admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        POST /logout                   → AdminLoginController@logout
        GET  /dashboard                → DashboardController@index
        
        // Work CRUD
        GET  /work                     → WorkController@index
        POST /work                     → WorkController@store
        GET  /work/{id}/edit           → WorkController@edit
        PUT  /work/{id}                → WorkController@update
        DELETE /work/{id}              → WorkController@destroy
        
        // Services CRUD (Fully Dynamic)
        GET  /services                 → ServiceController@index
        GET  /services/create          → ServiceController@create
        POST /services                 → ServiceController@store
        GET  /services/{id}/edit       → ServiceController@edit
        PUT  /services/{id}            → ServiceController@update
        DELETE /services/{id}          → ServiceController@destroy
        POST /services/reorder         → ServiceController@reorder
        
        [Similar CRUD routes for notes, blog, tools, etc.]
        
        // Inquiries
        GET  /inquiries                → InquiryController@index
        GET  /inquiries/{id}           → InquiryController@show
        POST /inquiries/{id}/reply     → InquiryController@reply
        PUT  /inquiries/{id}/status    → InquiryController@updateStatus
        
        // Insights/Analytics
        GET  /insights                 → InsightController@index
        
        // Media
        GET  /media                    → MediaController@index
        POST /media/upload             → MediaController@upload
        
        // Settings
        GET  /settings                 → SettingController@index
        POST /settings/update          → SettingController@update
    });

    // Email Verification
    GET  /email/verify                 → VerificationPrompt
    GET  /email/verify/{id}/{hash}    → VerifyEmail
    POST /email/resend                 → EmailVerificationNotification
});
```

---

## 📁 COMPLETE FOLDER STRUCTURE TREE

```
project-root/
│
├── app/
│   ├── Actions/
│   │   ├── Project/
│   │   ├── Service/
│   │   ├── Article/
│   │   ├── Blog/
│   │   ├── Tool/
│   │   └── Contact/
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── RegisteredUserController.php
│   │   │   │   ├── AuthenticatedSessionController.php
│   │   │   │   ├── PasswordResetLinkController.php
│   │   │   │   ├── NewPasswordController.php
│   │   │   │   ├── VerifyEmailController.php
│   │   │   │   └── EmailVerificationController.php
│   │   │   ├── Admin/
│   │   │   │   ├── LoginController.php
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── WorkController.php
│   │   │   │   ├── ServiceController.php
│   │   │   │   ├── NoteController.php
│   │   │   │   ├── BlogController.php
│   │   │   │   ├── ToolController.php
│   │   │   │   ├── InquiryController.php
│   │   │   │   ├── InsightController.php
│   │   │   │   ├── MediaController.php
│   │   │   │   └── SettingController.php
│   │   │   ├── HomeController.php
│   │   │   └── ProfileController.php
│   │   │
│   │   ├── Middleware/
│   │   │   ├── AdminAuth.php
│   │   │   ├── Authenticate.php
│   │   │   └── [Laravel defaults]
│   │   │
│   │   └── Kernel.php
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Project.php
│   │   ├── Service.php
│   │   ├── ServiceFeature.php
│   │   ├── ServicePricingModel.php
│   │   ├── ServiceProcessStep.php
│   │   ├── ServiceTechnology.php
│   │   ├── ServiceFAQ.php
│   │   ├── Article.php
│   │   ├── BlogPost.php
│   │   ├── Category.php
│   │   ├── Tag.php
│   │   ├── Tool.php
│   │   ├── ToolUsage.php
│   │   ├── Contact.php
│   │   ├── Visitor.php
│   │   ├── PageView.php
│   │   └── DTOs/ [Data Transfer Objects]
│   │
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   └── [others]
│   │
│   ├── Services/
│   │   ├── Analytics/
│   │   ├── Content/
│   │   ├── Contact/
│   │   ├── Media/
│   │   └── Tool/
│   │
│   ├── Traits/
│   ├── Events/
│   ├── Listeners/
│   ├── Policies/
│   ├── Rules/
│   └── Enums/
│
├── bootstrap/
│   └── [Laravel bootstrap files]
│
├── config/
│   └── [All Laravel config files]
│
├── database/
│   ├── migrations/
│   │   ├── 2026_03_10_110656_create_users_table.php
│   │   ├── 2026_03_10_110709_create_personal_access_tokens_table.php
│   │   ├── [other migrations]
│   │   └── 2026_03_10_120000_add_role_to_users_table.php
│   │
│   ├── factories/
│   │   ├── UserFactory.php
│   │   └── [other factories]
│   │
│   └── seeders/
│       └── DatabaseSeeder.php
│
├── resources/
│   ├── css/
│   │   ├── app.css
│   │   └── admin.css
│   │
│   ├── js/
│   │   ├── app.js
│   │   │
│   │   ├── Pages/
│   │   │   ├── Public/
│   │   │   │   ├── Home/
│   │   │   │   │   └── HomePage.vue
│   │   │   │   ├── Work/
│   │   │   │   │   ├── WorkListPage.vue
│   │   │   │   │   └── WorkDetailPage.vue
│   │   │   │   ├── Services/
│   │   │   │   │   ├── ServicesListPage.vue
│   │   │   │   │   └── ServiceDetailPage.vue
│   │   │   │   ├── Notes/
│   │   │   │   │   ├── NotesListPage.vue
│   │   │   │   │   └── ArticleDetailPage.vue
│   │   │   │   ├── Blog/
│   │   │   │   │   ├── BlogListPage.vue
│   │   │   │   │   └── PostDetailPage.vue
│   │   │   │   ├── Tools/
│   │   │   │   │   ├── ToolsListPage.vue
│   │   │   │   │   ├── JsonFormatterPage.vue
│   │   │   │   │   ├── ApiViewerPage.vue
│   │   │   │   │   ├── SlugGeneratorPage.vue
│   │   │   │   │   ├── MarkdownPreviewPage.vue
│   │   │   │   │   └── TextUtilitiesPage.vue
│   │   │   │   ├── Contact/
│   │   │   │   │   ├── ContactPage.vue
│   │   │   │   │   └── ThankYouPage.vue
│   │   │   │   ├── Schedule/
│   │   │   │   │   └── SchedulePage.vue
│   │   │   │   └── Info/
│   │   │   │       ├── AboutPage.vue
│   │   │   │       ├── NowPage.vue
│   │   │   │       ├── UsesPage.vue
│   │   │   │       ├── PrivacyPage.vue
│   │   │   │       └── TermsPage.vue
│   │   │   │
│   │   │   └── Auth/
│   │   │       └── [Auth pages if using Vue]
│   │   │
│   │   ├── Components/
│   │   │   ├── Common/
│   │   │   ├── Sections/
│   │   │   ├── Forms/
│   │   │   ├── Cards/
│   │   │   └── [reusable Vue components]
│   │   │
│   │   ├── Stores/ (Pinia)
│   │   │   ├── useAuthStore.js
│   │   │   ├── useServiceStore.js
│   │   │   ├── useProjectStore.js
│   │   │   └── [other stores]
│   │   │
│   │   ├── Router/
│   │   │   └── index.js
│   │   │
│   │   ├── Layouts/
│   │   │   └── PublicLayout.vue
│   │   │
│   │   └── [other Vue utilities]
│   │
│   └── views/
│       ├── app.blade.php              (Vue SPA entry point)
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── admin/
│       │   ├── layouts/
│       │   │   └── app.blade.php
│       │   ├── dashboard/
│       │   │   └── index.blade.php
│       │   ├── work/
│       │   │   └── index.blade.php
│       │   ├── services/
│       │   │   └── index.blade.php
│       │   ├── notes/
│       │   │   └── index.blade.php
│       │   ├── blog/
│       │   │   └── index.blade.php
│       │   ├── tools/
│       │   │   └── index.blade.php
│       │   ├── inquiries/
│       │   │   └── index.blade.php
│       │   ├── insights/
│       │   │   └── index.blade.php
│       │   ├── media/
│       │   │   └── index.blade.php
│       │   └── settings/
│       │       └── index.blade.php
│       └── dashboard.blade.php        (User dashboard)
│
├── routes/
│   ├── web.php                        (Web routes + auth + SPA)
│   ├── api.php                        (API routes)
│   ├── admin.php                      (Admin routes)
│   └── console.php
│
├── storage/
│   ├── app/
│   ├── framework/
│   └── logs/
│
├── tests/
│   ├── Feature/
│   │   ├── AuthTest.php
│   │   └── [other feature tests]
│   ├── Unit/
│   └── TestCase.php
│
├── vendor/ (Composer dependencies)
│
├── public/
│   ├── index.php
│   ├── build/ (Compiled assets)
│   ├── css/
│   ├── js/
│   └── [other public files]
│
├── .env
├── .env.example
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
├── vite.config.js
├── postcss.config.js
├── tailwind.config.js
├── phpunit.xml
├── README.md
├── GETTING_STARTED.md
├── PROJECT_STRUCTURE.md
├── DATABASE_ARCHITECTURE.md
└── COMPLETE_FOLDER_STRUCTURE_WITH_AUTH.md (This file)
```

---

## 🎯 KEY IMPLEMENTATION NOTES

### Authentication Flow
1. User visits `/register` → Public auth page (Blade or Vue)
2. Fills registration form → `RegisteredUserController@store`
3. User created with `role = 'user'` by default
4. Auto-login → Redirects to `/dashboard`
5. Admin login at `/admin/login` → restricted to `role = 'admin'`

### Public Pages Flow
1. Vue Router handles all routes (single-page app)
2. Pages fetch API data where needed (services, articles, etc.)
3. Layout wrapper provides consistent header/footer
4. No authentication required for public pages

### Admin Pages Flow
1. All admin routes go through middleware (`auth`, `admin`)
2. Blade templates render server-side
3. Only accessible to users with `role = 'admin'`
4. Can manage all content (services, projects, articles, etc.)

### Database Relationships
- Users → hasMany Projects
- Users → hasMany Articles
- Services → hasMany Features/PricingModels/ProcessSteps/FAQs/Technologies
- Articles → belongsToMany Tags
- Blog → belongsTo Category
- Contacts → tracked as inquiries

### API Endpoints
- Public endpoints for frontend consumption
- Sanctum tokens for authenticated API access
- Admin endpoints require both auth and admin role
- All responses return JSON

---

## 📝 NEXT STEPS

1. Run `php artisan migrate` to create all tables
2. Optionally run `php artisan breeze:install` for scaffolding
3. Generate all Vue pages (see AI_PROMPT_FOR_PAGE_GENERATION.md)
4. Generate all Blade admin pages
5. Create controllers and implement CRUD operations
6. Wire up API endpoints
7. Test authentication flow
8. Deploy to production

---

**End of Document**