<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PsychologistProfile;
use App\Models\Jadwal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin PsychoConnect',
            'email' => 'admin@psychoconnect.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Psychologist 1
        $psikolog1 = User::create([
            'name' => 'Dr. Sarah Williams',
            'email' => 'sarah@psychoconnect.com',
            'password' => Hash::make('password'),
            'role' => 'psikolog',
        ]);

        PsychologistProfile::create([
            'user_id' => $psikolog1->id,
            'specialization' => 'Psikologi Klinis & Terapi Kognitif',
            'bio' => 'Berpengalaman 10 tahun dalam menangani kecemasan, depresi, dan gangguan mood. Menggunakan pendekatan Cognitive Behavioral Therapy (CBT).',
            'str_number' => 'STR-2024-001',
            'is_verified' => true,
        ]);

        // Add schedules for Psikolog 1
        Jadwal::create([
            'user_id' => $psikolog1->id,
            'day_of_week' => 'Monday',
            'start_time' => '09:00',
            'end_time' => '12:00',
            'is_available' => true,
        ]);

        Jadwal::create([
            'user_id' => $psikolog1->id,
            'day_of_week' => 'Wednesday',
            'start_time' => '14:00',
            'end_time' => '17:00',
            'is_available' => true,
        ]);

        // Create Psychologist 2
        $psikolog2 = User::create([
            'name' => 'Dr. Michael Chen',
            'email' => 'michael@psychoconnect.com',
            'password' => Hash::make('password'),
            'role' => 'psikolog',
        ]);

        PsychologistProfile::create([
            'user_id' => $psikolog2->id,
            'specialization' => 'Psikologi Anak & Remaja',
            'bio' => 'Spesialis dalam menangani masalah perkembangan anak, ADHD, dan kesulitan belajar. Berpengalaman 8 tahun.',
            'str_number' => 'STR-2024-002',
            'is_verified' => true,
        ]);

        Jadwal::create([
            'user_id' => $psikolog2->id,
            'day_of_week' => 'Tuesday',
            'start_time' => '10:00',
            'end_time' => '13:00',
            'is_available' => true,
        ]);

        Jadwal::create([
            'user_id' => $psikolog2->id,
            'day_of_week' => 'Friday',
            'start_time' => '15:00',
            'end_time' => '18:00',
            'is_available' => true,
        ]);

        // Create Psychologist 3 (Unverified)
        $psikolog3 = User::create([
            'name' => 'Dr. Amanda Brown',
            'email' => 'amanda@psychoconnect.com',
            'password' => Hash::make('password'),
            'role' => 'psikolog',
        ]);

        PsychologistProfile::create([
            'user_id' => $psikolog3->id,
            'specialization' => 'Psikologi Keluarga & Pernikahan',
            'bio' => 'Konselor pernikahan dan terapis keluarga dengan pengalaman 5 tahun.',
            'str_number' => 'STR-2024-003',
            'is_verified' => false, // Not verified yet
        ]);

        // Create Patient 1
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);

        // Create Patient 2
        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'pasien',
        ]);
    }
}
