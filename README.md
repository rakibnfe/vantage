# Vantage - Laravel 12 + Vue 3 SPA

Production-ready portfolio platform.

## Quick Start

```bash
# Terminal 1
npm run dev

# Terminal 2
php artisan serve
```

Visit: `http://localhost:8000`

## Setup Checklist

- ✅ Laravel 12 installed
- ✅ Vue 3 SPA configured
- ✅ Database migrations executed
- ✅ All dependencies installed

## Tech Stack

- **Backend**: Laravel 12, PHP 8.4
- **Frontend**: Vue 3, Vite, Tailwind CSS v4
- **State**: Pinia
- **Routing**: Vue Router
- **Database**: MySQL/SQLite
- **Packages**: Sanctum, Horizon, Pulse, Spatie Permission/Media/ActivityLog

## Project Structure

```
app/                 → Laravel models, controllers, services
resources/js/        → Vue components, pages, stores, router
routes/              → Web and API routes
database/migrations/ → Database schema
config/              → Configuration files
```

## Commands

```bash
npm run dev              # Start Vite
php artisan serve       # Start Laravel
php artisan tinker      # PHP REPL
php artisan migrate     # Run migrations
npm run build           # Build for production
php artisan optimize    # Production optimization
```

## Database

Models: Service, Project, Article, Contact, Tool, Visitor

Run migrations: `php artisan migrate`

## Routes

**Public Pages:**
- `/` `/work` `/work/:slug` `/services` `/services/:slug`
- `/notes` `/notes/:slug` `/tools` `/tools/:slug`
- `/contact` `/about` `/blog` `/privacy` `/terms`

**API:**
- `GET /api/services`
- `GET /api/services/{slug}`

## State Management

```javascript
import { useThemeStore } from '@/Stores/theme.js'
import { useServicesStore } from '@/Stores/services.js'
import { useVisitorStore } from '@/Stores/visitor.js'
import { useToolsStore } from '@/Stores/tools.js'
```

## Done. Start Building.
