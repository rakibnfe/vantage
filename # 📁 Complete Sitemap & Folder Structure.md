# 📁 Complete Sitemap & Folder Structure (Updated with Dynamic Services)

## 📄 Filename
`complete-sitemap-and-folder-structure.md`

---

# 🗺️ Complete Sitemap & Folder Structure

## 📑 TABLE OF CONTENTS
1. [Public Pages Structure](#public-pages-structure)
2. [Admin Pages Structure](#admin-pages-structure)
3. [Laravel Folder Structure](#laravel-folder-structure)
4. [Frontend (Vue) Folder Structure](#frontend-vue-folder-structure)
5. [Backend (Blade) Folder Structure](#backend-blade-folder-structure)

---

## 🏠 PUBLIC PAGES STRUCTURE (Vue)

### 1. HOMEPAGE (`/`)

```
🏠 Homepage
├── ⚡ Hero Section
│   ├── Animated introduction
│   ├── Value proposition
│   └── Primary CTA buttons
│
├── ✨ Featured Work
│   ├── 3-4 highlighted projects
│   ├── Quick stats/preview
│   └── "View all work" link
│
├── 🛠️ Services Overview (Dynamic)
│   ├── 3-4 core services (fetched from DB)
│   ├── Brief description each
│   └── "See all services" link
│
├── 📝 Recent Writings
│   ├── 3-4 latest articles
│   ├── Reading time
│   ├── Publication date
│   └── "Read all notes" link
│
├── 🔧 Featured Tools
│   ├── 2-3 popular tools
│   ├── Quick access
│   └── "Explore tools" link
│
└── 🤝 Let's Connect
    ├── Contact invitation
    ├── Calendar link
    └── Social/professional links
```

---

### 2. WORK SECTION

#### `/work` (Main Listing)

```
📁 Work Listing Page
├── 🔍 Filter Bar
│   ├── Technology filter
│   ├── Project type filter
│   └── Clear filters button
│
├── 📊 Project Grid
│   ├── Project thumbnail
│   ├── Project title
│   ├── Brief description
│   ├── Technologies used
│   └── View project link
│
└── 📄 Pagination
    ├── Page numbers
    └── Load more button
```

#### `/work/{project-slug}` (Individual Project)

```
📄 Individual Project Page
├── 🖼️ Hero Section
│   ├── Project image
│   ├── Project title
│   └── Quick stats
│
├── 📋 Overview
│   ├── Problem statement
│   ├── My role
│   └── Timeline
│
├── 🔧 Technical Deep Dive
│   ├── Architecture decisions
│   ├── Technologies used
│   └── Challenges solved
│
├── 📊 Results
│   ├── Before/after metrics
│   ├── Performance improvements
│   └── Business impact
│
├── 🔗 Links
│   ├── Live demo button
│   ├── GitHub link
│   └── Case study PDF download
│
├── 🎯 Related Services (Dynamic)
│   └── Services used in this project
│
└── 🎯 CTA Section
    └── "Need something similar?" button
```

---

### 3. SERVICES SECTION (FULLY DYNAMIC)

#### `/services` (Main Listing - Dynamic)

```
📋 Services Listing Page
├── 📌 Page Header
│   ├── Title (from DB)
│   └── Description (from DB)
│
├── 🎯 Service Cards (Dynamic from DB)
│   ├── For each service in database:
│   │   ├── Icon
│   │   ├── Title
│   │   ├── Short description
│   │   ├── Features list (short)
│   │   └── "Learn more" link
│   └── Ordered by user-defined sort order
│
└── 📞 Consultation CTA
    └── "Let's discuss your project" button
```

#### `/services/{service-slug}` (Individual Service Page - Dynamic)

```
📄 Individual Service Page
├── 🖼️ Hero Section
│   ├── Service icon
│   ├── Service title (from DB)
│   ├── Tagline (from DB)
│   └── Primary CTA
│
├── 📝 Overview (Dynamic)
│   ├── Full description (from DB)
│   └── Key differentiators
│
├── ✨ Key Features (Dynamic)
│   ├── Feature list with descriptions (from DB)
│   └── Visual indicators
│
├── ⚙️ Process (Dynamic)
│   ├── Step-by-step process (from DB)
│   └── Timeline expectations
│
├── 🛠️ Technologies (Dynamic)
│   ├── Tech stack used (from DB)
│   └── Icons/tags
│
├── 📁 Related Projects (Dynamic)
│   ├── Projects that used this service
│   └── Case study links
│
├── 💼 Case Studies (Dynamic)
│   └── Success stories (from DB)
│
├── 💰 Pricing Approach (Dynamic)
│   ├── Pricing models (from DB)
│   └── Ballpark ranges
│
├── ❓ FAQ Section (Dynamic)
│   ├── Frequently asked questions (from DB)
│   └── Expandable answers
│
├── 📞 Service-specific CTA
│   └── "Book {service name} consultation" button
│
└── 🔗 Related Services (Dynamic)
    └── Other services you might need
```

#### Service Data Structure (Stored in DB):

```php
services table:
- id
- title
- slug
- tagline
- icon
- featured_image
- overview (long text)
- process (JSON or structured text)
- features (JSON array)
- technologies (JSON array)
- pricing_models (JSON array)
- faqs (JSON array)
- meta_title
- meta_description
- order
- is_published
- published_at
- created_at
- updated_at
```

---

### 4. NOTES & WRITINGS SECTION

#### `/notes` (Main Listing)

```
📚 Notes Listing Page
├── 🔍 Search & Filter
│   ├── Search bar
│   ├── Topic filters
│   └── Tag cloud
│
├── ⭐ Featured Article
│   ├── Title
│   ├── Excerpt
│   └── Read more
│
├── 📋 Article Grid
│   ├── Article cards with:
│   │   ├── Title
│   │   ├── Excerpt
│   │   ├── Reading time
│   │   ├── Publication date
│   │   └── Tags
│   └── Pagination
│
└── 📧 Newsletter Signup
    └── Email subscription
```

#### `/notes/{article-slug}` (Individual Article)

```
📄 Individual Article Page
├── 📌 Article Header
│   ├── Title
│   ├── Publication date
│   ├── Reading time
│   └── Tags
│
├── 📑 Table of Contents
│   └── Section links (for long articles)
│
├── 📝 Article Content
│   ├── Headings
│   ├── Paragraphs
│   ├── Code snippets
│   ├── Images/diagrams
│   └── Blockquotes
│
├── 👤 Author Bio
│   ├── Brief intro
│   └── Social links
│
├── 🔗 Related Articles
│   └── 3-4 article suggestions
│
├── 💬 Discussion
│   └── Comments link
│
└── 📧 Subscribe Section
    └── "Get updates" form
```

#### `/notes/topics/{topic}` (Topic Page)

```
📑 Topic Page
├── 📌 Topic Header
│   ├── Topic name
│   └── Description
│
├── 📋 Articles in Topic
│   └── List of articles
│
└── 🔗 Related Topics
    └── Topic suggestions
```

---

### 5. TOOLS SECTION

#### `/tools` (Main Listing)

```
🔧 Tools Listing Page
├── 📋 Tool Categories
│   ├── Developer tools
│   └── Text utilities
│
├── 🔧 Tool Grid
│   ├── Tool cards with:
│   │   ├── Tool name
│   │   ├── Brief description
│   │   └── Popularity indicator
│   └── Use tool button
│
└── 🎯 Recently Used
    └── Quick access (session-based)
```

#### `/tools/json-formatter`

```
🔧 JSON Formatter Tool
├── 📝 Input Area
│   ├── Paste JSON
│   ├── Upload file
│   └── Sample data button
│
├── ⚡ Format Button
│   └── Process input
│
├── 📤 Output Area
│   ├── Formatted JSON
│   ├── Copy button
│   ├── Download button
│   ├── Minify option
│   └── Validate option
│
└── ❌ Error Display
    └── Validation messages
```

#### `/tools/api-response-viewer`

```
🔧 API Response Viewer
├── 📝 Input Area
│   └── Paste API response
│
├── 🌳 Tree View
│   ├── Expand/collapse all
│   ├── Search in response
│   └── Copy path
│
└── 📋 Raw View
    └── Toggle between views
```

#### `/tools/slug-generator`

```
🔧 Slug Generator
├── 📝 Input Field
│   └── Enter text
│
├── ⚙️ Options
│   ├── Lowercase toggle
│   ├── Separator selector
│   └── Max length
│
├── 👁️ Live Preview
│   └── Generated slug
│
└── 📋 Copy Button
    └── Copy to clipboard
```

#### `/tools/markdown-preview`

```
🔧 Markdown Preview
├── 📝 Editor Pane
│   ├── Markdown input
│   └── Syntax highlighting
│
├── 👁️ Preview Pane
│   └── Live rendered HTML
│
├── 📋 Copy Options
│   ├── Copy HTML
│   └── Download markdown
│
└── 📚 Examples
    └── Sample markdown button
```

#### `/tools/text-utilities`

```
🔧 Text Utilities
├── 🔢 Character Counter
│   └── Live count
│
├── 📊 Word Counter
│   └── Live count
│
├── 🔠 Case Converter
│   ├── UPPERCASE
│   ├── lowercase
│   ├── Title Case
│   └── Sentence case
│
└── ✂️ Remove Extra Spaces
    └── Clean button
```

---

### 6. CONTACT SECTION

#### `/contact` (Main Contact Page)

```
📞 Contact Page
├── 📝 Contact Form
│   ├── Name field
│   ├── Email field
│   ├── Subject field
│   ├── Message textarea
│   ├── Budget range (optional)
│   ├── Timeline (optional)
│   └── Send button
│
├── 📅 Calendar Integration
│   └── Booking widget (optional)
│
├── ⏱️ Response Time
│   └── Expectation message
│
└── 📧 Direct Email
    └── Email address fallback
```

#### `/contact/thank-you`

```
✅ Thank You Page
├── 🙏 Thank You Message
│
├── 📋 Next Steps
│   ├── What happens now
│   └── Timeline expectation
│
└── 🔗 Browse Work Link
    └── "Check out my work while you wait"
```

---

### 7. BOOKING SECTION (Optional)

#### `/schedule`

```
📅 Booking Page
├── 🌍 Timezone Selector
│   └── Auto-detect or manual
│
├── 📋 Meeting Type
│   ├── Discovery call
│   ├── Project consultation
│   └── Technical discussion
│
├── 📆 Calendar View
│   ├── Available dates
│   └── Time slots
│
├── 📝 Confirmation Form
│   ├── Name
│   ├── Email
│   └── Notes
│
└── ✅ Booking Confirmation
    └── Success message
```

---

### 8. BLOG SECTION

#### `/blog` (Main Listing)

```
📰 Blog Listing Page
├── ⭐ Featured Post
│   ├── Title
│   ├── Excerpt
│   └── Read more
│
├── 📋 Categories Sidebar
│   └── Category list with counts
│
├── 📄 Post Grid
│   ├── Post cards with:
│   │   ├── Title
│   │   ├── Excerpt
│   │   ├── Date
│   │   ├── Category
│   │   └── Read more
│   └── Pagination
│
├── 🔍 Search Bar
│   └── Search posts
│
└── 📧 Newsletter
    └── Subscribe form
```

#### `/blog/{post-slug}`

```
📄 Individual Blog Post
├── 📌 Post Header
│   ├── Title
│   ├── Publication date
│   ├── Category
│   └── Reading time
│
├── 📝 Post Content
│   ├── Full article
│   └── Images
│
├── 👤 Author Info
│   └── Author bio
│
├── 💬 Comments Section
│   ├── Comment form
│   └── Comment list
│
├── 🔗 Share Buttons
│   ├── Twitter
│   ├── LinkedIn
│   └── Copy link
│
├── 📖 Related Posts
│   └── 3 related articles
│
└── 📧 Subscribe
    └── Newsletter signup
```

#### `/blog/categories/{category}`

```
📑 Category Page
├── 📌 Category Header
│   ├── Category name
│   └── Description
│
├── 📋 Posts in Category
│   └── List of posts
│
└── 🔗 Other Categories
    └── Category suggestions
```

---

### 9. OTHER PAGES

#### `/about`

```
👤 About Page
├── 📝 Who I Am
│   ├── Introduction
│   └── Photo
│
├── 🛤️ My Journey
│   ├── Career timeline
│   └── Key experiences
│
├── 💭 Philosophy
│   ├── Work principles
│   └── Values
│
├── 🛠️ Tools I Use
│   ├── Hardware
│   ├── Software
│   └── Daily drivers
│
├── 📚 Currently
│   ├── Reading
│   └── Learning
│
└── 🎯 Personal Interests
    └── Brief hobbies section
```

#### `/now`

```
⏰ Now Page
├── 🚀 Current Projects
│   └── What I'm building
│
├── 📚 Learning
│   └── What I'm studying
│
├── 📖 Reading List
│   └── Current books
│
└── 🔄 Recent Updates
    └── What's changed
```

#### `/uses`

```
💻 Uses Page
├── 🖥️ Desk Setup
│   ├── Monitor
│   ├── Keyboard
│   ├── Mouse
│   └── Chair
│
├── 💿 Software
│   ├── Editor/IDE
│   ├── Terminal
│   ├── Browser
│   └── Productivity apps
│
├── 🔧 Dev Tools
│   ├── Laravel tools
│   ├── Debugging tools
│   └── Testing tools
│
└── ⚡ Productivity
    └── How I stay productive
```

#### `/privacy`

```
🔒 Privacy Policy
├── 📋 Data Collection
│   ├── What I collect
│   └── How it's used
│
├── 🍪 Cookie Policy
│   └── Cookie usage
│
├── 👤 Your Rights
│   ├── Access
│   ├── Deletion
│   └── Opt-out
│
└── 📞 Contact
    └── Privacy concerns
```

#### `/terms`

```
📜 Terms of Use
├── 📝 Terms
│   ├── Usage terms
│   ├── Copyright
│   └── Liability
│
└── 📞 Contact
    └── Legal inquiries
```

---

## 🔐 ADMIN PAGES STRUCTURE (Blade)

#### `/admin/login`

```
🔐 Admin Login
├── 📝 Login Form
│   ├── Email
│   ├── Password
│   └── Remember me
│
└── 🔑 Password Reset
    └── Forgot password link
```

#### `/admin/dashboard`

```
📊 Admin Dashboard
├── 📈 Quick Stats
│   ├── Total visitors
│   ├── Inquiries
│   ├── Projects
│   └── Articles
│
├── 📋 Recent Inquiries
│   └── Latest messages
│
├── 📝 Recent Content
│   ├── Updated projects
│   └── New articles
│
└── ⚡ Quick Actions
    ├── Add project
    ├── Write article
    └── View inquiries
```

#### `/admin/work`

```
📁 Manage Work
├── 📋 Projects List
│   ├── Table with:
│   │   ├── Title
│   │   ├── Status
│   │   ├── Featured
│   │   └── Actions
│   └── Search/filter
│
├── ➕ Add Project
│   └── Form with all fields
│
├── ✏️ Edit Project
│   └── Pre-filled form
│
└── 🗑️ Delete Project
    └── Confirmation modal
```

#### `/admin/services` (FULLY DYNAMIC CRUD)

```
🛠️ Manage Services (Dynamic)
├── 📋 Services List
│   ├── Table with:
│   │   ├── Title
│   │   ├── Slug
│   │   ├── Order
│   │   ├── Status (published/draft)
│   │   ├── Featured
│   │   └── Actions (Edit, Preview, Delete)
│   ├── Search/filter
│   └── Drag to reorder
│
├── ➕ Add New Service
│   └── Form with:
│       ├── Title
│       ├── Slug (auto-generated)
│       ├── Tagline
│       ├── Icon selector
│       ├── Featured image upload
│       ├── Overview (rich text editor)
│       ├── Key Features (repeater field)
│       │   ├── Feature title
│       │   └── Feature description
│       ├── Process Steps (repeater field)
│       │   ├── Step title
│       │   └── Step description
│       ├── Technologies (tag input)
│       ├── Pricing Models (repeater field)
│       │   ├── Model name
│       │   └── Description
│       ├── FAQs (repeater field)
│       │   ├── Question
│       │   └── Answer
│       ├── Related Projects (multi-select)
│       ├── Meta Title (SEO)
│       ├── Meta Description (SEO)
│       ├── Order position
│       └── Publish status
│
├── ✏️ Edit Service
│   └── Pre-filled form with same fields
│
├── 👁️ Preview Service
│   └── Live preview of service page
│
├── 📋 Bulk Actions
│   ├── Publish selected
│   ├── Draft selected
│   └── Delete selected
│
└── 🔄 Reorder Services
    └── Drag and drop interface
```

#### `/admin/notes`

```
📝 Manage Notes
├── 📋 Articles List
│   ├── Title
│   ├── Status
│   ├── Published date
│   └── Actions
│
├── ✍️ Write/Edit Article
│   ├── Title field
│   ├── Content editor
│   ├── Tags
│   ├── Featured image
│   ├── SEO fields
│   └── Publish settings
│
├── 📁 Tags Manager
│   ├── List tags
│   ├── Merge tags
│   └── Delete tags
│
└── 📅 Schedule
    └── Future publishing
```

#### `/admin/blog`

```
📰 Manage Blog
├── 📋 Posts List
│   ├── Title
│   ├── Category
│   ├── Status
│   └── Actions
│
├── ✍️ Write/Edit Post
│   ├── Title
│   ├── Content editor
│   ├── Category
│   ├── Tags
│   ├── Featured image
│   ├── SEO fields
│   └── Publish settings
│
├── 📁 Categories Manager
│   ├── Add category
│   ├── Edit category
│   └── Delete category
│
└── 💬 Comments Manager
    ├── Approve/reject
    ├── Edit
    └── Delete
```

#### `/admin/tools`

```
🔧 Manage Tools
├── 📋 Tools List
│   ├── Tool names
│   ├── Enabled/disabled
│   └── Edit actions
│
├── ⚙️ Configure Tool
│   ├── Settings
│   └── Options
│
└── 📊 Usage Stats
    └── Tool popularity
```

#### `/admin/inquiries`

```
📞 Manage Inquiries
├── 📋 Inbox
│   ├── List of messages
│   ├── Read/unread status
│   └── Sender info
│
├── 📄 Message Detail
│   ├── Full message
│   ├── Context (page viewed)
│   ├── Reply form
│   └── Add notes
│
├── 🏷️ Status Tags
│   ├── New
│   ├── Replied
│   └── Closed
│
└── 📊 Reports
    └── Inquiry trends
```

#### `/admin/insights`

```
📊 Insights Dashboard
├── 📈 Traffic Overview
│   ├── Visitors chart
│   ├── Page views
│   └── Time on site
│
├── 📋 Popular Content
│   ├── Top projects
│   ├── Top articles
│   ├── Top services
│   └── Top tools
│
├── 🔗 Referral Sources
│   └── Where visitors come from
│
├── 📱 Device Breakdown
│   ├── Desktop vs mobile
│   ├── Browsers
│   └── OS
│
├── 🔧 Tool Usage Stats
│   └── Most used tools
│
└── 📊 Conversion
    └── Contact form views vs submissions
```

#### `/admin/media`

```
🖼️ Media Library
├── 📁 Folders
│   ├── Create folder
│   ├── Rename
│   └── Delete
│
├── 📋 Files Grid
│   ├── Thumbnails
│   ├── File names
│   ├── Size
│   └── Actions
│
├── 📤 Upload
│   ├── Drag & drop
│   ├── Multiple files
│   └── Progress bar
│
├── ✂️ Edit Image
│   ├── Crop
│   ├── Resize
│   └── Optimize
│
└── 🔗 Usage Tracking
    └── Where file is used
```

#### `/admin/settings`

```
⚙️ Settings
├── 🌐 Site Settings
│   ├── Site name
│   ├── Description
│   ├── Logo
│   └── Favicon
│
├── 🔍 SEO Defaults
│   ├── Meta title format
│   ├── Meta description
│   └── Social media images
│
├── 📧 Email
│   ├── SMTP settings
│   ├── Templates
│   └── Test email
│
├── 👥 User Management
│   ├── List users
│   ├── Add user
│   ├── Edit permissions
│   └── Delete user
│
├── 📋 Activity Logs
│   └── User actions
│
└── 🍪 Cookie Consent
    └── Settings
```

---

## 📁 LARAVEL FOLDER STRUCTURE (With Dynamic Services)

```
project-root/
├── app/
│   ├── Actions/
│   │   ├── Project/
│   │   │   ├── CreateProject.php
│   │   │   ├── UpdateProject.php
│   │   │   └── DeleteProject.php
│   │   ├── Service/
│   │   │   ├── CreateService.php
│   │   │   ├── UpdateService.php
│   │   │   ├── DeleteService.php
│   │   │   └── ReorderServices.php
│   │   ├── Article/
│   │   │   ├── CreateArticle.php
│   │   │   ├── UpdateArticle.php
│   │   │   └── PublishArticle.php
│   │   ├── Contact/
│   │   │   ├── SubmitContact.php
│   │   │   └── ReplyToContact.php
│   │   └── Tool/
│   │       ├── ProcessJsonFormatter.php
│   │       └── GenerateSlug.php
│   │
│   ├── Console/
│   │   ├── Commands/
│   │   │   └── GenerateSitemap.php
│   │   └── Kernel.php
│   │
│   ├── DTOs/
│   │   ├── ProjectData.php
│   │   ├── ServiceData.php
│   │   ├── ArticleData.php
│   │   ├── ContactData.php
│   │   └── VisitorData.php
│   │
│   ├── Enums/
│   │   ├── ProjectStatus.php
│   │   ├── ServiceStatus.php
│   │   ├── ArticleStatus.php
│   │   ├── ContactStatus.php
│   │   └── VisitorType.php
│   │
│   ├── Events/
│   │   ├── ContactSubmitted.php
│   │   ├── ArticleViewed.php
│   │   ├── ServiceViewed.php
│   │   └── ToolUsed.php
│   │
│   ├── Exceptions/
│   │   └── Handler.php
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Public/
│   │   │   │   ├── HomeController.php
│   │   │   │   ├── ProjectController.php
│   │   │   │   ├── ServiceController.php  
│   │   │   │   ├── ArticleController.php
│   │   │   │   ├── ToolController.php
│   │   │   │   ├── ContactController.php
│   │   │   │   └── BlogController.php
│   │   │   └── Admin/
│   │   │       ├── DashboardController.php
│   │   │       ├── ProjectController.php
│   │   │       ├── ServiceController.php  
│   │   │       ├── ArticleController.php
│   │   │       ├── ContactController.php
│   │   │       ├── MediaController.php
│   │   │       └── SettingsController.php
│   │   │
│   │   ├── Middleware/
│   │   │   ├── TrackVisitor.php
│   │   │   ├── AdminAuth.php
│   │   │   └── LocalizeDates.php
│   │   │
│   │   ├── Requests/
│   │   │   ├── Project/
│   │   │   │   ├── StoreProjectRequest.php
│   │   │   │   └── UpdateProjectRequest.php
│   │   │   ├── Service/
│   │   │   │   ├── StoreServiceRequest.php
│   │   │   │   └── UpdateServiceRequest.php
│   │   │   ├── Article/
│   │   │   │   ├── StoreArticleRequest.php
│   │   │   │   └── UpdateArticleRequest.php
│   │   │   └── Contact/
│   │   │       └── StoreContactRequest.php
│   │   │
│   │   └── Resources/
│   │       ├── ProjectResource.php
│   │       ├── ServiceResource.php
│   │       ├── ArticleResource.php
│   │       └── ContactResource.php
│   │
│   ├── Listeners/
│   │   ├── SendContactNotification.php
│   │   ├── LogArticleView.php
│   │   ├── LogServiceView.php
│   │   └── UpdateVisitorSession.php
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Project.php
│   │   ├── Service.php          
│   │   ├── Article.php
│   │   ├── Tool.php
│   │   ├── Contact.php
│   │   ├── Visitor.php
│   │   ├── PageView.php
│   │   ├── Tag.php
│   │   └── Category.php
│   │
│   ├── Policies/
│   │   ├── ProjectPolicy.php
│   │   ├── ServicePolicy.php
│   │   ├── ArticlePolicy.php
│   │   └── ContactPolicy.php
│   │
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   └── EventServiceProvider.php
│   │
│   ├── Rules/
│   │   ├── SlugRule.php
│   │   └── SecureUrlRule.php
│   │
│   ├── Services/
│   │   ├── Analytics/
│   │   │   ├── VisitorTracker.php
│   │   │   ├── EngagementCalculator.php
│   │   │   └── ReportGenerator.php
│   │   ├── Content/
│   │   │   ├── ArticleService.php
│   │   │   ├── ProjectService.php
│   │   │   └── ServiceService.php    (Service business logic)
│   │   ├── Tool/
│   │   │   ├── JsonFormatterService.php
│   │   │   └── SlugGeneratorService.php
│   │   ├── Contact/
│   │   │   └── ContactService.php
│   │   └── Media/
│   │       └── MediaService.php
│   │
│   └── Traits/
│       ├── HasSlug.php
│       ├── HasTags.php
│       └── HasMedia.php
│
├── bootstrap/
│   ├── app.php
│   └── cache/
│
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── filesystems.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── sanctum.php
│   ├── session.php
│   ├── settings.php
│   ├── activitylog.php
│   └── permission.php
│
├── database/
│   ├── factories/
│   │   ├── ProjectFactory.php
│   │   ├── ServiceFactory.php
│   │   ├── ArticleFactory.php
│   │   └── UserFactory.php
│   │
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2024_01_01_000001_create_projects_table.php
│   │   ├── 2024_01_01_000002_create_services_table.php  
│   │   ├── 2024_01_01_000003_create_articles_table.php
│   │   ├── 2024_01_01_000004_create_tools_table.php
│   │   ├── 2024_01_01_000005_create_contacts_table.php
│   │   ├── 2024_01_01_000006_create_visitors_table.php
│   │   ├── 2024_01_01_000007_create_page_views_table.php
│   │   ├── 2024_01_01_000008_create_tags_table.php
│   │   ├── 2024_01_01_000009_create_categories_table.php
│   │   └── 2024_01_01_000010_create_activity_log_table.php
│   │
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       ├── ProjectSeeder.php
│       └── ServiceSeeder.php  (Seed default services)
│
├── public/
│   ├── index.php
│   ├── .htaccess
│   ├── favicon.ico
│   ├── robots.txt
│   └── assets/
│       ├── css/
│       ├── js/
│       └── images/
│
├── resources/
│   ├── css/
│   │   └── app.css
│   │
│   ├── js/
│   │   ├── app.js
│   │   ├── bootstrap.js
│   │   └── [Vue structure continues below]
│   │
│   ├── views/
│   │   ├── admin/
│   │   │   ├── layouts/
│   │   │   │   ├── master.blade.php
│   │   │   │   ├── header.blade.php
│   │   │   │   ├── sidebar.blade.php
│   │   │   │   └── footer.blade.php
│   │   │   │
│   │   │   ├── dashboard/
│   │   │   │   └── index.blade.php
│   │   │   │
│   │   │   ├── projects/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   ├── edit.blade.php
│   │   │   │   └── show.blade.php
│   │   │   │
│   │   │   ├── services/           (Dynamic CRUD views)
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   ├── edit.blade.php
│   │   │   │   ├── show.blade.php
│   │   │   │   └── reorder.blade.php
│   │   │   │
│   │   │   ├── articles/
│   │   │   │   ├── index.blade.php
│   │   │   │   ├── create.blade.php
│   │   │   │   ├── edit.blade.php
│   │   │   │   └── show.blade.php
│   │   │   │
│   │   │   ├── contacts/
│   │   │   │   ├── index.blade.php
│   │   │   │   └── show.blade.php
│   │   │   │
│   │   │   ├── media/
│   │   │   │   └── index.blade.php
│   │   │   │
│   │   │   └── settings/
│   │   │       └── index.blade.php
│   │   │
│   │   └── emails/
│   │       ├── contact-notification.blade.php
│   │       └── contact-autoreply.blade.php
│   │
│   └── lang/
│       └── en/
│           ├── messages.php
│           └── validation.php
│
├── routes/
│   ├── web.php          (Public routes including services/{slug})
│   ├── admin.php         (Admin routes including service CRUD)
│   └── channels.php
│
├── storage/
│   ├── app/
│   │   └── public/
│   │       ├── media/
│   │       ├── projects/
│   │       ├── services/        (Service images)
│   │       └── case-studies/
│   ├── framework/
│   └── logs/
│
├── .env
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── vite.config.js
├── pint.json
└── phpstan.neon
```

---

## 🎨 FRONTEND (VUE) FOLDER STRUCTURE (Public Only)

```
resources/js/
├── app.js                 # Main entry point
├── bootstrap.js           # Bootstrap file
│
├── Components/            # Reusable Vue components
│   ├── common/            # Shared components
│   │   ├── Button.vue
│   │   ├── Card.vue
│   │   ├── Modal.vue
│   │   ├── Spinner.vue
│   │   └── Toast.vue
│   │
│   ├── layout/            # Layout components
│   │   ├── Header.vue
│   │   ├── Footer.vue
│   │   └── Navigation.vue
│   │
│   ├── home/              # Homepage components
│   │   ├── Hero.vue
│   │   ├── FeaturedWork.vue
│   │   ├── ServicesOverview.vue   (Dynamic - fetches services)
│   │   ├── RecentWritings.vue
│   │   ├── FeaturedTools.vue
│   │   └── Connect.vue
│   │
│   ├── projects/          # Project-related components
│   │   ├── ProjectGrid.vue
│   │   ├── ProjectCard.vue
│   │   ├── ProjectFilter.vue
│   │   ├── ProjectDetail.vue
│   │   └── CaseStudy.vue
│   │
│   ├── services/          # Service-related components (Dynamic)
│   │   ├── ServiceGrid.vue          # Grid of all services
│   │   ├── ServiceCard.vue          # Individual service card
│   │   ├── ServiceDetail.vue        # Full service page
│   │   ├── ServiceFeatures.vue      # Features section
│   │   ├── ServiceProcess.vue       # Process section
│   │   ├── ServiceFAQ.vue           # FAQ accordion
│   │   └── RelatedServices.vue      # Related services
│   │
│   ├── articles/          # Article-related components
│   │   ├── ArticleGrid.vue
│   │   ├── ArticleCard.vue
│   │   ├── ArticleDetail.vue
│   │   ├── TableOfContents.vue
│   │   └── RelatedArticles.vue
│   │
│   ├── tools/             # Tool components
│   │   ├── ToolGrid.vue
│   │   ├── ToolCard.vue
│   │   ├── JsonFormatter.vue
│   │   ├── ApiViewer.vue
│   │   ├── SlugGenerator.vue
│   │   ├── MarkdownPreview.vue
│   │   └── TextUtilities.vue
│   │
│   ├── contact/           # Contact components
│   │   ├── ContactForm.vue
│   │   ├── CalendarWidget.vue
│   │   └── ThankYou.vue
│   │
│   └── blog/              # Blog components
│       ├── PostGrid.vue
│       ├── PostCard.vue
│       ├── PostDetail.vue
│       └── Comments.vue
│
├── Composables/           # Composition API functions
│   ├── useAnalytics.js    # Tracking functions
│   ├── useTheme.js        # Dark/light mode
│   ├── useForm.js         # Form handling
│   ├── useToast.js        # Toast notifications
│   ├── useVisitor.js      # Visitor data
│   └── useServices.js     # Fetch services data
│
├── Layouts/               # Page layouts
│   └── PublicLayout.vue   # Layout for public pages
│
├── Pages/                 # Page components
│   ├── HomePage.vue
│   ├── ProjectsPage.vue
│   ├── ProjectDetailPage.vue
│   ├── ServicesPage.vue          
│   ├── ServiceDetailPage.vue     
│   ├── ArticlesPage.vue
│   ├── ArticleDetailPage.vue
│   ├── ToolsPage.vue
│   ├── ToolDetailPage.vue
│   ├── ContactPage.vue
│   ├── AboutPage.vue
│   ├── NowPage.vue
│   ├── UsesPage.vue
│   ├── BlogPage.vue
│   ├── BlogPostPage.vue
│   └── Legal/
│       ├── PrivacyPage.vue
│       └── TermsPage.vue
│
├── Router/                # Vue Router configuration
│   ├── index.js           # Router setup
│   └── routes.js          # Route definitions (includes services/:slug)
│
├── Stores/                # Pinia stores
│   ├── theme.js           # Theme preferences
│   ├── visitor.js         # Visitor/session data
│   ├── tools.js           # Tool state
│   └── services.js        # Services state/cache
│
├── Utils/                 # Utility functions
│   ├── formatters.js      # Date/number formatting
│   ├── validators.js      # Form validation
│   ├── analytics.js       # Analytics helpers
│   └── constants.js       # Constant values
│
├── Api/                   # API integration
│   └── services.js        # Service API calls
│
└── Types/                 # TypeScript type definitions
    ├── project.d.ts
    ├── service.d.ts       # Service type definitions
    ├── article.d.ts
    └── visitor.d.ts
```

---



