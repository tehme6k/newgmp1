<?php

namespace App\Http\Controllers;

use App\Bpr;
use App\Http\Requests\AddProductToMprRequest;
use App\Http\Requests\ApproveStatusRequest;
use App\Http\Requests\NewMprRequest;
use App\Mpr;
use App\User;
use App\MprProduct;
use App\Product;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MprController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(NewMprRequest $request)
    {
        //check if version already exists. if not, then set blank, it will auto to 1.
        //if there is a version, get it and increase it by 1.
        if($request->version < 0){
            $version = '';
        }else{
            $version = $request->version +1;
        }


        
        //create mpr
        Mpr::create([
            'project_id' => $request->project_id,
            'version' => $version,
            'serving_size' => $request->serving_size,
            'created_by' => auth()->user()->id
        ]);

        session()->flash('success', 'Mpr Created Successfully');

        return back();
    }

    public function show(Mpr $mpr)
    {

        $powders = MprProduct::where('mpr_id', $mpr->id)->where('category_id', 1)->get();
        $bottles = MprProduct::where('mpr_id', $mpr->id)->where('category_id', 2)->get();
        $lids = MprProduct::where('mpr_id', $mpr->id)->where('category_id', 3)->get();
        $scoops = MprProduct::where('mpr_id', $mpr->id)->where('category_id', 4)->get();
        $labels = MprProduct::where('mpr_id', $mpr->id)->where('category_id', 5)->get();
        $desiccants = MprProduct::where('mpr_id', $mpr->id)->where('category_id', 6)->get();

//        dd($bottles);

        $bprs = Bpr::where('mpr_id', $mpr->id)
            ->where('status', 'quarantine')
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();

        return view('mprs.show')
            ->with('mpr', $mpr)
            ->with('bprs', $bprs)
            ->with('powders', $powders)
            ->with('bottles', $bottles)
            ->with('lids', $lids)
            ->with('scoops', $scoops)
            ->with('labels', $labels)
            ->with('desiccants', $desiccants)
            ->with('allProducts', Product::all());
    }

    public function addProduct(AddProductToMprRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        MprProduct::create([
            'mpr_id' => $request->mpr_id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'category_id' => $product->category->id
        ]);

        session()->flash('success', 'Item added!');

        return back();
    }

    public function approve(Mpr $mpr, ApproveStatusRequest $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);


        $sum = $mpr->powders()->sum('amount');

        $gpb = ($sum * $mpr->serving_size) / 1000;



        if (Hash::check($request->password, $user->password)) {
            $mpr->update([
                'approved_by' => auth()->user()->id,
                'status' => 'approved',
                'gpb' => $gpb
            ]);

            session()->flash('success', 'Item Approved');

            return back();
        }
        else {
            session()->flash('fail', 'Approval Failed');

            return back();
        }
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
