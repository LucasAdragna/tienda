<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['title', 'description', 'cta_label', 'cta_url', 'starts_on', 'ends_on', 'is_active'];

    protected function casts(): array
    {
        return ['starts_on' => 'date:Y-m-d', 'ends_on' => 'date:Y-m-d', 'is_active' => 'boolean'];
    }

    public function scopeCurrent(Builder $query): Builder
    {
        $today = today(config('app.timezone'))->toDateString();

        return $query->where('is_active', true)->whereDate('starts_on', '<=', $today)->whereDate('ends_on', '>=', $today);
    }
}
