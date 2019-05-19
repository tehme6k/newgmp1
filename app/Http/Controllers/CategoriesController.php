<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index()
    {
        return view('categories.index')->with('categories', Category::all());
    }

    public function store(CreateCategoryRequest $request)
    {
        //get current user
        $user = User::findOrFail(auth()->user()->id)->first();

        //create new category created by current user
        $user->category()->create([
            'name' => $request->name,
        ]);

        session()->flash('success', 'Category Added');

        return back();
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
