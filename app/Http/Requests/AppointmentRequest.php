<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Rules\UniqueAppointment;
use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function rules(): array
    {
        $appointmentId = $this->route('appointment')?->id;

        return [
            'appointment_date' => [
                'required',
                'date',
                'after:now',
                new UniqueAppointment(auth()->id(), $appointmentId),
            ],
            'client_name' => 'required|string|max:255',
            'egn' => 'required|digits:10',
            'description' => 'nullable|string',
            'notification_method' => 'required|in:SMS,Email',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
