<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

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

    public function vendors(){
        return $this->belongsToMany(Vendor::class);
    }
}
