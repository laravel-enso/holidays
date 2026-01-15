<?php

namespace LaravelEnso\Holidays\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use LaravelEnso\Tables\Traits\TableCache;

class HolidayYear extends Model
{
    use TableCache;

    protected $guarded = [];

    public function holidays():Relation
    {
        return $this->hasMany(Holiday::class);
    }
    //
}
