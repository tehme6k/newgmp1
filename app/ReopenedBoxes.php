<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Box;


class ReopenedBoxes extends Model
{
    protected $guarded = [];

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by_id');
    }
}
