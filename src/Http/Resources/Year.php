<?php

namespace LaravelEnso\Holidays\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Year extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->year,
        ];
    }
}
