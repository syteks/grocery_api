<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GroceryListItemResource extends JsonResource
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
            'name' => $this->item->name,
            'grocery_list' => $this->groceryList->name,
            'created_by' => new MinimalUserResource($this->creator),
            'purchased_by' => new MinimalUserResource($this->purchaser),
            'was_purchased' => (bool) $this->was_purchased,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
