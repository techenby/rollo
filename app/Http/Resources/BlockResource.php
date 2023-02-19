<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlockResource extends JsonResource
{
    public static $wrap = false;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->activity->title,
            'start' => $this->start,
            'end' => $this->end ?? now(),
            'backgroundColor' => $this->activity->color,
        ];
    }
}
