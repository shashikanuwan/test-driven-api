<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TodoListResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}
