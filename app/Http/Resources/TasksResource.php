<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title' => $this['title'],
            'description' => $this['description'],
            'status' => $this['status']
        ];
    }
}
