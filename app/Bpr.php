<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bpr extends Model
{
    protected $fillable = [
        'mpr_id',
        'lot_number',
        'bottle_count',
        'created_by',
        'approved_by',
        'status',
        'project_id',
        'reason',
        'run_count'
    ];

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('amount', 'category_id');
    }

    public function powders()
    {
        return $this->belongsToMany(Product::class)->withPivot('amount', 'category_id')->where('products.category_id', 1);
    }

    public function mpr()
    {
        return $this->belongsTo(Mpr::class);
    }
}
