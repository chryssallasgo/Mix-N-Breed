# 🐶 Mix N' Breed - AI-Powered Dog Breed Matching Platform

Welcome to **Mix N' Breed**! An innovative Laravel + Livewire application that uses AI to generate previews of mixed dog breeds and provides educational resources for responsible dog breeding.

---

## ✨ Features

- 🎯 **AI-Powered Breed Mixing** - Generate visual previews of mixed breed combinations
- 🐕 **Dog Profile Management** - Create and manage comprehensive dog profiles
- 📱 **Responsive Design** - Works seamlessly on desktop, tablet, and mobile devices
- 🎨 **Modern UI/UX** - Built with TailwindCSS and Livewire for reactive interactions
- 📊 **Statistics Dashboard** - Track platform usage and breeding insights
- 🎓 **Educational Content** - Learn about dog breeding compatibility and best practices
- 👤 **User Authentication** - Secure user accounts and profile management
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
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Build frontend assets
npm run dev
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
# Create symbolic link for public storage
php artisan storage:link
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
│   │   ├── Controllers/        # Laravel controllers
│   │   └── Livewire/          # Livewire components
│   └── Models/                # Eloquent models
├── database/
│   ├── migrations/            # Database migrations
│   └── seeders/              # Database seeders
├── resources/
│   ├── css/                  # Stylesheets (TailwindCSS)
│   ├── js/                   # JavaScript files
│   └── views/                # Blade templates
│       ├── layouts/          # Layout templates
│       └── livewire/         # Livewire component views
├── routes/
│   └── web.php              # Web routes
└── public/
    ├── images/              # Static images
    └── storage/             # User uploaded files
```

---

## 🔧 Technology Stack

- **Backend**: Laravel 10, PHP 8.1+
- **Frontend**: Livewire, TailwindCSS, Alpine.js
- **Database**: MySQL 8.0+
- **Build Tools**: Vite, npm
- **Authentication**: Laravel Breeze
- **File Storage**: Laravel Storage
- **AI Integration**: ComfyUI API

---

## 📱 Key Features

### Dog Profile Management
- Create detailed dog profiles with images
- Track breed, age, size, health status, and traits
- Manage multiple dog profiles per user

### AI Breed Mixing
- Select two dog profiles for breed combination
- AI-generated preview of potential offspring
- Display combined characteristics and traits

### Responsive Design
- Mobile-first responsive navigation
- Touch-friendly interactions for tablets
- Optimized for all screen sizes

### Educational Resources
- Dog breeding compatibility guides
- Health risk assessments
- Best practices for responsible breeding

---

## 🛠️ Development

### Useful Commands

```bash
# Clear all caches
php artisan optimize:clear

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

# Access Laravel Tinker
php artisan tinker
```

### Database Management

```bash
# Rollback migrations
php artisan migrate:rollback

# Reset and re-run all migrations
php artisan migrate:fresh

# Refresh with seeders
php artisan migrate:fresh --seed
```

---

## 🐛 Troubleshooting

### Common Issues

1. **Permission Issues**
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

2. **Storage Link Missing**
   ```bash
   php artisan storage:link
   ```

3. **Assets Not Loading**
   ```bash
   npm run build
   php artisan config:clear
   ```

4. **Database Connection Error**
   - Check MySQL service is running
   - Verify database credentials in `.env`
   - Ensure database exists

---

## 🚀 Deployment

### Production Checklist

- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure production database
- [ ] Run `composer install --optimize-autoloader --no-dev`
- [ ] Run `npm run build`
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Set up proper file permissions
- [ ] Configure web server (Apache/Nginx)

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

---

## � Support

If you encounter any issues or have questions:

1. Check the [troubleshooting section](#-troubleshooting)
2. Review existing [GitHub issues](https://github.com/chryssallasgo/Mix-N-Breed/issues)
3. Create a new issue with detailed information

---

## 🙏 Acknowledgments

- Laravel community for the amazing framework
- Livewire for reactive components
- TailwindCSS for utility-first styling
- ComfyUI for AI image generation capabilities

---

**Happy Coding! 🎉**


