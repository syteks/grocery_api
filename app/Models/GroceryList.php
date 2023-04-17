<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GroceryList extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * Gets items that are found in the list.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\Item>
     */
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class)
            ->using(GroceryListItem::class)
            ->withPivot(['id', 'purchased_by', 'created_by', 'was_purchased']);
    }

    /**
     * Gets the users that are associated with the list.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\User>
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->using(GroceryListUser::class)
            ->withPivot(['id']);
    }

    /**
     * Gets the creator of the grocery list.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\User>
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
