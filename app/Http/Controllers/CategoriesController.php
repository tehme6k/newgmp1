<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoriesController extends Controller
{

    public function index()
    {
        return view('categories.index')->with('categories', Category::all());
    }

    public function store(CreateCategoryRequest $request)
    {
        try{

            Category::create([
                'name' => $request->name,
            ]);
            session()->flash('success', 'Category Added');
            return Redirect::route('categories.index');
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

    public function edit(Category $category)
    {
        return view('categories.create')->with('category', $category);
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
