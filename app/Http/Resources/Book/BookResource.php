<?php

namespace App\Http\Resources\Book;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'uuid' => $this->uuid,
            'category' => [
                'uuid' => $this->category->uuid,
                'name' => $this->category->name,
            ],
            'title' => $this->title,
            'created_at' => date_format($this->created_at, "d/m/Y"),
        ];
    }
}
