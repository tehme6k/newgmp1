<?php

namespace App\Http\Controllers;


use App\Http\Requests\ApproveStatusRequest;
use App\Http\Requests\RejectBatchRequest;
use App\Project;
use App\User;
use App\Bpr;
use App\BprProduct;
use App\MprProduct;
use App\Product;
use App\Mpr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BprController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {

    }

    public function store(Request $request)
    {



        $MprProducts = MprProduct::where('mpr_id', $request->mpr_id)->get();

        $run_count = $request->run_count + 1;

        $pn = $request->project_id;


        $dt = Carbon::now();
        $dt = substr($dt->toDateString(), 2, 2);

        $count = str_pad($run_count, 3, "0", STR_PAD_LEFT);

        $lot = $pn.$dt.$count;

        $user = User::findOrFail(auth()->user()->id)->first();

        $bpr = $user->bpr()->create([
            'mpr_id' => $request->mpr_id,
            'lot_number' => $lot,
            'bottle_count' => $request->bottle_count * 1.05,
            'created_by' => auth()->user()->id,
            'project_id' => $request->project_id,
        ]);

        $project = Project::findOrFail($request->project_id);



        $project->update([
            'batch_count' => $count
        ]);

        foreach($MprProducts as $mprProduct){
            if($mprProduct->category_id == 1){
                $amount = $mprProduct->amount * 0.001 * $request->serving_size * ($request->bottle_count * 1.05) ;
            } else {
                $amount = $request->bottle_count * 1.05;
            }
            $bpr->products()->attach($mprProduct->product_id, ['amount' => $amount, 'category_id' => $mprProduct->category_id]);

            $product = Product::findOrFail($mprProduct->product_id)->first();

            $product->update([
                'total' => $product->total - $amount
            ]);
        }

        session()->flash('success', 'Batch created');

        return back();



//        $mprProducts = MprProduct::where('mpr_id', $request->mpr_id)->get();
//
//            foreach($mprProducts as $mprProduct){
//                dd($mprProduct->amount);
//            }


//        $mprs = Mpr::with('products')->toSql();
//
//        dd($mprs);
//
//
//        foreach($mprs as $mpr){
//            dd($mpr->products->pivot->amount);
//        }

//        $products = MprProduct::where('mpr_id', $request->mpr_id)->get();
//
//        $bpr = Bpr::create([
//            'mpr_id' => $request->mpr_id,
//            'project_id' => $request->project_id,
//            'lot_number' => '123401001',
//            'bottle_count' => 5250,
//            'created_by' => auth()->user()->id
//        ]);
//
//        foreach($products as $product){
//            dd($product->pivot);
//            $bpr->products()->attach($product->id, ['amount' => 500]);
//        }
    }

    public function show(Bpr $bpr)
    {


        return view('bprs.show')->with('bpr', $bpr);
    }


    public function approve(Bpr $bpr, ApproveStatusRequest $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if (Hash::check($request->password, $user->password)) {
            $bpr->update([
                'status' => 'approved',
                'approved_by' => $user_id
            ]);

            session()->flash('success', 'Batch Approved');

            return back();
        }
        else {
            session()->flash('fail', 'Approve Failed');

            return back();
        }
    }

    public function reject(Bpr $bpr, RejectBatchRequest $request)
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if (Hash::check($request->password, $user->password)) {
            $bpr->update([
                'status' => 'rejected',
                'approved_by' => $user->id,
                'reason' => $request->reason
            ]);

            session()->flash('success', 'Batch Rejected');

            return back();
        }
        else {
            session()->flash('fail', 'Rejection Failed');

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
