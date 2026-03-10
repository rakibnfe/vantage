# 📦 VANTAGE - Complete Folder Structure with Authentication & All Pages

**Project:** Vantage Portfolio Website  
**Framework:** Laravel 12 + Vue 3 SPA  
**Database:** MySQL  
**Last Updated:** March 10, 2026

---

## 📋 Table of Contents

1. [Project Overview](#project-overview)
2. [Directory Structure](#directory-structure)
3. [Complete File Tree](#complete-file-tree)
4. [Authentication System](#authentication-system)
5. [Public Pages (Vue)](#public-pages-vue)
6. [Admin Pages (Blade)](#admin-pages-blade)
7. [Database Tables](#database-tables)
8. [Routes](#routes)
9. [Controllers](#controllers)
10. [Models](#models)
11. [Setup Instructions](#setup-instructions)

---

## 🎯 Project Overview

**Vantage** is a full-stack portfolio and project management website with:
- **Public Frontend:** Showcases portfolio, services, blog, tools, and projects
- **Admin Dashboard:** Complete management system for content creation and analytics
- **Authentication System:** User registration, login, role-based access control
- **Dynamic Content:** Services, projects, articles, blog posts all managed from admin
- **Analytics:** Visitor tracking, page views, tool usage statistics
- **Developer Tools:** Free utilities for developers (JSON formatter, slug generator, etc.)

---

## 📁 Directory Structure

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
│   │   │   │   ├── EmailVerificationNotificationController.php
│   │   │   │   └── EmailVerificationPromptController.php
│   │   │   ├── HomeController.php
│   │   │   ├── ContactController.php
│   │   │   └── ProfileController.php
│   │   ├── Middleware/
│   │   │   ├── AdminAuth.php
│   │   │   └── VerifyAdmin.php
│   │   └── Requests/
│   │       ├── StoreProjectRequest.php
│   │       ├── UpdateProjectRequest.php
│   │       ├── StoreServiceRequest.php
│   │       └── StoreInquiryRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Project.php
│   │   ├── Service.php
│   │   ├── ServiceFeature.php
│   │   ├── ServiceProcessStep.php
│   │   ├── ServiceFAQ.php
│   │   ├── ServiceTechnology.php
│   │   ├── ServicePricingModel.php
│   │   ├── Article.php
│   │   ├── Blog.php
│   │   ├── Category.php
│   │   ├── Tag.php
│   │   ├── Tool.php
│   │   ├── ToolUsage.php
│   │   ├── Contact.php
│   │   ├── Visitor.php
│   │   └── PageView.php
│   ├── Actions/
│   ├── Services/
│   ├── Traits/
│   ├── Events/
│   ├── Listeners/
│   ├── Policies/
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   └── HorizonServiceProvider.php
│   └── Enums/
├── bootstrap/
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── database.php
│   ├── filesystems.php
│   ├── mail.php
│   └── queue.php
├── database/
│   ├── migrations/
│   │   ├── 2026_03_10_110656_create_users_table.php
│   │   ├── 2026_03_10_110700_create_projects_table.php
│   │   ├── 2026_03_10_110710_create_services_table.php
│   │   ├── 2026_03_10_110720_create_service_features_table.php
│   │   ├── 2026_03_10_110730_create_service_process_steps_table.php
│   │   ├── 2026_03_10_110740_create_service_faqs_table.php
│   │   ├── 2026_03_10_110750_create_service_technologies_table.php
│   │   ├── 2026_03_10_110760_create_service_pricing_models_table.php
│   │   ├── 2026_03_10_110770_create_articles_table.php
│   │   ├── 2026_03_10_110780_create_blog_table.php
│   │   ├── 2026_03_10_110790_create_categories_table.php
│   │   ├── 2026_03_10_110800_create_tags_table.php
│   │   ├── 2026_03_10_110810_create_taggables_table.php
│   │   ├── 2026_03_10_110820_create_tools_table.php
│   │   ├── 2026_03_10_110830_create_tool_usages_table.php
│   │   ├── 2026_03_10_110840_create_contacts_table.php
│   │   ├── 2026_03_10_110850_create_visitors_table.php
│   │   └── 2026_03_10_110860_create_page_views_table.php
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   ├── UserSeeder.php
│   │   ├── ProjectSeeder.php
│   │   ├── ServiceSeeder.php
│   │   └── ToolSeeder.php
│   └── factories/
│       ├── UserFactory.php
│       ├── ProjectFactory.php
│       └── ServiceFactory.php
├── resources/
│   ├── js/
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
│   │   │   │   ├── Info/
│   │   │   │   │   ├── AboutPage.vue
│   │   │   │   │   ├── NowPage.vue
│   │   │   │   │   ├── UsesPage.vue
│   │   │   │   │   ├── PrivacyPage.vue
│   │   │   │   │   └── TermsPage.vue
│   │   │   │   └── Auth/
│   │   │   │       ├── LoginPage.vue
│   │   │   │       └── RegisterPage.vue
│   │   │   └── Admin/
│   │   │       ├── Dashboard/
│   │   │       │   └── AdminDashboard.vue
│   │   │       └── [Remaining admin pages...]
│   │   ├── Components/
│   │   │   ├── Public/
│   │   │   │   ├── Header.vue
│   │   │   │   ├── Footer.vue
│   │   │   │   ├── Navbar.vue
│   │   │   │   ├── HeroSection.vue
│   │   │   │   ├── ProjectCard.vue
│   │   │   │   ├── ServiceCard.vue
│   │   │   │   └── ArticleCard.vue
│   │   │   └── Admin/
│   │   │       ├── Sidebar.vue
│   │   │       ├── TopBar.vue
│   │   │       ├── StatsCard.vue
│   │   │       └── DataTable.vue
│   │   ├── Layouts/
│   │   │   ├── PublicLayout.vue
│   │   │   ├── AdminLayout.vue
│   │   │   └── AuthLayout.vue
│   │   ├── Composables/
│   │   │   ├── useApi.js
│   │   │   ├── useAuth.js
│   │   │   ├── usePagination.js
│   │   │   └── useForm.js
│   │   ├── Stores/
│   │   │   ├── authStore.js
│   │   │   ├── userStore.js
│   │   │   └── uiStore.js
│   │   ├── router/
│   │   │   ├── index.js
│   │   │   ├── routes.js
│   │   │   ├── publicRoutes.js
│   │   │   ├── adminRoutes.js
│   │   │   └── authRoutes.js
│   │   ├── app.js
│   │   └── bootstrap.js
│   ├── css/
│   │   ├── app.css
│   │   ├── variables.css
│   │   └── responsive.css
│   └── views/
│       ├── app.blade.php
│       └── welcome.blade.php
├── routes/
│   ├── web.php
│   ├── api.php
│   ├── console.php
│   ├── admin.php
│   └── public.php
├── storage/
├── tests/
├── vendor/
├── .env
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
├── vite.config.js
├── postcss.config.js
├── tailwind.config.js
├── README.md
└── PROJECT_STRUCTURE.md
```

---

## 🔐 Authentication System

### Authentication Overview

**Type:** Laravel Standard Authentication (Breeze-style)  
**Guard:** `web` (default)  
**Database:** SQLite (development) / MySQL (production)

### Users Table Schema

```sql
CREATE TABLE users (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    is_active BOOLEAN DEFAULT true,
    profile_picture JSON NULL,
    bio TEXT NULL,
    email_verified_at TIMESTAMP NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### User Model Relationships

```php
User::
  ├── hasMany(Project)
  ├── hasMany(Article)
  ├── hasMany(Blog)
  ├── hasMany(Tool)
  ├── hasMany(roles)          // Spatie Permission
  └── hasMany(permissions)    // Spatie Permission
```

### Authentication Routes

```php
// Registration
GET    /register                → resources/views/register.blade.php
POST   /register                → RegisteredUserController@store

// Login
GET    /login                   → resources/views/login.blade.php
POST   /login                   → AuthenticatedSessionController@store

// Password Reset
GET    /forgot-password         → PasswordResetLinkController@create
POST   /forgot-password         → PasswordResetLinkController@store
GET    /reset-password/{token}  → NewPasswordController@create
POST   /reset-password          → NewPasswordController@store

// Email Verification
GET    /email/verify            → VerificationPrompt
GET    /email/verify/{id}/{hash} → VerifyEmailController@__invoke
POST   /email/verification-send → EmailVerificationNotificationController@store

// Admin Login (Separate)
GET    /admin/login             → Admin/LoginController@showLoginForm
POST   /admin/login             → Admin/LoginController@login
POST   /admin/logout            → Admin/LoginController@logout

// Logout
POST   /logout                  → AuthenticatedSessionController@destroy
```

### Middleware Authentication

```php
// auth - Verify user is authenticated
Route::middleware('auth') -> { ... }

// guest - Verify user is NOT authenticated
Route::middleware('guest') -> { ... }

// admin - Custom middleware for admin role check
Route::middleware(['auth', 'admin']) -> { ... }

// verified - Email verification required
Route::middleware(['auth', 'verified']) -> { ... }
```

### Authorization Policies

```php
// app/Policies/ProjectPolicy.php
Can user update own project?
Can admin update any project?

// app/Policies/ServicePolicy.php
Can admin manage services?

// app/Policies/BlogPolicy.php
Can user edit own blog posts?
```

---

## 🏠 PUBLIC PAGES (VUE SPA)

### Public Routes (Frontend)

```
/                              → HomePage
/work                          → WorkListPage
/work/{slug}                   → WorkDetailPage
/services                      → ServicesListPage
/services/{slug}               → ServiceDetailPage
/notes                         → NotesListPage
/notes/{slug}                  → ArticleDetailPage
/blog                          → BlogListPage
/blog/{slug}                   → PostDetailPage
/tools                         → ToolsListPage
/tools/json-formatter          → JsonFormatterPage
/tools/api-viewer              → ApiViewerPage
/tools/slug-generator          → SlugGeneratorPage
/tools/markdown-preview        → MarkdownPreviewPage
/tools/text-utilities          → TextUtilitiesPage
/contact                       → ContactPage
/contact/thank-you             → ThankYouPage
/schedule                      → SchedulePage
/about                         → AboutPage
/now                           → NowPage
/uses                          → UsesPage
/privacy                       → PrivacyPage
/terms                         → TermsPage
/register                      → RegisterPage
/login                         → LoginPage
```

### Page Descriptions

#### **HomePage** (/)
- Hero introduction section
- Featured projects showcase (3-4 featured)
- Services overview cards
- Recent articles/notes section
- Featured tools preview
- Client testimonials (optional)
- CTA to contact section

**File:** `resources/js/Pages/Public/Home/HomePage.vue`

---

#### **Work Pages**

**WorkListPage** (/work)
- Grid/list of all projects
- Search functionality
- Filter by technology or category
- Project cards with thumbnail, title, description
- Pagination

**File:** `resources/js/Pages/Public/Work/WorkListPage.vue`

**WorkDetailPage** (/work/{slug})
- Project title and tagline
- Featured image
- Problem statement section
- Solution/approach section
- Technologies used
- Results and metrics
- Project links (demo, github)
- Related projects carousel
- Time on project

**File:** `resources/js/Pages/Public/Work/WorkDetailPage.vue`

---

#### **Services Pages**

**ServicesListPage** (/services)
- Grid of service cards
- Service title, icon, tagline
- Brief description
- CTA button for each service

**File:** `resources/js/Pages/Public/Services/ServicesListPage.vue`

**ServiceDetailPage** (/services/{slug})
- Service title and icon
- Full overview/description
- Features list (with icons)
- Process steps (numbered/sequential)
- Technologies used
- Pricing tiers (if applicable)
- FAQ section
- Related projects
- CTA section
- Client testimonials

**File:** `resources/js/Pages/Public/Services/ServiceDetailPage.vue`

---

#### **Notes Pages** (Knowledge Base / Articles)

**NotesListPage** (/notes)
- Article grid/list
- Search bar
- Filter by tag/category
- Article cards with excerpt, date, reading time
- Pagination

**File:** `resources/js/Pages/Public/Notes/NotesListPage.vue`

**ArticleDetailPage** (/notes/{slug})
- Article title
- Metadata (author, date, reading time)
- Featured image
- Table of contents (auto-generated)
- Article content (HTML/markdown)
- Tags
- Related articles section
- Share buttons

**File:** `resources/js/Pages/Public/Notes/ArticleDetailPage.vue`

---

#### **Blog Pages**

**BlogListPage** (/blog)
- Featured post banner
- Category filter
- Blog post cards
- Pagination/infinite scroll
- Search functionality

**File:** `resources/js/Pages/Public/Blog/BlogListPage.vue`

**PostDetailPage** (/blog/{slug})
- Post title and featured image
- Author info and date
- Category badge
- Post content
- Comment section
- Related posts
- Share buttons
- Navigation (prev/next post)

**File:** `resources/js/Pages/Public/Blog/PostDetailPage.vue`

---

#### **Tools Pages**

**ToolsListPage** (/tools)
- Grid of available tools
- Tool cards with name, icon, brief description
- Direct links to each tool

**File:** `resources/js/Pages/Public/Tools/ToolsListPage.vue`

**JsonFormatterPage** (/tools/json-formatter)
- Input textarea for JSON
- Format button
- Minify button
- Copy to clipboard
- Output pane with formatted JSON
- Error handling

**File:** `resources/js/Pages/Public/Tools/JsonFormatterPage.vue`

**ApiViewerPage** (/tools/api-viewer)
- Input for API response
- Tree view visualization
- Collapsible/expandable sections
- Copy path functionality

**File:** `resources/js/Pages/Public/Tools/ApiViewerPage.vue`

**SlugGeneratorPage** (/tools/slug-generator)
- Text input
- Real-time slug generation
- Copy to clipboard
- Options (lowercase, separator, etc.)

**File:** `resources/js/Pages/Public/Tools/SlugGeneratorPage.vue`

**MarkdownPreviewPage** (/tools/markdown-preview)
- Split-pane editor (left: markdown, right: preview)
- Real-time preview
- Download as HTML or PDF
- Syntax highlighting

**File:** `resources/js/Pages/Public/Tools/MarkdownPreviewPage.vue`

**TextUtilitiesPage** (/tools/text-utilities)
- Text input area
- Character count
- Word count
- Line count
- Uppercase/lowercase buttons
- Capitalize all words button
- Remove whitespace button
- Sort lines

**File:** `resources/js/Pages/Public/Tools/TextUtilitiesPage.vue`

---

#### **Contact Pages**

**ContactPage** (/contact)
- Contact form (name, email, subject, message)
- Budget range field (optional)
- Timeline field (optional)
- Submit button
- Response time expectation message
- Contact info (email, socials)

**File:** `resources/js/Pages/Public/Contact/ContactPage.vue`

**ThankYouPage** (/contact/thank-you)
- Success message
- Confirmation of inquiry submission
- Link back to home

**File:** `resources/js/Pages/Public/Contact/ThankYouPage.vue`

---

#### **Schedule Page** (/schedule)
- Calendar for meeting scheduling
- Integration with Calendly or similar
- Available time slots
- Confirmation modal

**File:** `resources/js/Pages/Public/Schedule/SchedulePage.vue`

---

#### **Info Pages**

**AboutPage** (/about)
- Personal bio/introduction
- Professional journey
- Skills and expertise
- Philosophy/values
- Profile picture

**File:** `resources/js/Pages/Public/Info/AboutPage.vue`

**NowPage** (/now)
- Current projects
- Things learning
- Books reading
- Interesting links

**File:** `resources/js/Pages/Public/Info/NowPage.vue`

**UsesPage** (/uses)
- Hardware I use
- Software I use
- Tools and services
- Browser extensions
- etc.

**File:** `resources/js/Pages/Public/Info/UsesPage.vue`

**PrivacyPage** (/privacy)
- Privacy policy content
- Data collection disclosure
- How data is used

**File:** `resources/js/Pages/Public/Info/PrivacyPage.vue`

**TermsPage** (/terms)
- Terms of service
- User agreements
- Disclaimers

**File:** `resources/js/Pages/Public/Info/TermsPage.vue`

---

#### **Auth Pages**

**LoginPage** (/login)
- Email input
- Password input
- Remember me checkbox
- Login button
- Forgot password link
- Register link

**File:** `resources/js/Pages/Public/Auth/LoginPage.vue`

**RegisterPage** (/register)
- Full name input
- Email input
- Password input
- Confirm password input
- Terms agreement checkbox
- Register button
- Login link

**File:** `resources/js/Pages/Public/Auth/RegisterPage.vue`

---

## 🔧 ADMIN PAGES (BLADE)

### Admin Routes

```
/admin/dashboard               → Dashboard
/admin/work                    → Work/Projects Management
/admin/services                → Services Management
/admin/notes                   → Notes/Articles Management
/admin/blog                    → Blog Management
/admin/tools                   → Tools Management
/admin/inquiries               → Inquiries/Contact Management
/admin/insights                → Analytics & Insights
/admin/media                   → Media Library
/admin/settings                → Settings
```

### Admin Page Descriptions

#### **Dashboard** (/admin/dashboard)
- Quick stats cards (visitors, inquiries, projects, articles)
- Recent inquiries list with quick view
- Recent content updates timeline
- Traffic chart (basic graph)

**File:** `resources/views/admin/dashboard/index.blade.php`

---

#### **Work Management** (/admin/work)
- Table with projects (title, status, featured, created)
- Search/filter functionality
- Add new project button
- Edit and delete actions
- Bulk actions (publish, draft, delete)

**File:** `resources/views/admin/work/index.blade.php`

---

#### **Services Management** (/admin/services) - FULLY DYNAMIC
- Drag-to-reorder interface
- Table with (title, slug, order, status, featured)
- Search/filter functionality
- Add new service form
- Edit service form with:
  - Title, slug (auto-generate)
  - Tagline
  - Icon selector
  - Featured image upload
  - Overview (rich text editor)
  - Key Features repeater
  - Process Steps repeater
  - Technologies multi-select
  - Pricing Models repeater
  - FAQs repeater
  - Related projects multi-select
  - Meta title/description (SEO)
  - Order position, publish status

**File:** `resources/views/admin/services/index.blade.php`

---

#### **Notes Management** (/admin/notes)
- Table with articles (title, status, published date)
- Search functionality
- Write new article button
- Rich text editor interface
- Tags manager
- Schedule publishing option
- Featured image upload

**File:** `resources/views/admin/notes/index.blade.php`

---

#### **Blog Management** (/admin/blog)
- Table with posts (title, category, status)
- Search/filter by category
- Write new post button
- Rich text editor
- Category manager
- Comments moderation section
- Published/draft status

**File:** `resources/views/admin/blog/index.blade.php`

---

#### **Tools Management** (/admin/tools)
- Table with tools (name, slug, enabled/disabled status)
- Enable/disable toggle
- Configure settings for each tool
- Delete tool functionality

**File:** `resources/views/admin/tools/index.blade.php`

---

#### **Inquiries Management** (/admin/inquiries)
- Inbox view with list of messages
- Read/unread status indicators
- Filter by status (new, replied, closed)
- Message preview on hover
- Open message detail view
- Reply form with email template
- Mark as status
- Delete inquiry

**File:** `resources/views/admin/inquiries/index.blade.php`

---

#### **Insights Dashboard** (/admin/insights)
- Traffic overview (visitors, page views, avg time on site)
- Traffic trend chart
- Popular content sections:
  - Top projects
  - Top articles
  - Top services
  - Most used tools
- Device breakdown (desktop/mobile, browsers, OS)
- Tool usage statistics table
- Referral sources chart

**File:** `resources/views/admin/insights/index.blade.php`

---

#### **Media Library** (/admin/media)
- Grid view with thumbnails
- Drag & drop upload
- Folder management (create, rename, delete)
- Image editing tools (crop, resize, optimize)
- File deletion
- Usage tracking (where file is used)
- Bulk select and delete

**File:** `resources/views/admin/media/index.blade.php`

---

#### **Settings** (/admin/settings)
- Site Settings section:
  - Site name
  - Site description
  - Contact email
  - Logo/favicon upload
  
- SEO Defaults:
  - Meta title format
  - Meta description
  - Social images
  
- Email Configuration:
  - SMTP host
  - SMTP port
  - SMTP username
  - SMTP password
  - From address
  
- Cookie Consent:
  - Enable/disable
  - Message text
  
- User Management:
  - List of users
  - Add new user
  - Edit permissions
  - Delete user
  
- Activity Logs
- System backup settings

**File:** `resources/views/admin/settings/index.blade.php`

---

## 📊 Database Tables

### Core Content Tables

#### `projects`
```sql
id, title, slug, description, overview, technologies (JSON), 
problem_statement, my_role, timeline, results (JSON), 
featured_image, url_demo, url_github, 
is_featured, is_published, 
created_at, updated_at, user_id
```

#### `services`
```sql
id, title, slug, tagline, icon,
overview (longText), 
featured_image,
order, is_published, published_at,
meta_title, meta_description,
created_at, updated_at
```

#### `service_features`
```sql
id, service_id, title, description, icon, order,
created_at, updated_at
```

#### `service_process_steps`
```sql
id, service_id, title, description, step_number,
created_at, updated_at
```

#### `service_faqs`
```sql
id, service_id, question, answer,
created_at, updated_at
```

#### `service_technologies`
```sql
id, service_id, name, icon, proficiency,
created_at, updated_at
```

#### `service_pricing_models`
```sql
id, service_id, name, price, description, features (JSON),
created_at, updated_at
```

#### `articles`
```sql
id, title, slug, description, content (longText),
reading_time, is_featured, is_published,
published_at, featured_image,
created_at, updated_at, user_id
```

#### `blog_posts` (or `blogs`)
```sql
id, title, slug, content (longText),
category_id, user_id,
is_published, published_at,
featured_image,
created_at, updated_at
```

#### `categories`
```sql
id, name, slug, description,
created_at, updated_at
```

#### `tags`
```sql
id, name, slug, visibility (public/private),
created_at, updated_at
```

#### `taggables` (Polymorphic pivot table)
```sql
id, tag_id, taggable_id, taggable_type,
created_at, updated_at
```

#### `tools`
```sql
id, name, slug, description, icon,
is_enabled, config (JSON),
created_at, updated_at, user_id
```

#### `tool_usages`
```sql
id, tool_id, visitor_id, ip_address,
created_at, updated_at
```

#### `contacts` (Inquiries)
```sql
id, name, email, subject, message,
budget_range, timeline,
status (new/replied/closed),
page_url, replied_at,
created_at, updated_at
```

#### `users`
```sql
id, name, email, password (hashed),
role (user/admin), is_active,
profile_picture (JSON), bio (text),
email_verified_at, remember_token,
created_at, updated_at
```

#### `visitors` (Analytics)
```sql
id, ip_address, user_agent,
visiting_page, referer,
created_at
```

#### `page_views` (Analytics)
```sql
id, visitor_id (FK),
page_url, session_id,
created_at
```

---

## 🛣️ Routes Overview

### Web Routes (routes/web.php)

```php
// Authentication routes (handled by Breeze)
Route::auth()

// Public routes (SPA - handled by Vue Router)
Route::get('/', [HomeController::class, 'index'])->name('home')
Route::get('/{any}', fn() => view('app'))->where('any', '.*')

// Admin panel (Blade templates)
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')
    Route::resource('work', ProjectController::class, ['prefix' => '', 'names' => 'admin.work'])
    Route::resource('services', ServiceController::class, ['names' => 'admin.services'])
    Route::resource('notes', ArticleController::class, ['names' => 'admin.notes'])
    Route::resource('blog', BlogController::class, ['names' => 'admin.blog'])
    Route::resource('tools', ToolController::class, ['names' => 'admin.tools'])
    Route::resource('inquiries', InquiryController::class, ['names' => 'admin.inquiries'])
    Route::get('insights', [InsightController::class, 'index'])->name('admin.insights')
    Route::resource('media', MediaController::class, ['names' => 'admin.media'])
    Route::resource('settings', SettingController::class, ['names' => 'admin.settings'])
})
```

### API Routes (routes/api.php)

```php
// Public API
Route::get('services', [ServiceController::class, 'list'])
Route::get('services/{slug}', [ServiceController::class, 'show'])
Route::get('articles', [ArticleController::class, 'list'])
Route::get('blog', [BlogController::class, 'list'])
Route::get('projects', [ProjectController::class, 'list'])
Route::post('contact', [ContactController::class, 'store'])

// Authenticated API
Route::middleware('auth:sanctum')->group(function () {
    Route::post('profile/update', [ProfileController::class, 'update'])
    Route::post('profile/avatar', [ProfileController::class, 'updateAvatar'])
    Route::get('dashboard', [ProfileController::class, 'dashboard'])
})

// Admin API
Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::get('stats', [DashboardController::class, 'stats'])
    Route::apiResource('services', ServiceController::class)
    Route::apiResource('projects', ProjectController::class)
    Route::apiResource('articles', ArticleController::class)
    Route::apiResource('blog', BlogController::class)
    Route::apiResource('tools', ToolController::class)
    Route::apiResource('inquiries', InquiryController::class)
    Route::get('insights', [InsightController::class, 'data'])
})
```

---

## 📱 Controllers Structure

The application has the following main controller groups:

### Admin Controllers
- `DashboardController` - Dashboard stats and overview
- `ProjectController` - CRUD for projects
- `ServiceController` - CRUD for services (with full relationships)
- `ArticleController` - CRUD for articles
- `BlogController` - CRUD for blog posts
- `ToolController` - Tool management
- `InquiryController` - Contact inquiries
- `InsightController` - Analytics and reporting
- `MediaController` - File uploads and management
- `SettingController` - Site settings

### Public Controllers
- `HomeController` - Home page with featured content
- `ContactController` - Contact form processing

### Auth Controllers (by Breeze)
- `RegisteredUserController` - User registration
- `AuthenticatedSessionController` - Login/logout
- `PasswordResetLinkController` - Password reset request
- `NewPasswordController` - Password update
- `VerifyEmailController` - Email verification
- `EmailVerificationNotificationController` - Resend verification

---

## 📦 Models Structure

All models extend `Illuminate\Database\Eloquent\Model`

### Main Models
- `User` - Users with roles
- `Project` - Portfolio projects
- `Service` - Services (dynamic, fully relational)
- `ServiceFeature` - Service features
- `ServiceProcessStep` - Service process
- `ServiceFAQ` - Service FAQs
- `ServiceTechnology` - Service tech stack
- `ServicePricingModel` - Service pricing
- `Article` - Knowledge base articles
- `Blog` - Blog posts
- `Category` - Blog categories
- `Tag` - Content tags (polymorphic)
- `Tool` - Developer tools
- `ToolUsage` - Tool usage analytics
- `Contact` - Contact inquiries
- `Visitor` - Analytics visitor
- `PageView` - Analytics page view

### Model Relationships

```
User -> hasMany(Project, Article, Blog, Tool)

Service -> hasMany(ServiceFeature, ServiceProcessStep, ServiceFAQ, 
                   ServiceTechnology, ServicePricingModel)
        -> belongsToMany(Project)
        
Project -> belongsTo(User)
        -> morphMany(Tag)
        
Article -> belongsTo(User)
        -> belongsToMany(Tag)
        
Blog -> belongsTo(User, Category)
    -> morphMany(Tag)
    
Tool -> belongsTo(User)
    -> hasMany(ToolUsage)
    
Visitor -> hasMany(PageView, ToolUsage)

PageView -> belongsTo(Visitor)
```

---

## 🚀 Setup Instructions

### 1. Clone and Install
```bash
git clone repo-url
cd vantage
composer install
npm install
```

### 2. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### 4. Generate API Keys (Sanctum)
```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

### 5. Build Assets
```bash
npm run dev    # Development
npm run build  # Production
```

### 6. Start Development Server
```bash
php artisan serve
```

Access the app at `http://localhost:8000`

### 7. Default Admin User
Check `database/seeders/UserSeeder.php` for default admin credentials

---

## 📝 Notes

- All Vue pages use Vue 3 Composition API
- Admin pages use Laravel Blade templates
- Styling uses Tailwind CSS throughout
- Database relationships include polymorphic tagging
- Complete audit trail with Spatie Activity Log (optional)
- Media handling with Spatie Media Library (optional)
- Role/permission system with Spatie Permission (optional)

---

**End of Complete Folder Structure Documentation**
