# Copilot Instructions for Marketplace Laravel Project

## Project Overview
This is a **Laravel 12 e-commerce marketplace** built with PHP 8.2. It's a multi-vendor platform where users can manage stores and sell products organized by categories.

### Core Domain Model
- **Users**: Platform users who can own stores (one-to-one relationship)
- **Stores**: Vendor storefronts owned by users (has many products)
- **Products**: Items for sale within stores (belongs to store, many-to-many with categories)
- **Categories**: Product classifications (many-to-many with products via pivot table)

**Key relationship** to understand: `User → Store → Product ← Category` (pivot table)

## Architecture & Patterns

### Model Conventions
All models in `app/Models/` use Eloquent ORM with explicit relationship definitions:
- Use `belongsTo()` for foreign key relationships (Product→Store, Store→User)
- Use `hasMany()` for one-to-many (Store→Products, User→Stores)
- Use `belongsToMany()` for many-to-many with pivot tables (Product↔Category)
- Models inherit from `Illuminate\Database\Eloquent\Model`

Example: [Store.php](app/Models/Store.php) defines `user()` and `products()` relationships.

### Database & Migrations
- Migrations stored in `database/migrations/` using chronological naming
- Foreign key constraints enforced at DB level (see store & product migrations)
- Pivot table `category_product` handles Product↔Category relationships
- All tables use `timestamps()` for created_at/updated_at

### Data Generation (Factories)
- Factories in `database/factories/` use `FakerPHP\Faker` for test data
- Each factory extends `Illuminate\Database\Eloquent\Factories\Factory<Model>`
- Define `definition()` method returning associative array of attributes
- **Current issues**: StoreFactory & ProductFactory have incomplete/broken implementations—fixtures must be corrected

**Example pattern** from UserFactory:
```php
public function definition(): array {
    return [
        'name' => fake()->name(),
        'email' => fake()->email(),
        'password' => bcrypt('password'),
    ];
}
```

### Development Workflow

#### Setup
```bash
composer run setup  # One-command init: dependencies, .env, key, migrations, npm
```

#### Local Development
```bash
composer run dev  # Concurrent: Laravel serve, queue listener, Vite dev server
npm run build     # Production frontend assets
```

#### Testing
```bash
composer test  # Clears config, runs PHPUnit (tests/ directory)
```

#### Code Quality
- **Linting**: `./vendor/bin/pint` (Laravel code style)
- **Database**: SQLite for local development (config/database.php)

## Frontend & Asset Pipeline

### Frontend Stack
- **Vite 7** for bundling (replacing Laravel Mix)
- **Tailwind CSS 4** with `@tailwindcss/vite` plugin for styling
- **Axios** for AJAX requests
- **Laravel Vite Plugin** integration

### Key Files
- `vite.config.js`: Vite configuration, entry points in `resources/js/app.js`
- `resources/css/app.css`: Global styles with Tailwind
- `package.json`: Frontend dependencies only (no Laravel packages)
- Built assets reference the Vite manifest during development

## Project-Specific Conventions

### Naming & Slugs
- Models use `slug` field for URL-friendly identifiers (see Products, Stores)
- Slugs should be generated using Str::slug() utility (see migrations)

### Routes
- Basic setup in `routes/web.php` (currently minimal—only welcome view)
- No resource routes defined yet; expect RESTful API patterns when expanded

### Seeders
- `database/seeders/DatabaseSeeder.php` orchestrates seeding
- `UsersTableSeeder.php` exists for user test data
- Use factories in seeders: `User::factory(10)->create()`

## Common Issues & Patterns

### Factory Syntax Issues
When writing factories, avoid incomplete faker chains:
- ❌ Bad: `'phone' => fake()->` (incomplete)
- ✅ Good: `'phone' => fake()->phoneNumber()`
- ✅ Good: `'slug' => str()->slug(fake()->sentence())`

### Mass Assignment
Models use `$fillable` to whitelist assignable attributes. Always define for model attributes.

### Pivot Table Handling
For Product↔Category many-to-many:
```php
$product->categories()->attach([1, 2, 3]);      // Attach categories
$product->categories()->detach([1]);            // Remove category
$product->categories()->sync([1, 2]);           // Sync to exact set
```

## Testing Conventions

- Tests split into `tests/Feature/` (integration) and `tests/Unit/` (isolated)
- Each test class extends `TestCase` with Laravel-specific assertions
- Database automatically rolled back after each test
- Use factories for creating test fixtures

## When Working on This Codebase

1. **Always maintain relationship consistency**: Update both sides of relationships
2. **Run migrations after schema changes**: `php artisan migrate`
3. **Regenerate slugs with Str::slug()**: Apply consistently across all slug-using models
4. **Keep factories complete**: Ensure all migration columns have faker definitions
5. **Update pivot table usage**: If relationship cardinality changes, mirror in migrations and models
