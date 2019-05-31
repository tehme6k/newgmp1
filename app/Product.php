<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'created_by'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function inventories(){
        return $this->hasMany(Inventory::class);
    }

    public function mprs()
    {
        return $this->belongsToMany(Mpr::class)->with('amount');
    }

    public function vendor(){
        return $this->belongsToMany(Vendor::class);
    }
}
