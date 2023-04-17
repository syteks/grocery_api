<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GroceryListUser extends Pivot
{
    /**
     * The table that the model represents.
     *
     * @var string
     */
    protected $table = 'grocery_list_user';

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
}
