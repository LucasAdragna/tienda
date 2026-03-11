<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_email',
        'customer_phone',
        'reservation_date',
        'people_count',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'reservation_date' => 'datetime',
        ];
    }
}
