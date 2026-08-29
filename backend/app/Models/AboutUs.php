<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    protected $table = 'sobre_nosotros';

    protected $primaryKey = 'so_id';

    public $timestamps = false;

    protected $fillable = [
        'so_titulo',
        'so_texto',
        'so_imagen',
        'so_pdf',
        'so_activo',
    ];

    protected function casts(): array
    {
        return [
            'so_activo' => 'boolean',
        ];
    }
}
