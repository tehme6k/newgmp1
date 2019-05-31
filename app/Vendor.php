<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $guarded = [];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }
}
