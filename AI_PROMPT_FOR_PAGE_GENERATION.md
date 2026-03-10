# 🤖 AI PROMPT FOR GENERATING VANTAGE PAGES CODE

## Overview

This document contains the comprehensive prompt and database/folder structure to provide to ChatGPT, DeepSeek, Claude, or similar AI models for generating all pages code for the Vantage project one by one.

**Before you start:** Copy the relevant section from this document and provide it to your AI along with the database structure and folder structure. Then follow the order below to generate each page systematically.

---

## 📋 GENERATION ORDER & BREAKDOWN

### Phase 1: Core Public Pages (Start Here)
1. **HomePage.vue** - Main landing page
2. **WorkListPage.vue** - Projects listing
3. **WorkDetailPage.vue** - Single project detail
4. **ServicesListPage.vue** - Services listing
5. **ServiceDetailPage.vue** - Single service detail

### Phase 2: Content Pages
6. **NotesListPage.vue** - Articles/notes listing
7. **ArticleDetailPage.vue** - Single article detail
8. **BlogListPage.vue** - Blog posts listing
9. **PostDetailPage.vue** - Single blog post detail

### Phase 3: Utility & Contact Pages
10. **ToolsListPage.vue** - Tools overview
11. **JsonFormatterPage.vue** - JSON formatter tool
12. **ApiViewerPage.vue** - API viewer tool
13. **SlugGeneratorPage.vue** - Slug generator tool
14. **MarkdownPreviewPage.vue** - Markdown preview tool
15. **TextUtilitiesPage.vue** - Text utilities tool
16. **ContactPage.vue** - Contact form
17. **ThankYouPage.vue** - Contact thank you

### Phase 4: Optional Pages
18. **SchedulePage.vue** - Calendar booking
19. **AboutPage.vue** - About page
20. **NowPage.vue** - Now/current projects
21. **UsesPage.vue** - Uses/tools page
22. **PrivacyPage.vue** - Privacy policy
23. **TermsPage.vue** - Terms of service

### Phase 5: Auth Pages
24. **LoginPage.vue** - Login page
25. **RegisterPage.vue** - Registration page

### Phase 6: Admin Pages (Blade Templates)
26. **admin/dashboard/index.blade.php** - Dashboard
27. **admin/work/index.blade.php** - Work management
28. **admin/services/index.blade.php** - Services management
29. **admin/notes/index.blade.php** - Notes management
30. **admin/blog/index.blade.php** - Blog management
31. **admin/tools/index.blade.php** - Tools management
32. **admin/inquiries/index.blade.php** - Inquiries
33. **admin/insights/index.blade.php** - Analytics
34. **admin/media/index.blade.php** - Media library
35. **admin/settings/index.blade.php** - Settings

### Phase 7: Components & Layouts
36. Reusable Vue components
37. Layout components
38. Admin layout structure

---

## 🧬 DATABASE SCHEMA (Provide This to AI)

