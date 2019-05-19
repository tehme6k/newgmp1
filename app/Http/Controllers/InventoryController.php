<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\AddFileRequest;
use App\Http\Requests\ApproveStatusRequest;
use App\Http\Requests\InventoryPowderReceiveRequest;
use App\Http\Requests\InventoryNonPowderReceiveRequest;
use App\Http\Requests\RejectStatusRequest;
use App\Http\Requests\InventoryNonPowderAdjustmentRequest;
use App\Http\Requests\InventoryPowderAdjustmentRequest;
use App\Inventory;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InventoryController extends Controller
{
    public function index()
    {
        $products = Product::paginate(25);


        return view('inventory.index')
            ->with('products', $products);
    }

    public function create()
    {
        //
    }

    public function powderstore(InventoryPowderAdjustmentRequest $request)
    {
        //conversion variables
        $lbs_kg = 0.45359237;
        $g_kg = 0.001;
        $amount = $request->amount;

        //perform conversions on amount if grams or pounds was used
        if($request->unit === 'lb'){
            $amount = $request->amount * $lbs_kg;
        }elseif($request->unit === 'g'){
            $amount = $request->amount * $g_kg;
        }

        //set amount to negative if removing
        if($request->adjustment_method == 'remove'){
            $amount = $amount * -1;
        }

        //create inventory adjustment
        $inventory = Inventory::create([
            'product_id' => $request->product_id,
            'amount' => $amount,
            'reason' => $request->reason,
            'type' => 'adjustment',
            'created_by' => auth()->user()->id
        ]);

        if($request->hasFile('file')){
            $fullName = $request->file->getClientOriginalName();
            $fileName = $inventory->product_id .'_'. time();
            $fileExtension = pathinfo($fullName, PATHINFO_EXTENSION);
            $file = $fileName.'.'.$fileExtension;
            if($path = $request->file->storeAs('coas/'.$request->category, $file, 'public')){
                $inventory->files()->create([
                    'name' => $path
                ]);
            }
        }



        session()->flash('success', 'Adjustment made to inventory successfully');

        return back();
    }

    public function nonpowderstore(InventoryNonPowderAdjustmentRequest $request)
    {
        if($request->action == 'add'){
            $amount = $request->amount;
        }elseif($request->action == 'remove'){
            $amount = $request->amount * -1;
        }



        $inventory = Inventory::create([
            'product_id' => $request->product_id,
            'amount' => $amount,
            'type' => 'adjustment',
            'reason' => $request->reason,
            'created_by' => auth()->user()->id

        ]);

        if($request->hasFile('file')){
            $fullName = $request->file->getClientOriginalName();
            $fileName = $inventory->product_id .'_'. time();
            $fileExtension = pathinfo($fullName, PATHINFO_EXTENSION);
            $file = $fileName.'.'.$fileExtension;
            if($path = $request->file->storeAs('coas/'.$request->category, $file, 'public')){
                $inventory->files()->create([
                    'name' => $path
                ]);
            }
        }

        session()->flash('success', 'Adjustment made to inventory successfully');

        return back();
    }

    public function powderReceive(InventoryPowderReceiveRequest $request)
    {
        //conversion variables
        $lbs_kg = 0.45359237;
        $g_kg = 0.001;
        $amount = $request->amount;

        //perform conversions on amount if grams or pounds was used
        if($request->unit === 'lb'){
            $amount = $request->amount * $lbs_kg;
        }elseif($request->unit === 'g'){
            $amount = $request->amount * $g_kg;
        }


        //create inventory adjustment
        $inventory = Inventory::create([
            'product_id' => $request->product_id,
            'amount' => $amount,
            'type' => 'receive',
            'lot' => $request->lot,
            'expiration_date' => $request->expiration_date,
            'created_by' => auth()->user()->id
        ]);

        if($request->hasFile('file')){
            $fullName = $request->file->getClientOriginalName();
            $fileName = $inventory->product_id .'_'. time();
            $fileExtension = pathinfo($fullName, PATHINFO_EXTENSION);
            $file = $fileName.'.'.$fileExtension;
            if($path = $request->file->storeAs('coas/'.$request->category, $file, 'public')){
                $inventory->files()->create([
                    'name' => $path
                ]);
            }
        }



        session()->flash('success', 'Product received to inventory successfully');

        return back();
    }

    public function nonpowderReceive(InventoryNonPowderReceiveRequest $request)
    {
        //conversion variables
        $lbs_kg = 0.45359237;
        $g_kg = 0.001;
        $amount = $request->amount;

        //perform conversions on amount if grams or pounds was used
        if($request->unit === 'lb'){
            $amount = $request->amount * $lbs_kg;
        }elseif($request->unit === 'g'){
            $amount = $request->amount * $g_kg;
        }


        //create inventory adjustment
        $inventory = Inventory::create([
            'product_id' => $request->product_id,
            'amount' => $amount,
            'type' => 'receive',
            'lot' => $request->lot,
            'expiration_date' => $request->expiration_date,
            'created_by' => auth()->user()->id
        ]);

        if($request->hasFile('file')){
            $fullName = $request->file->getClientOriginalName();
            $fileName = $inventory->product_id .'_'. time();
            $fileExtension = pathinfo($fullName, PATHINFO_EXTENSION);
            $file = $fileName.'.'.$fileExtension;
            if($path = $request->file->storeAs('coas/'.$request->category, $file, 'public')){
                $inventory->files()->create([
                    'name' => $path
                ]);
            }
        }



        session()->flash('success', 'Product received to inventory successfully');

        return back();
    }

    public function show(Inventory $inventory)
    {

        $total = Inventory::where('product_id', $inventory->product->id)->where('status', 'approved');


        if($inventory->product->category->name == 'Powder'){
            $unit = 'Kg';
        }else{
            $unit = 'each';
        }



        return view('inventory.show')
            ->with('inventory', $inventory)
            ->with('total', $total)
            ->with('unit');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function approve(Inventory $inventory, ApproveStatusRequest $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if (Hash::check($request->password, $user->password)) {
            $inventory->update([
                'status' => 'approved'
            ]);

            session()->flash('success', 'Item Approved');

            return redirect()->route('products.show', ['id' => $inventory->product->id]);

        }
        else {
            session()->flash('fail', 'Approval Failed');

            return back();
        }
    }

    public function reject(Inventory $inventory, RejectStatusRequest $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if (Hash::check($request->password, $user->password)) {
            $inventory->update([
                'status' => 'rejected'
            ]);

            session()->flash('success', 'Item Rejected');

            return redirect()->route('products.show', ['id' => $inventory->product->id]);
        }
        else {
            session()->flash('fail', 'Rejection Failed');

            return back();
        }
    }

    public function newFile(Inventory $inventory, AddFileRequest $request)
    {
        if($request->hasFile('file')){
            $fullName = $request->file->getClientOriginalName();
            $fileName = $inventory->product_id .'_'. time();
            $fileExtension = pathinfo($fullName, PATHINFO_EXTENSION);
            $file = $fileName.'.'.$fileExtension;
            if($path = $request->file->storeAs('coas/'.$request->category, $file, 'public')){
                $inventory->files()->create([
                    'name' => $path
                ]);
            }
        }

        session()->flash('success', 'File Added');

        return back();
    }
}
