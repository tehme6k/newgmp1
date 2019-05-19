<?php

namespace App;


use Illuminate\Database\Eloquent\Relations\Pivot;

class MprProduct extends Pivot
{
    protected $fillable = [
        'mpr_id',
        'product_id',
        'amount',
        'category_id'
    ];
}