```sql
-- Core Tables

-- Users
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

-- Projects / Work
CREATE TABLE projects (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description VARCHAR(500),
    overview LONGTEXT,
    technologies JSON,
    problem_statement TEXT,
    my_role VARCHAR(255),
    timeline VARCHAR(100),
    results JSON,
    featured_image VARCHAR(255),
    url_demo VARCHAR(255) NULL,
    url_github VARCHAR(255) NULL,
    is_featured BOOLEAN DEFAULT false,
    is_published BOOLEAN DEFAULT false,
    published_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Services (DYNAMIC)
CREATE TABLE services (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    tagline VARCHAR(255),
    icon VARCHAR(255),
    overview LONGTEXT,
    featured_image VARCHAR(255) NULL,
    order INT DEFAULT 0,
    is_published BOOLEAN DEFAULT true,
    published_at TIMESTAMP NULL,
    meta_title VARCHAR(255),
    meta_description VARCHAR(255),
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Service Features
CREATE TABLE service_features (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    service_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    icon VARCHAR(255) NULL,
    order INT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Service Process Steps
CREATE TABLE service_process_steps (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    service_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    step_number INT,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Service FAQs
CREATE TABLE service_faqs (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    service_id BIGINT UNSIGNED NOT NULL,
    question VARCHAR(255) NOT NULL,
    answer TEXT,
    order INT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Service Technologies
CREATE TABLE service_technologies (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    service_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    icon VARCHAR(255) NULL,
    proficiency VARCHAR(50),
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Service Pricing Models
CREATE TABLE service_pricing_models (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    service_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NULL,
    description TEXT,
    features JSON,
    is_featured BOOLEAN DEFAULT false,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
);

-- Articles / Notes
CREATE TABLE articles (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description VARCHAR(500),
    content LONGTEXT,
    reading_time INT DEFAULT 5,
    is_featured BOOLEAN DEFAULT false,
    is_published BOOLEAN DEFAULT false,
    published_at TIMESTAMP NULL,
    featured_image VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Blog Posts
CREATE TABLE blog_posts (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    category_id BIGINT UNSIGNED NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    content LONGTEXT,
    is_published BOOLEAN DEFAULT false,
    published_at TIMESTAMP NULL,
    featured_image VARCHAR(255) NULL,
    view_count INT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Categories
CREATE TABLE categories (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Tags
CREATE TABLE tags (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    slug VARCHAR(255) UNIQUE NOT NULL,
    visibility ENUM('public', 'private') DEFAULT 'public',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Taggables (Polymorphic Pivot)
CREATE TABLE taggables (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    tag_id BIGINT UNSIGNED NOT NULL,
    taggable_id BIGINT UNSIGNED NOT NULL,
    taggable_type VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

-- Tools
CREATE TABLE tools (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE NOT NULL,
    description TEXT,
    icon VARCHAR(255) NULL,
    is_enabled BOOLEAN DEFAULT true,
    config JSON NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tool Usage (Analytics)
CREATE TABLE tool_usages (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    tool_id BIGINT UNSIGNED NOT NULL,
    visitor_id BIGINT UNSIGNED NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP NULL,
    FOREIGN KEY (tool_id) REFERENCES tools(id) ON DELETE CASCADE,
    FOREIGN KEY (visitor_id) REFERENCES visitors(id) ON DELETE CASCADE
);

-- Contacts / Inquiries
CREATE TABLE contacts (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message LONGTEXT NOT NULL,
    budget_range VARCHAR(100) NULL,
    timeline VARCHAR(100) NULL,
    status ENUM('new', 'replied', 'closed') DEFAULT 'new',
    page_url VARCHAR(255) NULL,
    replied_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- Visitors (Analytics)
CREATE TABLE visitors (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    visiting_page VARCHAR(255),
    referer VARCHAR(255) NULL,
    session_id VARCHAR(255) NULL,
    created_at TIMESTAMP NULL
);

-- Page Views (Analytics)
CREATE TABLE page_views (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    visitor_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NULL,
    page_url VARCHAR(255),
    session_id VARCHAR(255),
    created_at TIMESTAMP NULL,
    FOREIGN KEY (visitor_id) REFERENCES visitors(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);
```

---

## 📂 FOLDER STRUCTURE (Provide This to AI)

