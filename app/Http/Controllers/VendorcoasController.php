<?php

namespace App\Http\Controllers;

use App\Product;
use App\Vendorcoa;
use Illuminate\Http\Request;

class VendorcoasController extends Controller
{

    public function index()
    {
        return view('vendorcoas.index')
            ->with('products', Product::all())
            ->with('vendorcoas', Vendorcoa::all());
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $coa = Vendorcoa::create([
            'product_id' => $request->product_id,
            'lot' => $request->lot,
            'created_by' => auth()->user()->id
        ]);

        if($request->hasFile('file')){
            $fullName = $request->file->getClientOriginalName();
            $fileName = pathinfo($fullName, PATHINFO_FILENAME);
            $fileExtension = pathinfo($fullName, PATHINFO_EXTENSION);
            $file = $fileName.'.'.$fileExtension;
            if($path = $request->file->storeAs('public/vcoas', $file)){
                $coa->files()->create([
                    'name' => $path
                ]);
            }
        }

        return back();
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
