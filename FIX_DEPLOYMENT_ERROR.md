# 🔧 FIX DEPLOYMENT ERROR - CONNECTION REFUSED

**Error:** SQLSTATE[HY000] [2002] Connection refused (Connection: mysql)  
**URL:** https://www.filiainterior.my.id  
**Penyebab:** Environment variables Vercel tidak diset dengan benar

---

## 🔍 ROOT CAUSE

### **Masalah Utama:**

Deployment mencoba connect ke **MySQL lokal** (127.0.0.1) yang tidak ada di Vercel, instead of **Aiven Cloud Database**.

```
Error Message:
SQLSTATE[HY000] [2002] Connection refused (Connection: mysql)
                                                      ↑
                                              Harusnya: aiven
```

### **Kenapa Terjadi:**

1. ❌ **Environment Variables Tidak Diset**
   - AIVEN_DB_HOST tidak diset → pakai default "localhost"
   - AIVEN_DB_PORT tidak diset → pakai default "3306"
   - DB_CONNECTION tidak diset → pakai default "mysql"
   
2. ❌ **vercel.json Override Settings**
   - SESSION_DRIVER di-set ke "cookie" (salah)
   - DB_CONNECTION tidak ada di vercel.json

3. ✅ **Di Lokal Berhasil Karena:**
   - .env lokal pakai DB_CONNECTION=mysql
   - MySQL lokal (XAMPP) berjalan di 127.0.0.1
   - Connect berhasil

4. ❌ **Di Deployment Gagal Karena:**
   - Tidak ada MySQL di Vercel serverless
   - Harus pakai Aiven Cloud Database
   - Environment variables tidak diset

---

## ✅ SOLUSI LENGKAP

### **STEP 1: Update vercel.json (SUDAH DONE)**

File `vercel.json` sudah diupdate dengan:

```json
"env": {
  "DB_CONNECTION": "aiven",           ← DITAMBAHKAN
  "SESSION_DRIVER": "database",       ← DIUBAH dari "cookie"
  "SESSION_CONNECTION": "aiven",      ← DITAMBAHKAN
  ...
}
```

### **STEP 2: Set Environment Variables di Vercel Dashboard**

**INI YANG PALING PENTING!**

#### **2.1 Login ke Vercel**

1. Buka https://vercel.com
2. Login dengan akun Anda
3. Pilih project **filia-interior**

#### **2.2 Buka Settings**

1. Klik tab **Settings**
2. Klik **Environment Variables** di sidebar

#### **2.3 Cek Variables yang Ada**

**Pastikan ADA 5 variables ini:**

| Variable Name | Value (contoh) | Status |
|---------------|----------------|--------|
| `AIVEN_DB_HOST` | `companyinterior-fadhlirajwaarahmana-9486.i.aivencloud.com` | ❓ |
| `AIVEN_DB_PORT` | `16722` | ❓ |
| `AIVEN_DB_DATABASE` | `filia-interior` atau `defaultdb` | ❓ |
| `AIVEN_DB_USERNAME` | `avnadmin` | ❓ |
| `AIVEN_DB_PASSWORD` | `your-password-here` | ❓ |

**Kalau TIDAK ADA atau SALAH, ikuti langkah berikut!**

#### **2.4 Tambah/Edit Variables**

**Untuk setiap variable:**

1. Klik **"Add New"** (kalau belum ada)
2. Atau klik **"Edit"** (kalau sudah ada tapi salah)
3. Isi:
   - **Name:** `AIVEN_DB_HOST`
   - **Value:** (paste dari Aiven dashboard)
   - **Environment:** Centang SEMUA (Production, Preview, Development)
4. Klik **"Save"**
5. **Ulangi untuk 5 variables**

#### **2.5 Cara Dapat Nilai dari Aiven**

1. Login ke https://console.aiven.io
2. Klik service MySQL Anda
3. Tab **"Overview"**
4. Lihat **"Connection Information"**
5. Copy setiap nilai:
   ```
   Host: companyinterior-fadhlirajwaarahmana-9486.i.aivencloud.com
   Port: 16722
   User: avnadmin
   Password: your-password-here
   Database: defaultdb (atau filia-interior jika sudah dibuat)
   ```

### **STEP 3: Redeploy**

Setelah environment variables diset:

#### **3.1 Via Vercel Dashboard**

1. Klik tab **"Deployments"**
2. Klik deployment terbaru
3. Klik **"..."** (titik tiga)
4. Klik **"Redeploy"**
5. **Tunggu** sampai deployment selesai

#### **3.2 Via Git Push**

```bash
cd e:\Xampp\htdocs\filia-interior-master-main

git add vercel.json
git commit -m "Fix: Force DB_CONNECTION=aiven in vercel.json"
git push origin master
```

Vercel akan auto-redeploy.

### **STEP 4: Jalankan Migrasi di Deployment**

**Penting!** Setelah credentials benar, jalankan migrasi:

1. Buka browser
2. Ke: `https://www.filiainterior.my.id/migrate?action=migrate-fresh`
3. Atau: `https://filia-interior.vercel.app/migrate?action=migrate-fresh`
4. Tunggu sampai selesai

