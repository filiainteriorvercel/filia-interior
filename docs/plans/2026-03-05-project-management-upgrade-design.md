# Project Management Upgrade Design

Tanggal: 2026-03-05

## Tujuan
Upgrade aplikasi agar dari website company profile + progress update menjadi website manajemen proyek interior dengan identitas project/customer yang kuat, histori repeat order, dan histori pembayaran bertahap yang terstruktur.

## Ruang Lingkup Fitur
1. Tambah ID Customer unik (`customer_code`) untuk user role customer.
2. Tambah master data project (`projects`) dengan ID Project unik (`project_code`).
3. Relasi customer -> banyak project (repeat order).
4. Progress update dikaitkan ke project.
5. Histori pembayaran per project (`project_payments`) dengan tanggal, persen, catatan, dan bukti bayar.
6. Form data customer di sisi admin mencakup: id project, id cust, nama, no hp, email, tanggal dealing, bukti bayar dealing.
7. Customer login hanya melihat project miliknya, termasuk progress dan histori pembayaran.

## Desain Data
- `users`
  - tambah: `customer_code` (unique, nullable), `phone` (nullable)
- `projects`
  - `id`, `project_code` (unique), `user_id` (fk users)
  - snapshot customer: `customer_name`, `customer_phone`, `customer_email`
  - `deal_date`, `deal_payment_proof` (longText nullable)
  - `status` default `in_progress`
  - timestamps
- `project_payments`
  - `id`, `project_id` (fk projects), `payment_percent` (decimal 5,2)
  - `payment_date`, `payment_proof` (longText nullable), `notes` (text nullable)
  - `created_by` (fk users nullable)
  - timestamps
- `progress_updates`
  - tambah: `project_id` (fk projects nullable saat migrasi)
  - data lama `id_project` dan `user_id` tetap dipertahankan agar backward compatible

## Desain Aplikasi
- Admin mengelola project melalui halaman baru dashboard.
- Saat membuat project, admin memilih customer dan dapat override snapshot data customer (nama/phone/email) jika perlu.
- Form progress update admin berbasis `project_id`.
- Pembayaran dikelola per project (halaman detail project admin).
- Dashboard customer menampilkan list project milik user, progress per project, dan riwayat pembayaran.

## Migrasi Data Lama
- Untuk setiap kombinasi unik `progress_updates.id_project + user_id`, dibuat 1 data `projects`.
- `progress_updates.project_id` diisi berdasarkan mapping tersebut.
- `projects.project_code` default dari `id_project` lama agar data historis tetap relevan.

## Catatan Teknis
- Upload bukti pembayaran dan bukti dealing mengikuti pola project saat ini: simpan path lokal bila writable, fallback base64 pada environment serverless.
- Validasi persen pembayaran dibatasi 0-100.
- Search admin minimal pada: `project_code`, `customer_code`, nama, no hp, email.
