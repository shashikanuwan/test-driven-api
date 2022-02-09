<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'todo_list' => $this->todo_list->name,
            'created_at' => $this->created_at->diffForHumans()
        ];
    }
}