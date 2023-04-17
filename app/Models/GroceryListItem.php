<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroceryListItem extends Pivot
{
    /**
     * The table that the model represents.
     *
     * @var string
     */
    protected $table = 'grocery_list_item';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The purchaser of the grocery list item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User>
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * The purchaser of the grocery list item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User>
     */
    public function purchaser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'purchased_by', 'id');
    }

    /**
     * The grocery list that the pivot is part of.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\GroceryList>
     */
    public function groceryList(): BelongsTo
    {
        return $this->belongsTo(GroceryList::class);
    }

    /**
     * The item that is associated with the grocery list item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\Item>
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
