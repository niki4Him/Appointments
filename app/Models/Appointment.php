<?php

namespace App\Models;

use App\Models\Enums\NotificationEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'appointment_date',
        'client_name',
        'egn',
        'description',
        'notification_method'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'notification_method' => NotificationEnum::class
        ];
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
