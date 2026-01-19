# PsychoConnect - Feature Documentation

## Role-Based System Architecture

PsychoConnect implements a three-tier role-based access control system with distinct functionalities for each user type.

## Administrator Features

### Dashboard
- System-wide statistics overview
- Pending psychologist verification queue
- User activity monitoring

### User Management
- Complete user directory with role filtering
- User deletion with cascading data cleanup
- Account status monitoring

### Psychologist Verification
- Credential review workflow
- STR (Registration Certificate) number validation
- Verification status management (approve/revoke)

### Appointment Oversight
- Comprehensive appointment listing across all users
- Status-based filtering (Pending, Confirmed, Completed, Cancelled)
- System-wide appointment analytics

## Psychologist Features

### Professional Profile
- Specialization declaration
- Biography and professional background
- STR number registration for verification
- Profile editing capabilities

### Schedule Management
- Weekly availability configuration
- Time slot definition (day, start time, end time)
- Schedule modification and deletion
- Availability status toggle

### Appointment Management
- Incoming appointment request review
- Approval and rejection workflow
- Meeting link integration (Google Meet, Zoom, etc.)
- Session completion marking

### Patient Monitoring
- Individual patient mood trend visualization
- 30-day journal history analysis
- Sentiment distribution statistics
- Negative mood threshold alerts

## Patient Features

### Psychologist Discovery
- Browse verified psychologist directory
- Detailed psychologist profile viewing
- Specialization-based filtering

### Appointment System
- Schedule-based appointment booking
- Date and time slot selection
- Appointment status tracking
- Meeting link access for confirmed sessions
- Appointment cancellation (pending status only)

### AI-Powered Mood Journal
- Daily journaling interface with Indonesian language support
- Automatic sentiment analysis using external AI API
- Mood categorization (Positive/Negative) with confidence scoring
- Journal entry management (create, edit, delete, re-analyze)
- Historical mood trend visualization
- Professional consultation disclaimer and recommendations

## Technical Implementation

### Database Structure

**users**
- Primary authentication table
- Fields: id, name, email, password, role (admin/psikolog/pasien)

**psychologist_profiles**
- Psychologist credential storage
- Fields: user_id, specialization, bio, str_number, is_verified

**jadwals**
- Weekly schedule templates
- Fields: user_id, day_of_week, start_time, end_time, is_available

**janji_temus**
- Appointment records
- Fields: pasien_id, psikolog_id, schedule_date, schedule_time, status, meeting_link, notes

**journals**
- Patient daily journals with AI analysis
- Fields: user_id, content, mood_label, mood_score, confidence_score, created_at

### Authentication Flow

**Admin Access**
- Routes: `/admin/*`
- Middleware: `auth, role:admin`
- Redirect: `/admin/dashboard`

**Psychologist Access**
- Routes: `/psikolog/*`
- Middleware: `auth, role:psikolog`
- Redirect: `/psikolog/dashboard`
- Requires: `is_verified = true`

**Patient Access**
- Routes: `/pasien/*`, `/dashboard`
- Middleware: `auth, role:pasien`
- Redirect: `/dashboard`

### Validation Rules

**Appointment Booking**
- Date must be in the future
- Time must match psychologist's available schedule
- Day of week must have active schedule entry
- Prevents self-booking by psychologists

**Schedule Creation**
- End time must be later than start time
- Time format: HH:MM (24-hour)
- Day of week validation

**Psychologist Profile**
- STR number must be unique
- Specialization is required
- Biography minimum length enforced

### AI Integration

**Mood Analysis Service**
- Endpoint: Configure via `AI_SERVICE_URL` in `.env` file
- Method: POST with JSON payload
- Input: `{"text": "journal_content"}`
- Output: `{"prediction_label": "...", "prediction_score": 0/1/2, "confidence": "75.5%"}`
- Timeout: 10 seconds
- Fallback: "Pending Analysis" on API failure

**Configuration:**
```bash
# .env
AI_SERVICE_URL=https://your-ai-service.com
```

## UI/UX Standards

### Responsive Design
- Mobile-first approach with Tailwind CSS
- Breakpoints: sm (640px), md (768px), lg (1024px)
- Adaptive grid layouts and component sizing

### Color Coding
- Status badges: Yellow (Pending), Green (Confirmed/Available), Blue (Completed), Red (Cancelled/Unavailable)
- Role themes: Purple (Admin), Blue/Yellow/Green (Psychologist), Indigo/Green (Patient)

### Component Library
- Laravel Breeze authentication scaffolding
- Tailwind CSS utility classes
- Chart.js for data visualization
- Responsive tables with horizontal scrolling
- Form validation with real-time feedback

## Security Measures

- Role-based middleware protection
- CSRF token validation on all forms
- Password hashing with bcrypt
- SQL injection prevention via Eloquent ORM
- XSS protection through Blade escaping
- Cascading deletion for data integrity
- Admin self-deletion prevention
3. **Pasien** isi form booking (tanggal, waktu, catatan)
4. Status: `pending` - menunggu konfirmasi
5. **Psikolog** approve/reject di dashboard
6. Jika approved: Status → `confirmed`
7. **Psikolog** tambahkan meeting link
8. **Pasien** bisa join meeting via link


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
