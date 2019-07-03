<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Http\Requests\CreateProductRequest;
use App\Inventory;
use App\Product;
use App\Vendor;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {

        return view('products.index')
            ->with('categories', Category::all())
            ->with('products', Product::all())
            ->with('vendors', Vendor::all());
    }

    public function create()
    {
        return view('products.create')
            ->with('categories', Category::all())
            ->with('vendors', Vendor::all());
    }



    public function store(CreateProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'location' => $request->location,
            'cost' => $request->cost,
            'par' => $request->par,
            'created_by' => auth()->user()->id,

        ]);

        $product->vendors()->attach($request->vendors);

        session()->flash('success', 'Product Added');

        return redirect(route('products.index'));
    }

    public function show(Product $product)
    {
        $inventories = Inventory::where('product_id', $product->id)->get();

        $total = Inventory::where('product_id', $product->id)->where('status', 'approved');

//        if($product->category->name == 'Powder'){
//            $unit = 'Kg';
//        }else{
//            $unit = 'each';
//        }

        return view('products.show')
            ->with('product', $product)
            ->with('inventories', $inventories)
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
