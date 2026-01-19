# PsychoConnect

A professional telehealth platform connecting patients with licensed psychologists for online counseling sessions.

## Overview

PsychoConnect is a Laravel-based web application designed to facilitate mental health consultations through secure online appointments. The platform features role-based access control for administrators, psychologists, and patients, with integrated AI-powered mood analysis for patient journaling.

## Core Features

### Administrative Panel
- User management across all roles
- Psychologist verification and credential review
- System-wide appointment monitoring
- Comprehensive dashboard with statistical insights

### Psychologist Portal
- Professional profile management with specialization and credentials
- Schedule management for available consultation hours
- Appointment request handling and approval workflow
- Meeting link integration for virtual sessions
- Patient mood monitoring dashboard with trend visualization

### Patient Portal
- Browse verified psychologist directory with detailed profiles
- Schedule appointments based on psychologist availability
- Daily AI-powered mood journal with sentiment analysis
- Appointment status tracking and meeting access
- Historical mood trend visualization

## Technology Stack

- **Framework**: Laravel 12.x
- **Backend**: PHP 8.3
- **Database**: MySQL 8.0
- **Authentication**: Laravel Breeze
- **Frontend**: Blade Templates, Tailwind CSS
- **Charts**: Chart.js
- **AI Integration**: Python Flask API for mood analysis

## System Requirements

- PHP >= 8.2
- Composer >= 2.0
- Node.js >= 18.x
- MySQL >= 8.0

## Installation

1. Clone the repository:
```bash
git clone https://github.com/wildhanry/psychoconnect-telehealth.git
cd psychoconnect-telehealth
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Database setup in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=psychoconnect
DB_USERNAME=root
DB_PASSWORD=
```

5. Run migrations and seeders:
```bash
php artisan migrate --seed
```

6. Build assets:
```bash
npm run build
```

7. Start development server:
```bash
php artisan serve
```

Access the application at `http://127.0.0.1:8000`

## Default Credentials

After seeding, use these credentials for testing:

**Administrator**
- Email: admin@psychoconnect.com
- Password: password

**Verified Psychologists**
- dr. Sarah Williams: sarah@psychoconnect.com
- dr. Michael Chen: michael@psychoconnect.com
- Password: password

**Patients**
- John Doe: john@example.com
- Jane Smith: jane@example.com
- Password: password

## Database Schema

### Primary Tables
- `users`: User accounts with role-based authentication
- `psychologist_profiles`: Psychologist credentials and verification status
- `jadwals`: Weekly schedule availability for psychologists
- `janji_temus`: Appointment records with status tracking
- `journals`: Patient daily journals with AI mood analysis results

## Security Features

- Role-based middleware for access control
- CSRF protection on all forms
- Password hashing with bcrypt
- SQL injection prevention through Eloquent ORM
- XSS protection via Blade templating

## API Integration

The system integrates with a Python Flask API for AI-powered mood analysis:
- Endpoint: `https://wildhanry.pythonanywhere.com/predict`
- Method: POST
- Input: Journal content text
- Output: Mood label, score, and confidence percentage

## License

This project is licensed under the MIT License.

## Support

For technical support or feature requests, please open an issue on the GitHub repository.
