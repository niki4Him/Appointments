<?php

namespace App\Observers;

use App\Models\Appointment;
use Log;

class AppointmentObserver
{
    /**
     * Handle the Appointment "created" event.
     */
    public function created(Appointment $appointment): void
    {
        $this->notifyUser($appointment, 'Създаден е нов час.');
    }

    /**
     * Handle the Appointment "updated" event.
     */
    public function updated(Appointment $appointment): void
    {
        $this->notifyUser($appointment, 'Часът е обновен.');
    }

    /**
     * Handle the Appointment "deleted" event.
     */
    public function deleted(Appointment $appointment): void
    {
        $this->notifyUser($appointment, 'Часът е изтрит.');
    }

    /**
     * Notify the user with a custom message.
     */
    private function notifyUser(Appointment $appointment, $message)
    {
        // Симулирано изпращане на съобщение
        $notificationMethod = $appointment->notification_method->name;
        
        // бъдещо разширение с Push нотификации
        if ($notificationMethod === 'PUSH') {
            // https://github.com/kreait/laravel-firebase - добро за push notifications..
            Log::info("Изпращане на Push нотификация до {$appointment->client_name}: {$message}");
        }

        // Тук просто записваме лог като замяна на реално изпращане
        Log::info("Уведомление за потребителя {$appointment->client_name} ({$appointment->egn}): {$message} чрез {$notificationMethod}.");
    }
}
