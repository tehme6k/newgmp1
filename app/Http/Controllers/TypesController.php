<?php

namespace App\Http\Controllers;

use App\Type;
use App\Http\Requests\CreateTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;

class TypesController extends Controller
{

    public function index()
    {
        $types = Type::all();

        return view('types.index')->with('types', $types);
    }

    public function create()
    {
        return view('types.create');
    }

    public function store(CreateTypeRequest $request)
    {
        try{
            Type::create([
                'name' => $request->name
            ]);

            session()->flash('success', 'Type Added');

            return Redirect::route('types.index');
        }
        catch (QueryException $e){
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                session()->flash('success', 'Type Already Exists');

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
