# 🗄️ VANTAGE - Complete Database Structure

**Project:** Vantage Portfolio & Service Management System  
**Database Type:** MySQL/MariaDB with Laravel Eloquent ORM  
**Last Updated:** March 11, 2026

---

## 📋 Table of Contents

1. [Core Tables](#core-tables)
2. [Feature Tables](#feature-tables)
3. [Relationship Tables](#relationship-tables)
4. [System Tables](#system-tables)
5. [Implementation Status](#implementation-status)
6. [Migration Order](#migration-order)

---

## 🔑 Core Tables

### 1. **users**
Stores all user accounts (admin, author, viewers)

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key (Auto-increment) |
| name | VARCHAR(255) | ❌ | - | User full name |
| email | VARCHAR(255) | ❌ | - | Email address (Unique) |
| email_verified_at | TIMESTAMP | ✅ | NULL | Email verification timestamp |
| password | VARCHAR(255) | ❌ | - | Hashed password |
| role | ENUM | ❌ | 'viewer' | User role: 'admin', 'author', 'viewer' |
| is_active | BOOLEAN | ❌ | true | Account active status |
| profile_picture | VARCHAR(255) | ✅ | NULL | Profile image filename |
| bio | TEXT | ✅ | NULL | User biography |
| remember_token | VARCHAR(100) | ✅ | NULL | Remember me token |
| created_at | TIMESTAMP | ❌ | CURRENT | Record creation time |
| updated_at | TIMESTAMP | ❌ | CURRENT | Record update time |

**Relationships:**
- `hasMany` Articles
- `hasMany` Projects
- `hasMany` Activity Logs

**Status:** ✅ **DONE**

---

### 2. **categories**
Article and content categories

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| name | VARCHAR(255) | ❌ | - | Category name |
| slug | VARCHAR(255) | ❌ | - | URL-friendly slug (Unique) |
| description | TEXT | ✅ | NULL | Category description |
| color | VARCHAR(7) | ✅ | NULL | Hex color code |
| icon | VARCHAR(255) | ✅ | NULL | Icon name/path |
| order | INT | ❌ | 0 | Display order |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Relationships:**
- `hasMany` Articles
- `hasMany` Tags (if applicable)

**Status:** ✅ **DONE**

---

### 3. **tags**
Tags for articles and projects

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| name | VARCHAR(255) | ❌ | - | Tag name |
| slug | VARCHAR(255) | ❌ | - | URL-friendly slug (Unique) |
| description | TEXT | ✅ | NULL | Tag description |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Relationships:**
- `morphedByMany` Articles (via taggables)
- `morphedByMany` Projects (via taggables)

**Status:** ✅ **DONE**

---

### 4. **articles**
Blog articles and notes

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| user_id | BIGINT | ❌ | - | Foreign Key → users.id |
| category_id | BIGINT | ✅ | NULL | Foreign Key → categories.id |
| title | VARCHAR(255) | ❌ | - | Article title |
| slug | VARCHAR(255) | ❌ | - | URL-friendly slug (Unique) |
| excerpt | VARCHAR(500) | ❌ | - | Short summary |
| content | LONGTEXT | ❌ | - | Full article content (Markdown) |
| featured_image | VARCHAR(255) | ✅ | NULL | Featured image filename |
| reading_time | INT | ✅ | NULL | Estimated reading time (minutes) |
| is_published | BOOLEAN | ❌ | false | Publication status |
| published_at | TIMESTAMP | ✅ | NULL | Publication timestamp |
| meta_title | VARCHAR(255) | ✅ | NULL | SEO title |
| meta_description | VARCHAR(500) | ✅ | NULL | SEO description |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Relationships:**
- `belongsTo` User
- `belongsTo` Category (optional)
- `morphMany` Tags

**Status:** ✅ **DONE**

---

### 5. **projects**
Portfolio projects and work showcase

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| user_id | BIGINT | ❌ | - | Foreign Key → users.id |
| title | VARCHAR(255) | ❌ | - | Project title |
| slug | VARCHAR(255) | ❌ | - | URL-friendly slug (Unique) |
| description | TEXT | ❌ | - | Short description |
| featured_image | VARCHAR(255) | ✅ | NULL | Featured image filename |
| images | JSON | ✅ | NULL | Array of image filenames |
| overview | TEXT | ❌ | - | Detailed overview |
| challenge | TEXT | ❌ | - | Challenge/problem statement |
| solution | TEXT | ❌ | - | Solution implemented |
| results | TEXT | ❌ | - | Results/outcomes |
| technologies | JSON | ❌ | - | Array of tech tags |
| live_url | VARCHAR(255) | ✅ | NULL | Live project URL |
| github_url | VARCHAR(255) | ✅ | NULL | GitHub repository URL |
| case_study_url | VARCHAR(255) | ✅ | NULL | Case study URL |
| start_date | DATE | ❌ | - | Project start date |
| end_date | DATE | ✅ | NULL | Project end date |
| status | ENUM | ❌ | 'planning' | Status: 'planning', 'in_progress', 'completed' |
| is_featured | BOOLEAN | ❌ | false | Featured on homepage |
| is_published | BOOLEAN | ❌ | false | Published/visible status |
| published_at | TIMESTAMP | ✅ | NULL | Publication timestamp |
| order | INT | ❌ | 0 | Display order |
| meta_title | VARCHAR(255) | ✅ | NULL | SEO title |
| meta_description | VARCHAR(500) | ✅ | NULL | SEO description |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Relationships:**
- `belongsTo` User
- `belongsToMany` Services (via service_project)
- `morphMany` Tags
- `hasMany` PageViews

**Status:** ✅ **DONE**

---

### 6. **services**
Service offerings and service-related details

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| title | VARCHAR(255) | ❌ | - | Service title |
| slug | VARCHAR(255) | ❌ | - | URL-friendly slug (Unique) |
| tagline | VARCHAR(255) | ❌ | - | Short tagline |
| icon | VARCHAR(255) | ✅ | NULL | Icon name/path |
| featured_image | VARCHAR(255) | ✅ | NULL | Featured image filename |
| overview | TEXT | ❌ | - | Service overview |
| description | TEXT | ✅ | NULL | Detailed description |
| process | JSON | ✅ | NULL | Process steps (array) |
| features | JSON | ✅ | NULL | Features list (array) |
| technologies | JSON | ✅ | NULL | Technologies used (array) |
| pricing_models | JSON | ✅ | NULL | Pricing options (array) |
| faqs | JSON | ✅ | NULL | FAQ items (array) |
| related_projects | JSON | ✅ | NULL | Related project IDs (array) |
| success_stories | TEXT | ✅ | NULL | Success stories/testimonials |
| delivery_timeframe | VARCHAR(100) | ✅ | NULL | Expected delivery time |
| team_size | VARCHAR(100) | ✅ | NULL | Typical team size |
| consultation_url | VARCHAR(255) | ✅ | NULL | Booking/consultation URL |
| meta_title | VARCHAR(255) | ✅ | NULL | SEO title |
| meta_description | VARCHAR(500) | ✅ | NULL | SEO description |
| is_published | BOOLEAN | ❌ | true | Published status |
| is_featured | BOOLEAN | ❌ | false | Featured on homepage |
| order | INT | ❌ | 0 | Display order |
| published_at | TIMESTAMP | ✅ | NULL | Publication timestamp |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Relationships:**
- `belongsToMany` Projects (via service_project)
- `hasMany` ServiceFeatures
- `hasMany` ServiceProcessSteps
- `hasMany` ServiceFAQs
- `hasMany` ServiceTechnologies
- `hasMany` ServicePricingModels

**Status:** ✅ **DONE**

---

## 🔗 Relationship/Detail Tables

### 7. **service_features**
Features of services (one-to-many detail)

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| service_id | BIGINT | ❌ | - | Foreign Key → services.id |
| title | VARCHAR(255) | ❌ | - | Feature title |
| description | TEXT | ✅ | NULL | Feature description |
| icon | VARCHAR(255) | ✅ | NULL | Icon name/path |
| order | INT | ❌ | 0 | Display order |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Status:** ✅ **DONE**

---

### 8. **service_process_steps**
Process steps for delivering a service

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| service_id | BIGINT | ❌ | - | Foreign Key → services.id |
| title | VARCHAR(255) | ❌ | - | Step title |
| description | TEXT | ✅ | NULL | Step description |
| icon | VARCHAR(255) | ✅ | NULL | Icon name/path |
| order | INT | ❌ | 0 | Step sequence |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Status:** ✅ **DONE**

---

### 9. **service_faqs**
Frequently Asked Questions for services

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| service_id | BIGINT | ❌ | - | Foreign Key → services.id |
| question | VARCHAR(500) | ❌ | - | FAQ question |
| answer | TEXT | ❌ | - | FAQ answer |
| order | INT | ❌ | 0 | Display order |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Status:** ✅ **DONE**

---

### 10. **service_technologies**
Technologies used in services

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| service_id | BIGINT | ❌ | - | Foreign Key → services.id |
| name | VARCHAR(255) | ❌ | - | Technology name |
| icon | VARCHAR(255) | ✅ | NULL | Technology icon |
| order | INT | ❌ | 0 | Display order |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Status:** ✅ **DONE**

---

### 11. **service_pricing_models**
Pricing tiers/models for services

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| service_id | BIGINT | ❌ | - | Foreign Key → services.id |
| name | VARCHAR(100) | ❌ | - | Pricing tier name (e.g., 'Basic', 'Pro') |
| description | TEXT | ✅ | NULL | Tier description |
| price | DECIMAL(10,2) | ✅ | NULL | Price in base currency |
| duration | VARCHAR(50) | ✅ | NULL | Duration (e.g., 'per month', 'per project') |
| features | JSON | ✅ | NULL | Array of included features |
| order | INT | ❌ | 0 | Display order |
| is_popular | BOOLEAN | ❌ | false | Mark as popular/recommended |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Status:** ✅ **DONE**

---

### 12. **testimonials**
Client testimonials and reviews

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| client_name | VARCHAR(255) | ❌ | - | Client name |
| client_title | VARCHAR(255) | ✅ | NULL | Client title/position |
| client_company | VARCHAR(255) | ✅ | NULL | Client company |
| content | TEXT | ❌ | - | Testimonial text |
| rating | INT | ❌ | 5 | Rating 1-5 |
| client_image | VARCHAR(255) | ✅ | NULL | Client profile image |
| service_id | BIGINT | ✅ | NULL | Foreign Key → services.id |
| project_id | BIGINT | ✅ | NULL | Foreign Key → projects.id |
| is_featured | BOOLEAN | ❌ | false | Feature on homepage |
| order | INT | ❌ | 0 | Display order |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Relationships:**
- `belongsTo` Service (optional)
- `belongsTo` Project (optional)

**Status:** ✅ **DONE**

---

### 13. **tools**
Tools, software, and resources tracking

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| name | VARCHAR(255) | ❌ | - | Tool name |
| slug | VARCHAR(255) | ❌ | - | URL-friendly slug (Unique) |
| description | TEXT | ✅ | NULL | Tool description |
| category | VARCHAR(100) | ✅ | NULL | Tool category |
| url | VARCHAR(255) | ✅ | NULL | Tool website URL |
| icon | VARCHAR(255) | ✅ | NULL | Tool icon/logo |
| is_active | BOOLEAN | ❌ | true | Active/in-use status |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Relationships:**
- `hasMany` ToolUsages

**Status:** ✅ **DONE**

---

### 14. **tool_usages**
Tracking of tool usage

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| tool_id | BIGINT | ❌ | - | Foreign Key → tools.id |
| project_id | BIGINT | ✅ | NULL | Foreign Key → projects.id |
| purpose | TEXT | ✅ | NULL | Purpose of usage |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Status:** ✅ **DONE**

---

## 🎯 Transaction/Activity Tables

### 15. **contacts**
Contact form submissions and inquiries

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| name | VARCHAR(255) | ❌ | - | Sender name |
| email | VARCHAR(255) | ❌ | - | Sender email |
| phone | VARCHAR(20) | ✅ | NULL | Sender phone |
| subject | VARCHAR(255) | ❌ | - | Message subject |
| message | TEXT | ❌ | - | Message content |
| status | ENUM | ❌ | 'new' | Status: 'new', 'replied', 'archived' |
| reply_message | TEXT | ✅ | NULL | Admin reply |
| replied_by | BIGINT | ✅ | NULL | Foreign Key → users.id |
| replied_at | TIMESTAMP | ✅ | NULL | Reply timestamp |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Status:** ✅ **DONE**

---

### 16. **schedules**
Bookings, appointments, and schedules

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| guest_name | VARCHAR(255) | ❌ | - | Guest/client name |
| guest_email | VARCHAR(255) | ❌ | - | Guest email |
| guest_phone | VARCHAR(20) | ✅ | NULL | Guest phone |
| type | ENUM | ❌ | 'appointment' | Type: 'appointment', 'consultation', 'meeting' |
| service_id | BIGINT | ✅ | NULL | Foreign Key → services.id |
| title | VARCHAR(255) | ❌ | - | Booking title |
| description | TEXT | ✅ | NULL | Booking description |
| start_time | TIMESTAMP | ❌ | - | Start date/time |
| end_time | TIMESTAMP | ❌ | - | End date/time |
| status | ENUM | ❌ | 'pending' | Status: 'pending', 'approved', 'declined', 'completed', 'cancelled' |
| notes | TEXT | ✅ | NULL | Internal notes |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Relationships:**
- `belongsTo` Service (optional)

**Status:** ✅ **DONE**

---

### 17. **visitors**
Website visitor tracking

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| ip_address | VARCHAR(45) | ❌ | - | Visitor IP address |
| user_agent | TEXT | ❌ | - | Browser user agent |
| referrer | VARCHAR(500) | ✅ | NULL | Referrer URL |
| country | VARCHAR(100) | ✅ | NULL | Country (from IP) |
| city | VARCHAR(100) | ✅ | NULL | City (from IP) |
| device | VARCHAR(50) | ✅ | NULL | Device type |
| browser | VARCHAR(50) | ✅ | NULL | Browser name |
| os | VARCHAR(50) | ✅ | NULL | Operating system |
| last_visit_at | TIMESTAMP | ❌ | - | Last visit timestamp |
| visit_count | INT | ❌ | 1 | Total visit count |
| created_at | TIMESTAMP | ❌ | - | First visit timestamp |
| updated_at | TIMESTAMP | ❌ | - | Last updated timestamp |

**Status:** ✅ **DONE**

---

### 18. **page_views**
Track page views for analytics

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| visitor_id | BIGINT | ✅ | NULL | Foreign Key → visitors.id |
| viewable_type | VARCHAR(255) | ✅ | NULL | Polymorphic type (Article, Project, Service) |
| viewable_id | BIGINT | ✅ | NULL | Polymorphic ID |
| page_url | VARCHAR(500) | ❌ | - | Page URL |
| page_title | VARCHAR(255) | ✅ | NULL | Page title |
| referrer | VARCHAR(500) | ✅ | NULL | Referrer URL |
| time_on_page | INT | ✅ | NULL | Time spent (seconds) |
| created_at | TIMESTAMP | ❌ | - | View timestamp |

**Status:** ✅ **DONE**

---

## 🔐 Permission & Role Tables

### 19. **permissions**
System permissions for role-based access control

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| name | VARCHAR(255) | ❌ | - | Permission name (Unique) |
| guard_name | VARCHAR(255) | ❌ | 'web' | Guard type |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |

**Status:** ✅ **DONE**

---

### 20. **roles**
User roles for access control

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| name | VARCHAR(255) | ❌ | - | Role name (Unique) |
| guard_name | VARCHAR(255) | ❌ | 'web' | Guard type |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |

**Status:** ✅ **DONE**

---

### 21. **role_has_permissions**
Pivot table: Roles to Permissions

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| permission_id | BIGINT | ❌ | - | Foreign Key → permissions.id |
| role_id | BIGINT | ❌ | - | Foreign Key → roles.id |

**Primary Key:** (permission_id, role_id)

**Status:** ✅ **DONE**

---

## 📁 Many-to-Many & Polymorphic Tables

### 22. **service_project**
Pivot table: Services to Projects

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| service_id | BIGINT | ❌ | - | Foreign Key → services.id |
| project_id | BIGINT | ❌ | - | Foreign Key → projects.id |

**Status:** ✅ **DONE**

---

### 23. **taggables**
Polymorphic table: Tags to Articles/Projects

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| tag_id | BIGINT | ❌ | - | Foreign Key → tags.id |
| taggable_type | VARCHAR(255) | ❌ | - | Model type (Article, Project) |
| taggable_id | BIGINT | ❌ | - | Model ID |

**Primary Key:** (tag_id, taggable_type, taggable_id)

**Status:** ✅ **DONE**

---

## 📸 Media & File Tables

### 24. **media**
File/media management

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| model_type | VARCHAR(255) | ✅ | NULL | Model type |
| model_id | BIGINT | ✅ | NULL | Model ID |
| uuid | VARCHAR(36) | ✅ | NULL | Unique identifier |
| collection_name | VARCHAR(255) | ❌ | - | Collection (e.g., 'images') |
| name | VARCHAR(255) | ❌ | - | File name |
| file_name | VARCHAR(255) | ❌ | - | Stored file name |
| mime_type | VARCHAR(255) | ✅ | NULL | MIME type |
| disk | VARCHAR(255) | ❌ | 'public' | Storage disk |
| size | BIGINT | ✅ | NULL | File size in bytes |
| manipulations | JSON | ✅ | NULL | Image manipulations |
| custom_properties | JSON | ✅ | NULL | Custom metadata |
| responsive_images | JSON | ✅ | NULL | Responsive image data |
| order_column | INT | ✅ | NULL | Sort order |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Status:** ✅ **DONE**

---

## 📊 System Tables

### 25. **activity_log**
Log of system activities and changes

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| log_name | VARCHAR(255) | ✅ | NULL | Log category |
| description | TEXT | ❌ | - | Activity description |
| subject_type | VARCHAR(255) | ✅ | NULL | Subject model type |
| subject_id | BIGINT | ✅ | NULL | Subject model ID |
| causer_type | VARCHAR(255) | ✅ | NULL | Causer model type (usually User) |
| causer_id | BIGINT | ✅ | NULL | Causer model ID |
| properties | JSON | ✅ | NULL | Activity properties/changes |
| created_at | TIMESTAMP | ❌ | - | Activity timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Status:** ✅ **DONE**

---

### 26. **sessions**
Session management

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | VARCHAR(255) | ❌ | - | Session ID |
| user_id | BIGINT | ✅ | NULL | Foreign Key → users.id |
| ip_address | VARCHAR(45) | ✅ | NULL | Client IP |
| user_agent | TEXT | ✅ | NULL | Browser user agent |
| payload | LONGTEXT | ❌ | - | Serialized session data |
| last_activity | INT | ❌ | - | Last activity timestamp |

**Status:** ✅ **DONE**

---

### 27. **personal_access_tokens**
API token management (Sanctum)

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| tokenable_type | VARCHAR(255) | ❌ | - | Model type (User) |
| tokenable_id | BIGINT | ❌ | - | Model ID |
| name | VARCHAR(255) | ❌ | - | Token name |
| token | VARCHAR(64) | ❌ | - | Hashed token |
| abilities | JSON | ✅ | NULL | Token abilities/scopes |
| last_used_at | TIMESTAMP | ✅ | NULL | Last used timestamp |
| created_at | TIMESTAMP | ❌ | - | Creation timestamp |
| updated_at | TIMESTAMP | ❌ | - | Update timestamp |

**Status:** ✅ **DONE**

---

### 28. **jobs**
Asynchronous job queue

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| queue | VARCHAR(255) | ❌ | - | Queue name |
| payload | LONGTEXT | ❌ | - | Job payload |
| exception | LONGTEXT | ✅ | NULL | Exception if failed |
| failed_at | TIMESTAMP | ✅ | NULL | Failure timestamp |

**Status:** ✅ **DONE**

---

### 29. **failed_jobs**
Failed job tracking

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| id | BIGINT | ❌ | - | Primary Key |
| uuid | VARCHAR(255) | ❌ | - | Unique job identifier |
| connection | TEXT | ❌ | - | Connection name |
| queue | TEXT | ❌ | - | Queue name |
| payload | LONGTEXT | ❌ | - | Job payload |
| exception | LONGTEXT | ❌ | - | Exception message |
| failed_at | TIMESTAMP | ❌ | - | Failure timestamp |

**Status:** ✅ **DONE**

---

### 30. **cache**
Cache store

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| key | VARCHAR(255) | ❌ | - | Cache key |
| value | MEDIUMTEXT | ❌ | - | Cached value |
| expiration | INT | ❌ | - | Expiration timestamp |

**Status:** ✅ **DONE**

---

### 31. **password_resets**
Password reset tokens

| Column | Type | Nullable | Default | Description |
|--------|------|----------|---------|-------------|
| email | VARCHAR(255) | ❌ | - | User email |
| token | VARCHAR(255) | ❌ | - | Reset token |
| created_at | TIMESTAMP | ✅ | NULL | Token creation time |

**Status:** ✅ **DONE**

---

## 📈 Implementation Status

### ✅ COMPLETED (31 Tables)

All database migrations have been created and the schema is properly set up.

| Category | Count | Status |
|----------|-------|--------|
| Core Tables | 6 | ✅ |
| Relationship Tables | 8 | ✅ |
| Permission/Role Tables | 3 | ✅ |
| Pivot Tables | 2 | ✅ |
| Media Tables | 1 | ✅ |
| System Tables | 7 | ✅ |
| OAuth/Token Tables | 1 | ✅ |
| **Total** | **31** | **✅** |

---

## ⏳ REMAINING TASKS (Controller Methods)

The database is fully set up. What remains is implementing the controller methods:

### Admin Controllers - Methods Needed

1. **ServiceController** ⏳ (Routes defined, methods needed)
   - `index()` - List all services
   - `create()` - Show creation form
   - `store()` - Save new service
   - `show()` - View single service
   - `edit()` - Show edit form
   - `update()` - Update service
   - `destroy()` - Delete service
   - `reorder()` - Reorder services
   - `toggleStatus()` - Toggle published status
   - `clone()` - Clone a service

2. **ProjectController** ⏳ (Routes defined, methods needed)
   - `index()` - List all projects
   - `create()` - Show creation form
   - `store()` - Save new project
   - `show()` - View single project
   - `edit()` - Show edit form
   - `update()` - Update project
   - `destroy()` - Delete project
   - `reorder()` - Reorder projects
   - `toggleFeatured()` - Toggle featured status
   - `togglePublished()` - Toggle published status

3. **ArticleController** ⏳ (Routes defined, methods needed)
   - `index()` - List all articles
   - `create()` - Show creation form
   - `store()` - Save new article
   - `show()` - View single article
   - `edit()` - Show edit form
   - `update()` - Update article
   - `destroy()` - Delete article
   - `togglePublished()` - Toggle published status
   - `categories()` - List categories
   - `storeCategory()` - Create category
   - `destroyCategory()` - Delete category

4. **BookingController** ⏳ (Routes defined, methods needed)
   - Full CRUD operations
   - `calendar()` - View calendar
   - `approve()` - Approve booking
   - `decline()` - Decline booking
   - `complete()` - Mark completed
   - `availability()` - Manage availability
   - `storeAvailability()` - Save availability

5. **ContactController** ⏳ (Routes defined, methods needed)
   - `index()` - List all contacts
   - `show()` - View single contact
   - `destroy()` - Delete contact
   - `reply()` - Send reply
   - `markAs()` - Mark as read/archived
   - `bulkAction()` - Bulk operations

6. **TestimonialController** ⏳ (Routes defined, methods needed)
   - Full CRUD operations
   - `reorder()` - Reorder testimonials
   - `toggleFeatured()` - Toggle featured

7. **ToolController** ⏳ (Routes defined, methods needed)
   - `index()` - List tools
   - `edit()` - Show edit form
   - `update()` - Update tool
   - `toggle()` - Toggle active status
   - `stats()` - Tool statistics

8. **InsightController** ⏳ (Routes defined, methods needed)
   - `index()` - Analytics overview
   - `visitors()` - Visitor analytics
   - `pageViews()` - Page view analytics
   - `popularContent()` - Popular content stats
   - `export()` - Export analytics

9. **MediaController** ⏳ (Routes defined, methods needed)
   - `index()` - List media
   - `upload()` - Upload files
   - `destroy()` - Delete file
   - `createFolder()` - Create folder
   - `deleteFolder()` - Delete folder
   - `bulkDelete()` - Bulk delete

10. **UserController** ⏳ (Routes defined, methods needed)
    - Full CRUD operations
    - `toggleStatus()` - Toggle user active
    - `assignRole()` - Assign role

11. **SettingController** ⏳ (Routes defined, methods needed)
    - `index()` - Show settings form
    - `updateGeneral()` - Update general settings
    - `updateSeo()` - Update SEO settings
    - `updateEmail()` - Update email settings
    - `updateSocial()` - Update social settings
    - `backup()` - Create backup
    - `logs()` - View logs

---

## 🚀 Migration Order

When running `php artisan migrate`, the migrations execute in this order:

1. **users** - Base user table
2. **personal_access_tokens** - API tokens
3. **categories** - Article categories
4. **visitors** - Visitor tracking
5. **tags** - Content tags
6. **projects** - Portfolio projects
7. **services** - Services offered
8. **articles** - Blog/articles
9. **tools** - Tools tracking
10. **contacts** - Contact inquiries
11. **schedules** - Appointments
12. **testimonials** - Client testimonials
13. **service_features** - Service details
14. **service_process_steps** - Process details
15. **service_faqs** - FAQ details
16. **service_technologies** - Tech stack
17. **service_pricing_models** - Pricing tiers
18. **taggables** - Polymorphic tag relationships
19. **service_project** - Service-project relationships
20. **page_views** - Page analytics
21. **permissions** - RBAC permissions
22. **roles** - RBAC roles
23. **role_has_permissions** - Role-permission mappings
24. **media** - File management
25. **activity_log** - Activity logging
26. **tool_usages** - Tool usage tracking
27. **password_resets** - Password recovery
28. **failed_jobs** - Failed job tracking
29. **jobs** - Job queue
30. **cache** - Cache storage
31. **sessions** - Session management

---

## 📝 Quick Reference: Relationships

```php
// User
User::articles()        // One-to-Many
User::projects()        // One-to-Many

// Article
Article::user()         // Belongs To
Article::category()     // Belongs To
Article::tags()         // Morph Many-to-Many

// Project
Project::user()         // Belongs To
Project::services()     // Many-to-Many
Project::tags()         // Morph Many-to-Many
Project::pageViews()    // One-to-Many

// Service
Service::features()     // One-to-Many
Service::processSteps() // One-to-Many
Service::faqs()         // One-to-Many
Service::technologies() // One-to-Many
Service::pricingModels()// One-to-Many
Service::projects()     // Many-to-Many

// Testimonial
Testimonial::service()  // Belongs To (optional)
Testimonial::project()  // Belongs To (optional)

// Tag
Tag::articles()         // Morph Many-to-Many
Tag::projects()         // Morph Many-to-Many

// Tool
Tool::usages()          // One-to-Many

// Visitor
Visitor::pageViews()    // One-to-Many
```

---

## 🎯 Summary

**Database Status:** ✅ **100% COMPLETE**

- All 31 tables created and migrated
- All relationships properly defined
- All migrations in proper order
- Foreign keys with cascading deletes where appropriate
- Timestamps and audit fields on all tables

**Next Steps:** Implement controller methods to work with this database structure.

