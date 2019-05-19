<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateProductRequest;
use App\Inventory;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return view('products.index')->with('categories', Category::all())->with('products', Product::all());
    }

    public function store(CreateProductRequest $request)
    {
        $user = User::find(auth()->user()->id)->first();

        $user->product->create([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

//        Product::create([
//
//            'created_by' => auth()->user()->id
//        ]);

        session()->flash('success', 'Product Added');

        return redirect(route('products.index'));
    }

    public function show(Product $product)
    {
        $inventories = Inventory::where('product_id', $product->id)->get();

        $total = Inventory::where('product_id', $product->id)->where('status', 'approved');

        if($product->category->name == 'Powder'){
            $unit = 'Kg';
        }else{
            $unit = 'each';
        }

        return view('products.show')
            ->with('product', $product)
            ->with('inventories', $inventories)
            ->with('unit', $unit)
            ->with('total', $total);
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
