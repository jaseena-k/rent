# Step-by-Step Implementation Plan

1. Bootstrap Laravel project with PostgreSQL, Sanctum, Filament.
2. Create migration schema for building/unit/tenant/lease/invoice/payment/expense/audit.
3. Implement Eloquent models and relationships.
4. Add RBAC roles and permissions (Owner, Manager, Accountant).
5. Build REST API controllers with validation and pagination.
6. Build Filament Resources (forms/tables/filters) for all modules.
7. Add report service and export endpoints (CSV/PDF).
8. Add scheduled reminders for due rent/overdue/lease expiry.
9. Add activity logging and audit report page.
10. Add feature tests for payment, vacancy transitions, and lease expiry.
11. Containerize with Docker and deploy via CI/CD.