```
resources/
├── js/
│   ├── Pages/
│   │   ├── Public/
│   │   │   ├── Home/HomePage.vue
│   │   │   ├── Work/WorkListPage.vue
│   │   │   ├── Work/WorkDetailPage.vue
│   │   │   ├── Services/ServicesListPage.vue
│   │   │   ├── Services/ServiceDetailPage.vue
│   │   │   ├── Notes/NotesListPage.vue
│   │   │   ├── Notes/ArticleDetailPage.vue
│   │   │   ├── Blog/BlogListPage.vue
│   │   │   ├── Blog/PostDetailPage.vue
│   │   │   ├── Tools/ToolsListPage.vue
│   │   │   ├── Tools/JsonFormatterPage.vue
│   │   │   ├── Tools/ApiViewerPage.vue
│   │   │   ├── Tools/SlugGeneratorPage.vue
│   │   │   ├── Tools/MarkdownPreviewPage.vue
│   │   │   ├── Tools/TextUtilitiesPage.vue
│   │   │   ├── Contact/ContactPage.vue
│   │   │   ├── Contact/ThankYouPage.vue
│   │   │   ├── Schedule/SchedulePage.vue
│   │   │   ├── Info/AboutPage.vue
│   │   │   ├── Info/NowPage.vue
│   │   │   ├── Info/UsesPage.vue
│   │   │   ├── Info/PrivacyPage.vue
│   │   │   ├── Info/TermsPage.vue
│   │   │   ├── Auth/LoginPage.vue
│   │   │   └── Auth/RegisterPage.vue
│   │   ├── Admin/
│   │   │   ├── Dashboard.vue
│   │   │   ├── Work.vue
│   │   │   └── ...
│   │   └── Layouts/
│   │       ├── PublicLayout.vue
│   │       └── AdminLayout.vue
│   ├── Components/
│   │   ├── Public/
│   │   │   ├── Header.vue
│   │   │   ├── Footer.vue
│   │   │   ├── ProjectCard.vue
│   │   │   ├── ServiceCard.vue
│   │   │   └── ArticleCard.vue
│   │   └── Admin/
│   │       ├── Sidebar.vue
│   │       ├── DataTable.vue
│   │       └── FormBuilder.vue
│   ├── Stores/
│   │   ├── authStore.js
│   │   └── uiStore.js
│   └── router/
│       └── index.js
└── views/
    └── app.blade.php

resources/views/admin/
├── layouts/app.blade.php
├── dashboard/index.blade.php
├── work/index.blade.php
├── services/index.blade.php
├── notes/index.blade.php
├── blog/index.blade.php
├── tools/index.blade.php
├── inquiries/index.blade.php
├── insights/index.blade.php
├── media/index.blade.php
└── settings/index.blade.php
```

---

## 🚀 HOW TO USE THIS PROMPT

### Step 1: Copy Database Schema
Copy the complete SQL database schema above.

### Step 2: Copy Folder Structure
Copy the folder structure section above.

### Step 3: Pick Your Page
Select a page from the Generation Order (Phase 1, Phase 2, etc.)

### Step 4: Create Detailed Prompt
Copy the page-specific prompt from the sections below and combine it with database schema and folder structure.

### Step 5: Submit to AI
Paste the combined prompt to ChatGPT, Claude, DeepSeek, or your AI of choice.

### Step 6: Get Code
Copy the generated code into the appropriate file in your project.

### Step 7: Repeat
Move to the next page and repeat.

---

## 📄 PHASE 1 PAGE PROMPTS

### 1. HomePage.vue

```
Generate the complete Vue 3 Composition API code for HomePage.vue

Requirements:
- Location: resources/js/Pages/Public/Home/HomePage.vue
- Framework: Vue 3 Composition API, Vue Router
- Styling: Tailwind CSS
- HTTP Client: axios or fetch API

Features Required:
1. Hero Section
   - Background image/gradient
   - Main heading and subheading
   - CTA button to contact or view work

2. Featured Projects Section
   - Display 3-4 featured projects
   - Project cards showing: title, image, brief description, technologies
   - "View All Projects" link to /work

3. Services Overview
   - Display featured services (4 maximum)
   - Service cards with icon, title, brief description
   - Link to /services for details

4. Recent Articles/Notes
   - Show 3 most recent articles
   - Article card with: title, excerpt, date, reading time
   - "Read More" links

5. Featured Tools
   - Display available developer tools
   - Tool cards with name, description, icon
   - Links to individual tools

6. Testimonials Section (optional)
   - Client quotes/testimonials carousel
   - Author info and rating

7. CTA Section
   - Large call-to-action to /contact
   - Headline and description

8. Performance
   - Use lazy loading for images
   - Optimize component rendering
   - Implement proper error boundaries

Data Sources:
- Fetch featured projects from GET /api/projects?featured=true
- Fetch services from GET /api/services
- Fetch articles from GET /api/articles?limit=3
- Fetch tools from GET /api/tools

Styling:
- Use modern design patterns
- Responsive design for mobile, tablet, desktop
- Smooth scrolling and transitions
- Proper spacing and typography

Export: Default export for the component
```

