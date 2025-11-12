# 🚀 Quick Start Guide - PsychoConnect

## Langkah Cepat untuk Memulai

### 1. Pastikan Server Berjalan

```bash
php artisan serve
```

Buka browser: `http://127.0.0.1:8000`

### 2. Testing Flow Lengkap

#### A. Login sebagai ADMIN

```
Email: admin@psychoconnect.com
Password: password
```

**Yang bisa dilakukan:**

-   ✅ Lihat statistik dashboard
-   ✅ Verifikasi psikolog yang belum terverifikasi (Amanda Brown)
-   ✅ Klik tombol "Verifikasi" untuk approve

---

#### B. Login sebagai PSIKOLOG

```
Email: sarah@psychoconnect.com
Password: password
```

**Yang bisa dilakukan:**

1. **Edit Profil**

    - Klik "Edit Profil"
    - Update spesialisasi, bio, nomor STR
    - Save

2. **Kelola Jadwal**

    - Klik "Kelola Jadwal"
    - Tambah jadwal baru (pilih hari, jam mulai, jam selesai)
    - Edit/Hapus jadwal existing

3. **Kelola Janji Temu**
    - Lihat janji temu pending di dashboard
    - Klik "Terima" untuk approve
    - Klik "Tolak" untuk reject
    - Update meeting link (Google Meet, Zoom, dll)
    - Tandai sebagai "Selesai" setelah konseling

---

#### C. Login sebagai PASIEN

```
Email: john@example.com
Password: password
```

**Yang bisa dilakukan:**

1. **Browse Psikolog**

    - Klik "Cari Psikolog" di dashboard
    - Lihat daftar psikolog terverifikasi
    - Klik "Lihat Detail" untuk info lengkap

2. **Buat Janji Temu**

    - Klik "Buat Janji" pada psikolog pilihan
    - Pilih tanggal dan waktu (sesuai jadwal psikolog)
    - Isi catatan (opsional)
    - Submit

3. **Kelola Janji Temu**
    - Klik "Janji Temu Saya"
    - Lihat status: Pending, Confirmed, Completed, Cancelled
    - Join meeting jika sudah confirmed (klik link)
    - Batalkan janji jika masih pending

---

## 🎯 Skenario Testing Lengkap

### Skenario 1: Pasien Booking Psikolog

1. Login sebagai **Pasien (john@example.com)**
2. Browse psikolog → Pilih "Dr. Sarah Williams"
3. Buat janji: Pilih Monday, jam 10:00, tambah catatan
4. Logout

5. Login sebagai **Psikolog (sarah@psychoconnect.com)**
6. Lihat janji temu pending di dashboard
7. Klik "Terima" untuk approve
8. Update meeting link: `https://meet.google.com/abc-defg-hij`
9. Logout

10. Login sebagai **Pasien (john@example.com)**
11. Lihat "Janji Temu Saya"
12. Status: Confirmed ✅
13. Klik "Join Meeting" untuk buka link

### Skenario 2: Admin Verifikasi Psikolog Baru

1. Login sebagai **Admin**
2. Lihat "Psikolog Menunggu Verifikasi"
3. Ada: Dr. Amanda Brown (belum terverifikasi)
4. Klik "Verifikasi"
5. Logout

6. Login sebagai **Pasien**
7. Browse psikolog
8. Sekarang bisa lihat Dr. Amanda Brown dalam list

### Skenario 3: Psikolog Kelola Jadwal

1. Login sebagai **Psikolog (michael@psychoconnect.com)**
2. Klik "Kelola Jadwal"
3. Tambah jadwal baru:
    - Hari: Thursday
    - Jam: 09:00 - 12:00
    - Status: Tersedia ✅
4. Save
5. Pasien sekarang bisa booking di hari Thursday

---

## 📊 Struktur Role & Akses

| Role     | Dashboard URL         | Fitur Utama                      |
| -------- | --------------------- | -------------------------------- |
| Admin    | `/admin/dashboard`    | Verifikasi psikolog, statistik   |
| Psikolog | `/psikolog/dashboard` | Profil, jadwal, approve booking  |
| Pasien   | `/dashboard`          | Browse, booking, my appointments |

---

## 🔍 Troubleshooting

### Error: "Psikolog tidak tersedia pada waktu yang dipilih"

-   ✅ Pastikan psikolog punya jadwal untuk hari tersebut
-   ✅ Pastikan waktu booking dalam range jadwal (start_time - end_time)
-   ✅ Pastikan jadwal status: "Tersedia"

### Psikolog tidak muncul di list

-   ✅ Pastikan psikolog sudah terverifikasi oleh admin
-   ✅ Check: `is_verified = true` di database

### Tidak bisa login

-   ✅ Pastikan sudah run `php artisan db:seed`
-   ✅ Default password semua user: `password`

---

## 🎨 Tips UI/UX

1. **Color Coding Status:**

    - 🟡 Yellow = Pending
    - 🟢 Green = Confirmed/Available
    - 🔵 Blue = Completed
    - 🔴 Red = Cancelled/Unavailable

2. **Navigation:**

    - Gunakan breadcrumb & back button
    - Dashboard sebagai home base
    - Quick actions di setiap halaman

3. **Forms:**
    - Semua required fields ada tanda \*
    - Validation real-time
    - Error messages jelas

---

## 📝 Notes untuk Development

### Jika ingin reset database:

```bash
php artisan migrate:fresh --seed
```

### Jika update CSS/JS:

```bash
npm run build
```

### Jika ada error migrations:

```bash
php artisan migrate:rollback
php artisan migrate
```

---

## ✅ Checklist Fitur

### Admin ✅

-   [x] Dashboard dengan stats
-   [x] Verifikasi psikolog
-   [x] Unverify psikolog

### Psikolog ✅

-   [x] Dashboard dengan appointments
-   [x] Edit profil (spesialisasi, bio, STR)
-   [x] CRUD jadwal
-   [x] Approve/reject appointment
-   [x] Update meeting link
-   [x] Complete appointment

### Pasien ✅

-   [x] Browse verified psychologists
-   [x] View psychologist detail
-   [x] Create appointment (dengan validasi)
-   [x] View my appointments
-   [x] Cancel appointment
-   [x] Join meeting via link

### Security ✅

-   [x] Role-based middleware
-   [x] CSRF protection
-   [x] Form validation
-   [x] Password hashing
-   [x] Authorization checks

---

## 🎓 Learning Resources

**Konsep yang digunakan:**

1. Laravel MVC Pattern
2. Eloquent Relationships (hasOne, hasMany, belongsTo)
3. Middleware & Route Groups
4. Form Requests & Validation
5. Blade Templates & Components
6. Tailwind CSS Utility Classes
7. Database Migrations & Seeders

**Next Steps untuk Belajar:**

-   API Development (untuk mobile app)
-   Testing (PHPUnit, Feature Tests)
-   Queue & Jobs (untuk email notifications)
-   Real-time features (WebSockets, Pusher)

---

Selamat mencoba! 🎉
