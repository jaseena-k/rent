# Building Rent & Room Management (Laravel + Filament + PostgreSQL)

Production-oriented MVP scaffold for building owners to manage buildings, units, tenants, leases, invoices/payments, expenses, reporting, reminders, RBAC, and audit trails.

## Tech Stack
- Laravel 11 (application structure and conventions)
- Filament 3 (admin panel resources)
- PostgreSQL 15+
- Laravel Sanctum for API auth
- Spatie Laravel Permission for role-based access
- Spatie Activitylog for audit trail

## Quick Start
1. Copy env: `cp .env.example .env`
2. Configure PostgreSQL credentials in `.env`
3. Install dependencies:
   - `composer install`
   - `php artisan key:generate`
4. Run migrations and seeders:
   - `php artisan migrate --seed`
5. Serve app:
   - `php artisan serve`

## Core Modules Implemented
- Buildings and units management
- Tenant and lease management
- Invoice/payment rent collection
- Expense tracking
- Reports endpoints (occupancy, dues, cash flow)
- Notifications service scaffold
- Role-based access (Owner/Manager/Accountant)
- Audit log model and middleware hook point

## API Summary
- `GET/POST /api/v1/buildings`
- `GET/POST /api/v1/units`
- `GET/POST /api/v1/tenants`
- `GET/POST /api/v1/leases`
- `GET/POST /api/v1/invoices`
- `POST /api/v1/invoices/{invoice}/payments`
- `GET/POST /api/v1/expenses`
- `GET /api/v1/reports/occupancy`
- `GET /api/v1/reports/pending-dues`
- `GET /api/v1/reports/net-cash-flow`

See `docs/` for ERD, full model relationships, implementation roadmap, testing strategy, and deployment checklist.