**Output yang benar:**
```
✅ Fresh migration with seeding completed!
✅ Test Users Created:
• Owner: filiainterior@gmail.com / password
• Customer 1: customer1@gmail.com / password
• Customer 2: customer2@gmail.com / password
```

### **STEP 5: Testing**

#### **Test 1: Portfolio Page**

1. Buka: https://www.filiainterior.my.id/portfolio
2. Harusnya **TIDAK ERROR** lagi
3. Page loading normal

#### **Test 2: Login**

1. Buka: https://www.filiainterior.my.id/login
2. Login dengan:
   ```
   Email: filiainterior@gmail.com
   Password: password
   ```
3. Harusnya **berhasil login**

---

## 🎯 KENAPA INI TERJADI?

### **Timeline:**

```
1. Client clone project
   ↓
2. Client jalankan: php artisan migrate (di lokal)
   ✅ Berhasil (pakai MySQL lokal)
   ↓
3. Client push ke Git
   ↓
4. Vercel auto-deploy
   ↓
5. Vercel baca .env.vercel
   - DB_CONNECTION=aiven ✅
   - AIVEN_DB_HOST=localhost ❌ (placeholder)
   ↓
6. Vercel coba connect ke Aiven
   - Tapi environment variables TIDAK DISET
   - Pakai placeholder values (localhost)
   ↓
7. ❌ Connection Refused!
```

### **Kesimpulan:**

- ✅ **Lokal:** Berhasil karena MySQL lokal berjalan
- ❌ **Deployment:** Gagal karena environment variables tidak diset
- ✅ **Solusi:** Set environment variables di Vercel Dashboard

---

## 📋 CHECKLIST FIX

Ikuti checklist ini:

- [ ] ✅ **vercel.json updated** (sudah done)
- [ ] ❓ **Vercel environment variables checked**
  - [ ] AIVEN_DB_HOST diset dengan nilai dari Aiven
  - [ ] AIVEN_DB_PORT = 16722
  - [ ] AIVEN_DB_DATABASE = filia-interior atau defaultdb
  - [ ] AIVEN_DB_USERNAME = avnadmin
  - [ ] AIVEN_DB_PASSWORD = (dari Aiven)
- [ ] ❓ **Redeploy** (via dashboard atau git push)
- [ ] ❓ **Migrasi deployment** (via /migrate endpoint)
- [ ] ❓ **Testing portfolio page** (tidak error)
- [ ] ❓ **Testing login** (berhasil login)

**Kalau semua ✅, deployment akan normal!**

---

## 🔧 TROUBLESHOOTING

### **Masih Error Setelah Fix?**

#### **Error: Connection refused**

**Cek:**
1. Environment variables Vercel **sudah diset semua** (5 variables)
2. Nilai environment variables **BENAR** (copy dari Aiven)
3. Sudah **redeploy** setelah set variables
4. Aiven service **RUNNING** (status hijau)

#### **Error: Access denied**

**Cek:**
1. AIVEN_DB_USERNAME = `avnadmin` (bukan `root`)
2. AIVEN_DB_PASSWORD copy-paste dari Aiven (jangan ketik manual)
3. Tidak ada spasi di awal/akhir password

#### **Error: Unknown database**

**Cek:**
1. AIVEN_DB_DATABASE = `defaultdb` atau database yang sudah dibuat
2. Kalau pakai nama custom, pastikan sudah dibuat di Aiven

---

## 📝 CARA PREVENT DI MASA DEPAN

### **Untuk Client:**

1. ❌ **JANGAN commit file .env** ke Git
2. ❌ **JANGAN ubah vercel.json** tanpa tahu konsekuensinya
3. ✅ **Setup environment variables** di Vercel Dashboard dulu sebelum deployment
4. ✅ **Jalankan /migrate** setelah deployment pertama kali

### **Best Practice:**

```bash
# Lokal development:
1. git clone project
2. composer install
3. npm install
4. copy .env.example .env
5. php artisan key:generate
6. Setup database lokal (MySQL/Aiven)
7. php artisan migrate
8. php artisan db:seed

# Deployment:
1. Push ke Git
2. Set Vercel environment variables
3. Deploy
4. Run /migrate endpoint
5. Test website
```

---

## 🎯 SUMMARY

### **Root Cause:**
- Environment variables Vercel tidak diset
- vercel.json tidak force DB_CONNECTION=aiven
- Deployment mencoba connect ke localhost instead of Aiven

### **Solution:**
1. ✅ Fix vercel.json (force DB_CONNECTION=aiven)
2. ✅ Set environment variables di Vercel Dashboard (5 AIVEN_DB_* vars)
3. ✅ Redeploy
4. ✅ Run migrations via /migrate
5. ✅ Test

### **Prevention:**
- Setup environment variables SEBELUM deployment
- Jangan commit .env
- Follow best practices

---

**File ini dibuat untuk fix deployment error www.filiainterior.my.id**  
**Tanggal:** 10 November 2025  
**Status:** SOLVED dengan follow langkah-langkah di atas
