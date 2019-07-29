<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $guarded = [];

    public function bpr(){
        return $this->belongsTo(Bpr::class);
    }
}