---

### 2. WorkListPage.vue

```
Generate the complete Vue 3 Composition API code for WorkListPage.vue (Projects List)

Requirements:
- Location: resources/js/Pages/Public/Work/WorkListPage.vue
- Framework: Vue 3 Composition API, Vue Router
- Styling: Tailwind CSS
- HTTP Client: axios or fetch API

Features Required:
1. Page Header
   - Title: "My Work"
   - Subtitle: "Portfolio of projects and case studies"
   - Breadcrumb navigation

2. Search & Filter Section
   - Search input for projects
   - Filter by technology (multi-select)
   - Filter by category
   - Sort by: newest, oldest, name, views

3. Projects Grid
   - Display projects in responsive grid (3-4 columns)
   - Project cards showing:
     - Featured image
     - Title
     - Brief description
     - Technologies used (as badges/tags)
     - Year/date completed
     - Link to detail page
   - Lazy loading for images

4. Pagination
   - Show current page / total pages
   - Previous/Next buttons
   - Page number links

5. No Results State
   - Friendly message when no projects match filters
   - Provide clear action (clear filters, go home)

6. Loading States
   - Skeleton loaders while fetching
   - Proper error handling with retry option

Data Flow:
1. Component mounts → Fetch projects from GET /api/projects
2. User interacts with filters → Update query parameters
3. Fetch new data with filters
4. Update grid display

Composition Structure:
- useProjects() composable for fetching
- useFilter() composable for filter logic
- usePagination() composable

Styling:
- Responsive grid layout
- Hover effects on cards
- Smooth transitions
- Professional spacing

Export: Default export for the component
```

---

### 3. WorkDetailPage.vue

```
Generate the complete Vue 3 Composition API code for WorkDetailPage.vue

Requirements:
- Location: resources/js/Pages/Public/Work/WorkDetailPage.vue
- Framework: Vue 3 Composition API, Vue Router
- Styling: Tailwind CSS
- Dynamic route: /work/:slug

Features Required:
1. Project Header
   - Large featured image/banner
   - Project title
   - Brief tagline/description
   - Client/company name (if available)
   - Project completion date/timeline

2. About Section
   - Overview/introduction to project
   - Problem statement
   - Solution/approach

3. Details Grid
   - My role/responsibilities
   - Technologies used (with logos if available)
   - Timeline/duration
   - Team size

4. Results Section
   - Metrics/statistics
   - Key achievements
   - Impact/value delivered

5. Gallery/Images
   - Project screenshots or demo images
   - Image carousel or lightbox
   - Captions for each image

6. Process/Features
   - Key features implemented
   - Process steps used
   - Methodology

7. Links Section
   - Live demo button (if available)
   - GitHub repository button (if available)
   - External links

8. Related Projects
   - Show 3 related projects
   - Navigation carousel
   - Link to full projects list

9. CTA Section
   - Encourage user to contact
   - Link to contact page

Data Fetching:
- Route slug from URL: useRoute().params.slug
- Fetch project: GET /api/projects/{slug}
- Handle 404 if project not found
- Fetch related projects: GET /api/projects?related=true

Content Sections:
- Use v-html for rich text (sanitized)
- Proper markdown rendering
- Code syntax highlighting if applicable

Performance:
- Image optimization
- Lazy loading below the fold
- Skeleton loading states

Styling:
- Modern, professional layout
- Good typography hierarchy
- Proper spacing and alignment
- Mobile responsive

Error Handling:
- 404 page if project not found
- Retry mechanism for failed requests
- User-friendly error messages

Export: Default export for the component
```

