<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $primaryKey = 's_id';

    public $timestamps = false;

    protected $fillable = [
        's_titulo',
        's_texto',
        's_imagen',
        's_tag',
        's_link',
        's_orden',
        's_visible',
        's_activo',
    ];

    protected function casts(): array
    {
        return [
            's_tag' => 'integer',
            's_orden' => 'integer',
            's_visible' => 'integer',
            's_activo' => 'integer',
        ];
    }
}
