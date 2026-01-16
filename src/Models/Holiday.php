<?php

namespace LaravelEnso\Holidays\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Holiday extends Model
{
    protected $guarded = [];

    public function year(): Relation
    {
        return $this->belongsTo(HolidayYear::class, 'year_id');
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'is_working_day' => 'boolean',
        ];
    }
}