---

### 4. ServicesListPage.vue

```
Generate the complete Vue 3 Composition API code for ServicesListPage.vue

Requirements:
- Location: resources/js/Pages/Public/Services/ServicesListPage.vue
- Framework: Vue 3 Composition API
- Styling: Tailwind CSS

Features Required:
1. Page Header
   - Title: "Services"
   - Subtitle: "What I can help you with"
   - Optional intro text

2. Services Grid
   - Responsive grid layout (2-3 columns)
   - Service cards displaying:
     - Icon (from icon field)
     - Title
     - Tagline/short description
     - Brief overview (first 100 words)
     - Number of features
     - Technologies preview (3-4 tech names)
     - Link to detail page
   - Hover effects with subtle animations

3. Service Categories (Optional)
   - If you have categories, show filter tabs
   - "All Services" tab selected by default
   - Filter services by category

4. Ordering
   - Services should be ordered by 'order' field
   - Maintain ranking for display

5. Featured Services
   - Highlight featured services
   - Special badge or styling

6. Call to Action
   - Each service card has link/button
   - CTA to schedule or contact for inquiries

Data Flow:
- Fetch services: GET /api/services
- Services already paginated from DB (all published)
- Order by 'order' field ascending

Responsive Design:
- Mobile: 1 column
- Tablet: 2 columns
- Desktop: 3 columns
- Ensure cards are equal height

Styling:
- Professional color scheme
- Icon styling and sizing
- Hover state animations
- Smooth transitions

Loading States:
- Skeleton loading cards while fetching
- Error state with retry option

Export: Default export for the component
```

---

### 5. ServiceDetailPage.vue

```
Generate the complete Vue 3 Composition API code for ServiceDetailPage.vue

Requirements:
- Location: resources/js/Pages/Public/Services/ServiceDetailPage.vue
- Framework: Vue 3 Composition API, Vue Router
- Styling: Tailwind CSS
- Dynamic route: /services/:slug

Features Required - This is a COMPLEX page with multiple nested relationships:

1. Service Header Section
   - Service title and icon
   - Tagline
   - Featured image (if available)
   - Brief overview paragraph
   - Key metrics (number of features, process steps, etc.)

2. Overview Section
   - Full overview/description text
   - Rich HTML content (v-html - sanitized)

3. Key Features Section
   - Fetch from service_features relationship
   - Display all features as:
     - Icon (if available)
     - Feature title
     - Feature description
   - Can be 2-column layout
   - Each feature on card with subtle shadow

4. Process/Methodology Section
   - Fetch from service_process_steps relationship
   - Display numbered steps
   - Timeline-style vertical layout on desktop
   - Step number, title, description
   - Optional step duration

5. Technologies Section
   - Fetch from service_technologies relationship
   - Display tech stack with:
     - Technology name
     - Icon/logo (if available)
     - Proficiency level (if available)
   - Grid layout with tech badges

6. Pricing Section
   - Fetch from service_pricing_models relationship
   - Display pricing tiers/models:
     - Plan name
     - Price (if not custom)
     - Description
     - List of features (from JSON array)
     - CTA button
   - Highlight featured pricing model

7. FAQ Section
   - Fetch from service_faqs relationship
   - Display as accordion/collapsible items
   - Question and answer
   - Smooth expand/collapse animation

8. Related Projects Section
   - Fetch related projects via relationship
   - Show 3-4 related project cards
   - Links to project detail pages

9. CTA Section
   - "Get Started" or "Schedule a Consultation"
   - Link to /contact or /schedule

Data Fetching:
- Main route parameter: slug from useRoute().params.slug
- Fetch: GET /api/services/{slug}
- Response includes all nested relationships:
  {
    id, title, slug, tagline, icon, overview, featured_image,
    service_features: [{ id, title, description, icon, order }],
    service_process_steps: [{ id, title, description, step_number }],
    service_technologies: [{ id, name, icon, proficiency }],
    service_pricing_models: [{ id, name, price, description, features }],
    service_faqs: [{ id, question, answer }],
    related_projects: [{ id, title, slug, featured_image }]
  }

Sections to Render:
- Check if each section exists before rendering
- Skip empty sections gracefully

Performance:
- Lazy load images below fold
- Skeleton loading states
- Proper error handling

Styling:
- Modern service page design
- Good use of whitespace
- Professional typography
- Color hierarchies
- Mobile responsive
- Dark/light mode support (optional)

Interactivity:
- Smooth scrolling anchor links
- Accordion animations for FAQ
- Hover effects on CTAs
- Modal for pricing comparison (optional)

Error Handling:
- 404 if service not found
- Loading states
- Error retry mechanism

Export: Default export for the component
```

