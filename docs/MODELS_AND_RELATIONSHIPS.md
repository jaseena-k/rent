# Models and Relationships

- Building: hasMany Units, hasMany Expenses
- Unit: belongsTo Building, hasMany Leases
- Tenant: hasMany Leases
- Lease: belongsTo Tenant, belongsTo Unit, hasMany Invoices
- Invoice: belongsTo Lease, hasMany Payments
- Payment: belongsTo Invoice
- Expense: belongsTo Building
- AuditLog: stores user action trail for key entity mutations

## Role Matrix
- Owner: full access to all modules and reporting
- Manager: buildings/units/tenants/leases/invoices/payments/expenses and reports
- Accountant: invoices/payments/expenses/reports (read-only units/tenants)
