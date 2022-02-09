<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LabelResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'color' => $this->color,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
