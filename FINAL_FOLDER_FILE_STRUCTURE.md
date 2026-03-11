project-root/
│
├── app/
│   ├── Actions/
│   │   ├── Project/
│   │   │   ├── CreateProject.php
│   │   │   ├── UpdateProject.php
│   │   │   └── DeleteProject.php
│   │   ├── Service/
│   │   │   ├── CreateService.php
│   │   │   ├── UpdateService.php
│   │   │   └── ReorderServices.php
│   │   ├── Article/
│   │   ├── Booking/
│   │   │   ├── CheckAvailability.php
│   │   │   └── CreateBooking.php
│   │   └── Contact/
│   │       └── SendContactInquiry.php
│   │
│   ├── Console/
│   │   ├── Commands/
│   │   │   ├── CleanupOldBookings.php
│   │   │   └── GenerateSitemap.php
│   │   └── Kernel.php
│   │
│   ├── DTOs/
│   │   ├── BookingData.php
│   │   ├── ContactData.php
│   │   └── ServiceData.php
│   │
│   ├── Enums/
│   │   ├── BookingStatus.php
│   │   ├── ContactStatus.php
│   │   ├── ServiceType.php
│   │   └── UserRole.php
│   │
│   ├── Events/
│   │   ├── Booking/
│   │   │   ├── BookingCreated.php
│   │   │   ├── BookingApproved.php
│   │   │   └── BookingDeclined.php
│   │   ├── Contact/
│   │   │   └── ContactSubmitted.php
│   │   └── Service/
│   │       └── ServicePublished.php
│   │
│   ├── Exceptions/
│   │   ├── Booking/
│   │   │   └── SlotUnavailableException.php
│   │   └── Handler.php
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   │   ├── V1/
│   │   │   │   │   ├── ArticleController.php
│   │   │   │   │   ├── CategoryController.php
│   │   │   │   │   ├── ContactController.php
│   │   │   │   │   ├── FaqController.php
│   │   │   │   │   ├── PricingController.php
│   │   │   │   │   ├── ProcessController.php
│   │   │   │   │   ├── ProjectController.php
│   │   │   │   │   ├── PublicBookingController.php
│   │   │   │   │   ├── ScheduleController.php
│   │   │   │   │   ├── ServiceController.php
│   │   │   │   │   ├── TagController.php
│   │   │   │   │   └── TestimonialController.php
│   │   │   │   └── Auth/
│   │   │   │       ├── LoginController.php
│   │   │   │       ├── LogoutController.php
│   │   │   │       ├── RegisterController.php
│   │   │   │       ├── ForgotPasswordController.php
│   │   │   │       └── ResetPasswordController.php
│   │   │   │
│   │   │   └── Admin/
│   │   │       ├── V1/
│   │   │       │   ├── DashboardController.php
│   │   │       │   ├── ProjectController.php
│   │   │       │   ├── ServiceController.php
│   │   │       │   ├── ArticleController.php
│   │   │       │   ├── BookingController.php
│   │   │       │   ├── ContactController.php
│   │   │       │   ├── InsightController.php
│   │   │       │   ├── MediaController.php
│   │   │       │   ├── SettingsController.php
│   │   │       │   ├── ToolController.php
│   │   │       │   └── UserController.php
│   │   │       └── Auth/
│   │   │           ├── LoginController.php
│   │   │           └── LogoutController.php
│   │   │
│   │   ├── Middleware/
│   │   │   ├── AdminMiddleware.php
│   │   │   ├── ApiVersionMiddleware.php
│   │   │   ├── CacheHeaders.php
│   │   │   ├── Cors.php
│   │   │   ├── ForceJsonResponse.php
│   │   │   ├── TrackVisitor.php
│   │   │   └── VerifyCsrfToken.php
│   │   │
│   │   ├── Requests/
│   │   │   ├── Api/
│   │   │   │   ├── V1/
│   │   │   │   │   ├── Booking/
│   │   │   │   │   │   ├── CheckAvailabilityRequest.php
│   │   │   │   │   │   └── CreateBookingRequest.php
│   │   │   │   │   ├── Contact/
│   │   │   │   │   │   └── StoreContactRequest.php
│   │   │   │   │   └── Service/
│   │   │   │   │       └── ListServiceRequest.php
│   │   │   │   └── Auth/
│   │   │   │       ├── LoginRequest.php
│   │   │   │       └── RegisterRequest.php
│   │   │   │
│   │   │   └── Admin/
│   │   │       ├── V1/
│   │   │       │   ├── Project/
│   │   │       │   │   ├── StoreProjectRequest.php
│   │   │       │   │   └── UpdateProjectRequest.php
│   │   │       │   ├── Service/
│   │   │       │   │   ├── StoreServiceRequest.php
│   │   │       │   │   ├── UpdateServiceRequest.php
│   │   │       │   │   └── ReorderServiceRequest.php
│   │   │       │   ├── Booking/
│   │   │       │   │   ├── ApproveBookingRequest.php
│   │   │       │   │   └── DeclineBookingRequest.php
│   │   │       │   └── Settings/
│   │   │       │       └── UpdateSettingsRequest.php
│   │   │
│   │   └── Resources/
│   │       ├── Api/
│   │       │   ├── V1/
│   │       │   │   ├── ArticleCollection.php
│   │       │   │   ├── ArticleResource.php
│   │       │   │   ├── BookingCollection.php
│   │       │   │   ├── BookingResource.php
│   │       │   │   ├── CategoryCollection.php
│   │       │   │   ├── CategoryResource.php
│   │       │   │   ├── ContactCollection.php
│   │       │   │   ├── ContactResource.php
│   │       │   │   ├── FAQCollection.php
│   │       │   │   ├── FAQResource.php
│   │       │   │   ├── FeatureCollection.php
│   │       │   │   ├── FeatureResource.php
│   │       │   │   ├── PricingModelCollection.php
│   │       │   │   ├── PricingModelResource.php
│   │       │   │   ├── ProcessStepCollection.php
│   │       │   │   ├── ProcessStepResource.php
│   │       │   │   ├── ProjectCollection.php
│   │       │   │   ├── ProjectResource.php
│   │       │   │   ├── ServiceCollection.php
│   │       │   │   ├── ServiceResource.php
│   │       │   │   ├── TagCollection.php
│   │       │   │   ├── TagResource.php
│   │       │   │   ├── TechnologyCollection.php
│   │       │   │   ├── TechnologyResource.php
│   │       │   │   ├── TestimonialCollection.php
│   │       │   │   ├── TestimonialResource.php
│   │       │   │   ├── UserCollection.php
│   │       │   │   └── UserResource.php
│   │       │   └── Auth/
│   │       │       ├── AuthResource.php
│   │       │       └── TokenResource.php
│   │       │
│   │       └── Admin/
│   │           └── V1/
│   │               └── [Admin specific resources]
│   │
│   ├── Jobs/
│   │   ├── ProcessContactInquiry.php
│   │   ├── SendBookingConfirmation.php
│   │   └── SendBookingNotification.php
│   │
│   ├── Listeners/
│   │   ├── SendContactAutoReply.php
│   │   ├── SendNewBookingNotification.php
│   │   └── UpdateBookingCalendar.php
│   │
│   ├── Mail/
│   │   ├── Booking/
│   │   │   ├── BookingConfirmation.php
│   │   │   ├── BookingApproved.php
│   │   │   └── BookingDeclined.php
│   │   └── Contact/
│   │       ├── ContactAutoReply.php
│   │       └── NewContactNotification.php
│   │
│   ├── Models/
│   │   ├── Article.php
│   │   ├── Category.php
│   │   ├── Contact.php
│   │   ├── PageView.php
│   │   ├── Project.php
│   │   ├── Schedule.php
│   │   ├── Service.php
│   │   ├── ServiceFAQ.php
│   │   ├── ServiceFeature.php
│   │   ├── ServicePricingModel.php
│   │   ├── ServiceProcessStep.php
│   │   ├── ServiceTechnology.php
│   │   ├── Tag.php
│   │   ├── Testimonial.php
│   │   ├── Tool.php
│   │   ├── ToolUsage.php
│   │   ├── User.php
│   │   ├── Visitor.php
│   │   └── Traits/
│   │       ├── HasSlug.php
│   │       ├── HasMeta.php
│   │       └── HasActivityLog.php
│   │
│   ├── Notifications/
│   │   ├── BookingConfirmed.php
│   │   └── NewBookingForAdmin.php
│   │
│   ├── Observers/
│   │   ├── BookingObserver.php
│   │   ├── ContactObserver.php
│   │   └── ServiceObserver.php
│   │
│   ├── Policies/
│   │   ├── BookingPolicy.php
│   │   ├── ProjectPolicy.php
│   │   └── ServicePolicy.php
│   │
│   ├── Providers/
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   ├── HorizonServiceProvider.php
│   │   └── RouteServiceProvider.php
│   │
│   ├── Rules/
│   │   ├── AvailableSlot.php
│   │   ├── FutureDateTime.php
│   │   └── ValidBookingTime.php
│   │
│   ├── Services/
│   │   ├── Analytics/
│   │   │   ├── AnalyticsService.php
│   │   │   └── TrackVisitorService.php
│   │   ├── Booking/
│   │   │   ├── AvailabilityService.php
│   │   │   └── BookingService.php
│   │   ├── Media/
│   │   │   └── MediaService.php
│   │   └── Settings/
│   │       └── SettingsService.php
│   │
│   └── Traits/
│       ├── ApiResponse.php
│       ├── HandlesBookings.php
│       └── HasVisitors.php
│
├── bootstrap/
│   ├── app.php
│   ├── cache/
│   └── providers.php
│
├── config/
│   ├── app.php
│   ├── auth.php
│   ├── cache.php
│   ├── cors.php
│   ├── database.php
│   ├── filesystems.php
│   ├── horizon.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── sanctum.php
│   ├── services.php
│   ├── session.php
│   ├── settings.php
│   └── view.php
│
├── database/
│   ├── factories/
│   │   ├── ArticleFactory.php
│   │   ├── CategoryFactory.php
│   │   ├── ContactFactory.php
│   │   ├── ProjectFactory.php
│   │   ├── ScheduleFactory.php
│   │   ├── ServiceFactory.php
│   │   ├── TestimonialFactory.php
│   │   ├── ToolFactory.php
│   │   └── UserFactory.php
│   │
│   ├── migrations/
│   │   ├── 2024_01_01_000001_create_users_table.php
│   │   ├── 2024_01_01_000002_create_visitors_table.php
│   │   ├── 2024_01_01_000003_create_services_table.php
│   │   ├── 2024_01_01_000004_create_service_features_table.php
│   │   ├── 2024_01_01_000005_create_service_process_steps_table.php
│   │   ├── 2024_01_01_000006_create_service_faqs_table.php
│   │   ├── 2024_01_01_000007_create_service_technologies_table.php
│   │   ├── 2024_01_01_000008_create_service_pricing_models_table.php
│   │   ├── 2024_01_01_000009_create_projects_table.php
│   │   ├── 2024_01_01_000010_create_service_project_table.php
│   │   ├── 2024_01_01_000011_create_articles_table.php
│   │   ├── 2024_01_01_000012_create_categories_table.php
│   │   ├── 2024_01_01_000013_create_tags_table.php
│   │   ├── 2024_01_01_000014_create_taggables_table.php
│   │   ├── 2024_01_01_000015_create_testimonials_table.php
│   │   ├── 2024_01_01_000016_create_contacts_table.php
│   │   ├── 2024_01_01_000017_create_schedules_table.php
│   │   ├── 2024_01_01_000018_create_tools_table.php
│   │   ├── 2024_01_01_000019_create_tool_usages_table.php
│   │   └── 2024_01_01_000020_create_page_views_table.php
│   │
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── RolePermissionSeeder.php
│       ├── UserSeeder.php
│       ├── ServiceSeeder.php
│       ├── ProjectSeeder.php
│       ├── ArticleSeeder.php
│       ├── TestimonialSeeder.php
│       ├── ScheduleSeeder.php
│       ├── ContactSeeder.php
│       └── ToolSeeder.php
│
├── lang/
│   ├── en/
│   │   ├── auth.php
│   │   ├── pagination.php
│   │   ├── passwords.php
│   │   ├── validation.php
│   │   └── messages.php
│   └── bn/
│       └── [Bengali translations]
│
├── public/
│   ├── build/
│   │   ├── assets/
│   │   │   ├── index-xxxx.js
│   │   │   └── index-xxxx.css
│   │   └── manifest.json
│   ├── storage/
│   ├── favicon.ico
│   ├── index.php
│   └── robots.txt
│
├── resources/
│   ├── css/
│   │   ├── app.css
│   │   └── admin.css
│   │
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
│   │   │   │   ├── Articles/
│   │   │   │   │   ├── ArticleListPage.vue
│   │   │   │   │   └── ArticleDetailPage.vue
│   │   │   │   ├── FAQ/
│   │   │   │   │   └── FaqListPage.vue
│   │   │   │   ├── Pricing/
│   │   │   │   │   └── PricingPage.vue
│   │   │   │   ├── Process/
│   │   │   │   │   └── ProcessPage.vue
│   │   │   │   ├── Booking/
│   │   │   │   │   ├── BookingPage.vue
│   │   │   │   │   └── BookingSuccessPage.vue
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
│   │   │   │   └── Info/
│   │   │   │       ├── AboutPage.vue
│   │   │   │       ├── NowPage.vue
│   │   │   │       ├── UsesPage.vue
│   │   │   │       ├── PrivacyPage.vue
│   │   │   │       └── TermsPage.vue
│   │   │   │
│   │   │   └── Auth/
│   │   │       ├── LoginPage.vue
│   │   │       ├── RegisterPage.vue
│   │   │       ├── ForgotPasswordPage.vue
│   │   │       └── ResetPasswordPage.vue
│   │   │
│   │   ├── Components/
│   │   │   ├── Public/
│   │   │   │   ├── Common/
│   │   │   │   │   ├── ProjectCard.vue
│   │   │   │   │   ├── ServiceCard.vue
│   │   │   │   │   ├── ArticleCard.vue
│   │   │   │   │   ├── TestimonialCard.vue
│   │   │   │   │   ├── Button.vue
│   │   │   │   │   ├── Input.vue
│   │   │   │   │   ├── Modal.vue
│   │   │   │   │   ├── Pagination.vue
│   │   │   │   │   └── Spinner.vue
│   │   │   │   ├── Layout/
│   │   │   │   │   ├── Header.vue
│   │   │   │   │   ├── Footer.vue
│   │   │   │   │   └── Navbar.vue
│   │   │   │   └── Home/
│   │   │   │       ├── FeaturedProjects.vue
│   │   │   │       ├── FeaturedArticles.vue
│   │   │   │       ├── RecentArticles.vue
│   │   │   │       ├── ServicesOverview.vue
│   │   │   │       └── TestimonialsCarousel.vue
│   │   │   │
│   │   │   └── UI/
│   │   │       ├── icons/
│   │   │       │   ├── HeroIcons.js
│   │   │       │   └── CustomIcons.vue
│   │   │       └── ThemeToggle.vue
│   │   │
│   │   ├── Composables/
│   │   │   ├── useApi.js
│   │   │   ├── useAuth.js
│   │   │   ├── useBooking.js
│   │   │   ├── useDarkMode.js
│   │   │   ├── useForm.js
│   │   │   ├── useNotification.js
│   │   │   ├── usePagination.js
│   │   │   └── useValidation.js
│   │   │
│   │   ├── Stores/
│   │   │   ├── auth.js
│   │   │   ├── booking.js
│   │   │   ├── notification.js
│   │   │   ├── service.js
│   │   │   ├── settings.js
│   │   │   └── theme.js
│   │   │
│   │   ├── Router/
│   │   │   ├── index.js
│   │   │   ├── routes.js
│   │   │   ├── guards.js
│   │   │   └── middleware.js
│   │   │
│   │   ├── Layouts/
│   │   │   ├── PublicLayout.vue
│   │   │   ├── AdminLayout.vue
│   │   │   └── AuthLayout.vue
│   │   │
│   │   ├── Plugins/
│   │   │   ├── axios.js
│   │   │   ├── dayjs.js
│   │   │   └── vue-query.js
│   │   │
│   │   ├── Utils/
│   │   │   ├── constants.js
│   │   │   ├── formatters.js
│   │   │   └── validators.js
│   │   │
│   │   ├── app.js
│   │   └── bootstrap.js
│   │
│   └── views/
│       ├── app.blade.php
│       ├── admin/
│       │   ├── layouts/
│       │   │   └── app.blade.php
│       │   └── dashboard.blade.php
│       └── vendor/
│           └── [package views]
│
├── routes/
│   ├── api.php
│   ├── web.php
│   ├── admin.php
│   ├── console.php
│   └── channels.php
│
├── storage/
│   ├── app/
│   │   ├── public/
│   │   │   ├── media/
│   │   │   └── uploads/
│   │   └── private/
│   ├── framework/
│   ├── logs/
│   └── database/
│
├── tests/
│   ├── Feature/
│   │   ├── Api/
│   │   │   ├── V1/
│   │   │   │   ├── BookingTest.php
│   │   │   │   ├── ContactTest.php
│   │   │   │   └── ServiceTest.php
│   │   │   └── Auth/
│   │   │       ├── LoginTest.php
│   │   │       └── RegisterTest.php
│   │   ├── Admin/
│   │   │   ├── ProjectManagementTest.php
│   │   │   └── ServiceManagementTest.php
│   │   └── Unit/
│   │       ├── Actions/
│   │       ├── Services/
│   │       └── Rules/
│   │
│   ├── Pest.php
│   └── TestCase.php
│
├── .editorconfig
├── .env
├── .env.example
├── .gitattributes
├── .gitignore
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── package-lock.json
├── phpunit.xml
├── vite.config.js
├── postcss.config.js
├── .prettierrc
├── .eslintrc.js
├── .styleci.yml
├── pint.json
├── phpstan.neon
├── phpcs.xml
├── README.md
├── CONTRIBUTING.md
├── CHANGELOG.md
└── LICENSE