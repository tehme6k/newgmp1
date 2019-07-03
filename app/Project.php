<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'type_id',
        'created_by',
        'flavor',
        'country_id',
        'batch_count'
    ];

    public function type()
    {
        return$this->belongsTo(Type::class);
    }

    public function country()
    {
        return$this->belongsTo(Country::class);
    }

    public function createdBy()
    {
        return$this->belongsTo(User::class, 'created_by');
    }


}
