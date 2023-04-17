<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    /**
     * Attributes that are not mass assignables.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * The grocery list that the item was created from.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\GroceryList>
     */
    public function groceryList(): BelongsTo
    {
        return $this->belongsTo(GroceryList::class);
    }
}
