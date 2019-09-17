<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use App\Vendor;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class VendorsController extends Controller
{

    public function index()
    {
        return view('vendors.index')
            ->with('vendors', Vendor::all())
            ->with('countries', Country::all());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try{
            Vendor::create([
                'name' => $request->name,
                'country_id' => $request->country_id,
                'user_id' => auth()->user()->id
            ]);
            session()->flash('success', 'Vendor Added');
            return redirect(route('vendors.index'));
        }
        catch (QueryException $e){
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                session()->flash('success', 'Type Already Exists');

                return view('errors.duplicate');
            }
        }

    }

    public function show(Vendor $vendor)
    {
        return view('vendors.show')
            ->with('vendor', $vendor);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
