<?php

namespace LaravelEnso\Holidays\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class HolidayYear extends Model
{
    protected $guarded = [];

    public function holidays(): Relation
    {
        return $this->hasMany(Holiday::class, 'year_id');
    }
}
