# Copilot Instructions for MixNBreed

## Project Overview
- **MixNBreed** is a Laravel (PHP) + Vite + Livewire web application for managing dog profiles and user accounts.
- Major components:
  - `app/Models/`: Eloquent models (e.g., `DogProfile.php`, `User.php`)
  - `app/Http/Controllers/`: Laravel controllers for routing and business logic
  - `app/Http/Livewire/`: Livewire components for reactive UI
  - `resources/views/`: Blade templates for UI
  - `database/migrations/`: Schema migrations
  - `database/seeders/`: Seed data

## Key Workflows
- **Install & Build:**
  - `composer install` (PHP deps)
  - `npm install` (JS deps)
  - `npm run dev` (build assets)
- **Environment:**
  - Copy `.env.example` to `.env` and set DB credentials
  - Generate app key: `php artisan key:generate`
- **Database:**
  - Migrate: `php artisan migrate`
  - DB: MySQL, default name `mixnbreed_db`

## Conventions & Patterns
- **Controllers**: Route logic is in `app/Http/Controllers/`. Use RESTful naming.
- **Models**: Eloquent models in `app/Models/` follow Laravel conventions.
- **Livewire**: UI interactivity via `app/Http/Livewire/` components.
- **Blade Views**: UI in `resources/views/`, organized by feature (e.g., `dogmatch/`).
- **Migrations**: Timestamped files in `database/migrations/`.
- **Testing**: Use `php artisan test` or `vendor/bin/phpunit`.

## Integration Points
- **Vite**: Asset bundling via `vite.config.js` and `npm run dev`.
- **Livewire**: JS interactivity without SPA complexity.
- **MySQL**: External DB, configured in `.env`.

## Project-Specific Notes
- **User & DogProfile**: Core domain models, see `app/Models/`.
- **Admin Features**: See migrations for `is_admin` field in users.
- **Images**: User-uploaded images in `public/images/`.
- **Customizations**: Check `resources/views/` for custom Blade layouts.

## Examples
- Add a migration: `php artisan make:migration add_field_to_table --table=table`
- Add a Livewire component: `php artisan make:livewire ComponentName`
- Run tests: `php artisan test`

## References
- See `README.md` for setup and troubleshooting.
- Key files: `app/Models/User.php`, `app/Models/DogProfile.php`, `resources/views/dogmatch/form.blade.php`

---
For more, see Laravel and Livewire docs. When in doubt, follow Laravel conventions unless project files show otherwise.
