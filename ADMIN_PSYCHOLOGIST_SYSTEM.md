# Administrative System Documentation

## Administrator Capabilities

### Dashboard Overview
- **Access Route**: `/admin/dashboard`
- **Features**:
  - Quick navigation cards to management sections
  - System statistics: Total psychologists, verified count, patient count, appointment count
  - Pending psychologist verification queue

### User Management
- **Access Route**: `/admin/users`
- **Capabilities**:
  - View complete user directory across all roles
  - Filter by role with visual badge indicators
  - View psychologist verification status
  - Delete user accounts (restrictions apply)
  - Cascading deletion removes associated data (profiles, schedules, appointments)
  
**Deletion Restrictions**:
- Administrators cannot delete their own account
- Administrators cannot delete other administrator accounts
- System enforces these rules at controller level

### Psychologist Management
- **Access Route**: `/admin/psychologists`
- **Capabilities**:
  - View all registered psychologists
  - Review credentials (specialization, STR number)
  - Grant verification status to new registrations
  - Revoke verification status
  - Delete psychologist accounts

### Patient Management
- **Access Route**: `/admin/patients`
- **Capabilities**:
  - View all registered patients
  - Monitor registration dates
  - Delete patient accounts

### Appointment Monitoring
- **Access Route**: `/admin/appointments`
- **Capabilities**:
  - View system-wide appointment records
  - Filter by status (Pending, Confirmed, Completed, Cancelled)
  - Monitor patient-psychologist interactions
  - Track appointment completion rates

## Psychologist Registration System

### Registration Process

**Step 1: Access Registration**
- Public route: `/register/psychologist`
- Available from welcome page via "Daftar Sebagai Psikolog" link
- No authentication required

**Step 2: Complete Registration Form**

Required account information:
- Full name
- Email address (unique validation)
- Password (minimum 8 characters)

Required professional information:
- Specialization (e.g., Clinical Psychology, Child Psychology)
- STR Number (Registration Certificate - unique validation)
- Professional biography

Optional information:
- Educational background
- Years of experience

**Step 3: Account Creation**
- System creates user account with `role = 'psikolog'`
- System creates psychologist profile with `is_verified = false`
- User redirected to login with pending verification message
- Account is inactive until administrator approval

**Step 4: Administrator Verification**
- Administrator reviews pending psychologist in dashboard
- Administrator verifies credentials (STR number, education)
- Administrator clicks "Verifikasi" to approve account
- System updates `is_verified = true`

**Step 5: Account Activation**
- Psychologist can now login with credentials
- Full access to psychologist dashboard and features
- Can create schedules and accept appointments
- Appears in patient psychologist directory

### Workflow Diagram

```
User Registration → Account Created (Unverified) → Admin Review → 
Admin Approval → Account Activated → Full System Access
```

### Technical Implementation

**Routes**
```
GET  /register/psychologist - Display registration form
POST /register/psychologist - Process registration submission
```

**Middleware**
- `guest` middleware ensures only unauthenticated users can register
- `auth, role:admin` protects verification endpoints

**Validation Rules**
- Email: Required, valid format, unique in users table
- Password: Required, minimum 8 characters, confirmed
- STR Number: Required, unique in psychologist_profiles table
- Specialization: Required, string
- Biography: Required, minimum length enforced

### Security Considerations

- Password hashing with bcrypt algorithm
- CSRF token validation on form submission
- SQL injection prevention via Eloquent ORM
- XSS protection through Blade template escaping
- Unique constraint on STR numbers prevents duplicate credentials
- Middleware authorization on all protected routes

### Database Schema

No migration changes required. Uses existing structure:
- `users.role` - Determines user type and access level
- `psychologist_profiles.is_verified` - Controls account activation
- `psychologist_profiles.str_number` - Professional credential validation

### Administrative Routes

```
GET    /admin/dashboard              - Administrator dashboard
GET    /admin/users                  - User management interface
GET    /admin/psychologists          - Psychologist management
GET    /admin/patients               - Patient management
GET    /admin/appointments           - Appointment monitoring
POST   /admin/psychologists/{id}/verify   - Grant verification
POST   /admin/psychologists/{id}/unverify - Revoke verification
DELETE /admin/users/{id}             - Delete user account
```

All administrative routes protected by `auth, role:admin` middleware.

### UI/UX Implementation

**Responsive Design**
- Mobile-first approach with Tailwind CSS
- Grid layouts adapt to screen size
- Tables implement horizontal scrolling on mobile devices

**Visual Indicators**
- Role badges with color coding (Admin: Purple, Psychologist: Blue, Patient: Green)
- Verification status badges (Verified: Green, Pending: Yellow)
- Status-based styling for appointments

**User Feedback**
- Confirmation dialogs before destructive actions
- Success messages after operations
- Clear error messages with actionable guidance

**Accessibility**
- Quick action cards for common tasks
- Consistent navigation patterns
- Clear labeling and form instructions
