<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroceryListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sharing_code' => $this->sharing_code,
            'creator' => new MinimalUserResource($this->creator),
            'items' => GroceryListItemResource::collection($this->items->map(fn ($item) => $item->pivot)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
