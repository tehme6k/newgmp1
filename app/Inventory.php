<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'product_id',
        'input_unit',
        'input_amount',
        'use_amount',
        'vendor_id',
        'vendor_lot',
        'notes',
        'status',
        'expiration_date',
        'type',
        'created_by',
        'updated_by',
        'remove_on_reject'

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

}
