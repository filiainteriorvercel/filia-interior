# Auto Project Code Implementation Plan

> **For Claude:** REQUIRED SUB-SKILL: Use superpowers:executing-plans to implement this plan task-by-task.

**Goal:** Membuat `project_code` otomatis untuk project baru tanpa mengubah `project_code` project lama.

**Architecture:** Project baru dibuat dengan placeholder unik sementara, lalu setelah record memperoleh `id`, sistem mengganti `project_code` menjadi format `PRJ-xxxx`. Form create tidak lagi menerima input kode manual, sedangkan form edit hanya menampilkan kode yang sudah ada.

**Tech Stack:** Laravel 12, Blade, Eloquent, PHPUnit.

---

### Task 1: Dokumentasi dan Perencanaan

**Files:**
- Create: `docs/plans/2026-03-08-auto-project-code-design.md`
- Create: `docs/plans/2026-03-08-auto-project-code.md`

**Langkah:**
1. Tulis keputusan desain bahwa project lama tetap dipertahankan.
2. Tulis rencana implementasi perubahan controller, view, dan test.

### Task 2: Backend Project Creation

**Files:**
- Modify: `app/Http/Controllers/ProjectController.php`

**Langkah:**
1. Hapus validasi `project_code` dari input create/update.
2. Saat create, isi placeholder unik sementara.
3. Setelah `Project::create`, update `project_code` dengan format `PRJ-xxxx`.
4. Pastikan update project tidak menerima perubahan manual pada `project_code`.

### Task 3: UI Form Create dan Edit

**Files:**
- Modify: `resources/views/dashboard/projects/create.blade.php`
- Modify: `resources/views/dashboard/projects/edit.blade.php`

**Langkah:**
1. Ubah form create agar menampilkan info bahwa ID Project dibuat otomatis.
2. Ubah guideline agar menjelaskan kode akan dibuat sistem.
3. Ubah form edit agar ID Project tampil read-only/informational.

### Task 4: Test

**Files:**
- Create: `tests/Feature/ProjectManagement/AutoProjectCodeTest.php`

**Langkah:**
1. Tambah test create project oleh owner.
2. Pastikan `project_code` terbentuk otomatis sesuai format.
3. Pastikan project lama dengan kode manual tidak ikut berubah.

### Task 5: Verifikasi

**Files:**
- N/A

**Langkah:**
1. Jalankan `php artisan test`.
2. Review perubahan pada form dan alur create/edit.
