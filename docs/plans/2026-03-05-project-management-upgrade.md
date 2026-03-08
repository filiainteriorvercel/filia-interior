# Project Management Upgrade Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Menambahkan manajemen project, repeat order customer, dan histori pembayaran per project sesuai requirement dosen.

**Architecture:** Data dipisah menjadi entitas `projects` (master proyek) dan `project_payments` (timeline pembayaran). Entitas lama `progress_updates` tetap dipakai tetapi dihubungkan ke `projects` agar transisi aman.

**Tech Stack:** Laravel 12, Blade, Eloquent, MySQL, Vite/Tailwind.

---

### Task 1: Schema Database

**Files:**
- Create: `database/migrations/*_add_customer_fields_to_users_table.php`
- Create: `database/migrations/*_create_projects_table.php`
- Create: `database/migrations/*_create_project_payments_table.php`
- Create: `database/migrations/*_add_project_id_to_progress_updates_table.php`

**Langkah:**
1. Tambah kolom `customer_code` + `phone` pada users.
2. Buat tabel `projects`.
3. Buat tabel `project_payments`.
4. Tambah kolom `project_id` pada progress updates.

### Task 2: Backfill Data Lama

**Files:**
- Create: `database/migrations/*_backfill_projects_from_progress_updates.php`

**Langkah:**
1. Mapping project lama dari `progress_updates`.
2. Buat record `projects` jika belum ada.
3. Isi `progress_updates.project_id`.

### Task 3: Model dan Relasi

**Files:**
- Create: `app/Models/Project.php`
- Create: `app/Models/ProjectPayment.php`
- Modify: `app/Models/User.php`
- Modify: `app/Models/ProgressUpdate.php`

**Langkah:**
1. Tambah fillable/casts.
2. Tambah relasi `User -> projects`, `Project -> payments/progressUpdates`, `ProgressUpdate -> project`.

### Task 4: Controller Fitur Project dan Payment

**Files:**
- Create: `app/Http/Controllers/ProjectController.php`
- Create: `app/Http/Controllers/ProjectPaymentController.php`
- Modify: `app/Http/Controllers/ProgressController.php`
- Modify: `app/Http/Controllers/DashboardController.php`

**Langkah:**
1. CRUD project untuk admin.
2. Tambah pembayaran per project.
3. Progress create/update pakai `project_id`.
4. Dashboard customer menampilkan data project + payment.

### Task 5: Routing

**Files:**
- Modify: `routes/web.php`

**Langkah:**
1. Tambah route resource untuk `dashboard/projects`.
2. Tambah route create/store payment per project.
3. Pastikan akses berbasis `auth` + role check di controller.

### Task 6: UI Blade

**Files:**
- Create: `resources/views/dashboard/projects/index.blade.php`
- Create: `resources/views/dashboard/projects/create.blade.php`
- Create: `resources/views/dashboard/projects/edit.blade.php`
- Create: `resources/views/dashboard/projects/show.blade.php`
- Modify: `resources/views/layouts/navigation.blade.php`
- Modify: `resources/views/progress/create.blade.php`
- Modify: `resources/views/progress/edit.blade.php`
- Modify: `resources/views/progress/index.blade.php`
- Modify: `resources/views/dashboard/customer.blade.php`

**Langkah:**
1. Tambah menu Project Management.
2. Tambah pencarian project (project/customer code, nama, hp, email).
3. Tampilkan history payment timeline di admin/customer.
4. Integrasi upload bukti pembayaran.

### Task 7: Seeder dan Validasi Data Existing

**Files:**
- Modify: `database/seeders/UserSeeder.php`

**Langkah:**
1. Isi `customer_code` dan `phone` default sample.
2. Uji migrasi fresh + seed.

### Task 8: Verifikasi

**Files:**
- N/A

**Langkah:**
1. Jalankan `php artisan migrate`.
2. Jalankan `php artisan test`.
3. Jalankan `php artisan route:list` untuk verifikasi route baru.
4. Smoke test alur admin & customer.
