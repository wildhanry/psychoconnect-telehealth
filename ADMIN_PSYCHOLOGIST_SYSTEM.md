# Admin & Psychologist Registration System

## Fitur Admin

Admin sekarang memiliki akses penuh untuk mengelola sistem:

### 1. Dashboard Admin
- **URL**: `/admin/dashboard`
- **Fitur**:
  - Quick actions ke semua management pages
  - Statistics cards (Total Psikolog, Terverifikasi, Pasien, Janji Temu)
  - List psikolog yang menunggu verifikasi

### 2. Kelola Semua User
- **URL**: `/admin/users`
- **Fitur**:
  - Lihat semua user (Admin, Psikolog, Pasien)
  - Filter by role dengan badge warna
  - Status verifikasi untuk psikolog
  - Hapus user (kecuali admin dan diri sendiri)
  - Menghapus user akan otomatis menghapus data terkait (profil, jadwal, dll)

### 3. Kelola Psikolog
- **URL**: `/admin/psychologists`
- **Fitur**:
  - Lihat semua psikolog terdaftar
  - Verifikasi psikolog baru
  - Cabut verifikasi psikolog
  - Lihat spesialisasi dan nomor STR
  - Hapus psikolog

### 4. Kelola Pasien
- **URL**: `/admin/patients`
- **Fitur**:
  - Lihat semua pasien terdaftar
  - Lihat tanggal registrasi
  - Hapus pasien

### 5. Kelola Janji Temu
- **URL**: `/admin/appointments`
- **Fitur**:
  - Lihat semua janji temu
  - Filter by status (Pending, Confirmed, Completed, Cancelled)
  - Lihat detail pasien dan psikolog
  - Monitor semua appointment di sistem

---

## Sistem Registrasi Psikolog

### Cara Psikolog Mendaftar:

1. **Akses Halaman Registrasi**
   - Dari welcome page, klik "Daftar Sebagai Psikolog" di bawah hero section
   - Atau langsung ke: `/register/psychologist`

2. **Isi Form Registrasi**
   Form mencakup:
   - **Data Akun**:
     - Nama Lengkap
     - Email
     - Password
   
   - **Data Profil Psikolog** (Wajib):
     - Spesialisasi (contoh: Klinis Dewasa, Anak & Remaja)
     - Nomor STR (Surat Tanda Registrasi) - untuk verifikasi
     - Bio/Deskripsi Diri - pengalaman dan pendekatan konseling
   
   - **Data Tambahan** (Opsional):
     - Pendidikan
     - Pengalaman (dalam tahun)

3. **Submit & Menunggu Verifikasi**
   - Setelah submit, akun dibuat dengan `is_verified = false`
   - Psikolog akan diarahkan ke login dengan pesan "Akun menunggu verifikasi admin"
   - Psikolog BELUM BISA login sampai diverifikasi

4. **Verifikasi Admin**
   - Admin login dan masuk dashboard
   - Akan melihat list "Psikolog Menunggu Verifikasi"
   - Admin memeriksa kredensial (STR number, pendidikan, dll)
   - Admin klik "Verifikasi" untuk mengaktifkan akun

5. **Psikolog Dapat Login**
   - Setelah diverifikasi, psikolog bisa login
   - Akses dashboard psikolog
   - Dapat mengatur jadwal praktik
   - Dapat menerima janji temu

---

## Alur Lengkap:

```
1. Psikolog → Register via /register/psychologist
2. Sistem → Buat User (role: psikolog) + PsychologistProfile (is_verified: false)
3. Admin → Login, lihat pending verification di dashboard
4. Admin → Verify psikolog
5. Psikolog → Sekarang bisa login dan berfungsi penuh
```

---

## Routes Baru:

```php
// Public - Registration
GET  /register/psychologist           → Form registrasi psikolog
POST /register/psychologist           → Proses registrasi

// Admin Routes
GET  /admin/users                     → List semua user
GET  /admin/psychologists             → List semua psikolog
GET  /admin/patients                  → List semua pasien
GET  /admin/appointments              → List semua janji temu
POST /admin/psychologists/{id}/verify → Verifikasi psikolog
POST /admin/psychologists/{id}/unverify → Cabut verifikasi
DELETE /admin/users/{id}              → Hapus user
```

---

## Database:

Tidak ada perubahan migration diperlukan. Sistem menggunakan kolom yang sudah ada:
- `psychologist_profiles.is_verified` → untuk status verifikasi
- `psychologist_profiles.str_number` → untuk validasi kredensial
- `users.role` → untuk menentukan akses

---

## Keamanan:

✅ Middleware `role:admin` melindungi semua admin routes
✅ Admin tidak bisa menghapus diri sendiri
✅ Admin tidak bisa menghapus admin lain
✅ Psikolog belum diverifikasi tidak bisa login
✅ Password di-hash dengan bcrypt
✅ CSRF protection aktif

---

## UI/UX:

- ✅ Responsive design untuk mobile, tablet, desktop
- ✅ Quick action cards dengan warna berbeda per role
- ✅ Status badges dengan color coding
- ✅ Confirmation dialog sebelum delete
- ✅ Success messages dengan styling
- ✅ Table dengan overflow-x-auto untuk mobile
