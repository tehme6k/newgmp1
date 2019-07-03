<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retention extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function inRetention($lot)
    {
        $retention = Retention::where('lot_number', $lot);
        if($retention)
        {
            return 'Lot already exists in system';
        }
    }
}
