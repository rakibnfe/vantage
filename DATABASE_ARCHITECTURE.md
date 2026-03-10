# 🗄️ Vantage - Complete Database Architecture

Complete database structure with all models, migrations, relations, and authentication system for Laravel 12 + Vue 3 SPA.

---

## 📋 Table of Contents

1. [Database Overview](#database-overview)
2. [Tables & Models](#tables--models)
3. [Relationships](#relationships)
4. [Migration Sequence](#migration-sequence)
5. [Models & Properties](#models--properties)
6. [Authentication System](#authentication-system)
7. [Seeders](#seeders)
8. [Reports & Queries](#reports--queries)

---

## 🗄️ Database Overview

**Database Name:** `vantage` (SQLite for dev, MySQL for production)
**Total Tables:** 18 core + 3 Spatie Permission + 2 Spatie Media + 1 Activity Log = 24 tables
**Models:** 11 primary models + 3 through relations
**Authentication:** Laravel Sanctum (token-based for SPA)

---

## 📊 Tables & Models

### 1. Core Authentication Tables

| Table | Model | Purpose | Records |
|-------|-------|---------|---------|
| `users` | `User` | Admin/author users | 1-5 typically |
| `personal_access_tokens` | (Sanctum) | API tokens for SPA auth | Dynamic |

### 2. Content Tables

| Table | Model | Purpose | Records |
|-------|-------|---------|---------|
| `projects` | `Project` | Portfolio projects | 5-50 |
| `services` | `Service` | Services/expertise (dynamic) | 3-10 |
| `service_features` | `ServiceFeature` | Service feature items | 20-50 |
| `service_process_steps` | `ServiceProcessStep` | Service process steps | 20-50 |
| `service_faqs` | `ServiceFAQ` | Service FAQ items | 20-100 |
| `service_technologies` | `ServiceTechnology` | Tech stack per service | 30-50 |
| `service_pricing_models` | `ServicePricingModel` | Pricing options per service | 10-30 |
| `articles` | `Article` | Blog/notes articles | 10-200 |
| `tools` | `Tool` | Developer tools | 5 fixed |
| `contacts` | `Contact` | Contact form submissions | 10-1000 |
| `categories` | `Category` | Article categories | 5-15 |
| `tags` | `Tag` | Content tags | 20-100 |
| `taggables` | (Pivot) | Tagging polymorphic | Dynamic |
| `visitors` | `Visitor` | Visitor sessions | 100-10000 |
| `page_views` | `PageView` | Page view analytics | 1000-100000 |

### 3. Spatie Packages Tables

| Table | Purpose | Notes |
|-------|---------|-------|
| `permissions` | Role/permission definitions | Spatie Permission |
| `roles` | Role definitions | Spatie Permission |
| `role_has_permissions` | Pivot for role→permission | Spatie Permission |
| `media` | File attachments | Spatie Media Library |
| `activity_log` | Audit trail | Spatie Activity Log |

---

## 🔗 Relationships

### User Relations
```
User
  ├─ hasMany Projects
  ├─ hasMany Articles
  ├─ hasMany Tools
  └─ hasMany roles (Spatie Permission)
```

### Project Relations
```
Project
  ├─ belongsTo User
  ├─ morphMany tags (polymorphic)
  ├─ morphOne media (featured image)
  └─ morphMany activities (audit trail)
```

### Service Relations (DYNAMIC)
```
Service
  ├─ hasMany ServiceFeature (one:many)
  ├─ hasMany ServiceProcessStep (one:many)
  ├─ hasMany ServiceFAQ (one:many)
  ├─ hasMany ServiceTechnology (many:many via table)
  ├─ hasMany ServicePricingModel (one:many)
  ├─ morphMany tags (polymorphic)
  ├─ morphOne media (featured image)
  ├─ belongsToMany projects (many:many via service_project)
  └─ morphMany activities (audit trail)
```

### Article Relations
```
Article
  ├─ belongsTo User
  ├─ belongsTo Category
  ├─ morphMany tags (polymorphic)
  ├─ morphOne media (featured image)
  └─ morphMany activities (audit trail)
```

### Tool Relations
```
Tool
  ├─ belongsTo User
  ├─ morphOne media (featured image)
  └─ morphMany activities (audit trail)
```

### Tool Usage Relations (Optional Analytics)
```
ToolUsage
  ├─ belongsTo Tool
  ├─ belongsTo Visitor
```

### Contact Relations
```
Contact
  ├─ belongsTo Visitor (optional - for tracking)
  └─ morphMany activities (audit trail)
```

### Visitor Relations
```
Visitor
  ├─ hasMany PageViews
  ├─ hasMany Contacts (optional)
  └─ hasMany ToolUsages (optional - analytics)
```

### PageView Relations
```
PageView
  ├─ belongsTo Visitor
  └─ nullable belongsTo User (if logged in)
```

### Category Relations
```
Category
  ├─ hasMany Articles
```

### Tag Relations (Polymorphic)
```
Tag
  ├─ morphedByMany(Project, Article) via taggables
```

---

## 📅 Migration Sequence

**✅ COMPLETED:** All migrations have been created and executed successfully in the correct sequence. Migration files are located in `database/migrations/` with timestamps starting from `2026_03_10_110656`.

**Important:** Migrations must run in this exact order to avoid foreign key constraint errors.

### Phase 1: Base Tables (No Dependencies)
```
1. 2026_03_10_110656_create_users_table ✅
2. 2026_03_10_110709_create_personal_access_tokens_table ✅ (Laravel Sanctum)
3. 2026_03_10_110722_create_categories_table ✅
4. 2026_03_10_110734_create_visitors_table ✅
5. 2026_03_10_110756_create_tags_table ✅
// additional Laravel defaults below
6. 2026_03_10_113526_create_password_resets_table ✅ (default)
7. 2026_03_10_113554_create_failed_jobs_table ✅ (default)
8. 2026_03_10_113608_create_jobs_table ✅ (default)
9. 2026_03_10_113619_create_cache_table ✅ (default)
```

### Phase 2: Main Content (Depends on Phase 1)
```
6. 2026_03_10_110809_create_projects_table ✅
7. 2026_03_10_110822_create_services_table ✅
8. 2026_03_10_110834_create_articles_table ✅
9. 2026_03_10_110846_create_tools_table ✅
10. 2026_03_10_110859_create_contacts_table ✅
```

### Phase 3: Service Deep Structure (Depends on Phase 2)
```
11. 2026_03_10_110911_create_service_features_table ✅
12. 2026_03_10_110925_create_service_process_steps_table ✅
13. 2026_03_10_110955_create_service_faqs_table ✅
14. 2026_03_10_111008_create_service_technologies_table ✅
15. 2026_03_10_111034_create_service_pricing_models_table ✅
```

### Phase 4: Relationships & Pivots (Depends on Phase 2-3)
```
16. 2026_03_10_111046_create_taggables_table ✅ (polymorphic)
17. 2026_03_10_111108_create_service_project_table ✅
18. 2026_03_10_111119_create_page_views_table ✅
```

### Phase 5: Spatie Packages (Independent)
```
19. 2026_03_10_111131_create_permissions_table ✅ (Spatie Permission)
20. 2026_03_10_111146_create_roles_table ✅ (Spatie Permission)
21. 2026_03_10_111157_create_role_has_permissions_table ✅ (Spatie Permission)
22. 2026_03_10_111217_create_media_table ✅ (Spatie Media Library)
```

### Phase 6: Analytics & Audit (Last)
```
23. 2026_03_10_111232_create_activity_log_table ✅ (Spatie Activity Log)
24. 2026_03_10_111243_create_tool_usages_table ✅ (Optional - analytics)
```

---

## 👥 Models & Properties

### User Model
```php
User
├─ Fields:
│  ├─ id (Primary Key)
│  ├─ name (String)
│  ├─ email (String, unique)
│  ├─ email_verified_at (Timestamp, nullable)
│  ├─ password (String)
│  ├─ role (Enum: admin, author, viewer) 
│  ├─ is_active (Boolean)
│  ├─ profile_picture (String, nullable - media ID)
│  ├─ bio (Text, nullable)
│  ├─ remember_token (String, nullable)
│  ├─ created_at (Timestamp)
│  └─ updated_at (Timestamp)
│
├─ Casts:
│  └─ role: AsEnumCollection
│
├─ Hidden:
│  └─ password, remember_token
│
├─ Appends:
│  └─ profile_url (media URL)
│
└─ Methods:
   ├─ projects() - hasMany
   ├─ articles() - hasMany
   ├─ tools() - hasMany
   └─ hasRole($role) - Spatie Permission
```

### Project Model
```php
Project
├─ Fields:
│  ├─ id
│  ├─ user_id (FK→users)
│  ├─ title (String)
│  ├─ slug (String, unique)
│  ├─ description (Text)
│  ├─ featured_image (String, nullable - media ID)
│  ├─ images (JSON - array of media IDs)
│  ├─ overview (Text)
│  ├─ challenge (Text)
│  ├─ solution (Text)
│  ├─ results (Text)
│  ├─ technologies (JSON - array)
│  ├─ live_url (String, nullable)
│  ├─ github_url (String, nullable)
│  ├─ case_study_url (String, nullable)
│  ├─ start_date (Date)
│  ├─ end_date (Date, nullable)
│  ├─ status (Enum: planning, in_progress, completed)
│  ├─ is_featured (Boolean)
│  ├─ is_published (Boolean)
│  ├─ published_at (Timestamp, nullable)
│  ├─ order (Integer)
│  ├─ meta_title (String, nullable)
│  ├─ meta_description (String, nullable)
│  ├─ created_at
│  └─ updated_at
│
├─ Casts:
│  ├─ technologies: AsCollection
│  ├─ images: AsCollection
│  ├─ start_date: AsDate
│  ├─ end_date: AsDate
│  └─ published_at: AsDateTime
│
├─ Scopes:
│  ├─ published()
│  ├─ featured()
│  ├─ ordered()
│  └─ byUser($userId)
│
└─ Methods:
   ├─ user() - belongsTo
   ├─ tags() - morphMany (polymorphic)
   ├─ featuredImage() - morphOne media
   └─ activities() - morphMany audit trail
```

### Service Model (DYNAMIC)
```php
Service
├─ Fields:
│  ├─ id
│  ├─ title (String)
│  ├─ slug (String, unique)
│  ├─ tagline (String)
│  ├─ icon (String, nullable - media ID or icon name)
│  ├─ featured_image (String, nullable - media ID)
│  ├─ overview (Text)
│  ├─ description (Text, nullable)
│  ├─ process (JSON, nullable - legacy/simple process)
│  ├─ features (JSON, nullable - legacy, use service_features)
│  ├─ technologies (JSON, nullable - legacy, use service_technologies)
│  ├─ pricing_models (JSON, nullable - legacy, use service_pricing_models)
│  ├─ faqs (JSON, nullable - legacy, use service_faqs)
│  ├─ related_projects (JSON, nullable - project IDs)
│  ├─ success_stories (Text, nullable)
│  ├─ delivery_timeframe (String, nullable - e.g., "2-4 weeks")
│  ├─ team_size (String, nullable - e.g., "2-3 people")
│  ├─ consultation_url (String, nullable)
│  ├─ meta_title (String, nullable)
│  ├─ meta_description (String, nullable)
│  ├─ is_published (Boolean, default: true)
│  ├─ is_featured (Boolean, default: false)
│  ├─ order (Integer)
│  ├─ published_at (Timestamp, nullable)
│  ├─ created_at
│  └─ updated_at
│
├─ Casts:
│  ├─ process: AsCollection
│  ├─ features: AsCollection
│  ├─ technologies: AsCollection
│  ├─ pricing_models: AsCollection
│  ├─ faqs: AsCollection
│  ├─ related_projects: AsCollection
│  └─ published_at: AsDateTime
│
├─ Scopes:
│  ├─ published()
│  ├─ featured()
│  ├─ ordered()
│  └─ withRelations()
│
└─ Methods:
   ├─ features() - hasMany ServiceFeature
   ├─ processSteps() - hasMany ServiceProcessStep
   ├─ faqs() - hasMany ServiceFAQ
   ├─ technologies() - hasMany ServiceTechnology
   ├─ pricingModels() - hasMany ServicePricingModel
   ├─ tags() - morphMany polymorphic
   ├─ featuredImage() - morphOne media
   ├─ projects() - belongsToMany many:many via service_project
   ├─ activities() - morphMany audit trail
   ├─ getRelatedProjects() - fetch related projects
   └─ getTechnologiesList() - formatted tech list
```

### ServiceFeature Model
```php
ServiceFeature
├─ Fields:
│  ├─ id
│  ├─ service_id (FK→services)
│  ├─ title (String)
│  ├─ description (Text)
│  ├─ icon (String, nullable)
│  ├─ order (Integer)
│  ├─ created_at
│  └─ updated_at
│
└─ Methods:
   └─ service() - belongsTo Service
```

### ServiceProcessStep Model
```php
ServiceProcessStep
├─ Fields:
│  ├─ id
│  ├─ service_id (FK→services)
│  ├─ title (String)
│  ├─ description (Text)
│  ├─ icon (String, nullable)
│  ├─ duration (String, nullable - e.g., "1-2 weeks")
│  ├─ order (Integer)
│  ├─ created_at
│  └─ updated_at
│
└─ Methods:
   └─ service() - belongsTo Service
```

### ServiceFAQ Model
```php
ServiceFAQ
├─ Fields:
│  ├─ id
│  ├─ service_id (FK→services)
│  ├─ question (String)
│  ├─ answer (Text)
│  ├─ order (Integer)
│  ├─ created_at
│  └─ updated_at
│
└─ Methods:
   └─ service() - belongsTo Service
```

### ServiceTechnology Model
```php
ServiceTechnology
├─ Fields:
│  ├─ id
│  ├─ service_id (FK→services)
│  ├─ name (String)
│  ├─ icon (String, nullable)
│  ├─ category (String, nullable - e.g., "Backend", "Frontend")
│  ├─ url (String, nullable)
│  ├─ order (Integer)
│  ├─ created_at
│  └─ updated_at
│
└─ Methods:
   └─ service() - belongsTo Service
```

### ServicePricingModel Model
```php
ServicePricingModel
├─ Fields:
│  ├─ id
│  ├─ service_id (FK→services)
│  ├─ name (String - e.g., "Hourly", "Project-based")
│  ├─ description (Text)
│  ├─ starting_price (Decimal nullable - e.g., 75.00)
│  ├─ notes (Text, nullable)
│  ├─ order (Integer)
│  ├─ created_at
│  └─ updated_at
│
└─ Methods:
   └─ service() - belongsTo Service
```

### Article Model
```php
Article
├─ Fields:
│  ├─ id
│  ├─ user_id (FK→users)
│  ├─ category_id (FK→categories, nullable)
│  ├─ title (String)
│  ├─ slug (String, unique)
│  ├─ excerpt (String)
│  ├─ content (Text)
│  ├─ featured_image (String, nullable - media ID)
│  ├─ reading_time (Integer, nullable - minutes)
│  ├─ is_published (Boolean)
│  ├─ published_at (Timestamp, nullable)
│  ├─ meta_title (String, nullable)
│  ├─ meta_description (String, nullable)
│  ├─ created_at
│  └─ updated_at
│
├─ Casts:
│  └─ published_at: AsDateTime
│
├─ Scopes:
│  ├─ published()
│  ├─ byCategory($id)
│  └─ ordered()
│
└─ Methods:
   ├─ user() - belongsTo
   ├─ category() - belongsTo
   ├─ tags() - morphMany polymorphic
   ├─ featuredImage() - morphOne media
   └─ activities() - morphMany audit trail
```

### Tool Model
```php
Tool
├─ Fields:
│  ├─ id
│  ├─ user_id (FK→users)
│  ├─ name (String)
│  ├─ slug (String, unique)
│  ├─ description (Text)
│  ├─ featured_image (String, nullable - media ID)
│  ├─ icon (String, nullable)
│  ├─ url (String, nullable - if external link)
│  ├─ category (String - e.g., "JSON", "Text", "Developer")
│  ├─ documentation_url (String, nullable)
│  ├─ is_active (Boolean)
│  ├─ is_featured (Boolean)
│  ├─ usage_count (Integer, default: 0)
│  ├─ created_at
│  └─ updated_at
│
├─ Scopes:
│  ├─ active()
│  ├─ featured()
│  ├─ byCategory($cat)
│  └─ mostUsed()
│
└─ Methods:
   ├─ user() - belongsTo
   ├─ featuredImage() - morphOne media
   ├─ usages() - hasMany ToolUsage (optional)
   └─ activities() - morphMany audit trail
```

### Contact Model
```php
Contact
├─ Fields:
│  ├─ id
│  ├─ visitor_id (FK→visitors, nullable)
│  ├─ name (String)
│  ├─ email (String)
│  ├─ phone (String, nullable)
│  ├─ subject (String)
│  ├─ message (Text)
│  ├─ budget (String, nullable - e.g., "5k-10k")
│  ├─ timeline (String, nullable - e.g., "ASAP", "3 months")
│  ├─ status (Enum: new, read, replied, closed, spam)
│  ├─ ip_address (String, nullable)
│  ├─ user_agent (String, nullable)
│  ├─ source_page (String, nullable - referring page)
│  ├─ notes (Text, nullable - admin notes)
│  ├─ replied_at (Timestamp, nullable)
│  ├─ created_at
│  └─ updated_at
│
├─ Casts:
│  ├─ replied_at: AsDateTime
│  └─ status: AsEnum
│
├─ Scopes:
│  ├─ unread()
│  ├─ new()
│  └─ recent()
│
└─ Methods:
   ├─ visitor() - belongsTo Visitor
   ├─ markAsRead() - status update
   ├─ markAsReplied() - status & timestamp
   └─ activities() - morphMany audit trail
```

### Category Model
```php
Category
├─ Fields:
│  ├─ id
│  ├─ name (String)
│  ├─ slug (String, unique)
│  ├─ description (Text, nullable)
│  ├─ color (String, nullable - hex color)
│  ├─ icon (String, nullable)
│  ├─ order (Integer)
│  ├─ created_at
│  └─ updated_at
│
└─ Methods:
   ├─ articles() - hasMany Article
   └─ articleCount() - get article count
```

### Tag Model
```php
Tag
├─ Fields:
│  ├─ id
│  ├─ name (String, unique)
│  ├─ slug (String, unique)
│  ├─ description (Text, nullable)
│  ├─ color (String, nullable - hex)
│  ├─ created_at
│  └─ updated_at
│
└─ Methods:
   └─ taggables() - morphedByMany (polymorphic)
```

### Visitor Model
```php
Visitor
├─ Fields:
│  ├─ id
│  ├─ session_id (String, unique)
│  ├─ ip_address (String, nullable)
│  ├─ user_agent (String, nullable)
│  ├─ browser (String, nullable)
│  ├─ os (String, nullable)
│  ├─ device (String, nullable - desktop, mobile, tablet)
│  ├─ country (String, nullable)
│  ├─ city (String, nullable)
│  ├─ referrer (String, nullable)
│  ├─ utm_source (String, nullable)
│  ├─ utm_medium (String, nullable)
│  ├─ utm_campaign (String, nullable)
│  ├─ first_visit_at (Timestamp)
│  ├─ last_visit_at (Timestamp)
│  ├─ visit_count (Integer, default: 1)
│  ├─ page_view_count (Integer, default: 0)
│  ├─ total_time_spent (Integer, nullable - seconds)
│  ├─ created_at
│  └─ updated_at
│
├─ Scopes:
│  ├─ recentVisitors()
│  ├─ mostActive()
│  ├─ byCountry($country)
│  └─ toDay()
│
└─ Methods:
   ├─ pageViews() - hasMany
   ├─ contacts() - hasMany Contact
   ├─ toolUsages() - hasMany ToolUsage (optional)
   ├─ getBrowserInfo() - formatted browser
   ├─ getDeviceInfo() - formatted device
   └─ getLocationInfo() - city, country
```

### PageView Model
```php
PageView
├─ Fields:
│  ├─ id
│  ├─ visitor_id (FK→visitors)
│  ├─ user_id (FK→users, nullable - if logged in)
│  ├─ page_url (String)
│  ├─ page_title (String)
│  ├─ page_type (String - e.g., project, article, tool, home)
│  ├─ page_id (String, nullable - ID of content if applicable)
│  ├─ time_spent (Integer, nullable - seconds)
│  ├─ scroll_depth (Integer, nullable - percentage)
│  ├─ ip_address (String, nullable)
│  ├─ referer (String, nullable)
│  ├─ created_at
│  └─ updated_at
│
├─ Scopes:
│  ├─ byPage($url)
│  ├─ byType($type)
│  └─ today()
│
└─ Methods:
   ├─ visitor() - belongsTo
   ├─ user() - belongsTo nullable
   └─ getPageContent() - fetch actual content
```

---

## 🔐 Authentication System

### ✅ IMPLEMENTATION COMPLETE: Laravel Sanctum

**Status:** Fully configured and ready for SPA authentication
**Configuration:** Sanctum config published, User model updated with HasApiTokens trait
**Database:** personal_access_tokens table created and migrated

**Why Sanctum?**
- Token-based authentication perfect for SPAs
- Built-in with Laravel 12
- No extra packages needed
- Secure and performant

### Key Components

#### 1. Login Endpoint (API)
```
POST /api/auth/login
{
  "email": "user@example.com",
  "password": "password"
}

Response:
{
  "token": "1|abc123...",
  "user": { ... }
}
```

#### 2. Logout Endpoint
```
POST /api/auth/logout
Authorization: Bearer {token}
```

#### 3. User Profile Endpoint
```
GET /api/auth/user
Authorization: Bearer {token}
```

#### 4. Token Refresh
```
POST /api/auth/refresh
Authorization: Bearer {token}
```

### Middleware Protection
```php
Route::middleware('auth:sanctum')->group(function () {
  // Protected routes
});
```

### Frontend Setup (boots.js)
```javascript
// Set default authorization header for axios
if (localStorage.getItem('auth_token')) {
  axios.defaults.headers.common['Authorization'] = 
    'Bearer ' + localStorage.getItem('auth_token')
}
```

---

## 🌱 Database Seeders

### UserSeeder
- Creates 3 default users (admin, author, viewer)
- Sets appropriate roles

### CategorySeeder
- Creates default article categories:
  - Laravel
  - Vue.js
  - PHP
  - Web Design
  - DevOps
  - Personal

### TagSeeder
- Creates common tags:
  - tutorial, tips, performance, security, laravel, vue, php, javascript, database, etc.

### ServiceSeeder
- Creates 5 default services with:
  - Features
  - Process steps
  - FAQs
  - Technologies
  - Pricing models
  - Example: Web Development, Mobile App Development, etc.

### ProjectSeeder
- Creates 5 example projects with realistic data
- Links to services and tags

### ArticleSeeder
- Creates 10 example articles
- Assigns to categories and tags

### ToolSeeder
- Creates 5 built-in tools:
  - JSON Formatter
  - API Viewer
  - Slug Generator
  - Markdown Preview
  - Text Utilities

### VisitorSeeder
- Creates fake visitor data for analytics testing
- Includes page views and contacts

---

## 📊 Reports & Queries

### Analytics Reports

#### 1. Traffic Report
```sql
SELECT 
  DATE(created_at) as date,
  COUNT(DISTINCT visitor_id) as unique_visitors,
  COUNT(*) as total_page_views,
  AVG(time_spent) as avg_time_spent
FROM page_views
GROUP BY DATE(created_at)
ORDER BY date DESC
```

#### 2. Popular Content Report
```sql
SELECT 
  page_url,
  page_title,
  COUNT(*) as views,
  AVG(time_spent) as avg_time_spent
FROM page_views
GROUP BY page_url
ORDER BY views DESC
LIMIT 10
```

#### 3. Geographic Report
```sql
SELECT 
  country,
  city,
  COUNT(DISTINCT id) as visitors,
  AVG(visit_count) as avg_visits
FROM visitors
WHERE country IS NOT NULL
GROUP BY country, city
ORDER BY visitors DESC
```

#### 4. Browser Report
```sql
SELECT 
  browser,
  device,
  COUNT(*) as count,
  ROUND(AVG(CAST(page_view_count AS FLOAT)), 2) as avg_pages
FROM visitors
WHERE browser IS NOT NULL
GROUP BY browser, device
ORDER BY count DESC
```

#### 5. Contact Report
```sql
SELECT 
  DATE(created_at) as date,
  COUNT(*) as total_contacts,
  SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) as new,
  SUM(CASE WHEN status = 'replied' THEN 1 ELSE 0 END) as replied,
  SUM(CASE WHEN status = 'closed' THEN 1 ELSE 0 END) as closed
FROM contacts
GROUP BY DATE(created_at)
ORDER BY date DESC
```

#### 6. Service Performance Report
```sql
SELECT 
  s.title,
  COUNT(DISTINCT pv.visitor_id) as unique_views,
  COUNT(pv.id) as total_views,
  COUNT(c.id) as contacts_from_service
FROM services s
LEFT JOIN page_views pv ON pv.page_url LIKE CONCAT('%/services/%', s.slug)
LEFT JOIN contacts c ON c.source_page LIKE CONCAT('%/services/%', s.slug)
GROUP BY s.id
ORDER BY unique_views DESC
```

#### 7. Tool Usage Report
```sql
SELECT 
  t.name,
  COUNT(*) as usage_count,
  COUNT(DISTINCT tu.visitor_id) as unique_users,
  DATE(MAX(tu.created_at)) as last_used
FROM tools t
LEFT JOIN tool_usages tu ON t.id = tu.tool_id
GROUP BY t.id
ORDER BY usage_count DESC
```

#### 8. Referral Sources Report
```sql
SELECT 
  referrer,
  COUNT(DISTINCT id) as visitors,
  COUNT(DISTINCT session_id) as sessions,
  SUM(page_view_count) as total_page_views
FROM visitors
WHERE referrer IS NOT NULL
GROUP BY referrer
ORDER BY visitors DESC
```

---

## 🚀 Running Migrations

### ✅ EXECUTED SUCCESSFULLY: Fresh Migration Completed

**Status:** All 24 migrations executed successfully on MySQL database
**Command Used:** `php artisan migrate:fresh`
**Execution Time:** ~3.5 seconds
**Database:** MySQL (vantage database)

### Fresh Start (Recommended for Initial Setup)
```bash
php artisan migrate:fresh --seed
```

This will:
1. Drop all tables
2. Run all migrations in sequence
3. Run all seeders

### Regular Migration
```bash
php artisan migrate
```

### Rollback Last
```bash
php artisan migrate:rollback
```

### Rollback All
```bash
php artisan migrate:reset
```

---

## 📝 Important Notes

### Foreign Key Constraints
- All foreign keys are properly cascaded
- Delete operations cascade appropriately
- Soft deletes available for sensitive content

### Migration Naming Convention
- Migrations follow Laravel convention
- Each table has dedicated migration file
- Related data (Service features) in separate migrations

### Polymorphic Relations
- Tags use polymorphic relation
- Supports projects, articles, services
- Can be extended to other models

### Audit Trail
- Spatie Activity Log tracks all changes
- Automatically logs CRUD operations
- Accessible via `$model->activities`

---

## 📈 Performance Considerations

### Indexes
All critical fields indexed:
- `users.email` (unique)
- `projects.slug, services.slug, articles.slug` (unique)
- `services.is_published, is_featured`
- `page_views.visitor_id, created_at`
- `contacts.email, status`

### Cache Fields
Consider caching:
- Service feature lists
- Category counts
- Tag cloud data
- Popular projects
- Recent contacts

### Query Optimization
Use eager loading:
```php
Service::with(['features', 'processSteps', 'faqs', 'tags'])->get()
```

---

## 🔄 Future Enhancements

1. **Comments System**
   - Add comments table for articles

2. **Testimonials**
   - Add testimonials from clients

3. **Newsletter**
   - Add subscriber table

4. **Bookmarks/Favorites**
   - Users bookmark projects/articles

5. **Search History**
   - Visitors search history

6. **Affiliate Links**
   - Track referral commissions

---

Last Updated: 2026-03-10
Version: 1.1 (Migrations Complete)
