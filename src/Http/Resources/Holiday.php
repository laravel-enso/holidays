<?php

namespace LaravelEnso\Holidays\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Config;

class Holiday extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date->format(Config::get('enso.config.dateFormat')),
            'month' => $this->date->month,
            'name' => $this->name,
            'description' => $this->description,
            'isWorkingDay' => $this->is_working_day,
        ];
    }
}
