# 🐶 Mix N' Breed - AI-Powered Dog Breed Matching Platform

Welcome to **Mix N' Breed**! An innovative Laravel + Livewire application that uses AI to generate previews of mixed dog breeds and provides educational resources for responsible dog breeding.

---

## ✨ Features

- 🎯 **AI-Powered Breed Mixing** - Generate visual previews of mixed breed combinations with real-time selection
- 🐕 **Dog Profile Management** - Create and manage comprehensive dog profiles with detailed attributes
- 📱 **Responsive Design** - Works seamlessly on desktop, tablet, and mobile devices with adaptive navigation
- 🎨 **Modern UI/UX** - Built with TailwindCSS and Livewire for reactive interactions
- 📊 **Statistics Dashboard** - Track total registered dogs, matches, and breeding insights across all users
- 🛍️ **Marketplace** - Browse and list dog profiles for adoption, breeding, or sale
- 🎓 **Educational Content** - Learn about dog breeding compatibility and best practices
- 👤 **User Authentication** - Secure user accounts with profile picture upload support
- 🔔 **Flash Notifications** - PHP Flasher with Toastr and Noty for elegant notifications
- 🔧 **Admin Panel** - Administrative tools for platform management

---

## 🚀 Getting Started

### Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js & npm
- MySQL 8.0 or higher
- Git

### 1. Clone the Repository

```bash
git clone https://github.com/chryssallasgo/Mix-N-Breed.git
cd Mix-N-Breed/mixnbreed
```

### 2. Install Dependencies

```bash
# Install PHP dependencies (includes PHP Flasher)
composer install

# Install JavaScript dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Database

Edit your `.env` file with your database credentials:

```env
APP_NAME="Mix N' Breed"
APP_ENV=local
APP_KEY=base64:your_generated_key_here
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mixnbreed_db
DB_USERNAME=root
DB_PASSWORD=your_mysql_password

# Vite Configuration
VITE_APP_NAME="${APP_NAME}"
```

### 5. Database Setup

```bash
# Create database (in MySQL)
CREATE DATABASE mixnbreed_db;

# Run migrations
php artisan migrate

# (Optional) Seed with sample data
php artisan db:seed
```

### 6. Storage Setup

```bash
# Create symbolic link for public storage (required for profile pictures)
php artisan storage:link
```

### 7. Build Frontend Assets

```bash
# For development (with hot reload)
npm run dev

# For production
npm run build
```

---

## 🏃‍♂️ Running the Application

### Development

```bash
# Start Laravel development server
php artisan serve

# In another terminal, start Vite for hot reloading
npm run dev
```

Access the application at: `http://localhost:8000`

### Production

```bash
# Build production assets
npm run build

# Optimize Laravel for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🏗️ Project Structure

```
mixnbreed/
├── app/
│   ├── Http/
│   │   ├── Controllers/           # Laravel controllers
│   │   │   ├── DashboardController.php
│   │   │   ├── DogProfileController.php
│   │   │   ├── UserProfileController.php
│   │   │   └── Admin/            # Admin controllers
│   │   └── Livewire/             # Livewire components
│   │       ├── DogMatchForm.php
│   │       ├── DogProfileComponent.php
│   │       └── UserProfile.php
│   └── Models/                   # Eloquent models
│       ├── DogProfile.php
│       └── User.php
├── config/
│   └── flasher.php               # PHP Flasher configuration
├── database/
│   ├── migrations/               # Database migrations
│   │   └── *_add_profile_picture_to_users_table.php
│   └── seeders/                 # Database seeders
├── resources/
│   ├── css/
│   │   └── app.css              # TailwindCSS + custom animations
│   ├── js/
│   │   └── app.js               # Vite configuration
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php    # Main layout with responsive navbar
│       ├── dogprofiles/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       ├── userprofile/
│       │   └── edit.blade.php   # Profile & password management
│       ├── livewire/
│       │   ├── dog-match-form.blade.php
│       │   └── dog-profile-component.blade.php
│       └── dashboard.blade.php  # Statistics dashboard
├── routes/
│   └── web.php                  # Web routes (RESTful + Livewire)
└── public/
    ├── images/                  # Static images & logo
    └── storage/                 # Symlinked storage
        └── profile-pictures/    # User profile pictures
