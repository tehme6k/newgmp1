<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BprProduct extends Pivot
{
    protected $fillable = [
        'bpr_id',
        'product_id',
        'amount',
        'category_id'
    ];
}
