# API Endpoints (v1)

All endpoints are under `/api/v1` and protected by `auth:sanctum`.

## Buildings
- GET `/buildings`
- POST `/buildings`
- GET `/buildings/{id}`
- PUT/PATCH `/buildings/{id}`
- DELETE `/buildings/{id}`

## Units
- GET `/units`
- POST `/units`
- GET `/units/{id}`
- PUT/PATCH `/units/{id}`
- DELETE `/units/{id}`

## Tenants
- GET `/tenants`
- POST `/tenants`
- GET `/tenants/{id}`
- PUT/PATCH `/tenants/{id}`
- DELETE `/tenants/{id}`

## Leases
- GET `/leases`
- POST `/leases`
- GET `/leases/{id}`
- PUT/PATCH `/leases/{id}`
- DELETE `/leases/{id}`

## Invoices & Payments
- GET `/invoices`
- POST `/invoices`
- GET `/invoices/{id}`
- PUT/PATCH `/invoices/{id}`
- DELETE `/invoices/{id}`
- POST `/invoices/{invoice}/payments`

## Expenses
- GET `/expenses`
- POST `/expenses`
- GET `/expenses/{id}`
- PUT/PATCH `/expenses/{id}`
- DELETE `/expenses/{id}`

## Reports
- GET `/reports/occupancy`
- GET `/reports/pending-dues`
- GET `/reports/net-cash-flow?month=YYYY-MM`
