# 🏠 Filia Interior - Interior Design Management System

Aplikasi manajemen proyek interior design berbasis Laravel untuk mengelola progress pemesanan dan komunikasi antara owner dan customer.

---

## ✨ Features

### 👤 Authentication
- Login/Register dengan role-based access
- Forgot Password dengan email notification
- 2 Role: Owner & Customer

### 📊 Dashboard
- **Owner Dashboard**: Manage semua project dan customer
- **Customer Dashboard**: Lihat progress project sendiri
- Real-time progress tracking

### 🔄 Progress Management
- Create, Read, Update, Delete progress updates
- Upload foto progress
- Email notification otomatis ke customer
- Filter by customer & project

### 📧 Email Notifications
- Reset password email (custom modern design)
- Progress update notifications
- Gmail SMTP integration

### 🎨 Modern UI/UX
- TailwindCSS 3.4
- Responsive design
- Clean & professional interface
- Dark mode ready

---

## 🛠️ Tech Stack

### Backend
- **Framework**: Laravel 11.x
- **PHP**: 8.2+
- **Database**: MySQL 8.0

### Frontend
- **Template Engine**: Blade
- **CSS Framework**: TailwindCSS 3.4
- **Build Tool**: Vite 7.0
- **JavaScript**: AlpineJS 3.4

### DevOps
- **Local Dev**: XAMPP
- **Cloud Database**: Aiven MySQL (Production)
- **Deployment**: Vercel Serverless
- **Email**: Gmail SMTP

---

## 🚀 Installation

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/XAMPP

### Setup Local Development

1. **Clone Repository**
```bash
git clone https://github.com/your-username/filia-interior.git
cd filia-interior
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Environment Configuration**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure Database**

Edit `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=filia-interior
DB_USERNAME=root
DB_PASSWORD=
```

5. **Run Migrations & Seeders**
```bash
php artisan migrate
php artisan db:seed
```

6. **Build Assets**
```bash
npm run dev
```

7. **Run Application**
```bash
php artisan serve
```

Visit: `http://127.0.0.1:8000`

---

## 👥 Default Accounts

After seeding:

**Owner Account:**
- Email: `filiainterior@gmail.com`
- Password: `password123`

**Customer Accounts:**
- Email: `fadhlirajwaarahmana@gmail.com`
- Password: `password123`

> **Note:** Change passwords immediately in production!

---

## 📧 Email Configuration

### Gmail SMTP Setup

1. **Enable 2-Step Verification** on your Gmail account

2. **Generate App Password**:
   - Go to Google Account → Security
   - 2-Step Verification → App passwords
   - Generate password for "Mail"

3. **Update `.env`**:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

4. **Clear Config Cache**:
```bash
php artisan config:clear
php artisan config:cache
```

---

## 🗄️ Database Configuration

### Dual Database Support

Project support 2 database connections:

**Local (Development):**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
```

**Cloud (Production):**
```env
DB_CONNECTION=aiven
```

Configure Aiven credentials in `.env` (see `.env.example`)

### Sync Data to Cloud
```bash
php sync_to_aiven.php
```

---

## 🌐 Deployment

### Vercel Deployment

1. **Install Vercel CLI**
```bash
npm install -g vercel
```

2. **Build Assets**
```bash
npm run build
```

3. **Deploy**
```bash
vercel login
vercel
```

4. **Configure Environment Variables** in Vercel Dashboard:
   - `APP_KEY`
   - `APP_URL`
   - `DB_CONNECTION=aiven`
   - Database credentials
   - Mail credentials

5. **Deploy to Production**
```bash
vercel --prod
```

See `DEPLOY_QUICK_GUIDE.txt` for detailed instructions.

---

## 📁 Project Structure

```
filia-interior/
├── app/
│   ├── Http/Controllers/      # Controllers
│   ├── Models/                # Eloquent Models
│   ├── Mail/                  # Mail classes
│   └── Notifications/         # Custom notifications
├── config/                    # Configuration files
├── database/
│   ├── migrations/            # Database migrations
│   └── seeders/               # Database seeders
├── resources/
│   ├── views/                 # Blade templates
│   └── css/                   # Stylesheets
├── routes/
│   ├── web.php               # Web routes
│   └── auth.php              # Auth routes
├── public/
│   ├── images/               # Public images
│   └── build/                # Compiled assets
└── api/
    └── index.php             # Vercel serverless entry
```

---

## 🔐 Security

- ✅ CSRF Protection
- ✅ SQL Injection Prevention (Eloquent ORM)
- ✅ XSS Protection (Blade escaping)
- ✅ Password Hashing (bcrypt)
- ✅ SSL Database Connection (Aiven)
- ✅ Environment Variables for sensitive data

**Important:** Never commit `.env` file to Git!

---

## 📝 Development Workflow

### Local Development
```bash
# Start dev server
php artisan serve

# Watch for asset changes
npm run dev

# Clear cache
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Testing
```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter TestName
```

### Database
```bash
# Fresh migration
php artisan migrate:fresh

# Seed database
php artisan db:seed

# Rollback migration
php artisan migrate:rollback
```

---

## 🐛 Troubleshooting

### Database Connection Error
```bash
# Check MySQL is running
# Verify credentials in .env
php artisan config:clear
```

### Email Not Sending
```bash
# Verify Gmail App Password
# Check SMTP settings in .env
php artisan config:cache
```

### Assets Not Loading
```bash
npm run build
php artisan view:clear
```

### Permission Errors
```bash
chmod -R 775 storage bootstrap/cache
```

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Author

**Fadhli Rajwaa Rahmana**
- Email: fadhlirajwaarahmana@gmail.com

---

## 🙏 Acknowledgments

- Laravel Framework
- TailwindCSS
- Aiven Database
- Vercel Hosting

---

## 📞 Support

For issues and questions:
- Create an issue in GitHub
- Contact via email

---

**Built with ❤️ using Laravel**
