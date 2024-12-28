<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Appointment;

class AppointmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'appointment_date' => $this->appointment_date,
            'client_name' => $this->client_name,
            'egn' => $this->egn,
            'description' => $this->description,
            'notification_method' => $this->notification_method->name,
            'user_id' => $this->user_id,
        ];
        
        if ($request->route()->getActionMethod() === 'show') {
            $data['other_appointments'] = Appointment::where('egn', $this->egn)
                ->where('id', '!=', $this->id)
                ->where('appointment_date', '>', now())
                ->get()
                ->map(function ($appointment) {
                    return [
                        'id' => $appointment->id,
                        'appointment_date' => $appointment->appointment_date,
                        'description' => $appointment->description,
                    ];
                });
        }

        return $data;
    }
}