```

---

## 🔧 Technology Stack

- **Backend**: Laravel 10, PHP 8.1+
- **Frontend**: Livewire 3, TailwindCSS 3
- **Database**: MySQL 8.0+
- **Build Tools**: Vite 5, npm
- **Authentication**: Laravel Breeze
- **File Storage**: Laravel Storage with public disk
- **AI Integration**: ComfyUI API
- **Notifications**: PHP Flasher with Toastr and Noty

---

## 📱 Key Features

### Dog Profile Management
- Create detailed dog profiles with images
- Track breed, age, size, weight, health status, and traits
- Vaccination status with 3 states: "Up to date", "Not up to date", "Unknown"
- Marketplace visibility toggle for adoptions/sales
- Manage multiple dog profiles per user

### AI Breed Mixing
- Visual selection of two dog profiles with highlighted states
- Real-time selection counter (max 2 profiles)
- Dynamic "Mix Breeds" button enablement
- Custom "Paw-gress Bar" loading animation
- AI-generated preview of potential offspring
- Display combined characteristics and traits

### User Profile Management
- Comprehensive user settings page
- Profile information update (name, email)
- Password change functionality
- Profile picture upload with image preview
- Account deletion with confirmation
- Secure authentication flow

### Dashboard
- Real-time statistics across all users:
  - Total Dogs Registered (from all user accounts)
  - Total Matches Generated
  - Educational Tips Available
- Quick access to core features

### Responsive Design
- Mobile-first responsive navigation with hamburger menu
- Touch-friendly interactions for tablets
- Profile picture display in navbar
- Adaptive layouts for all screen sizes
- Sticky navigation with proper z-indexing

### Flash Notifications (PHP Flasher)
- Elegant notifications using Toastr and Noty libraries
- Multiple notification styles (success, error, warning, info)
- Auto-dismiss with customizable duration
- Position customization (top-right, bottom-center, etc.)
- Queue support for multiple notifications
- Livewire integration for AJAX requests

### Educational Resources
- Dog breeding compatibility guides
- Health risk assessments
- Best practices for responsible breeding
- About Us and Contact pages

---

## 🛠️ Development

### Useful Commands

```bash
# Clear all caches
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Run tests
php artisan test

# Check code style
./vendor/bin/pint

# Watch for file changes (Vite)
npm run dev

# Create new migration
php artisan make:migration create_table_name

# Create new Livewire component
php artisan make:livewire ComponentName

# Access Laravel Tinker (for database queries)
php artisan tinker

# List all routes
php artisan route:list

# List specific route
php artisan route:list --name=dashboard
```

### Database Management

```bash
# Rollback migrations
php artisan migrate:rollback

# Reset and re-run all migrations
php artisan migrate:fresh

# Refresh with seeders
php artisan migrate:fresh --seed

# Query database in Tinker
php artisan tinker
> App\Models\DogProfile::count();
> App\Models\User::all();
```

---

## 🎨 Flash Notifications with PHP Flasher

### Installation

PHP Flasher is already included in `composer.json`. After running `composer install`, it's ready to use.

### Usage in Controllers

```php
// Success notification
flash()->success('Profile created successfully!');

// Error notification
flash()->error('Something went wrong!');

// Warning notification
flash()->warning('Please verify your email address.');

// Info notification
flash()->info('Your session will expire in 5 minutes.');

// With redirect
return redirect()->route('dogprofiles.index')
    ->with('success', 'Dog profile updated successfully!');
