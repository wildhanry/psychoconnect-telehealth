# PsychoConnect - TeleHealth Platform untuk Konseling Psikologi

Platform TeleHealth yang menghubungkan Pasien dengan Psikolog untuk konsultasi online.

## 🚀 Fitur Utama

### Admin

-   ✅ Dashboard dengan statistik
-   ✅ Verifikasi psikolog (approve/reject)
-   ✅ Manajemen user

### Psikolog

-   ✅ Dashboard dengan daftar janji temu
-   ✅ Setup profil (spesialisasi, bio, nomor STR)
-   ✅ Kelola jadwal praktik (CRUD)
-   ✅ Approve/Reject janji temu
-   ✅ Update link meeting (Google Meet, Zoom, dll)
-   ✅ Tandai janji temu sebagai selesai

### Pasien

-   ✅ Browse psikolog terverifikasi
-   ✅ Lihat detail psikolog dan jadwal
-   ✅ Buat janji temu
-   ✅ Lihat status janji temu
-   ✅ Batalkan janji temu
-   ✅ Join meeting via link

## 🛠️ Tech Stack

-   **Framework:** Laravel 11
-   **Database:** MySQL/SQLite
-   **Auth:** Laravel Breeze (Blade & Tailwind)
-   **Frontend:** Blade Templates + Tailwind CSS

## 📋 Prerequisites

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL/SQLite

## ⚙️ Instalasi

1. **Clone repository**

```bash
git clone <repository-url>
cd telehealth-psikolog
```

2. **Install dependencies**

```bash
composer install
npm install
```

3. **Setup environment**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi database di `.env`**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=psychoconnect
DB_USERNAME=root
DB_PASSWORD=
```

5. **Jalankan migrations**

```bash
php artisan migrate
```

6. **Seed sample data (opsional)**

```bash
php artisan db:seed
```

7. **Build assets**

```bash
npm run build
# atau untuk development:
npm run dev
```

8. **Jalankan server**

```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://127.0.0.1:8000`

## 👥 Sample User Credentials

Setelah menjalankan `php artisan db:seed`, gunakan kredensial berikut untuk login:

### Admin

-   Email: `admin@psychoconnect.com`
-   Password: `password`

### Psikolog (Terverifikasi)

-   Email: `sarah@psychoconnect.com` - Dr. Sarah Williams (Psikologi Klinis)
-   Email: `michael@psychoconnect.com` - Dr. Michael Chen (Psikologi Anak & Remaja)
-   Password: `password`

### Psikolog (Belum Terverifikasi)

-   Email: `amanda@psychoconnect.com` - Dr. Amanda Brown
-   Password: `password`

### Pasien

-   Email: `john@example.com` - John Doe
-   Email: `jane@example.com` - Jane Smith
-   Password: `password`

## 🗄️ Database Structure

### Tables

1. **users**

    - Kolom utama: id, name, email, password, role (enum: admin, psikolog, pasien)

2. **psychologist_profiles**

    - Kolom utama: user_id, specialization, bio, str_number, is_verified

3. **jadwals (schedules)**

    - Kolom utama: user_id, day_of_week, start_time, end_time, is_available

4. **janji_temus (appointments)**
    - Kolom utama: pasien_id, psikolog_id, schedule_date, schedule_time, status, meeting_link, notes

## 🔐 Role-Based Access Control

Sistem menggunakan middleware `CheckRole` untuk mengatur akses:

-   **Admin routes:** `/admin/*` - Hanya admin
-   **Psikolog routes:** `/psikolog/*` - Hanya psikolog
-   **Pasien routes:** `/pasien/*` - Hanya pasien

Redirect otomatis setelah login:

-   Admin → `/admin/dashboard`
-   Psikolog → `/psikolog/dashboard`
-   Pasien → `/dashboard`

## 📝 Validation Rules

### Booking Appointment

-   ✅ Pasien tidak bisa booking diri sendiri
-   ✅ Tanggal harus di masa depan
-   ✅ Waktu harus sesuai dengan jadwal psikolog
-   ✅ Validasi hari dan jam tersedia

### Schedule Management

-   ✅ Jam selesai harus lebih besar dari jam mulai
-   ✅ Format waktu HH:MM

### Psychologist Profile

-   ✅ Nomor STR harus unique
-   ✅ Spesialisasi wajib diisi

## 🎨 UI Components

Menggunakan Tailwind CSS dengan komponen dari Laravel Breeze:

-   Forms dengan validation feedback
-   Tables responsif
-   Cards untuk list items
-   Status badges dengan warna
-   Alert messages (success, error)

## 🔄 Workflow

### Flow Booking Janji Temu:

1. **Pasien** browse daftar psikolog terverifikasi
2. **Pasien** pilih psikolog dan lihat jadwal tersedia
3. **Pasien** isi form booking (tanggal, waktu, catatan)
4. Status: `pending` - menunggu konfirmasi
5. **Psikolog** approve/reject di dashboard
6. Jika approved: Status → `confirmed`
7. **Psikolog** tambahkan meeting link
8. **Pasien** bisa join meeting via link
9. **Psikolog** tandai sebagai `completed` setelah selesai

## 🧪 Testing

Untuk testing manual:

1. Login sebagai **Admin** → Verifikasi psikolog
2. Login sebagai **Psikolog** → Setup profil & jadwal
3. Login sebagai **Pasien** → Browse & booking
4. Login sebagai **Psikolog** → Approve booking
5. Login sebagai **Pasien** → Lihat status & join meeting

## 📂 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   └── AdminController.php
│   │   ├── Psikolog/
│   │   │   ├── PsikologDashboardController.php
│   │   │   ├── ProfileController.php
│   │   │   ├── JadwalController.php
│   │   │   └── AppointmentController.php
│   │   └── Pasien/
│   │       ├── PsychologistController.php
│   │       └── BookingController.php
│   ├── Middleware/
│   │   └── CheckRole.php
│   └── Requests/
│       ├── StoreAppointmentRequest.php
│       ├── StorePsychologistProfileRequest.php
│       └── StoreJadwalRequest.php
├── Models/
│   ├── User.php
│   ├── PsychologistProfile.php
│   ├── Jadwal.php
│   └── JanjiTemu.php
```

## 🚧 Future Enhancements

-   [ ] Payment integration
-   [ ] Rating & review system
-   [ ] Chat/messaging feature
-   [ ] Video call integration
-   [ ] Email notifications
-   [ ] SMS reminders
-   [ ] Export reports
-   [ ] Multi-language support

## 📄 License

MIT License

## 👨‍💻 Developer

Built with ❤️ using Laravel 11 & Tailwind CSS

---

**Note:** Ini adalah project educational/demo. Untuk production, tambahkan:

-   Email verification
-   Two-factor authentication
-   Rate limiting
-   Comprehensive testing
-   Error logging & monitoring
-   Backup strategy
