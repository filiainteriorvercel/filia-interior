# 🗄️ PANDUAN SETUP DATABASE AIVEN

**Panduan Lengkap Langkah-demi-Langkah Setup Database Aiven Cloud**  
**Proyek:** Sistem Manajemen Filia Interior  
**Database:** MySQL di Aiven Cloud

---

## 📋 DAFTAR ISI

1. [Penjelasan Umum](#penjelasan-umum)
2. [Yang Harus Disiapkan](#yang-harus-disiapkan)
3. [Langkah 1: Buat Database Aiven](#langkah-1-buat-database-aiven)
4. [Langkah 2: Setting Environment Lokal](#langkah-2-setting-environment-lokal)
5. [Langkah 3: Jalankan Migrasi](#langkah-3-jalankan-migrasi)
6. [Langkah 4: Isi Data Awal](#langkah-4-isi-data-awal)
7. [Langkah 5: Setting Vercel](#langkah-5-setting-vercel)
8. [Troubleshooting](#troubleshooting)
9. [Tips Keamanan](#tips-keamanan)

---

## 🎯 PENJELASAN UMUM

### Apa itu Aiven?
Aiven adalah layanan database cloud yang menyediakan MySQL, PostgreSQL, dan database lainnya yang sudah dikelola otomatis. Cocok untuk deployment serverless seperti Vercel.

### Kenapa Pakai Aiven untuk Proyek Ini?
✅ **Ada Gratis** - Bagus untuk development/proyek kecil  
✅ **Berbasis Cloud** - Bisa diakses dari mana saja (Vercel + Lokal)  
✅ **Sudah Dikelola** - Backup otomatis, update otomatis, monitoring  
✅ **Aman dengan SSL** - Koneksi terenkripsi  

### Alur Deployment
```
┌─────────────────┐
│ 1. Buat Database│
│    Aiven        │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ 2. Ambil        │
│    Kredensial   │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ 3. Setting      │
│    .env (Lokal) │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ 4. Jalankan     │
│    Migrasi      │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ 5. Isi Data     │
│    Awal (Seed)  │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ 6. Setting      │
│    Vercel       │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ ✅ SELESAI!     │
└─────────────────┘
```

---

## 📦 YANG HARUS DISIAPKAN

### Wajib Punya:
- ✅ Akun Aiven (daftar gratis di https://aiven.io)
- ✅ Proyek Laravel (proyek ini)
- ✅ Composer sudah terinstall
- ✅ PHP 8.3+ dengan ekstensi MySQL
- ✅ Git

### Opsional (Tapi Disarankan):
- Aplikasi database client (MySQL Workbench, DBeaver, atau TablePlus)
- Akun Vercel untuk deployment

---

## 🚀 LANGKAH 1: BUAT DATABASE AIVEN

### 1.1 Daftar / Login ke Aiven

**URL:** https://aiven.io

```
1. Klik "Sign Up" atau "Login"
2. Pakai email atau akun GitHub/Google
3. Verifikasi email jika diminta
```

### 1.2 Buat Service MySQL Baru

**Langkah-langkah:**
```
1. Klik "Create Service"
2. Pilih "MySQL"
3. Pilih Paket:
   - GRATIS: Hobbyist (1 GB storage, 1 GB RAM)
   - Untuk testing: Mulai dengan yang gratis
4. Pilih Cloud Provider:
   - AWS, Google Cloud, atau Azure
   - Pilih region yang paling dekat dengan lokasi Anda
5. Nama Service:
   - Contoh: "filia-interior-db"
6. Klik "Create Service"
```

**Waktu Tunggu:** 5-10 menit sampai service jalan

### 1.3 Get Connection Details

Once service is **RUNNING**:

```
1. Click on your service name
2. Go to "Overview" tab
3. Find "Connection Information" section
```

**You'll see:**
```
Service URI:
mysql://avnadmin:<password>@<hostname>:<port>/defaultdb?ssl-mode=REQUIRED

Or separate values:
Host: companyinterior-fadhlirajwaarahmana-9486.i.aivencloud.com
Port: 16722
User: avnadmin
Password: your-password-here
Database: defaultdb
SSL Mode: REQUIRED
```

### 1.4 Create Your Database (Optional)

**Via Aiven Console:**
```
1. Go to "Databases" tab
2. Click "Add Database"
3. Name: filia-interior
4. Click "Add Database"
```

**Or via MySQL Client later**

---

## ⚙️ STEP 2: CONFIGURE LOCAL ENVIRONMENT

### 2.1 Copy Credentials

**From Aiven Dashboard, copy:**
- Host
- Port  
- Username (usually `avnadmin`)
- Password
- Database name

### 2.2 Update `.env` File

**Location:** `e:\Xampp\htdocs\filia-interior-master-main\.env`

**Add/Update these lines:**

```env
# Database Connection
DB_CONNECTION=aiven

# Aiven Cloud Database Configuration
AIVEN_DB_HOST=companyinterior-fadhlirajwaarahmana-9486.i.aivencloud.com
AIVEN_DB_PORT=16722
AIVEN_DB_DATABASE=filia-interior
AIVEN_DB_USERNAME=avnadmin
AIVEN_DB_PASSWORD=your-password-here
```

**Important Notes:**
- ⚠️ Replace with YOUR actual credentials from Aiven
- ⚠️ Database name can be `defaultdb` or custom name
- ⚠️ Port is usually `16722` for Aiven MySQL
- ⚠️ Never commit `.env` to Git!

### 2.3 Verify Database Configuration

**Check:** `config/database.php`

Should already have:
```php
'aiven' => [
    'driver' => 'mysql',
    'url' => env('DATABASE_URL'),
    'host' => env('AIVEN_DB_HOST', '127.0.0.1'),
    'port' => env('AIVEN_DB_PORT', '3306'),
    'database' => env('AIVEN_DB_DATABASE', 'forge'),
    'username' => env('AIVEN_DB_USERNAME', 'forge'),
    'password' => env('AIVEN_DB_PASSWORD', ''),
    'unix_socket' => env('DB_SOCKET', ''),
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix' => '',
    'prefix_indexes' => true,
    'strict' => true,
    'engine' => null,
    'options' => extension_loaded('pdo_mysql') ? array_filter([
        PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
    ]) : [],
],
```

✅ **Already configured in this project!**

### 2.4 Test Connection

**Option A: Via Artisan Tinker**
```bash
cd e:\Xampp\htdocs\filia-interior-master-main
php artisan tinker

# In tinker:
DB::connection('aiven')->getPdo();
# Should show: PDO object (success!)
```

**Option B: Via Terminal**
```bash
php artisan db:show

# Should display:
MySQL 8.x.x
Database: filia-interior
Host: companyinterior-fadhlirajwaarahmana-9486.i.aivencloud.com
```

**If Error:**
- Check credentials
- Check firewall/antivirus
- Check internet connection
- Verify Aiven service is running

---

## 📊 STEP 3: RUN MIGRATIONS

### 3.1 Check Migration Files

**Location:** `database/migrations/`

**Should have:**
```
✓ 0001_01_01_000000_create_users_table.php
✓ 2025_08_09_061930_create_progress_updates_table.php
✓ 2025_08_09_212616_create_progress_table.php
✓ 2025_08_11_013205_add_status_to_progress_updates_table.php
✓ 2025_08_11_020538_make_foto_nullable_in_progress_updates_table.php
✓ 2025_11_07_000001_change_foto_to_longtext_in_progress_updates.php
```

### 3.2 Run Migrations

**Command:**
```bash
cd e:\Xampp\htdocs\filia-interior-master-main

php artisan migrate
```

**Expected Output:**
```
   INFO  Preparing database.

  Creating migration table ..................................... 12ms DONE

   INFO  Running migrations.

  0001_01_01_000000_create_users_table ......................... 45ms DONE
  0001_01_01_000001_create_cache_table ......................... 23ms DONE
  0001_01_01_000002_create_jobs_table .......................... 34ms DONE
  2025_08_09_061930_create_progress_updates_table .............. 28ms DONE
  2025_08_09_212616_create_progress_table ...................... 21ms DONE
  2025_08_11_013205_add_status_to_progress_updates_table ....... 19ms DONE
  2025_08_11_020538_make_foto_nullable_in_progress_updates ..... 17ms DONE
  2025_11_07_000001_change_foto_to_longtext_in_progress_updates. 22ms DONE
```

✅ **Tables created successfully!**

### 3.3 Verify Tables Created

**Command:**
```bash
php artisan db:table users
php artisan db:table progress_updates
```

**Or via MySQL Client:**
```sql
SHOW TABLES;

-- Should show:
+---------------------------+
| Tables_in_filia-interior  |
+---------------------------+
| cache                     |
| cache_locks               |
| failed_jobs               |
| job_batches               |
| jobs                      |
| migrations                |
| password_reset_tokens     |
| progress_updates          |
| sessions                  |
| users                     |
+---------------------------+
```

---

## 🌱 STEP 4: SEED DATABASE

### 4.1 Check Seeders

**Location:** `database/seeders/`

**Available:**
- `DatabaseSeeder.php` - Main seeder
- `UserSeeder.php` - Creates default users

### 4.2 Run Seeders

**Command:**
```bash
php artisan db:seed
```

**Expected Output:**
```
   INFO  Seeding database.

  Database\Seeders\UserSeeder ................................. RUNNING
  Database\Seeders\UserSeeder ............................. 156.78ms DONE
```

### 4.3 Verify Data

**Command:**
```bash
php artisan tinker

# In tinker:
User::all();
# Should show 3 users
```

**Or via MySQL Client:**
```sql
SELECT * FROM users;

-- Should show:
+----+----------------+-----------------------------+------+
| id | name           | email                       | role |
+----+----------------+-----------------------------+------+
|  1 | Filia Interior | filiainterior@gmail.com     | owner|
|  2 | Customer 1     | customer1@gmail.com         | customer|
|  3 | Customer 2     | customer2@gmail.com         | customer|
+----+----------------+-----------------------------+------+
```

**Default Password:** `password` (for all users)

---

## 🌐 STEP 5: CONFIGURE VERCEL

### 5.1 Login to Vercel

**URL:** https://vercel.com

```
1. Login to Vercel
2. Go to your project: filia-interior
3. Click "Settings"
4. Click "Environment Variables"
```

### 5.2 Add Aiven Credentials

**Add these environment variables:**

| Name | Value | Environments |
|------|-------|--------------|
| `AIVEN_DB_HOST` | `companyinterior-fadhlirajwaarahmana-9486.i.aivencloud.com` | Production, Preview, Development |
| `AIVEN_DB_PORT` | `16722` | Production, Preview, Development |
| `AIVEN_DB_DATABASE` | `filia-interior` | Production, Preview, Development |
| `AIVEN_DB_USERNAME` | `avnadmin` | Production, Preview, Development |
| `AIVEN_DB_PASSWORD` | `your-password-here` | Production, Preview, Development |

**Steps for each variable:**
```
1. Click "Add New"
2. Name: AIVEN_DB_HOST
3. Value: (paste your value)
4. Environments: Check all (Production, Preview, Development)
5. Click "Save"
6. Repeat for all 5 variables
```

### 5.3 Redeploy Vercel

**Option A: Via Dashboard**
```
1. Go to Deployments tab
2. Click on latest deployment
3. Click "..." menu
4. Click "Redeploy"
```

**Option B: Via Git Push**
```bash
git add .
git commit -m "Update Aiven config"
git push origin master
# Auto-deploys to Vercel
```

### 5.4 Run Migrations on Vercel

**URL:** `https://filia-interior.vercel.app/migrate`

**Steps:**
```
1. Open browser
2. Go to: https://filia-interior.vercel.app/migrate?action=migrate-fresh
3. Wait for migrations to complete
4. Should see:
   ✅ Fresh migration with seeding completed!
```

**Seeded Users:**
- Owner: `filiainterior@gmail.com` / `password`
- Customer 1: `customer1@gmail.com` / `password`
- Customer 2: `customer2@gmail.com` / `password`

---

## 🧪 TESTING

### Test Local Connection

**Step 1: Start local server**
```bash
php artisan serve
```

**Step 2: Login**
```
URL: http://localhost:8000/login
Email: filiainterior@gmail.com
Password: password
```

**Step 3: Create Progress**
```
1. Go to Progress → Create Progress
2. Fill form
3. Upload foto
4. Submit
5. ✅ Should save to Aiven database
```

### Test Vercel Connection

**Step 1: Open Vercel app**
```
URL: https://filia-interior.vercel.app/login
```

**Step 2: Login**
```
Email: filiainterior@gmail.com
Password: password
```

**Step 3: Verify Data**
```
1. Go to Progress list
2. Should show data from Aiven database
3. Both local and Vercel use SAME database!
```

---

## 🔧 TROUBLESHOOTING

### Error: "SQLSTATE[HY000] [2002] Connection refused"

**Cause:** Cannot connect to Aiven

**Solutions:**
1. Check credentials in `.env`
2. Check internet connection
3. Verify Aiven service is running (green status)
4. Check firewall/antivirus not blocking port 16722
5. Try pinging Aiven host

### Error: "Access denied for user 'avnadmin'"

**Cause:** Wrong username or password

**Solutions:**
1. Verify credentials in Aiven dashboard
2. Copy-paste carefully (no extra spaces)
3. Check password doesn't have special characters needing escape

### Error: "Unknown database 'filia-interior'"

**Cause:** Database doesn't exist

**Solutions:**
1. Create database in Aiven console
2. Or use `defaultdb` as database name
3. Run migrations to create tables

### Error: "Migration table not found"

**Cause:** Fresh database

**Solution:**
```bash
php artisan migrate:install
php artisan migrate
```

### Error: SSL connection error

**Cause:** Aiven requires SSL

**Solution:**
Check `config/database.php` has:
```php
'options' => extension_loaded('pdo_mysql') ? array_filter([
    PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
]) : [],
```

---

## 🔐 SECURITY BEST PRACTICES

### ✅ DO:
- ✅ Use environment variables for credentials
- ✅ Never commit `.env` to Git
- ✅ Use strong passwords
- ✅ Enable SSL connections
- ✅ Set Vercel env vars in dashboard
- ✅ Rotate passwords periodically
- ✅ Use Aiven's IP allowlist if needed

### ❌ DON'T:
- ❌ Hardcode credentials in code
- ❌ Share credentials in chat/email
- ❌ Commit `.env` to GitHub
- ❌ Use weak passwords
- ❌ Disable SSL
- ❌ Share Aiven dashboard access

---

## 📝 QUICK REFERENCE

### Environment Variables Needed

**Local (.env):**
```env
DB_CONNECTION=aiven
AIVEN_DB_HOST=your-host.aivencloud.com
AIVEN_DB_PORT=16722
AIVEN_DB_DATABASE=filia-interior
AIVEN_DB_USERNAME=avnadmin
AIVEN_DB_PASSWORD=your-password
```

**Vercel Dashboard:**
Same 5 variables above (without `DB_CONNECTION`)

### Common Commands

```bash
# Test connection
php artisan db:show

# Run migrations
php artisan migrate

# Run migrations fresh (drop all tables)
php artisan migrate:fresh

# Run seeders
php artisan db:seed

# Run migrations + seeders
php artisan migrate:fresh --seed

# Rollback last migration
php artisan migrate:rollback

# Check migration status
php artisan migrate:status
```

### Important URLs

```
Aiven Dashboard: https://console.aiven.io
Vercel Dashboard: https://vercel.com/dashboard
Vercel Env Vars: https://vercel.com/fadhlirajwaas-projects/filia-interior/settings/environment-variables
Vercel Migrations: https://filia-interior.vercel.app/migrate
```

---

## ✅ DEPLOYMENT CHECKLIST

- [ ] Aiven account created
- [ ] MySQL service created and running
- [ ] Connection credentials copied
- [ ] `.env` configured locally
- [ ] Connection tested (`php artisan db:show`)
- [ ] Migrations run (`php artisan migrate`)
- [ ] Database seeded (`php artisan db:seed`)
- [ ] Vercel environment variables set
- [ ] Vercel redeployed
- [ ] Vercel migrations run (`/migrate` endpoint)
- [ ] Local login tested
- [ ] Vercel login tested
- [ ] Both environments sharing same database ✅

---

## 🎯 SUMMARY

**Your Understanding is CORRECT!**

✅ **YES, the flow is:**
1. Create Aiven database
2. Get credentials from Aiven
3. Configure `.env` with Aiven credentials
4. Run `php artisan migrate` to create tables
5. Run `php artisan db:seed` to add default data
6. Set same credentials in Vercel dashboard
7. Run migrations on Vercel via `/migrate` endpoint

**Result:**
- ✅ Local development uses Aiven
- ✅ Vercel production uses Aiven
- ✅ Same database, synchronized data!

---

**Documentation Complete!** 🎉  
**For Questions:** See Aiven docs or contact development team.