---

## 📄 PHASE 2 PAGE PROMPTS

### 6. NotesListPage.vue

```
Generate the complete Vue 3 Composition API code for NotesListPage.vue

This page displays a list of all articles/notes with search, filtering, and pagination.

Requirements:
- Location: resources/js/Pages/Public/Notes/NotesListPage.vue
- Framework: Vue 3 Composition API
- Styling: Tailwind CSS

Features Required:
1. Page Header
   - Title: "Notes"
   - Subtitle: "Articles, insights, and learnings"

2. Search Bar
   - Search input for article titles/content
   - Real-time search (debounced)
   - Clear button

3. Filter Section
   - Filter by tags (multi-select tags from articles)
   - Filter by reading time (quick read, medium, long form)
   - Sort by: newest, oldest, most read, title A-Z

4. Articles Grid
   - Responsive grid (1-3 columns depending on screen)
   - Article cards with:
     - Featured image
     - Title
     - Excerpt (first 150 characters)
     - Author name
     - Publication date
     - Reading time in minutes
     - Tags (as badges)
     - Link to full article
   - Hover effect on cards

5. Pagination
   - Articles paginated (20 per page)
   - Show current/total pages
   - Previous/Next buttons
   - Page number links

6. Empty State
   - Friendly message if no articles found
   - Clear filters option

7. Loading State
   - Skeleton card loaders
   - Loading spinner

Data Flow:
- Fetch from GET /api/articles with query params:
  - search: search term
  - tags: array of tag IDs
  - sort: field to sort by
  - page: page number
  - limit: per page (20)

Response Structure:
  {
    data: [
      {
        id, title, slug, excerpt, featured_image,
        reading_time, published_at,
        user: { name },
        tags: [ { id, name, slug } ]
      }
    ],
    current_page, last_page, total, per_page
  }

Composables:
- useArticles() for fetching
- useFilter() for filter logic
- usePagination() for pagination

Styling:
- Card-based layout
- Professional spacing
- Responsive design
- Smooth transitions

Export: Default export
```

---

### 7. ArticleDetailPage.vue

