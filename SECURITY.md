# Security Policy

## 🔒 Security Best Practices

This document outlines security considerations and best practices for deploying PsychoConnect.

---

## 🛡️ Environment Configuration

### Critical: Never Commit `.env` File

The `.env` file contains sensitive credentials and must **NEVER** be committed to version control.

**Protected Information:**
- `APP_KEY` - Application encryption key
- `DB_PASSWORD` - Database credentials
- `AI_SERVICE_URL` - External API endpoints
- Mail server credentials
- AWS/cloud service keys

**Verification:**
```bash
# Ensure .env is in .gitignore
cat .gitignore | grep "^.env$"

# Check if .env is tracked
git status --ignored | grep ".env"
```

---

## 🔐 Authentication & Authorization

### Implemented Security Features

✅ **Password Security**
- Bcrypt hashing (12 rounds)
- Minimum 8 characters required
- Password confirmation on registration

✅ **Role-Based Access Control (RBAC)**
- Three roles: `admin`, `psikolog`, `pasien`
- Middleware-based route protection
- User-level data isolation

✅ **Session Security**
- Database-driven sessions
- 120-minute session lifetime
- CSRF token protection on all forms

---

## 🗄️ Database Security

### Data Isolation

Users can only access their own data:

```php
// ✅ CORRECT: Scoped to authenticated user
$journals = Journal::where('user_id', auth()->id())->get();

// ❌ WRONG: Exposes all users' data
$journals = Journal::all();
```

### SQL Injection Prevention

- ✅ Use Eloquent ORM (automatic parameter binding)
- ✅ Avoid raw queries
- ✅ Validate all user inputs

---

## 🌐 API Security

### External AI Service

**Current Implementation:**
- API URL stored in environment variable
- 10-second timeout to prevent hanging
- Graceful fallback on API failure
- No API authentication (public endpoint)

⚠️ **Recommendation for Production:**
```bash
# Add API authentication
AI_SERVICE_URL=https://your-service.com
AI_SERVICE_API_KEY=your-secret-api-key
```

**Rate Limiting:**
```php
// Add to routes/web.php
Route::middleware('throttle:60,1')->group(function () {
    // AI-dependent routes
});
```

---

## 📊 Data Privacy (Medical Data Compliance)

### ⚠️ Current Limitations

The system currently **DOES NOT** implement:
- ❌ Encryption of journal content at rest
- ❌ Audit logging for data access
- ❌ Patient consent management
- ❌ HIPAA/GDPR compliance features
- ❌ Data retention policies
- ❌ Right to be forgotten

### 🚀 Recommended Enhancements for Production

#### 1. Encrypt Sensitive Data
```php
// Migration
Schema::table('journals', function (Blueprint $table) {
    $table->text('content')->change(); // Will be encrypted
});

// Model
use Illuminate\Database\Eloquent\Casts\Encrypted;

class Journal extends Model
{
    protected $casts = [
        'content' => Encrypted::class,
    ];
}
```

#### 2. Audit Logging
```php
// Create audit_logs table
Schema::create('audit_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->string('action'); // 'view', 'edit', 'delete'
    $table->string('resource'); // 'journal', 'appointment'
    $table->foreignId('resource_id')->nullable();
    $table->ipAddress('ip_address');
    $table->timestamps();
});
```

#### 3. Patient Consent
```php
// Add to users table
$table->boolean('consent_ai_analysis')->default(false);
$table->boolean('consent_data_sharing')->default(false);
$table->timestamp('consent_given_at')->nullable();
```

---

## 🚨 Vulnerability Disclosure

### Reporting Security Issues

If you discover a security vulnerability, please **DO NOT** open a public issue.

**Contact:**
- Email: (Add your email)
- Encrypt sensitive reports using GPG (optional)

**Response Time:**
- Initial response: 48 hours
- Fix timeline: Based on severity

---

## ✅ Pre-Deployment Checklist

Before deploying to production:

- [ ] `APP_ENV=production` in `.env`
- [ ] `APP_DEBUG=false` in `.env`
- [ ] Generate unique `APP_KEY`: `php artisan key:generate`
- [ ] Use HTTPS/SSL certificate
- [ ] Configure proper database credentials
- [ ] Set secure `SESSION_DOMAIN` and `SESSION_SECURE=true`
- [ ] Enable rate limiting on authentication routes
- [ ] Configure proper CORS headers
- [ ] Set up regular database backups
- [ ] Enable error logging (not display)
- [ ] Review and restrict file upload permissions
- [ ] Configure Content Security Policy (CSP) headers

---

## 📝 Security Updates

### Dependency Management

Keep Laravel and dependencies up to date:

```bash
# Check for outdated packages
composer outdated

# Update dependencies
composer update

# Audit for known vulnerabilities
composer audit
```

### Laravel Security Releases

Monitor: https://laravel.com/docs/security

---

## 🔍 Code Review Guidelines

### Security Checklist for Pull Requests

- [ ] No hardcoded credentials or API keys
- [ ] All user inputs validated and sanitized
- [ ] Proper authorization checks on all routes
- [ ] No sensitive data in error messages
- [ ] CSRF protection on all state-changing operations
- [ ] SQL queries use parameter binding
- [ ] File uploads restricted and validated
- [ ] Session handling follows best practices

---

## 📚 Additional Resources

- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Laravel Security Best Practices](https://laravel.com/docs/security)
- [HIPAA Compliance Guide](https://www.hhs.gov/hipaa/index.html)
- [GDPR Requirements](https://gdpr.eu/)

---

**Last Updated:** January 19, 2026  
**Version:** 1.0
