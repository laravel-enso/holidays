<?php

namespace LaravelEnso\Holidays\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use LaravelEnso\Tables\Traits\TableCache;

class Holiday extends Model
{
    use TableCache;

    protected $guarded = [];

    public function holidayYear(): Relation
    {
        return $this->belongsTo(HolidayYear::class);
    }

    public function casts()
    {
        return [
            'date' => 'date',
            'is_working_day' => 'boolean',
        ];
    }
}
