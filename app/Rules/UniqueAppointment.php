<?php

namespace App\Rules;

use App\Models\Appointment;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueAppointment implements ValidationRule
{
    protected $userId;
    protected $appointmentId;

    /**
     * Constructor to pass user ID and (optionally) the appointment ID.
     */
    public function __construct($userId, $appointmentId = null)
    {
        $this->userId = $userId;
        $this->appointmentId = $appointmentId;
    }

    /**
     * Validate the rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $existingAppointment = Appointment::where('user_id', $this->userId)
            ->where('appointment_date', $value)
            ->where('egn', request()->input('egn'))
            ->when($this->appointmentId, function ($query) {
                $query->where('id', '!=', $this->appointmentId);
            })
            ->exists();

        if ($existingAppointment) {
            $fail('Вече имате записан час за това ЕГН в същия час.');
        }
    }
}
