<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model

{
    protected $dates = [
        'created_at',
        'updated_at',
        'closed_at'
    ];

    protected $fillable = [
        'opened_by',
        'closed_by',
        'closed_at',
        'status',
        'hold_date'
    ];

    public function openedBy()
    {
        return $this->belongsTo(User::class, 'opened_by');
    }

    public function closedBy()
    {
        return $this->belongsTo(User::class, 'closed_by');
    }

    public function reopenboxes()
    {
        return $this->hasMany(ReopenedBoxes::class, 'box_id');
    }
}
