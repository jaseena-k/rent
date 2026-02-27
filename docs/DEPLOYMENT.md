# Docker + Production Checklist

## Docker
- Use PHP-FPM 8.2 image with required extensions (`pdo_pgsql`, `bcmath`, `mbstring`).
- Nginx reverse proxy.
- PostgreSQL 15 managed service or container.
- Queue worker and scheduler containers.

## Checklist
- [ ] `APP_ENV=production`, `APP_DEBUG=false`
- [ ] Secure `APP_KEY` and secrets in vault/secret manager
- [ ] Force HTTPS and trusted proxies configured
- [ ] DB backups + point-in-time recovery enabled
- [ ] Queue workers supervised and auto-restarted
- [ ] Scheduler cron running (`php artisan schedule:run`)
- [ ] S3/object storage for tenant documents
- [ ] Error monitoring (Sentry/Bugsnag) configured
- [ ] Access logs and audit logs retained with policy
- [ ] Load/perf smoke tests passed
