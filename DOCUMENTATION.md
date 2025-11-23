A# 📚 FILIA INTERIOR - PROJECT DOCUMENTATION

**Complete File-by-File Documentation**  
**Version:** 1.0  
**Last Updated:** November 7, 2025

---

## 📋 TABLE OF CONTENTS

1. [Root Configuration Files](#root-configuration-files)
2. [API Directory](#api-directory)
3. [App Directory](#app-directory)
4. [Config Directory](#config-directory)
5. [Database Directory](#database-directory)
6. [Public Directory](#public-directory)
7. [Resources Directory](#resources-directory)
8. [Routes Directory](#routes-directory)
9. [Storage Directory](#storage-directory)
10. [Vendor Directory](#vendor-directory)

---

## 🔧 ROOT CONFIGURATION FILES

### `.env`
**Location:** `/`  
**Type:** Environment Configuration  
**Purpose:** Local development environment variables

**Contains:**
- Database credentials (local + Aiven Cloud)
- Mail server settings (Gmail SMTP)
- Application key & debug mode
- Session & cache drivers

**Important Variables:**
```env
APP_KEY=base64:... # Laravel encryption key
DB_CONNECTION=aiven # Uses Aiven cloud database
MAIL_MAILER=smtp # Email via Gmail
```

**Usage:** Loaded by Laravel during bootstrap, defines app behavior

---

### `.env.vercel`
**Location:** `/`  
**Type:** Vercel Production Environment Template  
**Purpose:** Template for Vercel deployment `.env` file

**Key Differences from `.env`:**
- Contains dummy/placeholder values for sensitive data
- Real values set via Vercel Dashboard Environment Variables
- Copied to `.env` during Vercel build (see `vercel.json`)

**Critical Settings:**
```env
APP_ENV=production
SESSION_DRIVER=database # Persist sessions in cloud DB
CACHE_DRIVER=array # No persistent cache on serverless
```

---

### `.gitignore`
**Location:** `/`  
**Type:** Git Configuration  
**Purpose:** Specifies files/folders to exclude from Git

**Key Exclusions:**
- `/node_modules` - NPM dependencies
- `/vendor` - Composer dependencies  
- `.env` - Sensitive local config
- `/storage` - User-generated content
- **NOT** `/public/build` - Vite assets committed for Vercel

**Modified for Vercel:** Removed `/public/build` so compiled CSS/JS deploy

---

### `composer.json`
**Location:** `/`  
**Type:** PHP Dependency Manager  
**Purpose:** Defines PHP packages and autoloading

**Key Dependencies:**
- `laravel/framework: ^11.0` - Core framework
- `laravel/breeze` - Authentication scaffolding
- `vlucas/phpdotenv` - Environment variable loader

**Autoload:**
- PSR-4: `App\` → `app/` directory
- Files: `app/helpers.php` (if exists)

---

### `package.json`
**Location:** `/`  
**Type:** NPM Configuration  
**Purpose:** Frontend dependencies & build scripts

**Key Dependencies:**
- `vite: ^5.0` - Frontend build tool
- `laravel-vite-plugin` - Laravel integration
- `tailwindcss` - CSS framework
- `@tailwindcss/forms` - Form styling

**Scripts:**
```json
"dev": "vite",          // Development server
"build": "vite build"   // Production build
```

---

### `vite.config.js`
**Location:** `/`  
**Type:** Vite Configuration  
**Purpose:** Frontend asset compilation settings

**Configuration:**
```javascript
laravel({
    input: ['resources/css/app.css', 'resources/js/app.js'],
    refresh: true
})

build: {
    manifest: 'manifest.json',  // Manifest location
    outDir: 'public/build'      // Output directory
}
```

**Purpose:** Compiles CSS/JS, generates manifest for Laravel asset helpers

---

### `tailwind.config.js`
**Location:** `/`  
**Type:** Tailwind CSS Configuration  
**Purpose:** Tailwind framework settings

**Content Paths:**
```javascript
content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
]
```

**Custom Theme:**
- Extended colors
- Custom fonts (Playfair Display, Inter)
- Responsive breakpoints

---

### `vercel.json`
**Location:** `/`  
**Type:** Vercel Deployment Configuration  
**Purpose:** Defines how Vercel deploys the app

**Key Settings:**
```json
{
  "buildCommand": "cp .env.vercel .env",
  "functions": {
    "api/*.php": { "runtime": "vercel-php@0.7.4" }
  },
  "routes": [
    { "src": "/build/(.*)", "dest": "/public/build/$1" },
    { "src": "/(.*)", "dest": "/api/index.php" }
  ],
  "env": {
    "APP_ENV": "production",
    "SESSION_DRIVER": "database"
  }
}
```

**Functions:**
- `buildCommand`: Copies `.env.vercel` to `.env` during build
- `functions`: Runs PHP 8.3 via Vercel serverless
- `routes`: Static assets → direct, dynamic → Laravel
- `env`: Force HTTPS, database sessions

---

## 🔌 API DIRECTORY

### `api/index.php`
**Location:** `/api/`  
**Type:** Vercel Serverless Entry Point  
**Purpose:** Bootstrap Laravel for Vercel serverless environment

**Key Features:**
1. **Custom Error Handlers:** Catch all errors as JSON
2. **Environment Setup:** `/tmp` storage paths
3. **Directory Creation:** Create required temp directories
4. **Laravel Bootstrap:** Load Laravel application

**Critical Code:**
```php
// Set storage to /tmp (writable on Vercel)
$_ENV['APP_STORAGE'] = '/tmp/storage';

// Create required directories
$dirs = ['/tmp/storage/framework/cache/data', ...];
foreach ($dirs as $dir) mkdir($dir, 0755, true);

// Boot Laravel
require __DIR__ . '/../public/index.php';
```

**Error Handling:**
- JSON output for all errors
- Detailed stack traces when `APP_DEBUG=true`

---

### `api/debug.php`
**Location:** `/api/`  
**Type:** Diagnostic Endpoint  
**Purpose:** Debug Vercel deployment issues

**Accessible At:** `https://filia-interior.vercel.app/debug`

**Shows:**
- PHP version
- Laravel version
- Environment variables
- Loaded extensions
- File permissions
- Database connectivity

**Security:** Should be disabled in production (`APP_DEBUG=false`)

---

### `api/migrate.php`
**Location:** `/api/`  
**Type:** Database Migration Endpoint  
**Purpose:** Run migrations on Vercel (no SSH access)

**Accessible At:** `https://filia-interior.vercel.app/migrate`

**Actions:**
- `?action=status` - Show migration status
- `?action=migrate` - Run pending migrations
- `?action=seed` - Run database seeders
- `?action=migrate-fresh` - Drop all tables & re-migrate

**Security:** Only works when `APP_DEBUG=true`

**Example:**
```
https://filia-interior.vercel.app/migrate?action=migrate-fresh
```

---

## 📦 APP DIRECTORY

### `app/Http/Controllers/HomeController.php`
**Location:** `/app/Http/Controllers/`  
**Type:** Controller  
**Purpose:** Handle public-facing pages

**Methods:**
- `index()` - Homepage with company photos
- `history()` - Company history page
- `location()` - Office location page
- `portfolio()` - Project portfolio page

**Key Feature:**
```php
// Hardcoded image paths (serverless-compatible)
$companyImages = [
    'images/company/company-1.jpg',
    'images/company/company-2.jpg',
    ...
];
```

**Why Hardcoded?** `File::files()` unreliable on serverless

---

### `app/Http/Controllers/ProgressController.php`
**Location:** `/app/Http/Controllers/`  
**Type:** Controller  
**Purpose:** Manage project progress updates

**Methods:**
1. `index()` - List all progress (filtered by role)
2. `create()` - Show create form (owner only)
3. `store()` - Save new progress + send email
4. `show()` - View single progress
5. `edit()` - Show edit form (owner only)
6. `update()` - Update progress + send email
7. `destroy()` - Delete progress

**Critical Feature - File Upload:**
```php
// Detect environment
$isVercel = env('VERCEL_ENV') !== null || !is_writable(public_path('images/progress'));

if ($isVercel) {
    // VERCEL: Store as base64 in database
    $imageData = base64_encode(file_get_contents($foto->getRealPath()));
    $validated['foto'] = 'data:image/jpeg;base64,' . $imageData;
} else {
    // LOCAL: Store as file
    $foto->move(public_path('images/progress'), $filename);
    $validated['foto'] = 'images/progress/' . $filename;
}
```

**Email Integration:**
- Sends `ProgressUpdateNotification` email to customer
- Catches mail errors with try-catch

---

### `app/Http/Controllers/Auth/AuthenticatedSessionController.php`
**Location:** `/app/Http/Controllers/Auth/`  
**Type:** Authentication Controller  
**Purpose:** Handle login/logout

**Methods:**
- `create()` - Show login form
- `store()` - Process login
- `destroy()` - Process logout

**From:** Laravel Breeze (authentication scaffolding)

---

### `app/Mail/ProgressUpdateNotification.php`
**Location:** `/app/Mail/`  
**Type:** Mailable Class  
**Purpose:** Email sent when progress updated

**Properties:**
- `$progressUpdate` - Progress model instance
- `$customerName` - Customer name

**Methods:**
- `envelope()` - Email subject
- `content()` - Email view (`emails.progress-update`)
- `attachments()` - **Convert base64 to file attachment**

**Critical Feature:**
```php
public function attachments(): array
{
    if (str_starts_with($this->progressUpdate->foto, 'data:')) {
        // Extract base64, save to temp file, attach
        $tempPath = sys_get_temp_dir() . '/progress_' . $this->progressUpdate->id . '.jpg';
        file_put_contents($tempPath, base64_decode($base64Data));
        
        return [Attachment::fromPath($tempPath)->as('progress_foto.jpg')];
    }
    return [];
}
```

**Why?** Gmail blocks large inline base64 images

---

### `app/Models/User.php`
**Location:** `/app/Models/`  
**Type:** Eloquent Model  
**Purpose:** User authentication & authorization

**Table:** `users`

**Fillable:**
- `name`, `email`, `password`, `role`

**Relationships:**
- `progressUpdates()` - HasMany ProgressUpdate

**Roles:**
- `owner` - Admin (can create progress)
- `customer` - Client (can view own progress)

---

### `app/Models/ProgressUpdate.php`
**Location:** `/app/Models/`  
**Type:** Eloquent Model  
**Purpose:** Project progress tracking

**Table:** `progress_updates`

**Fillable:**
- `user_id`, `id_project`, `deskripsi`, `foto`, `tanggal_update`, `status`

**Relationships:**
- `user()` - BelongsTo User

**Casts:**
- `tanggal_update` - Date

**Special:** `foto` can be file path OR base64 data URI

---

### `app/Providers/AppServiceProvider.php`
**Location:** `/app/Providers/`  
**Type:** Service Provider  
**Purpose:** Application-wide bootstrapping

**Key Feature:**
```php
public function boot(): void
{
    // Force HTTPS in production (Vercel)
    if (env('APP_ENV') === 'production') {
        URL::forceScheme('https');
    }
}
```

**Why?** Vercel uses HTTPS but Laravel sees HTTP (proxy)

---

### `app/Http/Middleware/TrustProxies.php`
**Location:** `/app/Http/Middleware/`  
**Type:** Middleware  
**Purpose:** Trust Vercel proxy headers

**Configuration:**
```php
protected $proxies = '*'; // Trust all proxies

protected $headers =
    Request::HEADER_X_FORWARDED_FOR |
    Request::HEADER_X_FORWARDED_PROTO |
    Request::HEADER_X_FORWARDED_AWS_ELB;
```

**Why?** Laravel needs to know request came via HTTPS

---

### `bootstrap/app.php`
**Location:** `/bootstrap/`  
**Type:** Application Bootstrap  
**Purpose:** Create Laravel application instance

**Critical Addition:**
```php
// Override storage path for Vercel serverless
if (isset($_ENV['APP_STORAGE']) && is_dir($_ENV['APP_STORAGE'])) {
    $app->useStoragePath($_ENV['APP_STORAGE']);
}
```

**Why?** `/storage` read-only on Vercel, use `/tmp/storage`

---

## ⚙️ CONFIG DIRECTORY

### `config/database.php`
**Location:** `/config/`  
**Type:** Database Configuration  
**Purpose:** Define database connections

**Connections:**
1. `sqlite` - SQLite (testing)
2. `mysql` - Local MySQL
3. `aiven` - **Aiven Cloud MySQL** (production)
4. `mariadb` - MariaDB variant

**Aiven Configuration:**
```php
'aiven' => [
    'driver' => 'mysql',
    'host' => env('AIVEN_DB_HOST'),
    'port' => env('AIVEN_DB_PORT'),
    'database' => env('AIVEN_DB_DATABASE'),
    'username' => env('AIVEN_DB_USERNAME'),
    'password' => env('AIVEN_DB_PASSWORD'),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
],
```

**Default:** Uses `DB_CONNECTION` env variable

---

### `config/mail.php`
**Location:** `/config/`  
**Type:** Mail Configuration  
**Purpose:** Email sending settings

**Default Mailer:** `smtp` (Gmail)

**Gmail SMTP:**
```php
'smtp' => [
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env('MAIL_PORT', 587),
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'), // App password!
],
```

**From Address:** `MAIL_FROM_ADDRESS` env variable

---

## 🗄️ DATABASE DIRECTORY

### `database/migrations/2025_08_09_061930_create_progress_updates_table.php`
**Purpose:** Create `progress_updates` table

**Columns:**
- `id` - Primary key
- `id_project` - Project ID
- `foto` - Photo path/base64 (originally VARCHAR, changed to LONGTEXT)
- `deskripsi` - Description
- `tanggal_update` - Update date
- `user_id` - Foreign key to users
- `status` - Project status (added later)

---

### `database/migrations/2025_11_07_000001_change_foto_to_longtext_in_progress_updates.php`
**Purpose:** Change `foto` column to support base64

**Migration:**
```php
Schema::table('progress_updates', function (Blueprint $table) {
    $table->longText('foto')->nullable()->change();
});
```

**Why?** Base64 images ~2-3MB, VARCHAR(255) only 255 chars

---

### `database/seeders/UserSeeder.php`
**Purpose:** Create default users

**Creates:**
1. **Owner:** `filiainterior@gmail.com` / `password`
2. **Customer 1:** `customer1@gmail.com` / `password`
3. **Customer 2:** `customer2@gmail.com` / `password`

**Usage:**
```bash
php artisan db:seed
# Or via Vercel:
https://filia-interior.vercel.app/migrate?action=seed
```

---

## 🌐 PUBLIC DIRECTORY

### `public/index.php`
**Location:** `/public/`  
**Type:** Application Entry Point  
**Purpose:** Traditional Laravel entry (local dev)

**Flow:**
1. Define `LARAVEL_START` constant
2. Load Composer autoloader
3. Bootstrap Laravel application
4. Handle incoming HTTP request
5. Send response

**Note:** On Vercel, `api/index.php` used instead

---

### `public/build/`
**Location:** `/public/`  
**Type:** Compiled Assets  
**Purpose:** Vite-compiled CSS & JS

**Contents:**
- `manifest.json` - Asset manifest
- `assets/app-CwNZVB0H.css` - Compiled CSS (hashed filename)
- `assets/app-DtCVKgHt.js` - Compiled JS (hashed filename)

**Note:** Normally gitignored, but committed for Vercel deployment

---

### `public/images/`
**Location:** `/public/`  
**Type:** Static Assets  
**Purpose:** Store public images

**Subdirectories:**
- `company/` - Company photos (homepage)
- `logo/` - Brand logos
- `progress/` - Progress photos (**LOCAL ONLY**, Vercel uses DB)

---

## 📱 RESOURCES DIRECTORY

### `resources/views/layouts/public.blade.php`
**Location:** `/resources/views/layouts/`  
**Type:** Blade Layout  
**Purpose:** Main layout template

**Sections:**
- `@yield('content')` - Page content
- `@vite()` - Load compiled CSS/JS
- Navigation menu
- Footer

**Key Feature:**
```blade
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

**Loads:** Vite-compiled assets via manifest

---

### `resources/views/progress/index.blade.php`
**Location:** `/resources/views/progress/`  
**Type:** Blade Template  
**Purpose:** Progress list page

**Features:**
- Displays progress updates as cards
- Filters by user role (owner sees all, customer sees own)
- Modal for detailed view
- Handles both base64 and file path images

**Image Display:**
```blade
<img src="{{ str_starts_with($progress->foto, 'data:') ? $progress->foto : asset($progress->foto) }}">
```

---

### `resources/views/emails/progress-update.blade.php`
**Location:** `/resources/views/emails/`  
**Type:** Email Template  
**Purpose:** Progress update notification email

**Content:**
- Customer greeting
- Progress details (ID, date, status)
- Description
- Photo (inline for local, attachment notice for Vercel)

**Key Logic:**
```blade
@if(str_starts_with($progressUpdate->foto, 'data:'))
    <p>✅ Foto progress terlampir sebagai attachment di email ini.</p>
@else
    <img src="{{ url($progressUpdate->foto) }}">
@endif
```

---

### `resources/css/app.css`
**Location:** `/resources/css/`  
**Type:** Main CSS File  
**Purpose:** Tailwind CSS entry point

**Content:**
```css
@tailwind base;
@tailwind components;
@tailwind utilities;

/* Custom styles */
@layer components {
    .gradient-bg { ... }
}
```

**Compiled To:** `public/build/assets/app-*.css`

---

### `resources/js/app.js`
**Location:** `/resources/js/`  
**Type:** Main JavaScript File  
**Purpose:** Frontend JavaScript entry point

**Currently:** Minimal (Laravel Breeze defaults)

**Compiled To:** `public/build/assets/app-*.js`

---

## 🛣️ ROUTES DIRECTORY

### `routes/web.php`
**Location:** `/routes/`  
**Type:** Web Routes Definition  
**Purpose:** Define HTTP routes

**Public Routes:**
```php
Route::get('/', [HomeController::class, 'index']);
Route::get('/history', [HomeController::class, 'history']);
Route::get('/location', [HomeController::class, 'location']);
Route::get('/portfolio', [HomeController::class, 'portfolio']);
```

**Authenticated Routes:**
```php
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', ...);
    Route::resource('progress', ProgressController::class);
});
```

**Breeze Routes:**
```php
require __DIR__.'/auth.php';
```

---

## 📄 DOCUMENTATION FILES

### `VERCEL_ENV_SETUP.md`
**Purpose:** Guide for setting Vercel environment variables

**Contains:**
- List of required env vars
- Instructions to set them in Vercel Dashboard
- Security notes

**Usage:** Reference when deploying to Vercel

---

### `DOCUMENTATION.md` (This File!)
**Purpose:** Complete project documentation

**Contains:**
- File-by-file explanations
- Configuration details
- Architecture decisions
- Deployment guides

---

## 🔐 SECURITY & DEPLOYMENT

### Key Security Measures:

1. **No Sensitive Data in Git:**
   - `.env` gitignored
   - Real credentials via Vercel Dashboard
   
2. **HTTPS Enforcement:**
   - `AppServiceProvider` forces HTTPS
   - `TrustProxies` middleware
   - HSTS headers in `vercel.json`

3. **CSRF Protection:**
   - Laravel built-in CSRF
   - Session driver: `database` (persistent)

4. **Role-Based Access:**
   - Middleware checks in controllers
   - `role` field in users table

---

## 🚀 DEPLOYMENT FLOW

### Local Development:
```bash
1. composer install
2. npm install
3. npm run dev
4. php artisan serve
```

### Vercel Production:
```bash
1. git push origin master
2. Vercel auto-deploys
3. Runs: cp .env.vercel .env
4. PHP runtime: vercel-php@0.7.4
5. App available at: filia-interior.vercel.app
```

---

## 📊 KEY ARCHITECTURAL DECISIONS

### 1. **File Storage Strategy:**
- **Local:** Files in `public/images/progress/`
- **Vercel:** Base64 in database (filesystem read-only)

### 2. **Session Management:**
- **Local:** Cookie/file driver
- **Vercel:** Database driver (persistent across functions)

### 3. **Email Attachments:**
- **Local:** Inline images (file URLs)
- **Vercel:** Attachments (Gmail blocks large base64)

### 4. **Database:**
- **Production:** Aiven Cloud MySQL (persistent)
- **Local:** MySQL or SQLite

---

## 🎯 ENVIRONMENT-SPECIFIC BEHAVIORS

| Feature | Local | Vercel |
|---------|-------|--------|
| **File Uploads** | `/public/images/` | Base64 in DB |
| **Sessions** | File/Cookie | Database |
| **Storage** | `/storage/` | `/tmp/storage/` |
| **Email Images** | Inline | Attachment |
| **Asset Serving** | Vite dev server | Pre-compiled |
| **Migrations** | `php artisan migrate` | `/migrate` endpoint |

---

## 📞 SUPPORT & MAINTENANCE

### Running Migrations:
```
Local: php artisan migrate
Vercel: https://filia-interior.vercel.app/migrate?action=migrate
```

### Checking Logs:
```
Local: storage/logs/laravel.log
Vercel: Vercel Dashboard → Functions → Logs
```

### Debugging:
```
Local: Set APP_DEBUG=true in .env
Vercel: Visit /debug endpoint
```

---

## 🏁 CONCLUSION

This Laravel application is optimized for both local development and Vercel serverless deployment with:

- ✅ Smart environment detection
- ✅ Serverless-compatible file handling
- ✅ Persistent cloud database
- ✅ Secure HTTPS enforcement
- ✅ Email notifications with attachments
- ✅ Role-based access control

**For Questions:** See inline code comments or contact development team.

---

**Documentation Version:** 1.0  
**Project:** Filia Interior Management System  
**Framework:** Laravel 11.x  
**Deployment:** Vercel Serverless  
**Database:** Aiven Cloud MySQL