```

### Usage in Livewire Components

```php
public function save()
{
    // Your save logic...
    
    flash()->success('Changes saved successfully!');
    
    // Or with Livewire flash
    session()->flash('success', 'Profile updated!');
}
```

### Configuration

Customize notifications in `config/flasher.php`:

```php
return [
    'default' => 'toastr', // or 'noty'
    
    'toastr' => [
        'options' => [
            'position' => 'top-right',
            'timeout' => 5000,
            'close_button' => true,
            'progress_bar' => true,
        ],
    ],
    
    'noty' => [
        'options' => [
            'layout' => 'topRight',
            'timeout' => 5000,
            'theme' => 'mint',
        ],
    ],
];
```

---

## 🔒 Important Files & Configurations

### Key Models
- `app/Models/User.php` - User model with profile_picture support
- `app/Models/DogProfile.php` - Dog profile model

### Key Controllers
- `app/Http/Controllers/DashboardController.php` - Dashboard with statistics
- `app/Http/Controllers/UserProfileController.php` - User profile management
- `app/Http/Controllers/DogProfileController.php` - CRUD for dog profiles

### Key Views
- `resources/views/layouts/app.blade.php` - Main layout with navbar
- `resources/views/dashboard.blade.php` - Statistics dashboard
- `resources/views/userprofile/edit.blade.php` - User settings page

### Configuration Files
- `config/flasher.php` - PHP Flasher notification settings
- `routes/web.php` - All web routes with middleware groups
- `.env` - Environment configuration

### Frontend Assets
- `resources/css/app.css` - TailwindCSS with custom animations
- `resources/js/app.js` - Vite configuration

---

## 🐛 Troubleshooting

### Common Issues

1. **Permission Issues**
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

2. **Storage Link Missing**
   ```bash
   php artisan storage:link
   ```

3. **Assets Not Loading**
   ```bash
   npm run build
   php artisan config:clear
   php artisan route:clear
   php artisan view:clear
   ```

4. **Database Connection Error**
   - Check MySQL service is running: `sudo service mysql status`
   - Verify database credentials in `.env`
   - Ensure database exists: `CREATE DATABASE mixnbreed_db;`
   - Test connection in Tinker: `php artisan tinker` then `DB::connection()->getPdo();`

5. **Flash Notifications Not Appearing**
   - Clear config cache: `php artisan config:clear`
   - Check if `@flasher_render` is in your layout file
   - Verify `config/flasher.php` settings
   - Ensure JavaScript assets are loaded

6. **Profile Picture Not Uploading**
   - Verify storage link exists: `ls -la public/storage`
   - Check file permissions: `chmod -R 775 storage`
   - Ensure upload max size in `php.ini`: `upload_max_filesize = 2M`

7. **"Undefined Variable" Errors**
   - Clear view cache: `php artisan view:clear`
   - Check route points to correct controller method
   - Use `dd()` in controller to debug variable flow

8. **Routes Not Found**
   - Clear route cache: `php artisan route:clear`
   - Verify route exists: `php artisan route:list --name=route.name`
   - Check for duplicate routes with same path

---

## 🚀 Deployment

### Production Checklist

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Generate new `APP_KEY`: `php artisan key:generate`
- [ ] Configure production database credentials
- [ ] Run `composer install --optimize-autoloader --no-dev`
- [ ] Run `npm install && npm run build`
- [ ] Run `php artisan migrate --force`
- [ ] Run `php artisan storage:link`
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Set proper file permissions (775 for storage, 644 for files)
- [ ] Configure web server (Apache/Nginx) to point to `public/` directory
- [ ] Set up SSL certificate (Let's Encrypt recommended)
- [ ] Configure backups for database and storage
- [ ] Set up monitoring and error logging

### Web Server Configuration

**Nginx Example:**
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/mixnbreed/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👥 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Coding Standards

- Follow PSR-12 coding standards for PHP
- Use Laravel naming conventions:
  - Controllers: `PascalCase` with `Controller` suffix
  - Models: Singular `PascalCase`
  - Routes: `kebab-case` for URLs
  - Views: `kebab-case.blade.php`
- Write descriptive commit messages
- Add comments for complex logic
- Update tests for new features

---

## 🆘 Support

If you encounter any issues or have questions:

1. Check the [troubleshooting section](#-troubleshooting)
2. Review existing [GitHub issues](https://github.com/chryssallasgo/Mix-N-Breed/issues)
3. Create a new issue with:
   - Laravel version: `php artisan --version`
   - PHP version: `php -v`
   - Error message/screenshot
   - Steps to reproduce

---

## 🙏 Acknowledgments

- Laravel community for the amazing framework
- Livewire for reactive components without JavaScript complexity
- TailwindCSS for utility-first styling
- PHP Flasher for elegant notification system
- ComfyUI for AI image generation capabilities
- All contributors and testers

---

## 📝 Changelog

### Recent Updates

- ✅ Added user profile picture upload functionality
- ✅ Integrated PHP Flasher with Toastr and Noty for notifications
- ✅ Fixed dashboard statistics to show all users' dog profiles
- ✅ Improved dog profile edit form (vaccination status & date fields)
- ✅ Added custom "Paw-gress Bar" loading animation
- ✅ Enhanced responsive navigation with profile picture support
- ✅ Implemented proper z-index hierarchy for overlays
- ✅ Added marketplace functionality for dog profiles

### Planned Features

- 🔄 Soft delete implementation for dog profiles (coming soon)
- 🔄 Advanced search and filtering for marketplace
- 🔄 Email notifications for matches
- 🔄 Social sharing features

---

**Happy Coding! 🎉**

Made with ❤️ by the MixNBreed Team