<?php

namespace App\Http\Controllers;

use App\Country;
use App\Http\Requests\CreateCountryRequest;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CountriesController extends Controller
{

    public function index()
    {
        return view('countries.index')
            ->with('countries', Country::all());
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(CreateCountryRequest $request)
    {
        try{
            $user = User::findOrFail(auth()->user()->id)->first();
            Country::create([
                'name' => $request->name,
                'abr' => $request->abr,
                'created_by' => $user->id
            ]);

            session()->flash('success', 'Country Added');

            return Redirect::route('countries.index');
        }
        catch (QueryException $e){
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                session()->flash('success', 'Country Already Exists');

                return view('errors.duplicate');
            }
        }


    }

    public function show($id)
    {
        //
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
