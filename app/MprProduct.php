<?php

namespace App;


use Illuminate\Database\Eloquent\Relations\Pivot;

class MprProduct extends Pivot
{
    public $timestamps = false;

    protected $fillable = [
        'mpr_id',
        'product_id',
        'amount',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
