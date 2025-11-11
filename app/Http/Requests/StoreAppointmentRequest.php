<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Jadwal;
use Carbon\Carbon;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'psikolog_id' => 'required|exists:users,id',
            'schedule_date' => 'required|date|after_or_equal:today',
            'schedule_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Ensure patient cannot book themselves
            if ($this->psikolog_id == $this->user()->id) {
                $validator->errors()->add('psikolog_id', 'Anda tidak dapat membuat janji dengan diri sendiri.');
            }

            // Ensure the psychologist has schedule for the selected date/time
            $dayOfWeek = Carbon::parse($this->schedule_date)->format('l'); // e.g., "Monday"
            $scheduleTime = $this->schedule_time;

            $hasSchedule = Jadwal::where('user_id', $this->psikolog_id)
                ->where('day_of_week', $dayOfWeek)
                ->where('is_available', true)
                ->where('start_time', '<=', $scheduleTime)
                ->where('end_time', '>=', $scheduleTime)
                ->exists();

            if (!$hasSchedule) {
                $validator->errors()->add('schedule_time', 'Psikolog tidak tersedia pada waktu yang dipilih.');
            }
        });
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'psikolog_id.required' => 'Pilih psikolog terlebih dahulu.',
            'psikolog_id.exists' => 'Psikolog tidak ditemukan.',
            'schedule_date.required' => 'Tanggal harus diisi.',
            'schedule_date.after_or_equal' => 'Tanggal tidak boleh di masa lalu.',
            'schedule_time.required' => 'Waktu harus diisi.',
            'schedule_time.date_format' => 'Format waktu tidak valid.',
        ];
    }
}
