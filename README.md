# Marketplace Laravel Project

This repository is a Laravel 12 multi-vendor marketplace (PHP 8.2+).

## Run the project (Local development)

### Prerequisites
- PHP 8.2+
- Composer
- Node.js (18+)
- npm
- SQLite (optional for local development)

### Quick setup
Install PHP dependencies:

```bash
composer install
```

Copy the environment file and generate an app key:

```powershell
copy .env.example .env
composer run key:generate   # or: php artisan key:generate
```

Create the storage symlink (if needed):

```bash
php artisan storage:link
```

Run database migrations and seeders:

```bash
php artisan migrate --seed
```

If using SQLite, ensure `database/database.sqlite` exists and set `DB_CONNECTION=sqlite` in `.env`.

### Frontend
Install JS dependencies and start the dev build:

```bash
npm install
npm run dev   # dev server / watch
```

Build production assets:

```bash
npm run build
```

### Start the app
Use Laravel's development server:

```bash
php artisan serve
```

Or use the project's helper script (if available):

```bash
composer run dev
```

Visit http://127.0.0.1:8000 (or the address printed by `php artisan serve`).

### Testing
Run the test suite with:

```bash
composer test
# or
vendor/bin/phpunit
```

### Notes
- If you encounter permission issues, ensure `storage/` and `bootstrap/cache` are writable.
- For production use, configure a persistent database (MySQL/Postgres), a webserver (Nginx/Apache), and queue workers.

---

See the repository for more project-specific scripts and configuration.

