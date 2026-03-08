# Auto Project Code Design

Tanggal: 2026-03-08

## Tujuan

Mengubah alur pembuatan project agar `project_code` tidak lagi diinput manual oleh admin, tetapi dibuat otomatis oleh sistem saat project baru disimpan.

## Keputusan Desain

1. Project lama tetap dipertahankan tanpa perubahan kode.
2. Project baru akan otomatis mendapatkan kode dengan format `PRJ-0001`, `PRJ-0002`, dan seterusnya.
3. Nilai nomor diambil dari `projects.id`, bukan dari hasil hitung manual, agar aman dari duplikasi.
4. Field `project_code` di form create dihapus dari input manual.
5. Field `project_code` di form edit tetap ditampilkan, tetapi sebagai informasi read-only.

## Alasan

1. Mengandalkan `id` database lebih aman dibanding menghitung `max + 1`.
2. Project lama tidak perlu diubah, sehingga histori progress dan pembayaran tidak terganggu.
3. Admin tidak perlu lagi menentukan format kode sendiri.

## Dampak Teknis

1. Backend `ProjectController@store` perlu membuat placeholder sementara lalu mengganti `project_code` setelah record punya `id`.
2. Backend `ProjectController@update` tidak lagi menerima `project_code` dari request.
3. Validasi project disederhanakan karena `project_code` tidak lagi menjadi input user.
4. UI create/edit perlu menyesuaikan copy dan field.
5. Perlu test untuk memastikan kode otomatis terbentuk dan unik.