```
Generate the complete Vue 3 Composition API code for ArticleDetailPage.vue

Requirements:
- Location: resources/js/Pages/Public/Notes/ArticleDetailPage.vue
- Framework: Vue 3 Composition API, Vue Router
- Styling: Tailwind CSS
- Dynamic route: /notes/:slug

Features Required:
1. Article Header
   - Title (h1)
   - Tagline/excerpt
   - Featured image (large banner)
   - Author name with avatar
   - Publication date
   - Reading time estimate
   - Share buttons (twitter, linkedin, copy link)

2. Article Metadata Bar
   - Reading time
   - Word count
   - Views count
   - Last updated date

3. Table of Contents (Auto-generated from H2/H3)
   - Sticky sidebar on desktop
   - Collapsible on mobile
   - Links to sections (anchor scrolling)
   - Smooth scroll to section

4. Article Content
   - Render HTML content (v-html - sanitized)
   - Markdown rendering
   - Code syntax highlighting
   - Blockquote styling
   - Image optimization
   - Video embedding support (if applicable)

5. Tags Section
   - Display tags/categories
   - Links to filtered notes list by tag

6. Related Articles
   - Show 3 related articles based on tags
   - Article cards with images and titles
   - Links to related articles

7. Navigation
   - Previous article link (by date)
   - Next article link (by date)
   - Back to notes list button

8. CTA Section
   - Subscribe/newsletter signup (optional)
   - Contact or discuss button

9. Comments Section (Optional)
   - Comment form
   - List of comments
   - Nested replies

Data Fetching:
- Route slug: useRoute().params.slug
- Fetch: GET /api/articles/{slug}
- Response:
  {
    id, title, slug, excerpt, content,
    featured_image, reading_time, published_at,
    user: { name, avatar },
    tags: [ { id, name, slug } ],
    related_articles: [ { id, title, slug, featured_image } ]
  }

Features:
- Auto-generate TOC from h2/h3 tags in content
- Highlight current section in TOC while scrolling
- Copy code blocks to clipboard
- Image lightbox/modal on click
- Print article functionality

Performance:
- Image lazy loading
- Code splitting for heavy content

Error Handling:
- 404 if article not found
- Loading skeleton
- Error retry

Export: Default export
```

---

## 🎯 CONTINUING WITH MORE PAGES...

Due to length, I'm providing the structure for remaining pages. Follow same pattern:

### 8. BlogListPage.vue - Similar to NotesListPage but with categories
### 9. PostDetailPage.vue - Similar to ArticleDetailPage but with comments
### 10-15. Tool Pages - Each tool page with specific functionality
### 16-17. Contact & Thank You Pages
### 18-23. Info Pages (About, Now, Uses, Privacy, Terms, Schedule)
### 24-25. Auth Pages (Login, Register)
### 26-35. Admin Pages (Blade templates with forms and tables)

---

## ✅ GENERATION CHECKLIST

For each page generated, verify:

- [ ] Vue 3 Composition API syntax
- [ ] Vue Router integration (if needed)
- [ ] Type safety with proper data structures
- [ ] Error handling implemented
- [ ] Loading states included
- [ ] Responsive design tested
- [ ] Tailwind CSS styling
- [ ] Accessibility attributes included
- [ ] Proper SEO meta tags
- [ ] Performance optimizations (lazy loading, etc.)
- [ ] Proper prop/data types defined
- [ ] Comments in code for clarity
- [ ] No console errors
- [ ] Cross-browser compatibility

---

## 🔗 API ENDPOINTS SUMMARY

All pages use these API endpoints:

```
GET /api/projects                  - List projects
GET /api/projects/{slug}           - Get single project
GET /api/services                  - List services
GET /api/services/{slug}           - Get service with relationships
GET /api/articles                  - List articles
GET /api/articles/{slug}           - Get single article
GET /api/blog                      - List blog posts
GET /api/blog/{slug}               - Get single blog post
GET /api/tools                     - List tools
POST /api/contact                  - Submit contact form

Admin API (authenticated):
GET /api/admin/services            - List all services (with draft)
POST /api/admin/services           - Create service
PUT /api/admin/services/{id}       - Update service
DELETE /api/admin/services/{id}    - Delete service
[Similar for other resources]
```

---

## 📝 FINAL NOTES

1. **Start with Phase 1** - Core public pages first
2. **Test as you go** - Verify each page in browser
3. **Use Database Schema** - Refer to it when uncertain about data structure
4. **Provide context to AI** - Always include database schema + folder structure with page prompt
5. **Iterate** - Ask AI to modify if output needs changes
6. **Document as needed** - Add comments to generated code for future maintenance

---

**Total Pages to Generate: 35 pages**  
**Estimated Time:** 3-4 hours with AI assistance  
**Difficulty:** Low to Medium

Good luck with your page generation! 🚀
