# Quick Start Guide

## Initial Setup

Start the development server:
```bash
php artisan serve
```

Access the application at `http://127.0.0.1:8000`

## Testing Workflows

### Administrator Workflow

**Login Credentials**
```
Email: admin@psychoconnect.com
Password: password
```

**Available Actions**
1. Access dashboard at `/admin/dashboard`
2. Review system statistics
3. Verify pending psychologist registrations
4. Navigate to user management sections
5. Monitor system-wide appointments

**Psychologist Verification Process**
1. Navigate to "Psikolog Menunggu Verifikasi" section
2. Review psychologist credentials (STR number, specialization)
3. Click "Verifikasi" to approve registration
4. Verified psychologists appear in patient directory

### Psychologist Workflow

**Login Credentials**
```
Email: sarah@psychoconnect.com
Password: password
```

**Profile Configuration**
1. Navigate to "Edit Profil"
2. Update specialization, biography, STR number
3. Save changes

**Schedule Management**
1. Access "Kelola Jadwal"
2. Add new schedule entries with day, start time, end time
3. Toggle availability status
4. Edit or delete existing schedules

**Appointment Management**
1. Review pending appointments on dashboard
2. Click "Terima" to confirm appointment
3. Enter meeting link (Google Meet, Zoom, etc.)
4. Click "Selesai" to mark session as completed

**Patient Monitoring**
1. Click "Monitor" on confirmed appointments
2. View patient mood trends over 30 days
3. Review sentiment statistics and alerts
4. Access individual journal entries

### Patient Workflow

**Login Credentials**
```
Email: john@example.com
Password: password
```

**Psychologist Discovery**
1. Click "Cari Psikolog" from dashboard
2. Browse verified psychologist directory
3. View detailed profiles and specializations

**Appointment Booking**
1. Select psychologist and click "Buat Janji"
2. Choose appointment date
3. Select time slot from available schedule
4. Add optional notes
5. Submit booking request

**Appointment Tracking**
1. Navigate to "Janji Temu Saya"
2. View appointment status (Pending, Confirmed, Completed, Cancelled)
3. Access meeting link for confirmed appointments
4. Cancel pending appointments if needed

**Daily Journal**
1. Access "Jurnal Harian" from dashboard
2. Write journal entry in Indonesian
3. Submit for automatic AI mood analysis
4. Review mood label, score, and confidence percentage
5. Edit, delete, or re-analyze previous entries
6. View mood trend visualization

## Complete Testing Scenarios

### Scenario 1: Full Appointment Lifecycle

1. **Patient** (john@example.com): Browse psychologists
2. **Patient**: Select dr. Sarah Williams
3. **Patient**: Book appointment for Monday at 10:00 with notes
4. **Patient**: Logout

5. **Psychologist** (sarah@psychoconnect.com): Login
6. **Psychologist**: Review pending appointment on dashboard
7. **Psychologist**: Click "Terima" to approve
8. **Psychologist**: Update meeting link: `https://meet.google.com/abc-defg-hij`
9. **Psychologist**: Logout

10. **Patient** (john@example.com): Login
11. **Patient**: Navigate to "Janji Temu Saya"
12. **Patient**: Verify status shows "Confirmed"
13. **Patient**: Click "Join Meeting" to access session

### Scenario 2: Psychologist Registration and Verification

1. **New User**: Access `/register/psychologist`
2. **New User**: Complete registration form with credentials
3. **New User**: Submit and receive verification pending message

4. **Admin** (admin@psychoconnect.com): Login
5. **Admin**: Review "Psikolog Menunggu Verifikasi"
6. **Admin**: Verify credentials
7. **Admin**: Click "Verifikasi" to approve

8. **New Psychologist**: Login with registered credentials
9. **New Psychologist**: Access psychologist dashboard
10. **New Psychologist**: Configure schedule and accept appointments

### Scenario 3: Mood Journal and Monitoring

1. **Patient** (john@example.com): Access "Jurnal Harian"
2. **Patient**: Write journal entry describing current mood
3. **Patient**: Submit for AI analysis
4. **Patient**: Review mood analysis results
5. **Patient**: Repeat for multiple days to build trend data

6. **Psychologist** (sarah@psychoconnect.com): Login
7. **Psychologist**: Navigate to confirmed appointment
8. **Psychologist**: Click "Monitor" button
9. **Psychologist**: Review patient mood trend chart
10. **Psychologist**: Analyze sentiment statistics and journal entries

## Role-Based Access Summary

| Role | Dashboard URL | Primary Functions |
|------|---------------|------------------|
| Admin | `/admin/dashboard` | User management, psychologist verification |
| Psychologist | `/psikolog/dashboard` | Profile, schedules, appointments, monitoring |
| Patient | `/dashboard` | Browse, booking, appointments, journaling |

## Common Issues and Solutions

**Issue: Psychologist not appearing in directory**
- Verify psychologist account has `is_verified = true`
- Check admin verification completion

**Issue: Cannot book appointment at selected time**
- Confirm psychologist has schedule for selected day
- Verify time falls within schedule start and end time
- Ensure schedule status is "Tersedia" (Available)

**Issue: Mood analysis shows "Pending Analysis"**
- AI service may be temporarily unavailable
- Use "Analisis Ulang" button to retry
- Check network connectivity

**Issue: Unable to login after registration**
- Psychologists require admin verification before login
- Check email/password correctness
- Verify account exists in database

## Development Commands

**Reset database with fresh seed data:**
```bash
php artisan migrate:fresh --seed
```

**Rebuild frontend assets:**
```bash
npm run build
```

**Run in development mode with hot reload:**
```bash
npm run dev
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
