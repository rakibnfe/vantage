## 📊 VANTAGE - Complete Database Structure

### Project: Vantage Portfolio Website
### Framework: Laravel 12
### Database: MySQL
### Total Tables: 31

---

## 📑 TABLE OF CONTENTS

1. [Core Tables](#core-tables)
2. [Service Related Tables](#service-related-tables)
3. [Content Tables](#content-tables)
4. [Authentication & Security Tables](#authentication--security-tables)
5. [Analytics Tables](#analytics-tables)
6. [Pivot Tables](#pivot-tables)
7. [System Tables](#system-tables)
8. [Table Relationships Diagram](#table-relationships-diagram)

---

## 🗃️ CORE TABLES

### 1. `users`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| name | varchar(255) | NOT NULL | User's full name |
| email | varchar(255) | UNIQUE, NOT NULL | User's email |
| email_verified_at | timestamp | NULL | Email verification timestamp |
| password | varchar(255) | NOT NULL | Hashed password |
| role | enum('admin','author','viewer') | DEFAULT 'viewer' | User role |
| is_active | tinyint(1) | DEFAULT 1 | Account status |
| profile_picture | varchar(255) | NULL | Path to profile picture |
| bio | text | NULL | User biography |
| remember_token | varchar(100) | NULL | Remember me token |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

---

### 2. `visitors`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| session_id | varchar(255) | UNIQUE, NOT NULL | Unique session identifier |
| ip_address | varchar(45) | NULL | Visitor IP address |
| user_agent | text | NULL | Browser user agent |
| browser | varchar(255) | NULL | Browser name |
| os | varchar(255) | NULL | Operating system |
| device | enum('desktop','mobile','tablet') | NULL | Device type |
| country | varchar(255) | NULL | Country from geolocation |
| city | varchar(255) | NULL | City from geolocation |
| referrer | varchar(255) | NULL | Referring URL |
| utm_source | varchar(255) | NULL | UTM source parameter |
| utm_medium | varchar(255) | NULL | UTM medium parameter |
| utm_campaign | varchar(255) | NULL | UTM campaign parameter |
| first_visit_at | timestamp | NOT NULL | First visit timestamp |
| last_visit_at | timestamp | NOT NULL | Last visit timestamp |
| visit_count | int(11) | DEFAULT 1 | Total visits |
| page_view_count | int(11) | DEFAULT 0 | Total page views |
| total_time_spent | int(11) | NULL | Total time on site (seconds) |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

---

## 🛠️ SERVICE RELATED TABLES

### 3. `services`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| title | varchar(255) | NOT NULL | Service title |
| slug | varchar(255) | UNIQUE, NOT NULL | URL slug |
| tagline | varchar(255) | NOT NULL | Short tagline |
| icon | varchar(255) | NULL | Icon identifier |
| featured_image | varchar(255) | NULL | Path to featured image |
| overview | text | NOT NULL | Service overview |
| description | text | NULL | Full description |
| process | json | NULL | Process steps (legacy) |
| features | json | NULL | Features (legacy) |
| technologies | json | NULL | Technologies (legacy) |
| pricing_models | json | NULL | Pricing models (legacy) |
| faqs | json | NULL | FAQs (legacy) |
| related_projects | json | NULL | Related project IDs |
| success_stories | text | NULL | Success stories |
| delivery_timeframe | varchar(255) | NULL | Expected delivery time |
| team_size | varchar(255) | NULL | Team size |
| consultation_url | varchar(255) | NULL | Booking URL |
| meta_title | varchar(255) | NULL | SEO meta title |
| meta_description | varchar(255) | NULL | SEO meta description |
| is_published | tinyint(1) | DEFAULT 1 | Published status |
| is_featured | tinyint(1) | DEFAULT 0 | Featured status |
| order | int(11) | DEFAULT 0 | Display order |
| published_at | timestamp | NULL | Publication timestamp |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Indexes:** `slug`

---

### 4. `service_features`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| service_id | bigint(20) UNSIGNED | FOREIGN KEY | References `services.id` |
| title | varchar(255) | NOT NULL | Feature title |
| description | text | NOT NULL | Feature description |
| icon | varchar(255) | NULL | Icon identifier |
| order | int(11) | DEFAULT 0 | Display order |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Key:** `service_id` → `services(id)` ON DELETE CASCADE

---

### 5. `service_process_steps`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| service_id | bigint(20) UNSIGNED | FOREIGN KEY | References `services.id` |
| title | varchar(255) | NOT NULL | Step title |
| description | text | NOT NULL | Step description |
| icon | varchar(255) | NULL | Icon identifier |
| duration | varchar(255) | NULL | Step duration |
| order | int(11) | DEFAULT 0 | Display order |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Key:** `service_id` → `services(id)` ON DELETE CASCADE

---

### 6. `service_faqs`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| service_id | bigint(20) UNSIGNED | FOREIGN KEY | References `services.id` |
| question | varchar(255) | NOT NULL | FAQ question |
| answer | text | NOT NULL | FAQ answer |
| order | int(11) | DEFAULT 0 | Display order |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Key:** `service_id` → `services(id)` ON DELETE CASCADE

---

### 7. `service_technologies`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| service_id | bigint(20) UNSIGNED | FOREIGN KEY | References `services.id` |
| name | varchar(255) | NOT NULL | Technology name |
| icon | varchar(255) | NULL | Icon identifier |
| category | varchar(255) | NULL | Technology category |
| url | varchar(255) | NULL | Documentation URL |
| order | int(11) | DEFAULT 0 | Display order |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Key:** `service_id` → `services(id)` ON DELETE CASCADE

---

### 8. `service_pricing_models`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| service_id | bigint(20) UNSIGNED | FOREIGN KEY | References `services.id` |
| name | varchar(255) | NOT NULL | Pricing model name |
| description | text | NOT NULL | Model description |
| starting_price | decimal(10,2) | NULL | Starting price |
| notes | text | NULL | Additional notes |
| order | int(11) | DEFAULT 0 | Display order |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Key:** `service_id` → `services(id)` ON DELETE CASCADE

---

## 🎨 CONTENT TABLES

### 9. `projects`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| user_id | bigint(20) UNSIGNED | FOREIGN KEY | References `users.id` |
| title | varchar(255) | NOT NULL | Project title |
| slug | varchar(255) | UNIQUE, NOT NULL | URL slug |
| description | text | NOT NULL | Short description |
| featured_image | varchar(255) | NULL | Path to featured image |
| images | json | NULL | Additional images |
| overview | text | NOT NULL | Project overview |
| challenge | text | NOT NULL | Challenge description |
| solution | text | NOT NULL | Solution description |
| results | text | NOT NULL | Results and outcomes |
| technologies | json | NOT NULL | Technologies used |
| live_url | varchar(255) | NULL | Live demo URL |
| github_url | varchar(255) | NULL | GitHub repository URL |
| case_study_url | varchar(255) | NULL | Case study URL |
| start_date | date | NOT NULL | Project start date |
| end_date | date | NULL | Project end date |
| status | enum('planning','in_progress','completed') | DEFAULT 'planning' | Project status |
| is_featured | tinyint(1) | DEFAULT 0 | Featured status |
| is_published | tinyint(1) | DEFAULT 0 | Published status |
| published_at | timestamp | NULL | Publication timestamp |
| order | int(11) | DEFAULT 0 | Display order |
| meta_title | varchar(255) | NULL | SEO meta title |
| meta_description | varchar(255) | NULL | SEO meta description |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Key:** `user_id` → `users(id)` ON DELETE CASCADE  
**Indexes:** `slug`, `status`, `is_featured`

---

### 10. `articles`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| user_id | bigint(20) UNSIGNED | FOREIGN KEY | References `users.id` |
| category_id | bigint(20) UNSIGNED | NULL, FOREIGN KEY | References `categories.id` |
| title | varchar(255) | NOT NULL | Article title |
| slug | varchar(255) | UNIQUE, NOT NULL | URL slug |
| excerpt | varchar(255) | NOT NULL | Short excerpt |
| content | text | NOT NULL | Article content |
| featured_image | varchar(255) | NULL | Path to featured image |
| reading_time | int(11) | NULL | Reading time in minutes |
| is_published | tinyint(1) | DEFAULT 0 | Published status |
| published_at | timestamp | NULL | Publication timestamp |
| meta_title | varchar(255) | NULL | SEO meta title |
| meta_description | varchar(255) | NULL | SEO meta description |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Keys:**  
- `user_id` → `users(id)` ON DELETE CASCADE  
- `category_id` → `categories(id)` ON DELETE SET NULL  
**Indexes:** `slug`, `is_published`

---

### 11. `categories`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| name | varchar(255) | NOT NULL | Category name |
| slug | varchar(255) | UNIQUE, NOT NULL | URL slug |
| description | text | NULL | Category description |
| color | varchar(255) | NULL | Display color |
| icon | varchar(255) | NULL | Icon identifier |
| order | int(11) | DEFAULT 0 | Display order |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

---

### 12. `tags`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| name | varchar(255) | UNIQUE, NOT NULL | Tag name |
| slug | varchar(255) | UNIQUE, NOT NULL | URL slug |
| description | text | NULL | Tag description |
| color | varchar(255) | NULL | Display color |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

---

### 13. `testimonials`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| client_name | varchar(255) | NOT NULL | Client name |
| client_role | varchar(255) | NULL | Client role/title |
| client_company | varchar(255) | NULL | Client company |
| client_avatar | varchar(255) | NULL | Avatar image path |
| content | text | NOT NULL | Testimonial content |
| rating | int(11) | DEFAULT 5 | Rating (1-5 stars) |
| project_name | varchar(255) | NULL | Related project name |
| project_link | varchar(255) | NULL | Project URL |
| is_featured | tinyint(1) | DEFAULT 0 | Featured status |
| is_published | tinyint(1) | DEFAULT 1 | Published status |
| order | int(11) | DEFAULT 0 | Display order |
| video_url | varchar(255) | NULL | Video testimonial URL |
| social_links | json | NULL | Social media links |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |
| deleted_at | timestamp | NULL | Soft delete timestamp |

**Indexes:** `is_featured`, `is_published`, `order`

---

## 📅 SCHEDULING TABLES

### 14. `schedules`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| title | varchar(255) | NOT NULL | Event title |
| slug | varchar(255) | UNIQUE, NOT NULL | URL slug |
| description | text | NULL | Event description |
| type | enum('appointment','blocked','availability') | DEFAULT 'appointment' | Event type |
| status | enum('scheduled','confirmed','completed','cancelled') | DEFAULT 'scheduled' | Event status |
| start_time | datetime | NOT NULL | Start date/time |
| end_time | datetime | NOT NULL | End date/time |
| is_all_day | tinyint(1) | DEFAULT 0 | All day event |
| is_recurring | tinyint(1) | DEFAULT 0 | Recurring event |
| recurrence_pattern | enum('none','daily','weekly','biweekly','monthly','yearly') | DEFAULT 'none' | Recurrence pattern |
| recurrence_days | json | NULL | Days of week for recurrence |
| recurrence_until | date | NULL | Recurrence end date |
| customer_name | varchar(255) | NULL | Customer name |
| customer_email | varchar(255) | NULL | Customer email |
| customer_phone | varchar(255) | NULL | Customer phone |
| customer_notes | text | NULL | Customer notes |
| metadata | json | NULL | Additional metadata |
| color | varchar(255) | NULL | Event color |
| location | varchar(255) | NULL | Event location |
| user_id | bigint(20) UNSIGNED | NULL, FOREIGN KEY | References `users.id` |
| service_id | bigint(20) UNSIGNED | NULL, FOREIGN KEY | References `services.id` |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |
| deleted_at | timestamp | NULL | Soft delete timestamp |

**Foreign Keys:**  
- `user_id` → `users(id)` ON DELETE SET NULL  
- `service_id` → `services(id)` ON DELETE SET NULL  
**Indexes:** `slug`, `start_time`, `end_time`, `status`, `type`

---

## 🔧 TOOLS TABLES

### 15. `tools`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| user_id | bigint(20) UNSIGNED | FOREIGN KEY | References `users.id` |
| name | varchar(255) | NOT NULL | Tool name |
| slug | varchar(255) | UNIQUE, NOT NULL | URL slug |
| description | text | NOT NULL | Tool description |
| featured_image | varchar(255) | NULL | Path to featured image |
| icon | varchar(255) | NULL | Icon identifier |
| url | varchar(255) | NULL | Tool URL |
| category | varchar(255) | NOT NULL | Tool category |
| documentation_url | varchar(255) | NULL | Documentation URL |
| is_active | tinyint(1) | DEFAULT 1 | Active status |
| is_featured | tinyint(1) | DEFAULT 0 | Featured status |
| usage_count | int(11) | DEFAULT 0 | Usage counter |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Key:** `user_id` → `users(id)` ON DELETE CASCADE  
**Indexes:** `slug`, `category`, `is_active`

---

### 16. `tool_usages`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| tool_id | bigint(20) UNSIGNED | FOREIGN KEY | References `tools.id` |
| visitor_id | bigint(20) UNSIGNED | FOREIGN KEY | References `visitors.id` |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Keys:**  
- `tool_id` → `tools(id)` ON DELETE CASCADE  
- `visitor_id` → `visitors(id)` ON DELETE CASCADE

---

## 📞 CONTACT TABLES

### 17. `contacts`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| visitor_id | bigint(20) UNSIGNED | NULL, FOREIGN KEY | References `visitors.id` |
| name | varchar(255) | NOT NULL | Contact name |
| email | varchar(255) | NOT NULL | Contact email |
| phone | varchar(255) | NULL | Phone number |
| subject | varchar(255) | NOT NULL | Message subject |
| message | text | NOT NULL | Message content |
| budget | varchar(255) | NULL | Budget range |
| timeline | varchar(255) | NULL | Project timeline |
| status | enum('new','read','replied','closed','spam') | DEFAULT 'new' | Contact status |
| ip_address | varchar(45) | NULL | IP address |
| user_agent | text | NULL | Browser user agent |
| source_page | varchar(255) | NULL | Source page URL |
| notes | text | NULL | Admin notes |
| replied_at | timestamp | NULL | Reply timestamp |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Key:** `visitor_id` → `visitors(id)` ON DELETE SET NULL  
**Indexes:** `status`, `email`

---

## 📊 ANALYTICS TABLES

### 18. `page_views`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| visitor_id | bigint(20) UNSIGNED | FOREIGN KEY | References `visitors.id` |
| user_id | bigint(20) UNSIGNED | NULL, FOREIGN KEY | References `users.id` |
| page_url | varchar(255) | NOT NULL | Page URL |
| page_title | varchar(255) | NOT NULL | Page title |
| page_type | varchar(255) | NOT NULL | Content type |
| page_id | varchar(255) | NULL | Content ID |
| time_spent | int(11) | NULL | Time spent (seconds) |
| scroll_depth | int(11) | NULL | Scroll depth percentage |
| ip_address | varchar(45) | NULL | IP address |
| referer | varchar(255) | NULL | Referrer URL |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Keys:**  
- `visitor_id` → `visitors(id)` ON DELETE CASCADE  
- `user_id` → `users(id)` ON DELETE SET NULL  
**Indexes:** `page_url`, `created_at`

---

## 🔐 AUTHENTICATION & SECURITY TABLES

### 19. `personal_access_tokens` (Sanctum)
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| tokenable_id | bigint(20) UNSIGNED | NOT NULL | Polymorphic relation ID |
| tokenable_type | varchar(255) | NOT NULL | Polymorphic relation type |
| name | varchar(255) | NOT NULL | Token name |
| token | varchar(64) | UNIQUE, NOT NULL | Token hash |
| abilities | text | NULL | Token permissions |
| last_used_at | timestamp | NULL | Last usage timestamp |
| expires_at | timestamp | NULL | Expiration timestamp |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Indexes:** `tokenable_id`, `tokenable_type`

---

### 20. `permissions` (Spatie)
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| name | varchar(255) | NOT NULL | Permission name |
| guard_name | varchar(255) | NOT NULL | Guard name |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Unique Key:** `name`, `guard_name`

---

### 21. `roles` (Spatie)
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| name | varchar(255) | NOT NULL | Role name |
| guard_name | varchar(255) | NOT NULL | Guard name |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Unique Key:** `name`, `guard_name`

---

### 22. `role_has_permissions` (Spatie)
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| permission_id | bigint(20) UNSIGNED | PRIMARY KEY, FOREIGN KEY | References `permissions.id` |
| role_id | bigint(20) UNSIGNED | PRIMARY KEY, FOREIGN KEY | References `roles.id` |

**Foreign Keys:**  
- `permission_id` → `permissions(id)` ON DELETE CASCADE  
- `role_id` → `roles(id)` ON DELETE CASCADE

---

## 🔗 PIVOT TABLES

### 23. `taggables` (Polymorphic Pivot)
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| tag_id | bigint(20) UNSIGNED | FOREIGN KEY | References `tags.id` |
| taggable_id | bigint(20) UNSIGNED | NOT NULL | Polymorphic relation ID |
| taggable_type | varchar(255) | NOT NULL | Polymorphic relation type |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Key:** `tag_id` → `tags(id)` ON DELETE CASCADE  
**Indexes:** `taggable_id`, `taggable_type`

---

### 24. `service_project` (Many-to-Many)
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| service_id | bigint(20) UNSIGNED | FOREIGN KEY | References `services.id` |
| project_id | bigint(20) UNSIGNED | FOREIGN KEY | References `projects.id` |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Foreign Keys:**  
- `service_id` → `services(id)` ON DELETE CASCADE  
- `project_id` → `projects(id)` ON DELETE CASCADE

---

## 🧰 MEDIA & ACTIVITY TABLES

### 25. `media` (Spatie Media Library)
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| model_id | bigint(20) UNSIGNED | NOT NULL | Polymorphic relation ID |
| model_type | varchar(255) | NOT NULL | Polymorphic relation type |
| uuid | char(36) | UNIQUE, NULL | UUID |
| collection_name | varchar(255) | NOT NULL | Media collection name |
| name | varchar(255) | NOT NULL | Media name |
| file_name | varchar(255) | NOT NULL | File name |
| mime_type | varchar(255) | NULL | MIME type |
| path | varchar(255) | NOT NULL | File path |
| disk | varchar(255) | NOT NULL | Storage disk |
| file_hash | varchar(64) | NULL | File hash |
| collection | varchar(255) | NULL | Collection name |
| size | bigint(20) UNSIGNED | NOT NULL | File size |
| manipulations | json | NOT NULL | Image manipulations |
| custom_properties | json | NOT NULL | Custom properties |
| generated_conversions | json | NOT NULL | Generated conversions |
| responsive_images | json | NOT NULL | Responsive images |
| order_column | int(10) UNSIGNED | NULL | Display order |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Indexes:** `model_id`, `model_type`

---

### 26. `activity_log` (Spatie Activity Log)
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| log_name | varchar(255) | NULL | Log name |
| description | text | NOT NULL | Activity description |
| subject_id | bigint(20) UNSIGNED | NULL | Subject ID |
| subject_type | varchar(255) | NULL | Subject type |
| causer_id | bigint(20) UNSIGNED | NULL | Causer ID |
| causer_type | varchar(255) | NULL | Causer type |
| properties | json | NULL | Activity properties |
| batch_uuid | char(36) | NULL | Batch UUID |
| event | varchar(255) | NULL | Event name |
| created_at | timestamp | NULL | |
| updated_at | timestamp | NULL | |

**Indexes:** `log_name`, `subject_id`, `subject_type`, `causer_id`, `causer_type`

---

## ⚙️ SYSTEM TABLES

### 27. `password_resets`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| email | varchar(255) | INDEX | User email |
| token | varchar(255) | NOT NULL | Reset token |
| created_at | timestamp | NULL | |

---

### 28. `failed_jobs`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| connection | text | NOT NULL | Queue connection |
| queue | text | NOT NULL | Queue name |
| payload | longtext | NOT NULL | Job payload |
| exception | longtext | NOT NULL | Exception details |
| failed_at | timestamp | NOT NULL | Failure timestamp |

---

### 29. `jobs`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint(20) UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | |
| queue | varchar(255) | INDEX, NOT NULL | Queue name |
| payload | longtext | NOT NULL | Job payload |
| attempts | tinyint(3) UNSIGNED | NOT NULL | Attempt count |
| reserved_at | int(10) UNSIGNED | NULL | Reservation timestamp |
| available_at | int(10) UNSIGNED | NOT NULL | Available timestamp |
| created_at | int(10) UNSIGNED | NOT NULL | |

---

### 30. `cache`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| key | varchar(255) | PRIMARY KEY | Cache key |
| value | text | NOT NULL | Cached value |
| expiration | int(11) | NULL | Expiration timestamp |

---

### 31. `sessions`
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | varchar(255) | PRIMARY KEY | Session ID |
| user_id | bigint(20) UNSIGNED | NULL, INDEX | User ID |
| ip_address | varchar(45) | NULL | IP address |
| user_agent | text | NULL | User agent |
| payload | longtext | NOT NULL | Session data |
| last_activity | int(11) | INDEX | Last activity timestamp |

**Foreign Key:** `user_id` → `users(id)` (implicit)

---

## 🔄 TABLE RELATIONSHIPS DIAGRAM

```
┌───────────┐       ┌──────────────┐       ┌──────────────┐
│   users   │───────│   projects   │───────│    tags      │
└───────────┘       └──────────────┘       └──────────────┘
       │                    │                       │
       │                    │                       │
       ▼                    ▼                       ▼
┌───────────┐       ┌──────────────┐       ┌──────────────┐
│  articles │       │  services    │───────│  taggables   │
└───────────┘       └──────────────┘       └──────────────┘
       │                    │                       ▲
       │                    │                       │
       ▼                    ▼                       │
┌───────────┐       ┌──────────────┐                │
│ categories│       │service_*     │────────────────┘
└───────────┘       └──────────────┘
                           │
                           │
┌───────────┐       ┌──────▼───────┐       ┌──────────────┐
│ visitors  │───────│  contacts    │       │  tools       │
└───────────┘       └──────────────┘       └──────────────┘
       │                                           │
       │                                           │
       ▼                                           ▼
┌───────────┐       ┌──────────────┐       ┌──────────────┐
│page_views │       │ tool_usages   │───────│    tools     │
└───────────┘       └──────────────┘       └──────────────┘

┌───────────┐       ┌──────────────┐
│schedules  │───────│  services    │
└───────────┘       └──────────────┘
```

---

## 📝 RELATIONSHIP SUMMARY

### One-to-Many Relationships
- `users` → `projects` (one user has many projects)
- `users` → `articles` (one user has many articles)
- `users` → `tools` (one user has many tools)
- `services` → `service_features` (one service has many features)
- `services` → `service_process_steps` (one service has many steps)
- `services` → `service_faqs` (one service has many FAQs)
- `services` → `service_technologies` (one service has many technologies)
- `services` → `service_pricing_models` (one service has many pricing models)
- `categories` → `articles` (one category has many articles)
- `visitors` → `contacts` (one visitor has many contacts)
- `visitors` → `page_views` (one visitor has many page views)
- `visitors` → `tool_usages` (one visitor has many tool usages)
- `tools` → `tool_usages` (one tool has many usages)

### Many-to-Many Relationships
- `services` ↔ `projects` (via `service_project` table)
- `taggable` polymorphic: `tags` ↔ `projects`, `articles`, `services` (via `taggables` table)

### Polymorphic Relationships
- `taggables` - connects tags to multiple content types
- `media` - connects files to multiple models
- `activity_log` - connects activities to multiple models

---

**Total Tables: 31**  
**Last Updated:** March 11, 2026