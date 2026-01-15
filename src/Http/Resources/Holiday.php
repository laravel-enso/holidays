<?php

namespace LaravelEnso\Holidays\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Holiday extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'year' => $this->whenLoaded('year')->year,
            'name' => $this->name,
            'description' => $this->description,
            'isEditable' => $this->is_working_day,
            'createdAt' => $this->created_at->toDatetimeString(),
            'updatedAt' => $this->updated_at->toDatetimeString(),
        ];
    }
}
