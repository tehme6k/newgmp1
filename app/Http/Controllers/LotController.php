<?php

namespace App\Http\Controllers;

use App\Inventory;
use Illuminate\Http\Request;

class LotController extends Controller
{
    public function show (Inventory $inventory)
    {
        return view('inventory.lot.show')->with('inventory', $inventory);
    }


    public function create(Inventory $inventory)
    {
        return $inventory->vendor_lot;
    }
}
