<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Psikolog\PsikologDashboardController;
use App\Http\Controllers\Psikolog\ProfileController as PsikologProfileController;
use App\Http\Controllers\Psikolog\JadwalController;
use App\Http\Controllers\Psikolog\AppointmentController as PsikologAppointmentController;
use App\Http\Controllers\Pasien\PsychologistController;
use App\Http\Controllers\Pasien\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Patient Dashboard (default)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:pasien'])->name('dashboard');

// Default Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ============================================
// ADMIN ROUTES
// ============================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Psychologist Management
    Route::get('/psychologists', [AdminController::class, 'psychologists'])->name('psychologists');
    Route::post('/psychologists/{id}/verify', [AdminController::class, 'verifyPsychologist'])->name('verify-psychologist');
    Route::post('/psychologists/{id}/unverify', [AdminController::class, 'unverifyPsychologist'])->name('unverify-psychologist');
    
    // Patient Management
    Route::get('/patients', [AdminController::class, 'patients'])->name('patients');
    
    // Appointment Management
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('appointments');
});

// ============================================
// PSYCHOLOGIST ROUTES
// ============================================
Route::middleware(['auth', 'role:psikolog'])->prefix('psikolog')->name('psikolog.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [PsikologDashboardController::class, 'index'])->name('dashboard');
    
    // Profile Management
    Route::get('/profile/edit', [PsikologProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [PsikologProfileController::class, 'update'])->name('profile.update');
    
    // Schedule Management (CRUD)
    Route::resource('jadwal', JadwalController::class);
    
    // Appointment Actions
    Route::post('/appointments/{id}/approve', [PsikologAppointmentController::class, 'approve'])->name('appointments.approve');
    Route::post('/appointments/{id}/reject', [PsikologAppointmentController::class, 'reject'])->name('appointments.reject');
    Route::post('/appointments/{id}/complete', [PsikologAppointmentController::class, 'complete'])->name('appointments.complete');
    Route::post('/appointments/{id}/meeting-link', [PsikologAppointmentController::class, 'updateMeetingLink'])->name('appointments.meeting-link');
});

// ============================================
// PATIENT ROUTES
// ============================================
Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    // Browse Psychologists
    Route::get('/psychologists', [PsychologistController::class, 'index'])->name('psychologists.index');
    Route::get('/psychologists/{id}', [PsychologistController::class, 'show'])->name('psychologists.show');
    
    // Booking
    Route::get('/booking/{psychologistId}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    
    // My Appointments
    Route::get('/appointments', [BookingController::class, 'myAppointments'])->name('appointments.index');
    Route::post('/appointments/{id}/cancel', [BookingController::class, 'cancel'])->name('appointments.cancel');
});

require __DIR__.'/auth.php';
